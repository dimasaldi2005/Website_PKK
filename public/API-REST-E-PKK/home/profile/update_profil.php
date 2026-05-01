<?php
header('Content-Type: application/json');
require '../../config/config.php';

date_default_timezone_set('Asia/Jakarta');
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!$koneksi) {
            throw new Exception("Database connection failed", 500);
        }

        $input = json_decode(file_get_contents('php://input'), true);
        
        if (empty($input['id'])) {
            throw new Exception("User ID is required", 400);
        }
        $userId = intval($input['id']);

        // Initialize update data
        $updateData = [];
        $updateType = '';

        // Profile Info Update
        if (!empty($input['full_name']) || !empty($input['phone_number'])) {
            $updateType = 'profile';
            
            if (!empty($input['full_name'])) {
                $updateData['full_name'] = mysqli_real_escape_string($koneksi, $input['full_name']);
            }
            if (!empty($input['phone_number'])) {
                $updateData['phone_number'] = mysqli_real_escape_string($koneksi, $input['phone_number']);
            }
        }
        // Password Update
        elseif (!empty($input['current_password']) && !empty($input['new_password'])) {
            $updateType = 'password';
            
            // Verify current password
            $stmt = mysqli_prepare($koneksi, "SELECT password FROM users_mobile WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            
            if (!password_verify($input['current_password'], $user['password'])) {
                throw new Exception("Current password is incorrect", 401);
            }
            
            $updateData['password'] = password_hash($input['new_password'], PASSWORD_BCRYPT);
        } else {
            throw new Exception("No valid update data provided", 400);
        }

        // Build UPDATE query
        $setClause = [];
        foreach ($updateData as $field => $value) {
            $setClause[] = "$field = ?";
        }
        $setClause[] = "updated_at = NOW()";
        
        $query = "UPDATE users_mobile SET " . implode(', ', $setClause) . " WHERE id = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        
        // Bind parameters dynamically
        $types = str_repeat('s', count($updateData)) . 'i';
        $params = array_values($updateData);
        $params[] = $userId;
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Failed to update profile", 500);
        }

        // Get updated data
        $query = "SELECT 
                    id, uuid, phone_number, full_name, status, 
                    DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as created_at,
                    DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i:%s') as updated_at
                  FROM users_mobile 
                  WHERE id = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $updatedUser = mysqli_fetch_assoc($result);

        $response = [
            'statusCode' => 200,
            'message' => ucfirst($updateType) . ' updated successfully',
            'data' => [$updatedUser],
            'error' => null
        ];

    } catch (Exception $e) {
        $code = $e->getCode() ?: 400;
        $response = [
            'statusCode' => $code,
            'message' => 'Update failed',
            'data' => null,
            'error' => [
                'message' => $e->getMessage(),
                'code' => $code
            ]
        ];
    }
} else {
    $response = [
        'statusCode' => 405,
        'message' => 'Method not allowed',
        'data' => null,
        'error' => [
            'message' => 'Only POST method is allowed',
            'code' => 405
        ]
    ];
}

echo json_encode($response);
if (isset($stmt)) mysqli_stmt_close($stmt);
mysqli_close($koneksi);
<?php
header('Content-Type: application/json');
require '../../config/config.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (!$koneksi) {
            throw new Exception("Database connection failed");
        }

        // Get user ID from JWT token or session in real implementation
        $userId = isset($_GET['id']) ? intval($_GET['id']) : null;
        
        if (!$userId) {
            throw new Exception("User ID is required", 400);
        }

        // Query to get profile data (excluding sensitive fields)
        $query = "SELECT 
                    id,
                    uuid,
                    phone_number,
                    full_name,
                    status,
                    DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as created_at,
                    DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i:%s') as updated_at,
                    id_subdistrict,
                    id_village,
                    id_role,
                    id_organization
                  FROM users_mobile
                  WHERE id = ?";
        
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            throw new Exception("Database query error", 500);
        }

        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (!empty($data)) {
            $response = [
                'statusCode' => 200,
                'message' => 'Profile data retrieved successfully',
                'data' => $data,
                'error' => null
            ];
        } else {
            throw new Exception("Profile not found", 404);
        }

    } catch (Exception $e) {
        $code = $e->getCode() ?: 500;
        $response = [
            'statusCode' => $code,
            'message' => 'Failed to get profile',
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
            'message' => 'Only GET method is allowed',
            'code' => 405
        ]
    ];
}
echo json_encode($response);
if (isset($stmt)) mysqli_stmt_close($stmt);
mysqli_close($koneksi);
<?php
header('Content-Type: application/json');
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['phone_number'])) {
        $phone_number = $_GET['phone_number'];
        
        try {
            $stmt = $koneksi->prepare("SELECT uuid, phone_number, full_name FROM users_mobile WHERE phone_number = ?");
            $stmt->bind_param("s", $phone_number);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();

                http_response_code(200);
                $response = [
                    'statusCode' => 200,
                    'message' => 'Phone number found.',
                    'data' => [
                        'id' => $data['uuid'],  
                        'phone_number' => $data['phone_number'],
                        'full_name' => $data['full_name'],
                    ],
                    'error' => null
                ];
            } else {
                http_response_code(404);
                $response = [
                    'statusCode' => 404,
                    'message' => 'Phone number not found.',
                    'data' => null,
                    'error' => ['message' => 'No user found with this phone number.']
                ];
            }

            $stmt->close();

        } catch (Exception $e) {
            http_response_code(500);
            $response = [
                'statusCode' => 500,
                'message' => 'Internal server error. Please try again later.',
                'data' => null,
                'error' => ['message' => 'Error while fetching data.']
            ];
        }

        echo json_encode($response);

    } else {
        http_response_code(400);
        echo json_encode([
            'statusCode' => 400,
            'message' => 'Phone number is required.',
            'data' => null,
            'error' => ['message' => 'Please provide a phone number.']
        ]);
    }

    mysqli_close($koneksi);
}

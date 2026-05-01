<?php
header('Content-Type: application/json');
require('../config/config.php');
require_once __DIR__ . '/../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

ob_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    
    $uuid = Uuid::uuid4()->toString(); 
    $full_name = $input['full_name'];
    $phone_number = $input['phone_number'];
    $password = $input['password'];
    $kode_otp = $input['kode_otp'];
    // $status = $input['status'];
    $id_subdistrict = $input['id_subdistrict'];
    $id_village = $input['id_village'];
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];
    
    date_default_timezone_set('Asia/Jakarta');
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    $cekNumberPhone = $koneksi->query("SELECT * FROM users_mobile WHERE phone_number = '$phone_number'");
    if ($cekNumberPhone->num_rows > 0) {
        $response = [
            'statusCode' => 409,
            'data' => null,
            'error' => ['message' => 'The phone number is already in use. Please use another number.']
        ];
        http_response_code(409);
        echo json_encode($response);
        exit;
    }

    $cekSubdistrict = $koneksi->query("SELECT id FROM subdistrict WHERE name = '$id_subdistrict'");
    if ($cekSubdistrict->num_rows == 0) { // Ubah logika pengecekan
        $response = [
            'statusCode' => 404,
            'data' => null, // Perbaikan data null
            'error' => ['message' => 'Subdistrict tidak ditemukan.']
        ];
        http_response_code(404);
        echo json_encode($response);
        exit;
    }
    $subdistrictData = $cekSubdistrict->fetch_assoc();
    $id_subdistrict_value = $subdistrictData['id']; // Ambil ID numerik

    $cekVillage = $koneksi->query("SELECT id FROM village WHERE name = '$id_village'");
    if ($cekVillage->num_rows == 0) { // Ubah logika pengecekan
        $response = [
            'statusCode' => 404,
            'data' => null, // Perbaikan data null
            'error' => ['message' => 'Village tidak ditemukan.']
        ];
        http_response_code(404);
        echo json_encode($response);
        exit;
    }
    $villageData = $cekVillage->fetch_assoc();
    $id_village_value = $villageData['id']; // Ambil ID numerik

    $password_encrypted = password_hash($password, PASSWORD_BCRYPT);

    $koneksi->autocommit(false);
    try {
        $query = "INSERT INTO users_mobile (uuid, phone_number, full_name, password, kode_otp, status, created_at, updated_at, id_subdistrict, id_village, id_role, id_organization) 
                  VALUES ('$uuid', '$phone_number', '$full_name', '$password_encrypted', '$kode_otp', 'Active', '$created_at', '$updated_at', $id_subdistrict_value, $id_village_value, $id_role, $id_organization)";
        $koneksi->query($query);

        $id_users = $koneksi->insert_id;

        $query = "
            SELECT 
                users_mobile.id,
                users_mobile.uuid,
                users_mobile.phone_number,
                users_mobile.full_name,
                users_mobile.status,
                users_mobile.created_at,
                users_mobile.updated_at,
                subdistrict.id AS subdistrict_id,
                subdistrict.uuid AS subdistrict_uuid,
                subdistrict.name AS subdistrict_name,
                village.id AS village_id,
                village.uuid AS village_uuid,
                village.name AS village_name,
                role_users_mobile.id AS role_id,
                role_users_mobile.uuid AS role_uuid,
                role_users_mobile.name AS role_name,
                role_organization.id AS organization_id,
                role_organization.uuid AS organization_uuid,
                role_organization.name AS organization_name
            FROM users_mobile
            LEFT JOIN subdistrict ON users_mobile.id_subdistrict = subdistrict.id
            LEFT JOIN village ON users_mobile.id_village = village.id
            LEFT JOIN role_users_mobile ON users_mobile.id_role = role_users_mobile.id
            LEFT JOIN role_organization ON users_mobile.id_organization = role_organization.id
            WHERE users_mobile.id = $id_users
        ";

        $result = $koneksi->query($query);
        if ($result->num_rows > 0) {
            $data_user = $result->fetch_assoc();

            $response = [
                'statusCode' => 200,
                'message' => 'Success Create Account',
                'data' => [
                    'id' => $data_user['id'],
                    'uuid' => $data_user['uuid'],
                    'phoneNumber' => $data_user['phone_number'],
                    'fullName' => $data_user['full_name'],
                    'status' => $data_user['status'],
                    'createdAt' => $data_user['created_at'],
                    'updatedAt' => $data_user['updated_at'],
                    'subdistrict' => [
                        'id' => $data_user['subdistrict_id'],
                        'uuid' => $data_user['subdistrict_uuid'],
                        'name' => $data_user['subdistrict_name']
                    ],
                    'village' => [
                        'id' => $data_user['village_id'],
                        'uuid' => $data_user['village_uuid'],
                        'name' => $data_user['village_name']
                    ],
                    'role' => [
                        'id' => $data_user['role_id'],
                        'uuid' => $data_user['role_uuid'],
                        'name' => $data_user['role_name']
                    ],
                    'organization' => [
                        'id' => $data_user['organization_id'],
                        'uuid' => $data_user['organization_uuid'],
                        'name' => $data_user['organization_name'],
                    ],
                ],
                'error' => null
            ];
            http_response_code(200);
        } else {
            $response = [
                'statusCode' => 404,
                'data' => null,
                'error' => ['message' => 'User data could not be retrieved.']
            ];
            http_response_code(404);
        }

        $koneksi->commit();
    } catch (Exception $e) {
        $response = [
            'statusCode' => 500,
            'data' => null,
            'error' => ['message' => 'Failed to create account due to an exception.' . $e->getMessage()]
        ];
        http_response_code(500);
        $koneksi->rollback();
    }

    ob_end_clean();
    
    echo json_encode($response);
    mysqli_close($koneksi);
}

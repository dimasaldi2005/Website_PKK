<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'KP3-' . $randomString; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!$koneksi) {
        $response['statusCode'] = 500;
        $response['message'] = "Koneksi Database Gagal.";
        $response['data'] = null;
        $response['error'] = ['message' => 'Failed to connect to database'];
        echo json_encode($response);
        exit();
    }

    $input = json_decode(file_get_contents("php://input"), true);

    // Data dari input
    $id_user = $input['id_user'];
    $pangan = $input['pangan'] ?? 0;
    $sandang = $input['sandang'] ?? 0;
    $tata_laksana_rumah = $input['tata_laksana_rumah'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_kader_pokja3 (
                    uuid, id_user, pangan, sandang, 
                    tata_laksana_rumah, catatan, status, 
                    created_at, updated_at, id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$pangan', '$sandang', 
                    '$tata_laksana_rumah', '$catatan', 'Proses', 
                    '$created_at', '$updated_at', '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_kader_pokja3.id_kader_pokja3,
                    laporan_kader_pokja3.uuid,
                    laporan_kader_pokja3.id_user,
                    laporan_kader_pokja3.pangan,
                    laporan_kader_pokja3.sandang,
                    laporan_kader_pokja3.tata_laksana_rumah,
                    laporan_kader_pokja3.catatan,
                    laporan_kader_pokja3.status,
                    laporan_kader_pokja3.created_at,
                    laporan_kader_pokja3.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_kader_pokja3
                LEFT JOIN role_users_mobile ON laporan_kader_pokja3.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_kader_pokja3.id_organization = role_organization.id
                WHERE laporan_kader_pokja3.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Successfully uploaded kader pokja 3 report";
            $response['data'] = [
                "id_kader_pokja3" => $data['id_kader_pokja3'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "pangan" => $data['pangan'],
                "sandang" => $data['sandang'],
                "tata_laksana_rumah" => $data['tata_laksana_rumah'],
                "catatan" => $data['catatan'],
                "status" => $data['status'],
                "created_at" => $data['created_at'],
                "updated_at" => $data['updated_at'],
                "role" => [
                    "id" => $data['role_id'],
                    "uuid"=> $data['role_uuid'],
                    "name" => $data['role_name']
                ],
                "organization" => [
                    "id" => $data['organization_id'],
                    'uuid' => $data['organization_uuid'],
                    "name" => $data['organization_name']
                ],
            ]; 
            $response['error'] = null;
        } else {
            $response['statusCode'] = 500;
            $response['message'] = "Failed to upload kader pokja 3 report";
            $response['data'] = null;
            $response['error'] = ['message' => 'Data insertion failed'];
        }
    } catch (Exception $e) {
        $response['statusCode'] = 500;
        $response['message'] = "An error occurred while processing the request.";
        $response['data'] = null;
        $response['error'] = ['message' => $e->getMessage()];
    }
    echo json_encode($response);
    mysqli_close($koneksi);
}
?>
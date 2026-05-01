<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'KP3B2-' . $randomString; 
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
    $jasa = $input['jasa'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_sandang (
                    uuid, id_user, pangan, sandang, 
                    jasa, catatan, status, 
                    created_at, updated_at, id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$pangan', '$sandang', 
                    '$jasa', '$catatan', 'Proses', 
                    '$created_at', '$updated_at', '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_sandang.id_pokja3_bidang2,
                    laporan_sandang.uuid,
                    laporan_sandang.id_user,
                    laporan_sandang.pangan,
                    laporan_sandang.sandang,
                    laporan_sandang.jasa,
                    laporan_sandang.catatan,
                    laporan_sandang.status,
                    laporan_sandang.created_at,
                    laporan_sandang.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_sandang
                LEFT JOIN role_users_mobile ON laporan_sandang.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_sandang.id_organization = role_organization.id
                WHERE laporan_sandang.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Successfully uploaded laporan sandang";
            $response['data'] = [
                "id_pokja3_bidang2" => $data['id_pokja3_bidang2'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "pangan" => $data['pangan'],
                "sandang" => $data['sandang'],
                "jasa" => $data['jasa'],
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
            $response['message'] = "Failed to upload laporan sandang";
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
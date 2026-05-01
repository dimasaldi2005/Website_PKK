<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'KP3B3-' . $randomString; 
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
    $layak_huni = $input['layak_huni'] ?? 0;
    $tidak_layak = $input['tidak_layak'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_perumahan (
                    uuid, id_user, layak_huni, tidak_layak, 
                    catatan, status, created_at, updated_at, 
                    id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$layak_huni', '$tidak_layak', 
                    '$catatan', 'Proses', '$created_at', '$updated_at', 
                    '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_perumahan.id_pokja3_bidang3,
                    laporan_perumahan.uuid,
                    laporan_perumahan.id_user,
                    laporan_perumahan.layak_huni,
                    laporan_perumahan.tidak_layak,
                    laporan_perumahan.catatan,
                    laporan_perumahan.status,
                    laporan_perumahan.created_at,
                    laporan_perumahan.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_perumahan
                LEFT JOIN role_users_mobile ON laporan_perumahan.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_perumahan.id_organization = role_organization.id
                WHERE laporan_perumahan.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Laporan perumahan berhasil disimpan";
            $response['data'] = [
                "id_pokja3_bidang3" => $data['id_pokja3_bidang3'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "layak_huni" => $data['layak_huni'],
                "tidak_layak" => $data['tidak_layak'],
                "catatan" => $data['catatan'],
                "status" => $data['status'],
                "created_at" => $data['created_at'],
                "updated_at" => $data['updated_at'],
                "role" => [
                    "id" => $data['role_id'],
                    "uuid" => $data['role_uuid'],
                    "name" => $data['role_name']
                ],
                "organization" => [
                    "id" => $data['organization_id'],
                    "uuid" => $data['organization_uuid'],
                    "name" => $data['organization_name']
                ]
            ]; 
            $response['error'] = null;
        } else {
            $response['statusCode'] = 500;
            $response['message'] = "Gagal menyimpan laporan perumahan";
            $response['data'] = null;
            $response['error'] = ['message' => 'Gagal menyimpan data ke database'];
        }
    } catch (Exception $e) {
        $response['statusCode'] = 500;
        $response['message'] = "Terjadi kesalahan saat memproses permintaan";
        $response['data'] = null;
        $response['error'] = ['message' => $e->getMessage()];
    }
    echo json_encode($response);
    mysqli_close($koneksi);
}
?>
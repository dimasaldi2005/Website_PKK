<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'KP4-' . $randomString; 
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
    $posyandu = $input['posyandu'] ?? 0;
    $gizi = $input['gizi'] ?? 0;
    $kesling = $input['kesling'] ?? 0;
    $penyuluhan_narkoba = $input['penyuluhan_narkoba'] ?? 0;
    $PHBS = $input['PHBS'] ?? 0;
    $KB = $input['KB'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_kader_pokja4 (
                    uuid, id_user, posyandu, gizi, kesling, 
                    penyuluhan_narkoba, PHBS, KB, catatan, 
                    status, created_at, updated_at, id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$posyandu', '$gizi', '$kesling', 
                    '$penyuluhan_narkoba', '$PHBS', '$KB', '$catatan', 
                    'Proses', '$created_at', '$updated_at', '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_kader_pokja4.id_kader_pokja4,
                    laporan_kader_pokja4.uuid,
                    laporan_kader_pokja4.id_user,
                    laporan_kader_pokja4.posyandu,
                    laporan_kader_pokja4.gizi,
                    laporan_kader_pokja4.kesling,
                    laporan_kader_pokja4.penyuluhan_narkoba,
                    laporan_kader_pokja4.PHBS,
                    laporan_kader_pokja4.KB,
                    laporan_kader_pokja4.catatan,
                    laporan_kader_pokja4.status,
                    laporan_kader_pokja4.created_at,
                    laporan_kader_pokja4.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_kader_pokja4
                LEFT JOIN role_users_mobile ON laporan_kader_pokja4.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_kader_pokja4.id_organization = role_organization.id
                WHERE laporan_kader_pokja4.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Laporan Kader Pokja 4 berhasil disimpan";
            $response['data'] = [
                "id_kader_pokja4" => $data['id_kader_pokja4'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "posyandu" => $data['posyandu'],
                "gizi" => $data['gizi'],
                "kesling" => $data['kesling'],
                "penyuluhan_narkoba" => $data['penyuluhan_narkoba'],
                "PHBS" => $data['PHBS'],
                "KB" => $data['KB'],
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
            $response['message'] = "Gagal menyimpan laporan kader pokja 4";
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
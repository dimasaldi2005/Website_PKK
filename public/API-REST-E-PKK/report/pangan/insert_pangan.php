<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'KP3B1-' . $randomString; 
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
    $beras = $input['beras'] ?? 0;
    $non_beras = $input['non_beras'] ?? 0;
    $peternakan = $input['peternakan'] ?? 0;
    $perikanan = $input['perikanan'] ?? 0;
    $warung_hidup = $input['warung_hidup'] ?? 0;
    $lumbung_hidup = $input['lumbung_hidup'] ?? 0;
    $toga = $input['toga'] ?? 0;
    $tanaman_keras = $input['tanaman_keras'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_pangan (
                    uuid, id_user, beras, non_beras, 
                    peternakan, perikanan, warung_hidup, 
                    lumbung_hidup, toga, tanaman_keras, 
                    catatan, status, created_at, updated_at, 
                    id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$beras', '$non_beras', 
                    '$peternakan', '$perikanan', '$warung_hidup', 
                    '$lumbung_hidup', '$toga', '$tanaman_keras', 
                    '$catatan', 'Proses', '$created_at', '$updated_at', 
                    '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_pangan.id_pokja3_bidang1,
                    laporan_pangan.uuid,
                    laporan_pangan.id_user,
                    laporan_pangan.beras,
                    laporan_pangan.non_beras,
                    laporan_pangan.peternakan,
                    laporan_pangan.perikanan,
                    laporan_pangan.warung_hidup,
                    laporan_pangan.lumbung_hidup,
                    laporan_pangan.toga,
                    laporan_pangan.tanaman_keras,
                    laporan_pangan.catatan,
                    laporan_pangan.status,
                    laporan_pangan.created_at,
                    laporan_pangan.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_pangan
                LEFT JOIN role_users_mobile ON laporan_pangan.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_pangan.id_organization = role_organization.id
                WHERE laporan_pangan.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Successfully uploaded laporan pangan";
            $response['data'] = [
                "id_pokja3_bidang1" => $data['id_pokja3_bidang1'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "beras" => $data['beras'],
                "non_beras" => $data['non_beras'],
                "peternakan" => $data['peternakan'],
                "perikanan" => $data['perikanan'],
                "warung_hidup" => $data['warung_hidup'],
                "lumbung_hidup" => $data['lumbung_hidup'],
                "toga" => $data['toga'],
                "tanaman_keras" => $data['tanaman_keras'],
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
            $response['message'] = "Failed to upload laporan pangan";
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
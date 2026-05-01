<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'KP4B3-' . $randomString; 
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
    $J_Psubur = $input['J_Psubur'] ?? 0;
    $J_Wsubur = $input['J_Wsubur'] ?? 0;
    $Kb_p = $input['Kb_p'] ?? 0;
    $Kb_w = $input['Kb_w'] ?? 0;
    $Kk_tbg = $input['Kk_tbg'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_perencanaan_sehat (
                    uuid, id_user, J_Psubur, J_Wsubur, 
                    Kb_p, Kb_w, Kk_tbg, catatan, 
                    status, created_at, updated_at, 
                    id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$J_Psubur', '$J_Wsubur', 
                    '$Kb_p', '$Kb_w', '$Kk_tbg', '$catatan', 
                    'Proses', '$created_at', '$updated_at', 
                    '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_perencanaan_sehat.id_pokja4_bidang3,
                    laporan_perencanaan_sehat.uuid,
                    laporan_perencanaan_sehat.id_user,
                    laporan_perencanaan_sehat.J_Psubur,
                    laporan_perencanaan_sehat.J_Wsubur,
                    laporan_perencanaan_sehat.Kb_p,
                    laporan_perencanaan_sehat.Kb_w,
                    laporan_perencanaan_sehat.Kk_tbg,
                    laporan_perencanaan_sehat.catatan,
                    laporan_perencanaan_sehat.status,
                    laporan_perencanaan_sehat.created_at,
                    laporan_perencanaan_sehat.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_perencanaan_sehat
                LEFT JOIN role_users_mobile ON laporan_perencanaan_sehat.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_perencanaan_sehat.id_organization = role_organization.id
                WHERE laporan_perencanaan_sehat.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Laporan Perencanaan Sehat berhasil disimpan";
            $response['data'] = [
                "id_pokja4_bidang3" => $data['id_pokja4_bidang3'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "J_Psubur" => $data['J_Psubur'],
                "J_Wsubur" => $data['J_Wsubur'],
                "Kb_p" => $data['Kb_p'],
                "Kb_w" => $data['Kb_w'],
                "Kk_tbg" => $data['Kk_tbg'],
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
            $response['message'] = "Gagal menyimpan laporan perencanaan sehat";
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
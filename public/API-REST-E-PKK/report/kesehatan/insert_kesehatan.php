<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'KP4B1-' . $randomString; 
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
    $jumlah_posyandu = $input['jumlah_posyandu'] ?? 0;
    $jumlah_posyandu_iterasi = $input['jumlah_posyandu_iterasi'] ?? 0;
    $jumlah_klp = $input['jumlah_klp'] ?? 0;
    $jumlah_anggota = $input['jumlah_anggota'] ?? 0;
    $jumlah_kartu_gratis = $input['jumlah_kartu_gratis'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_bidang_kesehatan (
                    uuid, id_user, jumlah_posyandu, jumlah_posyandu_iterasi, 
                    jumlah_klp, jumlah_anggota, jumlah_kartu_gratis, 
                    catatan, status, created_at, updated_at, 
                    id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$jumlah_posyandu', '$jumlah_posyandu_iterasi', 
                    '$jumlah_klp', '$jumlah_anggota', '$jumlah_kartu_gratis', 
                    '$catatan', 'Proses', '$created_at', '$updated_at', 
                    '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_bidang_kesehatan.id_pokja4_bidang1,
                    laporan_bidang_kesehatan.uuid,
                    laporan_bidang_kesehatan.id_user,
                    laporan_bidang_kesehatan.jumlah_posyandu,
                    laporan_bidang_kesehatan.jumlah_posyandu_iterasi,
                    laporan_bidang_kesehatan.jumlah_klp,
                    laporan_bidang_kesehatan.jumlah_anggota,
                    laporan_bidang_kesehatan.jumlah_kartu_gratis,
                    laporan_bidang_kesehatan.catatan,
                    laporan_bidang_kesehatan.status,
                    laporan_bidang_kesehatan.created_at,
                    laporan_bidang_kesehatan.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_bidang_kesehatan
                LEFT JOIN role_users_mobile ON laporan_bidang_kesehatan.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_bidang_kesehatan.id_organization = role_organization.id
                WHERE laporan_bidang_kesehatan.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Laporan Bidang Kesehatan berhasil disimpan";
            $response['data'] = [
                "id_pokja4_bidang1" => $data['id_pokja4_bidang1'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "jumlah_posyandu" => $data['jumlah_posyandu'],
                "jumlah_posyandu_iterasi" => $data['jumlah_posyandu_iterasi'],
                "jumlah_klp" => $data['jumlah_klp'],
                "jumlah_anggota" => $data['jumlah_anggota'],
                "jumlah_kartu_gratis" => $data['jumlah_kartu_gratis'],
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
            $response['message'] = "Gagal menyimpan laporan bidang kesehatan";
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
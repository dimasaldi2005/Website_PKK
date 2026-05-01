<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'PKKUM-' . $randomString; 
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
    $dusun_lingkungan = $input['dusun_lingkungan'] ?? '';
    $PKK_RW = $input['PKK_RW'] ?? 0;
    $desa_wisma = $input['desa_wisma'] ?? 0;
    $KRT = $input['KRT'] ?? 0;
    $KK = $input['KK'] ?? 0;
    $jiwa_laki = $input['jiwa_laki'] ?? 0;
    $jiwa_perempuan = $input['jiwa_perempuan'] ?? 0;
    $anggota_laki = $input['anggota_laki'] ?? 0;
    $anggota_perempuan = $input['anggota_perempuan'] ?? 0;
    $umum_laki = $input['umum_laki'] ?? 0;
    $umum_perempuan = $input['umum_perempuan'] ?? 0;
    $khusus_laki = $input['khusus_laki'] ?? 0;
    $khusus_perempuan = $input['khusus_perempuan'] ?? 0;
    $honorer_laki = $input['honorer_laki'] ?? 0;
    $honorer_perempuan = $input['honorer_perempuan'] ?? 0;
    $bantuan_laki = $input['bantuan_laki'] ?? 0;
    $bantuan_perempuan = $input['bantuan_perempuan'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_umum (
                    uuid, id_user, dusun_lingkungan, PKK_RW, desa_wisma, 
                    KRT, KK, jiwa_laki, jiwa_perempuan, 
                    anggota_laki, anggota_perempuan, umum_laki, umum_perempuan, 
                    khusus_laki, khusus_perempuan, honorer_laki, honorer_perempuan, 
                    bantuan_laki, bantuan_perempuan, catatan, status, 
                    created_at, updated_at, id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$dusun_lingkungan', '$PKK_RW', '$desa_wisma', 
                    '$KRT', '$KK', '$jiwa_laki', '$jiwa_perempuan', 
                    '$anggota_laki', '$anggota_perempuan', '$umum_laki', '$umum_perempuan', 
                    '$khusus_laki', '$khusus_perempuan', '$honorer_laki', '$honorer_perempuan', 
                    '$bantuan_laki', '$bantuan_perempuan', '$catatan', 'Proses', 
                    '$created_at', '$updated_at', '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_umum.id_laporan_umum,
                    laporan_umum.uuid,
                    laporan_umum.id_user,
                    laporan_umum.dusun_lingkungan,
                    laporan_umum.PKK_RW,
                    laporan_umum.desa_wisma,
                    laporan_umum.KRT,
                    laporan_umum.KK,
                    laporan_umum.jiwa_laki,
                    laporan_umum.jiwa_perempuan,
                    laporan_umum.anggota_laki,
                    laporan_umum.anggota_perempuan,
                    laporan_umum.umum_laki,
                    laporan_umum.umum_perempuan,
                    laporan_umum.khusus_laki,
                    laporan_umum.khusus_perempuan,
                    laporan_umum.honorer_laki,
                    laporan_umum.honorer_perempuan,
                    laporan_umum.bantuan_laki,
                    laporan_umum.bantuan_perempuan,
                    laporan_umum.catatan,
                    laporan_umum.status,
                    laporan_umum.created_at,
                    laporan_umum.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_umum
                LEFT JOIN role_users_mobile ON laporan_umum.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_umum.id_organization = role_organization.id
                WHERE laporan_umum.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Laporan Umum PKK berhasil disimpan";
            $response['data'] = [
                "id_laporan_umum" => $data['id_laporan_umum'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "dusun_lingkungan" => $data['dusun_lingkungan'],
                "PKK_RW" => $data['PKK_RW'],
                "desa_wisma" => $data['desa_wisma'],
                "KRT" => $data['KRT'],
                "KK" => $data['KK'],
                "jiwa_laki" => $data['jiwa_laki'],
                "jiwa_perempuan" => $data['jiwa_perempuan'],
                "anggota_laki" => $data['anggota_laki'],
                "anggota_perempuan" => $data['anggota_perempuan'],
                "umum_laki" => $data['umum_laki'],
                "umum_perempuan" => $data['umum_perempuan'],
                "khusus_laki" => $data['khusus_laki'],
                "khusus_perempuan" => $data['khusus_perempuan'],
                "honorer_laki" => $data['honorer_laki'],
                "honorer_perempuan" => $data['honorer_perempuan'],
                "bantuan_laki" => $data['bantuan_laki'],
                "bantuan_perempuan" => $data['bantuan_perempuan'],
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
            $response['message'] = "Gagal menyimpan laporan umum PKK";
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
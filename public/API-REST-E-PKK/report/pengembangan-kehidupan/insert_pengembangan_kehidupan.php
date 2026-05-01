<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'KP2B2-' . $randomString; 
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
    $jumlah_kelompok_pemula = $input['jumlah_kelompok_pemula'] ?? 0;
    $jumlah_peserta_pemula = $input['jumlah_peserta_pemula'] ?? 0;
    $jumlah_kelompok_madya = $input['jumlah_kelompok_madya'] ?? 0;
    $jumlah_peserta_madya = $input['jumlah_peserta_madya'] ?? 0;
    $jumlah_kelompok_utama = $input['jumlah_kelompok_utama'] ?? 0;
    $jumlah_peserta_utama = $input['jumlah_peserta_utama'] ?? 0;
    $jumlah_kelompok_mandiri = $input['jumlah_kelompok_mandiri'] ?? 0;
    $jumlah_peserta_mandiri = $input['jumlah_peserta_mandiri'] ?? 0;
    $jumlah_kelompok_hukum = $input['jumlah_kelompok_hukum'] ?? 0;
    $jumlah_peserta_hukum = $input['jumlah_peserta_hukum'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_pengembangan_kehidupan (
                    uuid, id_user, jumlah_kelompok_pemula, jumlah_peserta_pemula, 
                    jumlah_kelompok_madya, jumlah_peserta_madya, jumlah_kelompok_utama, 
                    jumlah_peserta_utama, jumlah_kelompok_mandiri, jumlah_peserta_mandiri, 
                    jumlah_kelompok_hukum, jumlah_peserta_hukum, catatan, status, 
                    created_at, updated_at, id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$jumlah_kelompok_pemula', '$jumlah_peserta_pemula', 
                    '$jumlah_kelompok_madya', '$jumlah_peserta_madya', '$jumlah_kelompok_utama', 
                    '$jumlah_peserta_utama', '$jumlah_kelompok_mandiri', '$jumlah_peserta_mandiri', 
                    '$jumlah_kelompok_hukum', '$jumlah_peserta_hukum', '$catatan', 'Proses', 
                    '$created_at', '$updated_at', '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_pengembangan_kehidupan.id_pokja2_bidang2,
                    laporan_pengembangan_kehidupan.uuid,
                    laporan_pengembangan_kehidupan.id_user,
                    laporan_pengembangan_kehidupan.jumlah_kelompok_pemula,
                    laporan_pengembangan_kehidupan.jumlah_peserta_pemula,
                    laporan_pengembangan_kehidupan.jumlah_kelompok_madya,
                    laporan_pengembangan_kehidupan.jumlah_peserta_madya,
                    laporan_pengembangan_kehidupan.jumlah_kelompok_utama,
                    laporan_pengembangan_kehidupan.jumlah_peserta_utama,
                    laporan_pengembangan_kehidupan.jumlah_kelompok_mandiri,
                    laporan_pengembangan_kehidupan.jumlah_peserta_mandiri,
                    laporan_pengembangan_kehidupan.jumlah_kelompok_hukum,
                    laporan_pengembangan_kehidupan.jumlah_peserta_hukum,
                    laporan_pengembangan_kehidupan.catatan,
                    laporan_pengembangan_kehidupan.status,
                    laporan_pengembangan_kehidupan.created_at,
                    laporan_pengembangan_kehidupan.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_pengembangan_kehidupan
                LEFT JOIN role_users_mobile ON laporan_pengembangan_kehidupan.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_pengembangan_kehidupan.id_organization = role_organization.id
                WHERE laporan_pengembangan_kehidupan.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Successfully uploaded pengembangan kehidupan report";
            $response['data'] = [
                "id_pokja2_bidang2" => $data['id_pokja2_bidang2'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "jumlah_kelompok_pemula" => $data['jumlah_kelompok_pemula'],
                "jumlah_peserta_pemula" => $data['jumlah_peserta_pemula'],
                "jumlah_kelompok_madya" => $data['jumlah_kelompok_madya'],
                "jumlah_peserta_madya" => $data['jumlah_peserta_madya'],
                "jumlah_kelompok_utama" => $data['jumlah_kelompok_utama'],
                "jumlah_peserta_utama" => $data['jumlah_peserta_utama'],
                "jumlah_kelompok_mandiri" => $data['jumlah_kelompok_mandiri'],
                "jumlah_peserta_mandiri" => $data['jumlah_peserta_mandiri'],
                "jumlah_kelompok_hukum" => $data['jumlah_kelompok_hukum'],
                "jumlah_peserta_hukum" => $data['jumlah_peserta_hukum'],
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
            $response['message'] = "Failed to upload pengembangan kehidupan report";
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
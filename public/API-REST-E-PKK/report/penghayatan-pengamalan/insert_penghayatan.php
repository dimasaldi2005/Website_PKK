<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6); // Membuat 7 karakter acak
    return 'KP1B1-' . $randomString; 
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

    $jml_kel_simulasi1 = $input['jumlah_kel_simulasi1'];
    $jml_anggota1 = $input['jumlah_anggota1'];
    $jml_kel_simulasi2 = $input['jumlah_kel_simulasi2'];
    $jml_anggota2 = $input['jumlah_anggota2'];
    $jml_kel_simulasi3 = $input['jumlah_kel_simulasi3'];
    $jml_anggota3 = $input['jumlah_anggota3'];
    $jml_kel_simulasi4 = $input['jumlah_kel_simulasi4'];
    $jml_anggota4 = $input['jumlah_anggota4'];
    $id_user = $input['id_user'];
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_penghayatan_n_pengamalan (uuid, id_user, jumlah_kel_simulasi1, jumlah_anggota1, 
                    jumlah_kel_simulasi2, jumlah_anggota2, jumlah_kel_simulasi3, jumlah_anggota3,
                    jumlah_kel_simulasi4, jumlah_anggota4, status, created_at, updated_at, id_role, id_organization) 
        VALUES ('$uuid', '$id_user', '$jml_kel_simulasi1', '$jml_anggota1', '$jml_kel_simulasi2', '$jml_anggota2',
                '$jml_kel_simulasi3', '$jml_anggota3', '$jml_kel_simulasi4', '$jml_anggota4',
                'Proses', '$created_at', '$updated_at', '$id_role', '$id_organization')";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_penghayatan_n_pengamalan.id_pokja1_bidang1,
                    laporan_penghayatan_n_pengamalan.uuid,
                    laporan_penghayatan_n_pengamalan.id_user,
                    laporan_penghayatan_n_pengamalan.jumlah_kel_simulasi1,
                    laporan_penghayatan_n_pengamalan.jumlah_anggota1,
                    laporan_penghayatan_n_pengamalan.jumlah_kel_simulasi2,
                    laporan_penghayatan_n_pengamalan.jumlah_anggota2,
                    laporan_penghayatan_n_pengamalan.jumlah_kel_simulasi3,
                    laporan_penghayatan_n_pengamalan.jumlah_anggota3,
                    laporan_penghayatan_n_pengamalan.jumlah_kel_simulasi4,
                    laporan_penghayatan_n_pengamalan.jumlah_anggota4,
                    laporan_penghayatan_n_pengamalan.catatan,
                    laporan_penghayatan_n_pengamalan.status,
                    laporan_penghayatan_n_pengamalan.created_at,
                    laporan_penghayatan_n_pengamalan.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_penghayatan_n_pengamalan
                LEFT JOIN role_users_mobile ON laporan_penghayatan_n_pengamalan.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_penghayatan_n_pengamalan.id_organization = role_organization.id
                WHERE laporan_penghayatan_n_pengamalan.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Successfully uploaded report penghayatan pengamalan";
            $response['data'] = [
                "id_pokja1_bidang1" => $data['id_pokja1_bidang1'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "jumlah_kel_simulasi1" => $data['jumlah_kel_simulasi1'],
                "jumlah_anggota1" => $data['jumlah_anggota1'],
                "jumlah_kel_simulasi2" => $data['jumlah_kel_simulasi2'],
                "jumlah_anggota2" => $data['jumlah_anggota2'],
                "jumlah_kel_simulasi3" => $data['jumlah_kel_simulasi3'],
                "jumlah_anggota3" => $data['jumlah_anggota3'],
                "jumlah_kel_simulasi4" => $data['jumlah_kel_simulasi4'],
                "jumlah_anggota4" => $data['jumlah_anggota4'],
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
            $response['message'] = "Failed to upload report kader pokja I";
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



<?php
header('Content-Type: application/json');
require '../../config/config.php';

function generateCustomUUID() {
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'KP2B1-' . $randomString; 
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
    $warga_buta = $input['warga_buta'] ?? 0;
    $kel_belajarA = $input['kel_belajarA'] ?? 0;
    $warga_belajarA = $input['warga_belajarA'] ?? 0;
    $kel_belajarB = $input['kel_belajarB'] ?? 0;
    $warga_belajarB = $input['warga_belajarB'] ?? 0;
    $kel_belajarC = $input['kel_belajarC'] ?? 0;
    $warga_belajarC = $input['warga_belajarC'] ?? 0;
    $kel_belajarKF = $input['kel_belajarKF'] ?? 0;
    $warga_belajarKF = $input['warga_belajarKF'] ?? 0;
    $paud = $input['paud'] ?? 0;
    $taman_bacaan = $input['taman_bacaan'] ?? 0;
    $jumlah_klp = $input['jumlah_klp'] ?? 0;
    $jumlah_ibu_peserta = $input['jumlah_ibu_peserta'] ?? 0;
    $jumlah_ape = $input['jumlah_ape'] ?? 0;
    $jumlah_kel_simulasi = $input['jumlah_kel_simulasi'] ?? 0;
    $KF = $input['KF'] ?? 0;
    $paud_tutor = $input['paud_tutor'] ?? 0;
    $BKB = $input['BKB'] ?? 0;
    $koperasi = $input['koperasi'] ?? 0;
    $ketrampilan = $input['ketrampilan'] ?? 0;
    $LP3PKK = $input['LP3PKK'] ?? 0;
    $TP3PKK = $input['TP3PKK'] ?? 0;
    $damas_pkk = $input['damas_pkk'] ?? 0;
    $catatan = $input['catatan'] ?? '';
    $id_role = $input['id_role'];
    $id_organization = $input['id_organization'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = time();
    $created_at = date("Y-m-d H:i:s", $timestamp);
    $updated_at = date("Y-m-d H:i:s", $timestamp);

    $uuid = generateCustomUUID();

    try {
        $query = "INSERT INTO laporan_pendidikan_n_keterampilan (
                    uuid, id_user, warga_buta, kel_belajarA, warga_belajarA, 
                    kel_belajarB, warga_belajarB, kel_belajarC, warga_belajarC, 
                    kel_belajarKF, warga_belajarKF, paud, taman_bacaan, jumlah_klp, 
                    jumlah_ibu_peserta, jumlah_ape, jumlah_kel_simulasi, KF, 
                    paud_tutor, BKB, koperasi, ketrampilan, LP3PKK, TP3PKK, 
                    damas_pkk, catatan, status, created_at, updated_at, id_role, id_organization
                ) VALUES (
                    '$uuid', '$id_user', '$warga_buta', '$kel_belajarA', '$warga_belajarA', 
                    '$kel_belajarB', '$warga_belajarB', '$kel_belajarC', '$warga_belajarC', 
                    '$kel_belajarKF', '$warga_belajarKF', '$paud', '$taman_bacaan', '$jumlah_klp', 
                    '$jumlah_ibu_peserta', '$jumlah_ape', '$jumlah_kel_simulasi', '$KF', 
                    '$paud_tutor', '$BKB', '$koperasi', '$ketrampilan', '$LP3PKK', '$TP3PKK', 
                    '$damas_pkk', '$catatan', 'Proses', '$created_at', '$updated_at', '$id_role', '$id_organization'
                )";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $selectQuery = "
                SELECT 
                    laporan_pendidikan_n_keterampilan.id_pokja2_bidang1,
                    laporan_pendidikan_n_keterampilan.uuid,
                    laporan_pendidikan_n_keterampilan.id_user,
                    laporan_pendidikan_n_keterampilan.warga_buta,
                    laporan_pendidikan_n_keterampilan.kel_belajarA,
                    laporan_pendidikan_n_keterampilan.warga_belajarA,
                    laporan_pendidikan_n_keterampilan.kel_belajarB,
                    laporan_pendidikan_n_keterampilan.warga_belajarB,
                    laporan_pendidikan_n_keterampilan.kel_belajarC,
                    laporan_pendidikan_n_keterampilan.warga_belajarC,
                    laporan_pendidikan_n_keterampilan.kel_belajarKF,
                    laporan_pendidikan_n_keterampilan.warga_belajarKF,
                    laporan_pendidikan_n_keterampilan.paud,
                    laporan_pendidikan_n_keterampilan.taman_bacaan,
                    laporan_pendidikan_n_keterampilan.jumlah_klp,
                    laporan_pendidikan_n_keterampilan.jumlah_ibu_peserta,
                    laporan_pendidikan_n_keterampilan.jumlah_ape,
                    laporan_pendidikan_n_keterampilan.jumlah_kel_simulasi,
                    laporan_pendidikan_n_keterampilan.KF,
                    laporan_pendidikan_n_keterampilan.paud_tutor,
                    laporan_pendidikan_n_keterampilan.BKB,
                    laporan_pendidikan_n_keterampilan.koperasi,
                    laporan_pendidikan_n_keterampilan.ketrampilan,
                    laporan_pendidikan_n_keterampilan.LP3PKK,
                    laporan_pendidikan_n_keterampilan.TP3PKK,
                    laporan_pendidikan_n_keterampilan.damas_pkk,
                    laporan_pendidikan_n_keterampilan.catatan,
                    laporan_pendidikan_n_keterampilan.status,
                    laporan_pendidikan_n_keterampilan.created_at,
                    laporan_pendidikan_n_keterampilan.updated_at,
                    role_users_mobile.id AS role_id,
                    role_users_mobile.uuid AS role_uuid,
                    role_users_mobile.name AS role_name,
                    role_organization.id AS organization_id,
                    role_organization.uuid AS organization_uuid,
                    role_organization.name AS organization_name
                FROM laporan_pendidikan_n_keterampilan
                LEFT JOIN role_users_mobile ON laporan_pendidikan_n_keterampilan.id_role = role_users_mobile.id
                LEFT JOIN role_organization ON laporan_pendidikan_n_keterampilan.id_organization = role_organization.id
                WHERE laporan_pendidikan_n_keterampilan.uuid = '$uuid'
            ";
                    
            $selectResult = mysqli_query($koneksi, $selectQuery);
            $data = mysqli_fetch_assoc($selectResult);

            $response['statusCode'] = 200;
            $response['message'] = "Successfully uploaded pendidikan dan keterampilan report";
            $response['data'] = [
                "id_pokja2_bidang1" => $data['id_pokja2_bidang1'],
                "uuid" => $data['uuid'],
                "id_user" => $data['id_user'],
                "warga_buta" => $data['warga_buta'],
                "kel_belajarA" => $data['kel_belajarA'],
                "warga_belajarA" => $data['warga_belajarA'],
                "kel_belajarB" => $data['kel_belajarB'],
                "warga_belajarB" => $data['warga_belajarB'],
                "kel_belajarC" => $data['kel_belajarC'],
                "warga_belajarC" => $data['warga_belajarC'],
                "kel_belajarKF" => $data['kel_belajarKF'],
                "warga_belajarKF" => $data['warga_belajarKF'],
                "paud" => $data['paud'],
                "taman_bacaan" => $data['taman_bacaan'],
                "jumlah_klp" => $data['jumlah_klp'],
                "jumlah_ibu_peserta" => $data['jumlah_ibu_peserta'],
                "jumlah_ape" => $data['jumlah_ape'],
                "jumlah_kel_simulasi" => $data['jumlah_kel_simulasi'],
                "KF" => $data['KF'],
                "paud_tutor" => $data['paud_tutor'],
                "BKB" => $data['BKB'],
                "koperasi" => $data['koperasi'],
                "ketrampilan" => $data['ketrampilan'],
                "LP3PKK" => $data['LP3PKK'],
                "TP3PKK" => $data['TP3PKK'],
                "damas_pkk" => $data['damas_pkk'],
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
            $response['message'] = "Failed to upload pendidikan dan keterampilan report";
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
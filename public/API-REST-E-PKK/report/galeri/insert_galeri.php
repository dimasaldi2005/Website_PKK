<?php
header('Content-Type: application/json');
require '../../config/config.php';

// Fungsi generate UUID khusus untuk galeri
function generateCustomUUID()
{
    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return 'GAL-' . $randomString;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = [
        'statusCode' => 500,
        'message' => 'Internal Server Error',
        'data' => null,
        'error' => null
    ];

    if (!$koneksi) {
        $response['error'] = ['message' => 'Koneksi database gagal'];
        echo json_encode($response);
        exit();
    }

    try {
        // Ambil data dari form-data
        $input = $_POST;

        // Validasi file upload
        if (empty($_FILES['gambar'])) {
            throw new Exception('File gambar wajib diunggah');
        }

        $file = $_FILES['gambar'];
        $uploadDir = 'C:/laragon/www/projekEpkk/public/frontend2/gallery2/';
        $fileName = uniqid() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;

        // Validasi tipe file
        // $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        // if (!in_array($file['type'], $allowedTypes)) {
        //     throw new Exception('Format file tidak didukung. Hanya JPEG, JPG, PNG, dan GIF yang diizinkan');
        // }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];

        if (!in_array(strtolower($extension), $allowedExtensions)) {
            throw new Exception('Ekstensi file tidak didukung. Hanya JPEG, JPG, PNG, dan GIF yang diizinkan');
        }

        // Pindahkan file ke direktori
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new Exception('Gagal menyimpan file gambar');
        }

        // Generate data
        $uuid = generateCustomUUID();
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = time();
        $created_at = date("Y-m-d H:i:s", $timestamp);
        $updated_at = date("Y-m-d H:i:s", $timestamp);

        // Data untuk insert
        $data = [
            'uuid' => $uuid,
            'id_user' => $input['id_user'],
            'deskripsi' => $input['deskripsi'],
            'gambar' => $fileName,
            'pokja' => $input['pokja'],
            'bidang' => $input['bidang'],
            'status' => $input['status'] ?? 'Proses',
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'id_role' => $input['id_role'],
            'id_organization' => $input['id_organization']
        ];

        // Query insert
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";

        $query = "INSERT INTO galerys ($columns) VALUES ($values)";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            throw new Exception('Gagal menyimpan data ke database: ' . mysqli_error($koneksi));
        }

        // Ambil data yang baru disimpan
        $selectQuery = "SELECT 
                galerys.*,
                role_users_mobile.id AS role_id,
                role_users_mobile.name AS role_name,
                role_organization.id AS organization_id,
                role_organization.name AS organization_name
            FROM galerys
            LEFT JOIN role_users_mobile ON galerys.id_role = role_users_mobile.id
            LEFT JOIN role_organization ON galerys.id_organization = role_organization.id
            WHERE galerys.uuid = '$uuid'";

        $selectResult = mysqli_query($koneksi, $selectQuery);
        $insertedData = mysqli_fetch_assoc($selectResult);

        // Format response
        $response['statusCode'] = 200;
        $response['message'] = 'Data galeri berhasil disimpan';
        $response['data'] = [
            'id' => $insertedData['id'],
            'uuid' => $insertedData['uuid'],
            'id_user' => $insertedData['id_user'],
            'deskripsi' => $insertedData['deskripsi'],
            'gambar' => $insertedData['gambar'],
            'pokja' => $insertedData['pokja'],
            'bidang' => $insertedData['bidang'],
            'status' => $insertedData['status'],
            'created_at' => $insertedData['created_at'],
            'updated_at' => $insertedData['updated_at'],
            'role' => [
                'id' => $insertedData['role_id'],
                'name' => $insertedData['role_name']
            ],
            'organization' => [
                'id' => $insertedData['organization_id'],
                'name' => $insertedData['organization_name']
            ]
        ];
    } catch (Exception $e) {
        $response['statusCode'] = 400;
        $response['message'] = 'Gagal menyimpan data';
        $response['error'] = ['message' => $e->getMessage()];

        // Hapus file jika gagal insert database
        if (!empty($targetPath) && file_exists($targetPath)) {
            unlink($targetPath);
        }
    }

    // bersihkan semua output sebelum JSON
    while (ob_get_level()) {
        ob_end_clean();
    }

    echo json_encode($response);
    mysqli_close($koneksi);
}

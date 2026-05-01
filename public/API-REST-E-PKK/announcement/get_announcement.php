<?php
header('Content-Type: application/json');
require '../config/config.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page - 1) * $limit;

    try {
        if (!$koneksi) {
            throw new Exception("Database connection failed");
        }

        // Query utama dengan pagination
        $query = "SELECT 
                    id,
                    judulPengumuman AS judul_pengumuman,
                    deskripsiPengumuman AS deskripsi_pengumuman,
                    tempatPengumuman AS tempat_pengumuman,
                    tanggalPengumuman AS tanggal_pengumuman,
                    updated_at,
                    created_at
                  FROM pengumumen
                  ORDER BY tanggal_pengumuman DESC 
                  LIMIT $limit OFFSET $offset";

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            throw new Exception("Query error: " . mysqli_error($koneksi));
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }

        // Query untuk total data
        $countQuery = "SELECT COUNT(*) as total FROM pengumumen";
        $countResult = mysqli_query($koneksi, $countQuery);
        $totalData = mysqli_fetch_assoc($countResult)['total'];

        if (count($data) > 0) {
            $response = [
                'statusCode' => 200,
                'message' => 'Berhasil mengambil data pengumuman',
                'data' => $data,
                'pagination' => [
                    'total_data' => (int)$totalData,
                    'total_halaman' => ceil($totalData / $limit),
                    'halaman_sekarang' => $page,
                    'data_per_halaman' => $limit
                ],
                'error' => null
            ];
        } else {
            $response = [
                'statusCode' => 404,
                'message' => 'Data pengumuman tidak ditemukan',
                'data' => [],
                'pagination' => null,
                'error' => null
            ];
        }

    } catch (Exception $e) {
        $response = [
            'statusCode' => 500,
            'message' => 'Terjadi kesalahan server',
            'data' => null,
            'pagination' => null,
            'error' => [
                'message' => $e->getMessage()
            ]
        ];
    }
} else {
    $response = [
        'statusCode' => 405,
        'message' => 'Method tidak diizinkan',
        'data' => null,
        'pagination' => null,
        'error' => [
            'message' => 'Hanya metode GET yang diizinkan'
        ]
    ];
}

echo json_encode($response);
mysqli_close($koneksi);
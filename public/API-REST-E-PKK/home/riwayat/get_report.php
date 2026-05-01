<?php
header('Content-Type: application/json');
require '../../config/config.php';
require_once 'get_riwayat.php'; // tempat fungsi getReports() didefinisikan

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = isset($_GET['id_user']) ? (int)$_GET['id_user'] : null;
    $userRole = isset($_GET['id_role']) ? (int)$_GET['id_role'] : null;
    $userOrg = isset($_GET['id_organization']) ? (int)$_GET['id_organization'] : null;

    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page - 1) * $limit;

    try {
        if (!$userId || !$userRole || !$userOrg) {
            throw new Exception('Parameter id_user, id_role, dan id_organization wajib diisi.');
        }

        if (!$koneksi) {
            throw new Exception('Database connection failed.');
        }

        // Ambil semua laporan
        $allReports = getReports($koneksi, $userId, $userRole, $userOrg);
        $totalReports = count($allReports);

        // Potong data untuk pagination
        $paginatedReports = array_slice($allReports, $offset, $limit);

        if (count($paginatedReports) > 0) {
            $response = [
                'statusCode' => 200,
                'message' => 'Berhasil mengambil data laporan',
                'data' => $paginatedReports,
                'pagination' => [
                    'total_data' => $totalReports,
                    'total_halaman' => ceil($totalReports / $limit),
                    'halaman_sekarang' => $page,
                    'data_per_halaman' => $limit
                ],
                'error' => null
            ];
        } else {
            $response = [
                'statusCode' => 404,
                'message' => 'Data laporan tidak ditemukan',
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

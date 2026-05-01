<?php
require '../../config/config.php';

function getReports($koneksi, $userId, $userRole, $userOrg) {
    $tableMapping = [
        1 => ['laporan_kader_pokja1', 'laporan_penghayatan_n_pengamalan', 'laporan_gotong_royong'],
        2 => ['laporan_pendidikan_n_keterampilan', 'laporan_pengembangan_kehidupan'],
        3 => ['laporan_kader_pokja3', 'laporan_pangan', 'laporan_sandang', 'laporan_perumahan'],
        4 => ['laporan_kader_pokja4', 'laporan_bidang_kesehatan', 'laporan_kelestarian_lingkungan_hidup', 'laporan_perencanaan_sehat'],
        5 => ['laporan_umum']
    ];

    $allowedTables = $tableMapping[$userOrg] ?? [];
    if (empty($allowedTables)) return [];

    $results = [];

    foreach ($allowedTables as $table) {
        // Gunakan backtick untuk menghindari error nama tabel
        $query = "SELECT uuid, id_user, status, created_at, id_role, id_organization 
                  FROM `$table` 
                  WHERE id_organization = ? 
                    AND id_user = ? 
                    AND id_role = ?";
        $stmt = $koneksi->prepare($query);
        if (!$stmt) {
            error_log("Prepare failed for table $table: " . $koneksi->error);
            continue;
        }

        $stmt->bind_param("iii", $userOrg, $userId, $userRole);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $results[] = $row;
        }
        $stmt->close();
    }

    // Urutkan berdasarkan created_at DESC (terbaru di atas)
    usort($results, function($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });

    return $results;
}
?>
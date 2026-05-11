public function cetak(Request $request)
{
    $bulan = $request->bulan;
    $tahun = $request->tahun;

    // Kondisi filter
    $queryFilter = function ($query) use ($bulan, $tahun) {
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
    };

    // GOTONG ROYONG
    $gotongroyong = DB::table('laporan_gotong_royong')
        ->join('users_mobile', 'laporan_gotong_royong.id_user', '=', 'users_mobile.id')
        ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
        ->select('laporan_gotong_royong.*', 'subdistrict.name as nama_kec')
        ->where($queryFilter)
        ->get();

    // PENGHAYATAN
    $penghayatan = DB::table('laporan_penghayatan')
        ->join('users_mobile', 'laporan_penghayatan.id_user', '=', 'users_mobile.id')
        ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
        ->select('laporan_penghayatan.*', 'subdistrict.name as nama_kec')
        ->where($queryFilter)
        ->get();

    // KADER
    $laporanpokja1 = DB::table('laporan_pokja1')
        ->join('users_mobile', 'laporan_pokja1.id_user', '=', 'users_mobile.id')
        ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
        ->select('laporan_pokja1.*', 'subdistrict.name as nama_kec')
        ->where($queryFilter)
        ->get();

    // FORMAT JUDUL
    if ($bulan) {
        $judul = "Laporan Bulan " . $bulan . " Tahun " . $tahun;
    } else {
        $judul = "Laporan Tahun " . $tahun;
    }

    $formattedDate = now()->format('d F Y');

    return view('backend.cetak_pokja1', compact(
        'gotongroyong',
        'penghayatan',
        'laporanpokja1',
        'judul',
        'bulan',
        'tahun',
        'formattedDate'
    ));
}
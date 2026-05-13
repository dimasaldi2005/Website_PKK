{{-- @extends('backend/layouts.template') --}}
{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Laporan</title>

    <link href="backend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="backend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="backend/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

  <style>
    * { font-family: "Poppins", sans-serif !important; }
    body { background: #f6f9ff !important; }
    .header { background: #fff !important; box-shadow: 0 2px 4px rgba(0,0,0,0.08) !important; height: 70px !important; padding: 0 20px !important; z-index: 998 !important; }
    .header .logo { min-width: auto; padding: 0; margin-left: 15px; }
    .header .logo img { max-height: 50px; width: 50px; border-radius: 50%; margin-right: 15px; flex-shrink: 0; }
    .header .logo span { font-size: 15px; font-weight: 700; font-family: "Poppins", sans-serif !important; line-height: 1.3; color: #1a1a1a; white-space: nowrap; display: inline-block; }
    .toggle-sidebar-btn { color: #1a1a1a !important; font-size: 24px !important; cursor: pointer !important; padding: 10px 15px !important; }
    .sidebar { width: 300px !important; top: 70px !important; background: #fff !important; border-right: 1px solid #e5e7eb !important; z-index: 997 !important; }
    .toggle-sidebar .sidebar { width: 80px !important; }
    .toggle-sidebar .sidebar .nav-link span { display: none !important; }
    .toggle-sidebar .sidebar .nav-link { justify-content: center !important; padding: 12px 0 !important; }
    #main { margin-left: 300px !important; margin-top: 70px !important; padding: 25px 35px !important; background: #f6f9ff !important; min-height: calc(100vh - 70px) !important; }
    .toggle-sidebar #main { margin-left: 80px !important; }
    .sidebar-nav .nav-link:not(.collapsed) { background: #e8ecff; color: #4154f1; border-radius: 6px; }
    .sidebar-nav .nav-link:not(.collapsed) i { color: #4154f1; }
    .sidebar-nav .nav-item { margin-bottom: 4px; }
    .sidebar-nav .nav-link { display: flex; align-items: center; padding: 12px 20px; font-size: 15px; font-weight: 400; font-family: "Poppins", sans-serif !important; color: #4b5563; transition: all 0.3s; }
    .sidebar-nav .nav-link i { font-size: 18px; margin-right: 12px; color: #6b7280; }
    .sidebar-nav .nav-link:hover { background: #f3f4f6; color: #4154f1; }
    i, .bi, [class^="bi-"], [class*=" bi-"], [class^="fa"], [class*=" fa-"] { font-family: unset !important; }
  </style>
</head>

<body>

@include('backend.includes.sidebar')

<main id="main" class="main">

<section class="section dashboard">
<div class="row">

<!-- CARD CETAK -->
<div class="col-12">
    <div class="card">
        <div class="card-body pt-3">

            <h5 class="card-title">Laporan Pokja 4</h5>

            <button type="button"
                class="btn btn-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalLaporan">

                <i class="bi bi-file-earmark-arrow-down"></i> Cetak Laporan
            </button>

        </div>
    </div>
</div>

</div>
</section>

</main>


<!-- MODAL -->
<div class="modal fade" id="modalLaporan" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">Cetak Laporan Pokja 4</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form id="formExport" method="GET">

<div class="modal-body">

    <!-- BULAN -->
    <div class="mb-3">
        <label>Bulan</label>
        <select name="bulan" class="form-select" required>
            <option value="">-- Pilih Bulan --</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </div>

    <!-- TAHUN -->
    <div class="mb-3">
        <label>Tahun</label>
        <select name="tahun" class="form-select" required>
            <option value="">-- Pilih Tahun --</option>

            @for ($year = now()->year; $year >= 2021; $year--)
                <option value="{{ $year }}">{{ $year }}</option>
            @endfor
        </select>
    </div>

    <!-- BIDANG -->
    <div class="mb-3">
        <label>Bidang</label>
        <select name="bidang" id="bidangSelect" class="form-select" required>
            <option value="">-- Pilih Bidang --</option>
            <option value="kesehatan">Kesehatan</option>
            <option value="kelestarian">Kelestarian Lingkungan Hidup</option>
            <option value="perencanaan">Perencanaan Sehat</option>
            <option value="kader">Kader Pokja 4</option>
            <option value="inovasi">Inovasi</option>
        </select>
    </div>

    <!-- SUB BIDANG INOVASI -->
    <div class="mb-3 d-none" id="subInovasiBox">
        <label>Jenis Inovasi</label>
        <select name="jenis_inovasi" class="form-select">
            <option value="">-- Pilih Jenis --</option>
            <option value="prioritas">Prioritas</option>
            <option value="keunggulan">Keunggulan</option>
        </select>
    </div>

    <!-- FORMAT -->
    <div class="mb-3">
        <label>Format</label>
        <select name="format" id="formatExport" class="form-select" required>
            <option value="">-- Pilih Format --</option>
            <option value="pdf">PDF</option>
            <option value="excel">Excel</option>
        </select>
    </div>

</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-success">
        <i class="bi bi-download"></i> Export
    </button>
</div>

</form>

</div>
</div>
</div>


<script src="backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
let bidang = document.getElementById('bidangSelect');
let subBox = document.getElementById('subInovasiBox');

bidang.addEventListener('change', function(){

    if(this.value == 'inovasi'){
        subBox.classList.remove('d-none');
    }else{
        subBox.classList.add('d-none');
    }

});

document.getElementById("formExport").addEventListener("submit", function(){

    let format = document.getElementById("formatExport").value;

    if(format == "pdf"){
        this.action = "{{ route('kesehatan.filter') }}";
    }

    if(format == "excel"){
        this.action = "LINK_APPS_SCRIPT";
    }

});
</script>

</body>
</html>

{{-- @endsection --}}
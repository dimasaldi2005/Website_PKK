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
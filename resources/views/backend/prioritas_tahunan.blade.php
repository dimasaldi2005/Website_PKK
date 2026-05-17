{{-- @extends('backend/layouts.template')

@section('content') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Rekap Desa Tahunan - Unggulan</title>

    <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            font-family: "Poppins", sans-serif !important;
        }

        body {
            background: #f6f9ff !important;
        }

        .header {
            background: #fff !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08) !important;
            height: 70px !important;
            padding: 0 20px !important;
            z-index: 998 !important;
        }

        .header .logo {
            min-width: auto;
            padding: 0;
            margin-left: 15px;
        }

        .header .logo img {
            max-height: 50px;
            width: 50px;
            border-radius: 50%;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .header .logo span {
            font-size: 15px;
            font-weight: 700;
            line-height: 1.3;
            color: #1a1a1a;
            white-space: nowrap;
            display: inline-block;
        }

        .toggle-sidebar-btn {
            color: #1a1a1a !important;
            font-size: 24px !important;
            cursor: pointer !important;
            padding: 10px 15px !important;
        }

        .sidebar {
            width: 300px !important;
            top: 70px !important;
            background: #fff !important;
            border-right: 1px solid #e5e7eb !important;
            z-index: 997 !important;
        }

        .toggle-sidebar .sidebar {
            width: 80px !important;
        }

        .toggle-sidebar .sidebar .nav-link span {
            display: none !important;
        }

        .toggle-sidebar .sidebar .nav-link {
            justify-content: center !important;
            padding: 12px 0 !important;
        }

        #main {
            margin-left: 300px !important;
            margin-top: 70px !important;
            padding: 25px 35px !important;
            background: #f6f9ff !important;
            min-height: calc(100vh - 70px) !important;
        }

        .toggle-sidebar #main {
            margin-left: 80px !important;
        }

        .sidebar-nav .nav-link:not(.collapsed) {
            background: #e8ecff;
            color: #4154f1;
            border-radius: 6px;
        }

        .sidebar-nav .nav-link:not(.collapsed) i {
            color: #4154f1;
        }

        .sidebar-nav .nav-item {
            margin-bottom: 4px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: 400;
            color: #4b5563;
            transition: all 0.3s;
        }

        .sidebar-nav .nav-link i {
            font-size: 18px;
            margin-right: 12px;
            color: #6b7280;
        }

        .sidebar-nav .nav-link:hover {
            background: #f3f4f6;
            color: #4154f1;
        }

        i,
        .bi,
        [class^="bi-"],
        [class*=" bi-"],
        [class^="fa"],
        [class*=" fa-"] {
            font-family: unset !important;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 10px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        }

        .table-responsive table {
            min-width: 1500px;
            white-space: nowrap;
            margin-bottom: 0;
        }

        .table-responsive thead th {
            position: sticky;
            top: 0;
            background: #f8fafc;
            color: #334155;
            z-index: 2;
            font-size: 12px;
            font-weight: 600;
            padding: 15px 10px;
            vertical-align: middle;
            border: 1px solid #e2e8f0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-responsive tbody td {
            font-size: 13px;
            padding: 12px 10px;
            vertical-align: middle;
            background-color: white;
            color: #475569;
        }

        .table-responsive tbody tr:hover td {
            background-color: #f1f5f9;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #e2e8f0;
        }

        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center w-100">
            <i class="bi bi-list toggle-sidebar-btn"></i>

            <a href="{{ route('dashboard') }}"
                class="logo d-flex align-items-center"
                style="text-decoration:none;">

                <img src="{{ asset('backend/assets/img/pkk.png') }}" alt="PKK">

                <span class="d-none d-lg-block">
                    Pemberdayaan Kesejahteraan Keluarga<br>
                    Kabupaten Nganjuk
                </span>

            </a>
        </div>

        <nav class="header-nav ms-auto"></nav>
    </header>

    <!-- Sidebar -->
    @include('backend.includes.sidebar')

    <!-- Main -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Rekap Desa Tahunan - Prioritas</h1>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ $message }}

            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
        @endif

        <div class="card mt-2">

            <div class="card-body">

                <div class="row mt-3">

                    <div class="col-md-4">

                        <form method="GET">

                            <label class="form-label fw-bold">
                                Status Laporan
                            </label>

                            <select name="status"
                                class="form-select"
                                onchange="this.form.submit()">

                                @if(Auth::guard('web')->check())

                                <option value="Disetujui1"
                                    {{ request('status') == 'Disetujui1' ? 'selected' : '' }}>
                                    Menunggu Persetujuan
                                </option>

                                <option value="Disetujui2"
                                    {{ request('status') == 'Disetujui2' ? 'selected' : '' }}>
                                    Sudah Disetujui
                                </option>

                                @elseif(Auth::guard('pengguna')->check())

                                <option value="Proses"
                                    {{ request('status') == 'Proses' ? 'selected' : '' }}>
                                    Menunggu Persetujuan
                                </option>

                                <option value="Disetujui1"
                                    {{ request('status') == 'Disetujui1' ? 'selected' : '' }}>
                                    Sudah Disetujui
                                </option>

                                @endif

                            </select>

                        </form>

                    </div>

                </div>

                <div class="alert alert-info d-flex align-items-center mt-3" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>

                    <div>
                        Scroll horizontal untuk melihat semua kolom data.
                    </div>
                </div>

                <div class="table-responsive mt-3">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <!-- ===================================================== -->
                            <!-- BARIS 1 -->
                            <!-- ===================================================== -->
                            <tr>

                                <th rowspan="4" class="text-center align-middle">
                                    NO
                                </th>

                                <th rowspan="4"
                                    class="text-center align-middle"
                                    style="min-width:260px;">

                                    NAMA WILAYAH <br>
                                    (DUSUN/DES/KEL/KEC/KAB/KOTA/PROV)

                                </th>

                                <!-- KESEHATAN -->
                                <th colspan="9" class="text-center align-middle">
                                    KESEHATAN
                                </th>

                                <!-- KELESTARIAN -->
                                <th colspan="7" class="text-center align-middle">
                                    KELESTARIAN LINGKUNGAN HIDUP
                                </th>

                                <!-- PERENCANAAN -->
                                <th colspan="6" class="text-center align-middle">
                                    PERENCANAAN SEHAT
                                </th>

                                <!-- PROGRAM -->
                                <th colspan="3" class="text-center align-middle">

                                    PROGRAM UNGGULAN <br>
                                    GERAKAN KELUARGA SEHAT <br>
                                    TANGGAP & TANGGUH <br>
                                    BENCANA (GKSTTB)

                                </th>

                                <th rowspan="4" class="text-center align-middle">
                                    STATUS
                                </th>

                                <th rowspan="4" class="text-center align-middle">
                                    TANGGAL
                                </th>

                                <th rowspan="4" class="text-center align-middle">
                                    AKSI
                                </th>

                            </tr>

                            <!-- ===================================================== -->
                            <!-- BARIS 2 -->
                            <!-- ===================================================== -->
                            <tr>

                                <!-- KESEHATAN -->
                                <th colspan="5" class="text-center align-middle">
                                    JUMLAH KADER
                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle rotate-text">

                                    POSYANDU

                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle rotate-text">

                                    IMUNISASI/VAKSINASI BAYI/BALITA

                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle rotate-text">

                                    PKG

                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle rotate-text">

                                    TBC

                                </th>

                                <!-- KELESTARIAN -->
                                <th colspan="3" class="text-center align-middle">

                                    JUMLAH RUMAH <br>
                                    YANG MEMILIKI

                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle">

                                    JUMLAH MCK

                                </th>

                                <th colspan="3"
                                    class="text-center align-middle">

                                    JUMLAH KRT <br>
                                    YANG MENGGUNAKAN AIR

                                </th>

                                <!-- PERENCANAAN -->
                                <th rowspan="3"
                                    class="text-center align-middle">

                                    JML PUS

                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle">

                                    JML WUS

                                </th>

                                <th colspan="2"
                                    class="text-center align-middle">

                                    JML AKSEPTOR KB

                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle">

                                    JML. KK YANG <br>
                                    MEMILIKI TABUNGAN <br>
                                    KELUARGA

                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle">

                                    JML. KK YANG <br>
                                    MEMILIKI ASURANSI <br>
                                    KESEHATAN

                                </th>

                                <!-- PROGRAM -->
                                <th rowspan="3"
                                    class="text-center align-middle program-vertical">

                                    KESEHATAN

                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle program-vertical">

                                    KELESTARIAN <br>
                                    LINGKUNGAN HIDUP

                                </th>

                                <th rowspan="3"
                                    class="text-center align-middle program-vertical">

                                    PERENCANAAN <br>
                                    SEHAT

                                </th>

                            </tr>

                            <!-- ===================================================== -->
                            <!-- BARIS 3 -->
                            <!-- ===================================================== -->
                            <tr>

                                <!-- JUMLAH KADER -->
                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    KADER KESEHATAN

                                </th>

                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    GIZI

                                </th>

                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    KESLING

                                </th>

                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    PHBS

                                </th>

                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    KB

                                </th>

                                <!-- RUMAH -->
                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    JAMBAN (WC)

                                </th>

                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    SPAL

                                </th>

                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    TPS

                                </th>

                                <!-- AIR -->
                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    PDAM

                                </th>

                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    SUMUR

                                </th>

                                <th rowspan="2"
                                    class="text-center align-middle rotate-text">

                                    LAIN-LAIN

                                </th>

                                <!-- AKSEPTOR -->
                                <th rowspan="2"
                                    class="text-center align-middle">

                                    L

                                </th>

                                <th rowspan="2"
                                    class="text-center align-middle">

                                    P

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @php $no = 1; @endphp

                            @forelse ($data as $item)

                            <tr>

                                <td class="text-center">
                                    {{ $no++ }}
                                </td>

                                <td>
                                    {{ $item->nama_desa ?? '-' }}
                                </td>

                                <!-- KESEHATAN -->
                                <td class="text-center">{{ $item->kader_kesehatan ?? 0 }}</td>
                                <td class="text-center">{{ $item->gizi ?? 0 }}</td>
                                <td class="text-center">{{ $item->kesling ?? 0 }}</td>
                                <td class="text-center">{{ $item->phbs ?? 0 }}</td>
                                <td class="text-center">{{ $item->kb ?? 0 }}</td>
                                <td class="text-center">{{ $item->posyandu ?? 0 }}</td>
                                <td class="text-center">{{ $item->imunisasi_vaksinasi_bayi_balita ?? 0 }}</td>
                                <td class="text-center">{{ $item->pkg ?? 0 }}</td>
                                <td class="text-center">{{ $item->tbc ?? 0 }}</td>

                                <!-- KELESTARIAN -->
                                <td class="text-center">{{ $item->jamban_wc ?? 0 }}</td>
                                <td class="text-center">{{ $item->spal ?? 0 }}</td>
                                <td class="text-center">{{ $item->tps ?? 0 }}</td>
                                <td class="text-center">{{ $item->jumlah_mck ?? 0 }}</td>
                                <td class="text-center">{{ $item->pdam ?? 0 }}</td>
                                <td class="text-center">{{ $item->sumur ?? 0 }}</td>
                                <td class="text-center">{{ $item->lain_lain ?? 0 }}</td>

                                <!-- PERENCANAAN -->
                                <td class="text-center">{{ $item->jml_pus ?? 0 }}</td>
                                <td class="text-center">{{ $item->jml_wus ?? 0 }}</td>
                                <td class="text-center">{{ $item->akseptor_kb_l ?? 0 }}</td>
                                <td class="text-center">{{ $item->akseptor_kb_p ?? 0 }}</td>
                                <td class="text-center">{{ $item->jml_kk_tabungan ?? 0 }}</td>
                                <td class="text-center">{{ $item->jml_kk_asuransi ?? 0 }}</td>

                                <!-- PROGRAM -->
                                <td class="text-center">{{ $item->kesehatan_program ?? 0 }}</td>
                                <td class="text-center">{{ $item->kelestarian_lingkungan_hidup ?? 0 }}</td>
                                <td class="text-center">{{ $item->perencanaan_sehat_program ?? 0 }}</td>

                                <!-- STATUS -->
                                <td class="text-center">

                                    @if(in_array(strtolower($item->status), ['proses', 'revisi']))

                                    <span class="badge bg-warning text-dark">
                                        {{ $item->status }}
                                    </span>

                                    @elseif(in_array(strtolower($item->status), ['disetujui1', 'disetujui2']))

                                    <span class="badge bg-success">
                                        {{ $item->status }}
                                    </span>

                                    @else

                                    <span class="badge bg-secondary">
                                        {{ $item->status }}
                                    </span>

                                    @endif

                                </td>

                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                </td>

                                <td class="text-center" style="white-space: nowrap;">

                                    @php
                                    $bolehEdit = false;

                                    /*
                                    |--------------------------------------------------------------------------
                                    | WEB KABUPATEN
                                    | - MOBILE DESA => Disetujui1
                                    | - MOBILE KEC => Proses
                                    |--------------------------------------------------------------------------
                                    */
                                    if (Auth::guard('web')->check()) {

                                    /*
                                    |--------------------------------------------------------------------------
                                    | DESA
                                    |--------------------------------------------------------------------------
                                    */
                                    if (
                                    $item->id_role == 1 &&
                                    strtolower($item->status) == 'disetujui1'
                                    ) {
                                    $bolehEdit = true;
                                    }

                                    /*
                                    |--------------------------------------------------------------------------
                                    | KECAMATAN
                                    |--------------------------------------------------------------------------
                                    */
                                    if (
                                    $item->id_role == 2 &&
                                    strtolower($item->status) == 'proses'
                                    ) {
                                    $bolehEdit = true;
                                    }
                                    }

                                    /*
                                    |--------------------------------------------------------------------------
                                    | WEB KECAMATAN
                                    | - MOBILE DESA => Proses
                                    |--------------------------------------------------------------------------
                                    */
                                    if (
                                    Auth::guard('pengguna')->check() &&
                                    strtolower($item->status) == 'proses'
                                    ) {
                                    $bolehEdit = true;
                                    }
                                    @endphp

                                    @if($bolehEdit)

                                    <a href="{{ route('prioritas.tahunan.edit', $item->id_rekap_desa_tahunan) }}"
                                        class="btn btn-sm btn-info text-white me-1"
                                        data-bs-toggle="tooltip"
                                        title="Review Data">

                                        <i class="bi bi-search"></i>

                                    </a>

                                    @endif

                                    <form action="{{ route('prioritas.tahunan.destroy', $item->id_rekap_desa_tahunan)}}"
                                        method="POST"
                                        class="d-inline delete-form">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmDelete(this)"
                                            data-bs-toggle="tooltip"
                                            title="Hapus Data">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="100" class="text-center py-5">

                                    <div class="alert alert-danger mb-0 w-100">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        Tidak ada data laporan.
                                    </div>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>

    <!-- Back To Top -->
    <a href="#"
        class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS -->
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    <script>
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );

        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        function confirmDelete(button) {

            Swal.fire({
                title: 'Yakin hapus data?',
                text: "Data yang dihapus tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {

                if (result.isConfirmed) {
                    button.closest('form').submit();
                }

            });
        }
    </script>

</body>

</html>

{{-- @endsection --}}
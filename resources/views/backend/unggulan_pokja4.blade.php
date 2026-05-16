{{-- @extends('backend/layouts.template')

@section('content') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Laporan Kegiatan Pokja 4 - Unggulan</title>

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

        /* ======================================================
       HEADER
    ====================================================== */

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

        /* ======================================================
       SIDEBAR
    ====================================================== */

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

        /* ======================================================
       TABLE WRAPPER
    ====================================================== */

        .table-responsive {
            overflow-x: auto;
            overflow-y: auto;
            max-height: 80vh;
            -webkit-overflow-scrolling: touch;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        }

        /* ======================================================
       TABLE POKJA 4
    ====================================================== */

        .table-pokja4 {
            width: 100%;
            min-width: 2300px;
            border-collapse: collapse !important;
            margin-bottom: 0 !important;
            background: #fff;
        }

        /* ======================================================
       HEADER TABLE
    ====================================================== */

        .table-pokja4 thead th {
            position: sticky;
            top: 0;
            z-index: 2;

            background: #f8fafc !important;
            color: #334155 !important;

            border: 1px solid #dbe2ea !important;

            text-align: center !important;
            vertical-align: middle !important;

            font-size: 11px !important;
            font-weight: 700 !important;

            padding: 10px 6px !important;

            line-height: 1.4;
            letter-spacing: .3px;

            text-transform: uppercase;
            white-space: normal !important;
        }

        /* ======================================================
       HEADER GROUP
    ====================================================== */

        .group-header {
            background: #eef2ff !important;
            color: #1e3a8a !important;
            font-size: 12px !important;
            font-weight: 700 !important;
        }

        /* ======================================================
       BODY TABLE
    ====================================================== */

        .table-pokja4 tbody td {
            border: 1px solid #e2e8f0 !important;

            text-align: center !important;
            vertical-align: middle !important;

            font-size: 12px !important;
            font-weight: 500;

            padding: 10px 6px !important;

            background: #fff;
            color: #475569;

            white-space: nowrap;
        }

        .table-pokja4 tbody tr:hover td {
            background: #f8fafc !important;
        }

        /* ======================================================
       KOLOM WILAYAH
    ====================================================== */

        .wilayah-col {
            min-width: 190px;
        }

        /* ======================================================
       TEXT VERTICAL
    ====================================================== */

        .vertical-text {
            writing-mode: unset !important;
            transform: none !important;

            white-space: normal !important;

            min-width: 90px;
            height: auto;

            padding: 12px 8px !important;

            text-align: center !important;
            vertical-align: middle !important;

            font-size: 11px !important;
            font-weight: 700 !important;

            line-height: 1.5;
            letter-spacing: .3px;

            font-family: "Poppins", sans-serif !important;
        }

        /* ======================================================
       BORDER
    ====================================================== */

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dbe2ea !important;
        }

        /* ======================================================
       SCROLLBAR
    ====================================================== */

        .table-responsive::-webkit-scrollbar {
            height: 10px;
            width: 10px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 20px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 20px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* ======================================================
       BADGE
    ====================================================== */

        .badge {
            padding: 6px 10px !important;
            border-radius: 30px !important;
            font-size: 11px !important;
            font-weight: 600 !important;
        }

        /* ======================================================
       BUTTON
    ====================================================== */

        .btn-sm {
            padding: 5px 9px !important;
            border-radius: 8px !important;
        }

        /* ======================================================
       RESPONSIVE
    ====================================================== */

        @media (max-width: 768px) {

            #main {
                padding: 15px !important;
            }

            .table-pokja4 {
                min-width: 2000px;
            }

            .table-pokja4 thead th {
                font-size: 10px !important;
            }

            .table-pokja4 tbody td {
                font-size: 11px !important;
            }
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
            <h1>Laporan Kegiatan Pokja 4 - Unggulan</h1>
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

                    <table class="table table-bordered table-hover table-pokja4">

                        <thead>

                            <tr>

                                <th rowspan="4">NO</th>

                                @if (Auth::guard('web')->check())

                                <th rowspan="4" class="wilayah-col">
                                    NAMA
                                    <br>
                                    WILAYAH
                                    <br>
                                    (DESA/KELURAHAN/KECAMATAN)
                                </th>

                                @else

                                <th rowspan="4" class="wilayah-col">
                                    NAMA
                                    <br>
                                    WILAYAH
                                    <br>
                                    (DESA/KELURAHAN)
                                </th>

                                @endif

                                {{-- KESEHATAN --}}
                                <th colspan="9" class="group-header">
                                    KESEHATAN
                                </th>

                                {{-- KELESTARIAN --}}
                                <th colspan="7" class="group-header">
                                    KELESTARIAN LINGKUNGAN HIDUP
                                </th>

                                {{-- PERENCANAAN --}}
                                <th colspan="6" class="group-header">
                                    PERENCANAAN SEHAT
                                </th>

                                {{-- PROGRAM --}}
                                <th colspan="3" class="group-header">
                                    PROGRAM UNGGULAN
                                    <br>
                                    GERAKAN KELUARGA
                                    <br>
                                    SEHAT TANGGAP &
                                    <br>
                                    TANGGUH BENCANA
                                    <br>
                                    (GKSTTB)
                                </th>

                                <th rowspan="4">STATUS</th>
                                <th rowspan="4">TANGGAL</th>
                                <th rowspan="4">AKSI</th>

                            </tr>

                            <tr>

                                {{-- JUMLAH KADER --}}
                                <th colspan="5">
                                    JUMLAH KADER
                                </th>

                                <th rowspan="3" class="vertical-text">
                                    POSYANDU
                                </th>

                                <th rowspan="3" class="vertical-text">
                                    IMUNISASI / VAKSINASI BAYI / BALITA
                                </th>

                                <th rowspan="3" class="vertical-text">
                                    PKG
                                </th>

                                <th rowspan="3" class="vertical-text">
                                    TBC
                                </th>

                                {{-- RUMAH --}}
                                <th colspan="3">
                                    JUMLAH RUMAH
                                    <br>
                                    YANG MEMILIKI
                                </th>

                                <th rowspan="3">
                                    JUMLAH
                                    <br>
                                    MCK
                                </th>

                                {{-- AIR --}}
                                <th colspan="3">
                                    JUMLAH KRT
                                    <br>
                                    YANG
                                    <br>
                                    MENGGUNAKAN AIR
                                </th>

                                {{-- PERENCANAAN --}}
                                <th rowspan="3">
                                    JML
                                    <br>
                                    PUS
                                </th>

                                <th rowspan="3">
                                    JML
                                    <br>
                                    WUS
                                </th>

                                <th colspan="2">
                                    JML
                                    <br>
                                    AKSEPTOR KB
                                </th>

                                <th rowspan="3">
                                    JML. KK
                                    <br>
                                    YANG
                                    <br>
                                    MEMILIKI
                                    <br>
                                    TABUNGAN
                                    <br>
                                    KELUARGA
                                </th>

                                <th rowspan="3">
                                    JML. KK
                                    <br>
                                    YANG
                                    <br>
                                    MEMILIKI
                                    <br>
                                    ASURANSI
                                    <br>
                                    KESEHATAN
                                </th>

                                {{-- GKSTTB --}}
                                <th rowspan="3">
                                    KESEHATAN
                                </th>

                                <th rowspan="3">
                                    KELESTARIAN
                                    <br>
                                    LINGKUNGAN
                                    <br>
                                    HIDUP
                                </th>

                                <th rowspan="3">
                                    PERENCANAAN
                                    <br>
                                    SEHAT
                                </th>

                            </tr>

                            <tr>

                                {{-- KADER --}}
                                <th rowspan="2" class="vertical-text">
                                    KADER KESEHATAN
                                </th>

                                <th rowspan="2" class="vertical-text">
                                    GIZI
                                </th>

                                <th rowspan="2" class="vertical-text">
                                    KESLING
                                </th>

                                <th rowspan="2" class="vertical-text">
                                    PHBS
                                </th>

                                <th rowspan="2" class="vertical-text">
                                    KB
                                </th>

                                {{-- RUMAH --}}
                                <th rowspan="2" class="vertical-text">
                                    JAMBAN (WC)
                                </th>

                                <th rowspan="2" class="vertical-text">
                                    SPAL
                                </th>

                                <th rowspan="2" class="vertical-text">
                                    TPS
                                </th>

                                {{-- AIR --}}
                                <th rowspan="2" class="vertical-text">
                                    PDAM
                                </th>

                                <th rowspan="2" class="vertical-text">
                                    SUMUR
                                </th>

                                <th rowspan="2" class="vertical-text">
                                    LAIN-LAIN
                                </th>

                                {{-- KB --}}
                                <th rowspan="2">
                                    L
                                </th>

                                <th rowspan="2">
                                    P
                                </th>

                            </tr>

                            <tr></tr>

                        </thead>

                        <tbody>

                            @php $no = 1; @endphp

                            @forelse ($data as $item)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $no++ }}
                                </td>

                                {{-- WILAYAH --}}
                                @if (Auth::guard('web')->check())

                                <td class="text-start">
                                    <strong>
                                        {{ $item->nama_desa ?? '-' }}
                                    </strong>

                                    <br>

                                    <small class="text-muted">
                                        {{ $item->nama_kec ?? '-' }}
                                    </small>
                                </td>

                                @else

                                <td class="text-start">
                                    <strong>
                                        {{ $item->nama_desa ?? '-' }}
                                    </strong>
                                </td>

                                @endif

                                {{-- KESEHATAN --}}
                                <td>{{ $item->kader_kesehatan ?? 0 }}</td>
                                <td>{{ $item->gizi ?? 0 }}</td>
                                <td>{{ $item->kesling ?? 0 }}</td>
                                <td>{{ $item->phbs ?? 0 }}</td>
                                <td>{{ $item->kb ?? 0 }}</td>
                                <td>{{ $item->posyandu ?? 0 }}</td>
                                <td>{{ $item->imunisasi_vaksinasi_bayi_balita ?? 0 }}</td>
                                <td>{{ $item->pkg ?? 0 }}</td>
                                <td>{{ $item->tbc ?? 0 }}</td>

                                {{-- KELESTARIAN --}}
                                <td>{{ $item->jamban_wc ?? 0 }}</td>
                                <td>{{ $item->spal ?? 0 }}</td>
                                <td>{{ $item->tps ?? 0 }}</td>
                                <td>{{ $item->jumlah_mck ?? 0 }}</td>
                                <td>{{ $item->pdam ?? 0 }}</td>
                                <td>{{ $item->sumur ?? 0 }}</td>
                                <td>{{ $item->lain_lain ?? 0 }}</td>

                                {{-- PERENCANAAN --}}
                                <td>{{ $item->jml_pus ?? 0 }}</td>
                                <td>{{ $item->jml_wus ?? 0 }}</td>
                                <td>{{ $item->akseptor_kb_l ?? 0 }}</td>
                                <td>{{ $item->akseptor_kb_p ?? 0 }}</td>
                                <td>{{ $item->kk_memiliki_tabungan ?? 0 }}</td>
                                <td>{{ $item->kk_memiliki_asuransi ?? 0 }}</td>

                                {{-- GKSTTB --}}
                                <td>{{ $item->kesehatan ?? 0 }}</td>
                                <td>{{ $item->kelestarian_lingkungan_hidup ?? 0 }}</td>
                                <td>{{ $item->perencanaan_sehat ?? 0 }}</td>

                                {{-- STATUS --}}
                                <td>

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

                                {{-- TANGGAL --}}
                                <td>
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                </td>

                                {{-- AKSI --}}
                                <td style="white-space: nowrap;">

                                    @php
                                    $bolehEdit = false;

                                    if (Auth::guard('web')->check()) {

                                    if (
                                    $item->id_role == 1 &&
                                    strtolower($item->status) == 'disetujui1'
                                    ) {
                                    $bolehEdit = true;
                                    }

                                    if (
                                    $item->id_role == 2 &&
                                    strtolower($item->status) == 'proses'
                                    ) {
                                    $bolehEdit = true;
                                    }
                                    }

                                    if (
                                    Auth::guard('pengguna')->check() &&
                                    strtolower($item->status) == 'proses'
                                    ) {
                                    $bolehEdit = true;
                                    }
                                    @endphp

                                    @if($bolehEdit)

                                    <a href="{{ route('unggulan.pokja4.edit', $item->id_kegiatan_pokja4) }}"
                                        class="btn btn-sm btn-info text-white me-1">

                                        <i class="bi bi-search"></i>

                                    </a>

                                    @endif

                                    <form action="{{ route('unggulan.pokja4.destroy', $item->id_kegiatan_pokja4)}}"
                                        method="POST"
                                        class="d-inline delete-form">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmDelete(this)">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="40" class="text-center py-5">

                                    <div class="alert alert-danger mb-0">

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
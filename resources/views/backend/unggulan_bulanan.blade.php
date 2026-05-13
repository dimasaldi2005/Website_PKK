<!-- resources/views/backend/unggulan_bulanan.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Rekap Desa Bulanan - Unggulan</title>

    <!-- Favicons -->
    <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|
        Nunito:300,300i,400,400i,600,600i,700,700i|
        Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}"
        rel="stylesheet">

    <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}"
        rel="stylesheet">

    <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}"
        rel="stylesheet">

    <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}"
        rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('backend/assets/css/style.css') }}"
        rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet"
        href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06);
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 12px;
        }

        .table-responsive table {
            min-width: 1800px;
            white-space: nowrap;
        }

        .table thead th {
            text-align: center;
            vertical-align: middle;
            font-size: 12px;
            font-weight: 700;
            background: #f8fafc;
            color: #334155;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
            font-size: 12px;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .badge {
            font-size: 11px;
            padding: 8px 14px;
        }

        .btn-sm {
            padding: 6px 10px;
        }
    </style>

</head>

<body>

    <!-- ======= HEADER ======= -->
    <header id="header"
        class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">

            <a href="#"
                class="logo d-flex align-items-center">

                <img src="{{ asset('backend/assets/img/pkk.png') }}"
                    alt="">

                <span class="d-none d-lg-block">

                    PKK NGANJUK

                </span>

            </a>

            <i class="bi bi-list toggle-sidebar-btn"></i>

        </div>

    </header>

    <!-- ======= SIDEBAR ======= -->
    @include('backend.includes.sidebar')

    <!-- ======= MAIN ======= -->
    <main id="main"
        class="main">

        <!-- PAGE TITLE -->
        <div class="pagetitle mb-4">

            <h1>Rekap Desa Bulanan - Unggulan</h1>

        </div>

        <!-- ALERT -->
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show"
            role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ $message }}

            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

        @endif

        <!-- SECTION -->
        <section class="section dashboard">

            <div class="card">

                <div class="card-body p-4">

                    <!-- FILTER -->
                    <div class="row mb-4">

                        <div class="col-md-4">

                            <form method="GET">

                                <label class="form-label fw-bold">

                                    Status Laporan

                                </label>

                                <select name="status"
                                    class="form-select"
                                    onchange="this.form.submit()">

                                    {{-- MENUNGGU PERSETUJUAN --}}
                                    <option value="Proses"
                                        {{ request('status', 'Proses') == 'Proses' ? 'selected' : '' }}>

                                        Menunggu Persetujuan

                                    </option>

                                    {{-- SUDAH DISETUJUI --}}
                                    <option value="Disetujui2"
                                        {{ request('status') == 'Disetujui2' ? 'selected' : '' }}>

                                        Sudah Disetujui

                                    </option>

                                </select>

                            </form>

                        </div>

                    </div>

                    <!-- INFO -->
                    <div class="alert alert-info d-flex align-items-center">

                        <i class="bi bi-info-circle-fill me-2"></i>

                        <div>

                            Scroll horizontal untuk melihat seluruh data laporan.

                        </div>

                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive mt-4">

                        <table class="table table-bordered table-hover align-middle">

                            <thead>

                                <!-- HEADER -->
                                <tr>

                                    <th rowspan="3">NO</th>

                                    @if (Auth::guard('web')->check())

                                    <th rowspan="3">
                                        KECAMATAN
                                    </th>

                                    <th rowspan="3">
                                        DESA
                                    </th>

                                    @elseif (Auth::guard('pengguna')->check())

                                    <th rowspan="3">
                                        DESA
                                    </th>

                                    @endif

                                    <th colspan="3">
                                        JUMLAH
                                    </th>

                                    <th colspan="4">
                                        JUMLAH IBU
                                    </th>

                                    <th colspan="6">
                                        JUMLAH BAYI
                                    </th>

                                    <th colspan="2">
                                        BALITA MENINGGAL
                                    </th>

                                    <th rowspan="3">
                                        STATUS
                                    </th>

                                    <th rowspan="3">
                                        TANGGAL
                                    </th>

                                    <th rowspan="3">
                                        AKSI
                                    </th>

                                </tr>

                                <!-- HEADER 2 -->
                                <tr>

                                    <th rowspan="2">RW</th>
                                    <th rowspan="2">RT</th>
                                    <th rowspan="2">DASA WISMA</th>

                                    <th rowspan="2">HAMIL</th>
                                    <th rowspan="2">MELAHIRKAN</th>
                                    <th rowspan="2">NIFAS</th>
                                    <th rowspan="2">MENINGGAL</th>

                                    <th colspan="2">LAHIR</th>

                                    <th colspan="2">AKTE</th>

                                    <th colspan="2">MENINGGAL</th>

                                    <th colspan="2"></th>

                                </tr>

                                <!-- HEADER 3 -->
                                <tr>

                                    <th>L</th>
                                    <th>P</th>

                                    <th>ADA</th>
                                    <th>TIDAK</th>

                                    <th>L</th>
                                    <th>P</th>

                                    <th>L</th>
                                    <th>P</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($data as $item)

                                <tr>

                                    <!-- NO -->
                                    <td>

                                        {{ $loop->iteration }}

                                    </td>

                                    <!-- KEC / DESA -->
                                    @if (Auth::guard('web')->check())

                                    <td>

                                        {{ $item->nama_kec ?? '-' }}

                                    </td>

                                    <td>

                                        {{ $item->nama_desa ?? '-' }}

                                    </td>

                                    @elseif (Auth::guard('pengguna')->check())

                                    <td>

                                        {{ $item->nama_desa ?? '-' }}

                                    </td>

                                    @endif

                                    <!-- DATA -->
                                    <td>{{ $item->rw ?? 0 }}</td>
                                    <td>{{ $item->rt ?? 0 }}</td>
                                    <td>{{ $item->dasa_wisma ?? 0 }}</td>

                                    <td>{{ $item->hamil ?? 0 }}</td>
                                    <td>{{ $item->melahirkan ?? 0 }}</td>
                                    <td>{{ $item->nifas ?? 0 }}</td>
                                    <td>{{ $item->meninggal ?? 0 }}</td>

                                    <td>{{ $item->bayi_lahir_l ?? 0 }}</td>
                                    <td>{{ $item->bayi_lahir_p ?? 0 }}</td>

                                    <td>{{ $item->akte_kelahiran_ada ?? 0 }}</td>
                                    <td>{{ $item->akte_kelahiran_tidak ?? 0 }}</td>

                                    <td>{{ $item->bayi_meninggal_l ?? 0 }}</td>
                                    <td>{{ $item->bayi_meninggal_p ?? 0 }}</td>

                                    <td>{{ $item->balita_meninggal_l ?? 0 }}</td>
                                    <td>{{ $item->balita_meninggal_p ?? 0 }}</td>

                                    <!-- STATUS -->
                                    <td class="text-center">

                                        {{-- WEB KABUPATEN --}}
                                        @if(Auth::guard('web')->check())

                                        {{-- MENUNGGU --}}
                                        @if($item->status == 'Proses')

                                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2">

                                            <i class="bi bi-hourglass-split me-1"></i>

                                            Menunggu Persetujuan

                                        </span>

                                        {{-- SUDAH --}}
                                        @elseif($item->status == 'Disetujui2')

                                        <span class="badge rounded-pill bg-success px-3 py-2">

                                            <i class="bi bi-check-circle-fill me-1"></i>

                                            Disetujui Kabupaten

                                        </span>

                                        @endif

                                        {{-- WEB KECAMATAN --}}
                                        @elseif(Auth::guard('pengguna')->check())

                                        {{-- PROSES --}}
                                        @if($item->status == 'Proses')

                                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2">

                                            <i class="bi bi-hourglass-split me-1"></i>

                                            Proses

                                        </span>

                                        {{-- DISETUJUI --}}
                                        @elseif($item->status == 'Disetujui2')

                                        <span class="badge rounded-pill bg-success px-3 py-2">

                                            <i class="bi bi-check-circle-fill me-1"></i>

                                            Disetujui1

                                        </span>

                                        @endif

                                        @endif

                                    </td>

                                    <!-- TANGGAL -->
                                    <td>

                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}

                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-center">

                                        {{-- WEB KABUPATEN --}}
                                        @if(Auth::guard('web')->check())

                                        {{-- MENUNGGU --}}
                                        @if($item->status == 'Proses')

                                        <div class="d-flex justify-content-center gap-1">

                                            <!-- REVIEW -->
                                            <a href="#"
                                                class="btn btn-info btn-sm rounded-pill px-3"
                                                title="Review">

                                                <i class="bi bi-eye-fill"></i>

                                            </a>

                                            <!-- HAPUS -->
                                            <form action="#"
                                                method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-pill px-3"
                                                    title="Hapus">

                                                    <i class="bi bi-trash-fill"></i>

                                                </button>

                                            </form>

                                        </div>

                                        {{-- SUDAH --}}
                                        @elseif($item->status == 'Disetujui2')

                                        <div class="d-flex justify-content-center gap-1">

                                            <!-- DETAIL -->
                                            <a href="#"
                                                class="btn btn-primary btn-sm rounded-pill px-3"
                                                title="Detail">

                                                <i class="bi bi-eye-fill"></i>

                                            </a>

                                            <!-- HAPUS -->
                                            <form action="#"
                                                method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-pill px-3"
                                                    title="Hapus">

                                                    <i class="bi bi-trash-fill"></i>

                                                </button>

                                            </form>

                                        </div>

                                        @endif

                                        {{-- WEB KECAMATAN --}}
                                        @elseif(Auth::guard('pengguna')->check())

                                        {{-- PROSES --}}
                                        @if($item->status == 'Proses')

                                        <div class="d-flex justify-content-center gap-1">

                                            <!-- REVIEW -->
                                            <a href="#"
                                                class="btn btn-info btn-sm rounded-pill px-3">

                                                <i class="bi bi-eye-fill"></i>

                                            </a>

                                            <!-- HAPUS -->
                                            <form action="#"
                                                method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-pill px-3">

                                                    <i class="bi bi-trash-fill"></i>

                                                </button>

                                            </form>

                                        </div>

                                        {{-- DISETUJUI --}}
                                        @elseif($item->status == 'Disetujui2')

                                        <div class="d-flex justify-content-center gap-1">

                                            <!-- DETAIL -->
                                            <a href="#"
                                                class="btn btn-primary btn-sm rounded-pill px-3">

                                                <i class="bi bi-eye-fill"></i>

                                            </a>

                                            <!-- HAPUS -->
                                            <form action="#"
                                                method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-pill px-3">

                                                    <i class="bi bi-trash-fill"></i>

                                                </button>

                                            </form>

                                        </div>

                                        @endif

                                        @endif

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="25"
                                        class="text-center py-5">

                                        <div class="alert alert-danger mb-0">

                                            <i class="bi bi-exclamation-circle-fill me-2"></i>

                                            Tidak ada data laporan

                                        </div>

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <!-- BACK TO TOP -->
    <a href="#"
        class="back-to-top d-flex align-items-center justify-content-center">

        <i class="bi bi-arrow-up-short"></i>

    </a>

    <!-- JS -->
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

</body>

</html>
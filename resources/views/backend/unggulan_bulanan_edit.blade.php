{{-- @extends('backend/layouts.template') --}}
{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Review Laporan Unggulan Bulanan</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
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

    <!-- Template Main CSS File -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">

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
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
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
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('backend.includes.sidebar')
    <!-- End Sidebar -->

    <main id="main" class="main">

        <section class="section">

            <div class="row">

                <div class="col-md-12 mx-auto mt-2">

                    <div class="pagetitle">
                        <h1>Review Laporan Unggulan Bulanan</h1>
                    </div>

                    <div class="card">

                        <div class="card-body mt-4">

                            <form action="{{ route('unggulan.bulanan.update', $data->id_rekap_desa_bulanan) }}"
                                method="POST"
                                enctype="multipart/form-data"
                                onsubmit="event.preventDefault(); confirmSubmission(event)">

                                @csrf
                                @method('PUT')

                                <div class="form-outline mb-4">

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            ID Laporan Unggulan
                                        </label>

                                        <input type="text"
                                            class="form-control"
                                            value="{{ $data->id_rekap_desa_bulanan }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Jumlah RW
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="rw"
                                            value="{{ $data->rw }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Jumlah RT
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="rt"
                                            value="{{ $data->rt }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Jumlah Dasa Wisma
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="dasa_wisma"
                                            value="{{ $data->dasa_wisma }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Ibu Hamil
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="hamil"
                                            value="{{ $data->hamil }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Ibu Melahirkan
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="melahirkan"
                                            value="{{ $data->melahirkan }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Ibu Nifas
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="nifas"
                                            value="{{ $data->nifas }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Ibu Meninggal
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="meninggal"
                                            value="{{ $data->meninggal }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Bayi Lahir (Laki-laki)
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="bayi_lahir_l"
                                            value="{{ $data->bayi_lahir_l }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Bayi Lahir (Perempuan)
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="bayi_lahir_p"
                                            value="{{ $data->bayi_lahir_p }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Akte Kelahiran (Ada)
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="akte_kelahiran_ada"
                                            value="{{ $data->akte_kelahiran_ada }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Akte Kelahiran (Tidak)
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="akte_kelahiran_tidak"
                                            value="{{ $data->akte_kelahiran_tidak }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Bayi Meninggal (Laki-laki)
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="bayi_meninggal_l"
                                            value="{{ $data->bayi_meninggal_l }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Bayi Meninggal (Perempuan)
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="bayi_meninggal_p"
                                            value="{{ $data->bayi_meninggal_p }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Balita Meninggal (Laki-laki)
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="balita_meninggal_l"
                                            value="{{ $data->balita_meninggal_l }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label class="form-label">
                                            Balita Meninggal (Perempuan)
                                        </label>

                                        <input type="number"
                                            class="form-control"
                                            name="balita_meninggal_p"
                                            value="{{ $data->balita_meninggal_p }}"
                                            readonly>
                                    </div>

                                    <div class="form-outline mb-4 mt-3">
                                        <label for="id_user" class="form-label">Id Pengguna</label>
                                        <input type="text" name="id_user" id="id_user" class="form-control" required readonly
                                            oninvalid="this.setCustomValidity('Harap lengkapi id pengguna')"
                                            oninput="this.setCustomValidity('')" placeholder="Masukkan Judul" value="{{ $data->id_user }}" />
                                    </div>

                                    <div id="statusAlert"
                                        class="alert alert-danger d-none"
                                        role="alert">
                                        Harap pilih status laporan.
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="datepicker-trigger form-control hasDatepicker"
                                            onchange="exibeMsg(this.value);">
                                            <option value="">--Pilih--</option>
                                            <option value="Revisi">Revisi</option>
                                            @if(Auth::guard('pengguna')->check())
                                            <option value="Disetujui1">Disetujui (Kecamatan)</option>
                                            @else
                                            <option value="Disetujui2">Disetujui (Admin)</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-outline mb-1 mt-3">

                                        <label class="form-label">
                                            Catatan
                                        </label>

                                        <input type="text"
                                            name="catatan"
                                            class="form-control"
                                            placeholder="Masukkan Catatan"
                                            value="{{ $data->catatan }}" />
                                    </div>

                                    <p class="mb-4">
                                        *Jika laporan perlu di revisi maka bisa
                                        menambahkan catatan dan catatan hanya
                                        di isi jika status laporan menjadi
                                        <b>Revisi</b>
                                    </p>

                                    <div class="form-outline mb-4 mt-3">

                                        <label class="form-label">
                                            Tanggal
                                        </label>

                                        <input type="text"
                                            class="form-control"
                                            value="{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d H:i:s') }}"
                                            readonly>
                                    </div>

                                    <div class="text-end pt-1 pb-1 mt-4">

                                        <button
                                            class="btn btn-success ps-xxl-5 pe-xxl-5 mr-auto background-blue-1 mb-2 fw-semibold fs-5"
                                            type="submit">
                                            Upload
                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <!-- Back To Top -->
    <a href="#"
        class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS -->
    <script src="{{ asset('backend/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmSubmission(e) {

            var status = document.querySelector('select[name="status"]').value;
            var alertBox = document.getElementById('statusAlert');

            alertBox.classList.add('d-none');

            if (status === "Revisi") {

                Swal.fire({
                    title: 'Konfirmasi Revisi',
                    text: 'Apakah Anda yakin ingin mengubah status menjadi Revisi?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Ubah',
                    cancelButtonText: 'Batal',
                }).then((result) => {

                    if (result.isConfirmed) {
                        e.target.submit();
                    }

                });

                return false;

            } else if (
                status === "Disetujui1" ||
                status === "Disetujui2"
            ) {

                Swal.fire({
                    title: 'Konfirmasi Persetujuan',
                    text: 'Apakah Anda yakin ingin menyetujui laporan ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Setujui',
                    cancelButtonText: 'Batal',
                }).then((result) => {

                    if (result.isConfirmed) {
                        e.target.submit();
                    }

                });

                return false;

            } else {

                alertBox.classList.remove('d-none');
                alertBox.innerText = 'Harap pilih status laporan.';
                return false;
            }
        }
    </script>

</body>

</html>

{{-- @endsection --}}
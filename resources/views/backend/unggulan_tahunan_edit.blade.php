```php
{{-- @extends('backend/layouts.template') --}}
{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Review Laporan Unggulan Tahunan</title>

    <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">

    <style>
        * {
            font-family: "Poppins", sans-serif !important;
            font-weight: 400 !important;
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
            font-weight: 700 !important;
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
            font-weight: 400 !important;
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

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .card-body {
            padding: 1.5rem !important;
        }

        .pagetitle h1 {
            font-size: 20px;
            font-weight: 700 !important;
            color: #012970;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 400 !important;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 10px !important;
            min-height: 44px !important;
            border: 1px solid #d1d5db !important;
            font-size: 15px !important;
            font-weight: 400 !important;
            padding: 10px 14px !important;
            box-shadow: none !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4154f1 !important;
            box-shadow: 0 0 0 0.1rem rgba(65, 84, 241, 0.15) !important;
        }

        .btn-success {
            border-radius: 10px !important;
            padding: 10px 28px !important;
            font-size: 15px !important;
            font-weight: 500 !important;
        }

        p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
        }

        b,
        strong {
            font-weight: 600 !important;
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

    <!-- HEADER -->
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

    </header>

    <!-- SIDEBAR -->
    @include('backend.includes.sidebar')

    <!-- MAIN -->
    <main id="main" class="main">



        <div class="pagetitle">
            <h1>Review Laporan Unggulan Tahunan</h1>
        </div>
        <section class="section">


            <div class="card">

                <div class="card-body p-4">

                    <form action="{{ route('unggulan.tahunan.update', $data->id_rekap_desa_tahunan) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        onsubmit="event.preventDefault(); confirmSubmission(event)">

                        @csrf
                        @method('PUT')

                        <div class="from-outline mb-4">

                            <div class="mb-3">
                                <label class="form-label">
                                    ID Laporan Tahunan
                                </label>

                                <input type="text"
                                    class="form-control"
                                    value="{{ $data->id_rekap_desa_tahunan }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kader Kesehatan</label>
                                <input type="number"
                                    class="form-control"
                                    name="kader_kesehatan"
                                    value="{{ $data->kader_kesehatan }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gizi</label>
                                <input type="number"
                                    class="form-control"
                                    name="gizi"
                                    value="{{ $data->gizi }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kesling</label>
                                <input type="number"
                                    class="form-control"
                                    name="kesling"
                                    value="{{ $data->kesling }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">PHBS</label>
                                <input type="number"
                                    class="form-control"
                                    name="phbs"
                                    value="{{ $data->phbs }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">KB</label>
                                <input type="number"
                                    class="form-control"
                                    name="kb"
                                    value="{{ $data->kb }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Posyandu</label>
                                <input type="number"
                                    class="form-control"
                                    name="posyandu"
                                    value="{{ $data->posyandu }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Imunisasi/Vaksinasi Bayi Balita
                                </label>

                                <input type="number"
                                    class="form-control"
                                    name="imunisasi_vaksinasi_bayi_balita"
                                    value="{{ $data->imunisasi_vaksinasi_bayi_balita }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">PKG</label>
                                <input type="number"
                                    class="form-control"
                                    name="pkg"
                                    value="{{ $data->pkg }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">TBC</label>
                                <input type="number"
                                    class="form-control"
                                    name="tbc"
                                    value="{{ $data->tbc }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jamban WC</label>
                                <input type="number"
                                    class="form-control"
                                    name="jamban_wc"
                                    value="{{ $data->jamban_wc }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">SPAL</label>
                                <input type="number"
                                    class="form-control"
                                    name="spal"
                                    value="{{ $data->spal }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">TPS</label>
                                <input type="number"
                                    class="form-control"
                                    name="tps"
                                    value="{{ $data->tps }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah MCK</label>
                                <input type="number"
                                    class="form-control"
                                    name="jml_mck"
                                    value="{{ $data->jumlah_mck }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">PDAM</label>
                                <input type="number"
                                    class="form-control"
                                    name="pdam"
                                    value="{{ $data->pdam }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sumur</label>
                                <input type="number"
                                    class="form-control"
                                    name="sumur"
                                    value="{{ $data->sumur }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lain-lain</label>
                                <input type="number"
                                    class="form-control"
                                    name="lain_lain"
                                    value="{{ $data->lain_lain }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah PUS</label>
                                <input type="number"
                                    class="form-control"
                                    name="jml_pus"
                                    value="{{ $data->jml_pus }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah WUS</label>
                                <input type="number"
                                    class="form-control"
                                    name="jml_wus"
                                    value="{{ $data->jml_wus }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Akseptor KB L</label>
                                <input type="number"
                                    class="form-control"
                                    name="akseptor_kb_l"
                                    value="{{ $data->akseptor_kb_l }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Akseptor KB P</label>
                                <input type="number"
                                    class="form-control"
                                    name="akseptor_kb_p"
                                    value="{{ $data->akseptor_kb_p }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">KK Tabungan</label>
                                <input type="number"
                                    class="form-control"
                                    name="jml_kk_tabungan"
                                    value="{{ $data->jml_kk_tabungan }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">KK Asuransi</label>
                                <input type="number"
                                    class="form-control"
                                    name="jml_kk_asuransi"
                                    value="{{ $data->jml_kk_asuransi }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Program Kesehatan</label>
                                <input type="number"
                                    class="form-control"
                                    name="kesehatan_program"
                                    value="{{ $data->kesehatan_program }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Kelestarian Lingkungan Hidup
                                </label>

                                <input type="number"
                                    class="form-control"
                                    name="kelestarian_lingkungan_hidup"
                                    value="{{ $data->kelestarian_lingkungan_hidup }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Perencanaan Sehat Program
                                </label>

                                <input type="number"
                                    class="form-control"
                                    name="perencanaan_sehat_program"
                                    value="{{ $data->perencanaan_sehat_program }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Id Pengguna</label>

                                <input type="text"
                                    class="form-control"
                                    value="{{ $data->id_user }}"
                                    readonly>
                            </div>

                            <div id="statusAlert"
                                class="alert alert-danger d-none">

                                Harap pilih status laporan.

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Status
                                </label>

                                <select name="status"
                                    class="form-select">

                                    <option value="">
                                        -- Pilih Status --
                                    </option>

                                    <option value="Revisi">
                                        Revisi
                                    </option>

                                    @if(Auth::guard('pengguna')->check())

                                    <option value="Disetujui1">
                                        Disetujui (Kecamatan)
                                    </option>

                                    @else

                                    <option value="Disetujui2">
                                        Disetujui (Admin)
                                    </option>

                                    @endif

                                </select>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Catatan
                                </label>

                                <input type="text"
                                    name="catatan"
                                    class="form-control"
                                    placeholder="Masukkan Catatan"
                                    value="{{ $data->catatan }}">

                            </div>

                            <p class="mb-4">
                                *Jika laporan perlu di revisi maka bisa
                                menambahkan catatan dan catatan hanya
                                di isi jika status laporan menjadi
                                <b>Revisi</b>
                            </p>

                            <div class="mb-4">

                                <label class="form-label">
                                    Tanggal
                                </label>

                                <input type="text"
                                    class="form-control"
                                    value="{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s') }}"
                                    readonly>

                            </div>

                            <div class="text-end pt-1 mt-4">

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

        </section>

    </main>

    <!-- JS -->
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
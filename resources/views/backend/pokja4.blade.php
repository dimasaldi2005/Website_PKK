{{-- @extends('backend/layouts.template') --}}
{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Laporan Pokja 4</title>

    <link href="backend/assets/img/favicon.png" rel="icon">
    <link href="backend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="backend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="backend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="backend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="backend/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="backend/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="backend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="backend/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="backend/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- HEADER -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <img src="{{ asset('backend/assets/img/pkk.png') }}" alt="">
                <span class="d-none d-lg-block">PKK NGANJUK</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
    </header>

    <!-- SIDEBAR -->
    @include('backend.includes.sidebar')

    <main id="main" class="main">

        @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <section class="section dashboard">
            <div class="row">

                <!-- CARD CETAK -->
                <div class="col-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Pokja 4</h5>
                            <p class="text-muted">Cetak laporan berdasarkan bulan, tahun, bidang dan format file</p>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalLaporan">
                                <i class="bi bi-file-earmark-arrow-down"></i> Cetak Laporan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- CARD KESEHATAN -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                        <a href="{{ route('acckesehatan.index') }}">
                            <div class="card-body">
                                <h5 class="card-title">Kesehatan</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $modelPertama ?? 0 }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- CARD KELESTARIAN -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                        <a href="{{ route('acckelestarian.index') }}">
                            <div class="card-body">
                                <h5 class="card-title">Kelestarian Lingkungan Hidup</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $modelKedua ?? 0 }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- CARD PERENCANAAN -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                        <a href="{{ route('accperencanaan.index') }}">
                            <div class="card-body">
                                <h5 class="card-title">Perencanaan Sehat</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $modelKetiga ?? 0 }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- CARD KADER -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                        <a href="{{ route('acclaporanpokja4.index') }}">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Kader Pokja 4</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $modelKeempat ?? 0 }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- CARD INOVASI -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                        <a href="{{ route('inovasi.index') }}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Inovasi
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-lightbulb-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $modelKelima ?? 0 }}</h6>
                                        <span class="text-muted small pt-2 ps-1">
                                            Jumlah total inovasi
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- MODAL CETAK -->
    <div class="modal fade" id="modalLaporan" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cetak Laporan Pokja 4</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formExport">
                    @csrf
                    <div class="modal-body">
                        <!-- BULAN -->
                        <div class="mb-3">
                            <label>Bulan <span class="text-danger">*</span></label>
                            <select name="bulan" class="form-select" required>
                                <option value="">-- Pilih Bulan --</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>

                        <!-- TAHUN -->
                        <div class="mb-3">
                            <label>Tahun <span class="text-danger">*</span></label>
                            <select name="tahun" class="form-select" required>
                                <option value="">-- Pilih Tahun --</option>
                                @for ($year = now()->year; $year >= 2021; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- BIDANG -->
                        <div class="mb-3">
                            <label>Bidang <span class="text-danger">*</span></label>
                            <select name="bidang" class="form-select" required>
                                <option value="">-- Pilih Bidang --</option>
                                <option value="kesehatan">Kesehatan</option>
                                <option value="kelestarian">Kelestarian Lingkungan Hidup</option>
                                <option value="perencanaan">Perencanaan Sehat</option>
                                <option value="kader">Kader Pokja 4</option>
                            </select>
                        </div>

                        <!-- FORMAT -->
                        <div class="mb-3">
                            <label>Format <span class="text-danger">*</span></label>
                            <select name="format" id="formatExport" class="form-select" required>
                                <option value="">-- Pilih Format --</option>
                                <option value="pdf">📄 PDF (Download)</option>
                                <option value="excel">📊 Google Sheets (Online)</option>
                            </select>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i>
                                Pilih Google Sheets untuk menyimpan data langsung ke spreadsheet online
                            </small>
                        </div>

                        <!-- INFO LINK GOOGLE SHEETS -->
                        <div class="alert alert-primary mt-3" id="infoLinkSheet" style="display: none; border-left: 4px solid #0d6efd;">
                            <h6 class="alert-heading fw-bold mb-1" style="font-size: 14px;"><i class="bi bi-link-45deg"></i> Link Spreadsheet Tujuan</h6>
                            <p class="mb-2" style="font-size: 13px;">Data akan diekspor dan disusun otomatis ke dalam tab di Google Sheets berikut:</p>
                            <a href="https://docs.google.com/spreadsheets/d/1sG9520UiJQIXg3u7YHXPPIpjU41w8fkyrw3fP37u-9c/edit?usp=sharing" target="_blank" class="btn btn-sm btn-light text-primary" style="font-size: 12px; font-weight: 600;">
                                <i class="bi bi-box-arrow-up-right"></i> Buka Spreadsheet Laporan
                            </a>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success" id="btnExport">
                            <i class="bi bi-download"></i> <span id="btnText">Export</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- JS -->
    <script src="backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="backend/assets/js/main.js"></script>

    <script>
        // PASTIKAN APPS SCRIPT URL INI ADALAH URL DEPLOYMENT UNTUK POKJA 4 KAMU
        const APPS_SCRIPT_URL = "https://script.google.com/macros/s/AKfycbxI94KbVy5KxSoClLSGjrqSLCaU9rqGdiHghFFcLnKlFV9-SgRnHDhLR5661sBsQukN/exec";

        // MUNCULKAN KOTAK INFO JIKA FORMAT EXCEL DIPILIH
        document.getElementById("formatExport").addEventListener("change", function() {
            const infoBox = document.getElementById("infoLinkSheet");
            if (this.value === "excel") {
                infoBox.style.display = "block";
            } else {
                infoBox.style.display = "none";
            }
        });

        document.getElementById("formExport").addEventListener("submit", async function(e) {
            e.preventDefault();

            const format = document.getElementById("formatExport").value;
            const btn = document.getElementById("btnExport");
            const btnText = document.getElementById("btnText");
            const form = e.target;

            const formData = new FormData(form);
            const bulan = formData.get('bulan');
            const tahun = formData.get('tahun');
            const bidang = formData.get('bidang');

            if (!format) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Format!',
                    text: 'Silakan pilih format export terlebih dahulu'
                });
                return;
            }

            if (format === "pdf") {
                // Jika route PDF-nya berbeda, sesuaikan di bawah ini
                const params = new URLSearchParams(formData).toString();
                window.location.href = "{{ route('kesehatan.filter') }}?" + params;

            } else if (format === "excel") {

                // --- KONFIRMASI SEBELUM EXPORT ---
                const confirmExport = await Swal.fire({
                    title: 'Mulai Ekspor?',
                    html: `Data akan ditimpa/diperbarui ke dalam <b>Google Sheets</b>.<br><br>
                 <a href="https://docs.google.com/spreadsheets/d/1sG9520UiJQIXg3u7YHXPPIpjU41w8fkyrw3fP37u-9c/edit?usp=sharing" target="_blank" style="text-decoration: none; color: #0d6efd; font-weight: 600; background: #f8f9fa; padding: 5px 10px; border-radius: 5px;">
                   <i class="bi bi-box-arrow-up-right"></i> Pratinjau Spreadsheet Saat Ini
                 </a>`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-send"></i> Ya, Ekspor Sekarang!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                });

                if (!confirmExport.isConfirmed) {
                    return;
                }

                btn.disabled = true;
                btnText.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';

                Swal.fire({
                    title: 'Mengekspor data...',
                    text: 'Sedang mengambil data dari Database...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                try {
                    // --- LANGKAH 1: AMBIL DATA DARI LARAVEL (Route Pokja 4) ---
                    const urlTarget = `{{ route('laporanpokja4.exportJson') }}?bulan=${bulan}&tahun=${tahun}&bidang=${bidang}`;

                    const dbResponse = await fetch(urlTarget);

                    if (!dbResponse.ok) {
                        const textError = await dbResponse.text();
                        let realErrorMsg = `Status: ${dbResponse.status}`;
                        try {
                            const jsonError = JSON.parse(textError);
                            if (jsonError.message) realErrorMsg = jsonError.message;
                        } catch (e) {}
                        throw new Error(realErrorMsg);
                    }

                    const dbResult = await dbResponse.json();

                    if (!dbResult.data || dbResult.data.length === 0) {
                        Swal.fire('Data Kosong', 'Tidak ada laporan yang Disetujui pada bulan dan tahun tersebut.', 'info');
                        btn.disabled = false;
                        btnText.textContent = 'Export';
                        return;
                    }

                    Swal.update({
                        text: `Ditemukan ${dbResult.data.length} baris data. Menyiapkan dan merapikan tabel di Google Sheets...`
                    });

                    // --- LANGKAH 2: KIRIM DATA KE GOOGLE APPS SCRIPT ---
                    const googleResponse = await fetch(APPS_SCRIPT_URL, {
                        method: 'POST',
                        redirect: 'follow',
                        headers: {
                            'Content-Type': 'text/plain;charset=utf-8'
                        },
                        body: JSON.stringify(dbResult)
                    });

                    const textResult = await googleResponse.text();

                    try {
                        const result = JSON.parse(textResult);

                        if (result.status === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                html: `✅ ${result.message}<br><br>
                               🔗 Silahkan buka tautan berikut untuk melihat hasilnya:<br><br>
                               <a href="https://docs.google.com/spreadsheets/d/1sG9520UiJQIXg3u7YHXPPIpjU41w8fkyrw3fP37u-9c/edit?usp=sharing" target="_blank" class="btn btn-sm btn-outline-primary">
                                  Buka Spreadsheet Laporan
                               </a>`,
                                confirmButtonText: 'Tutup',
                            }).then(() => {
                                form.reset();
                                document.getElementById("infoLinkSheet").style.display = "none";
                                const modal = bootstrap.Modal.getInstance(document.getElementById('modalLaporan'));
                                if (modal) modal.hide();
                            });
                        } else {
                            throw new Error(result.message);
                        }
                    } catch (e) {
                        console.error("Respons dari Google Script:", textResult);
                        throw new Error("Google Apps Script mengembalikan halaman error. Pastikan Deploy as Web App di-set ke 'Who has access: Anyone'.");
                    }

                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengirim!',
                        html: `Terjadi kesalahan:<br><br><code>${error.message}</code>`
                    });
                } finally {
                    btn.disabled = false;
                    btnText.textContent = 'Export';
                }
            }
        });
    </script>

</body>

</html>
{{-- @endsection --}}
{{-- @extends('backend/layouts.template') --}}

{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan Pokja 1</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="backend/assets/img/favicon.png" rel="icon">
  <link href="backend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="backend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="backend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="backend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="backend/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="backend/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="backend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="backend/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="backend/assets/css/style.css" rel="stylesheet">

  {{-- fontawesome --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">

  {{-- SweetAlert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .input-laporan {
      display: block;
      width: 100%;
      padding: 0.375rem 0.75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      appearance: none;
      border-radius: 0.375rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
      margin: 8px 0;
    }

    .input-laporan-btn {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      color: white;
      padding: 8px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .input-laporan-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
  </style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{asset('backend/assets/img/pkk.png')}}" alt="">
        <span class="d-none d-lg-block">PKK NGANJUK</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('backend.includes.sidebar')


  <main id="main" class="main">

    {{-- error data kosong --}}
    @if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Perhatian!</strong> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

    <section class="section dashboard">
      <div class="row">

        <div class="row">

          <!-- CARD CETAK LAPORAN POKJA 1 -->
          <div class="col-12">
            <div class="card info-card sales-card">
              <div class="card-body">

                <h5 class="card-title">Laporan Pokja 1</h5>
                <p class="text-muted">Cetak laporan berdasarkan bulan, tahun, bidang dan format file</p>

                <button type="button"
                  class="btn btn-primary btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#modalLaporanPokja1">
                  <i class="bi bi-file-earmark-arrow-down"></i> Cetak Laporan
                </button>

              </div>
            </div>
          </div><!-- End Sales Card -->

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <a href="{{ route('accpenghayatan.index') }}">
                <div class="card-body">
                  <h5 class="card-title">Penghayatan Dan Pengamalan Pancasila</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-sharp fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $modelPertama ?? 0 }}</h6>
                      <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <a href="{{ route('accgotongroyong.index') }}">
                <div class="card-body">
                  <h5 class="card-title">Gotong Royong</h5>
                  <br>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-sharp fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $modelKedua ?? 0 }}</h6>
                      <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div><!-- End Revenue Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <a href="{{ route('acclaporanpokja1.index') }}">
                <div class="card-body">
                  <h5 class="card-title">Kader Pokja 1</h5>
                  <br>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-sharp fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $modelKetiga ?? 0 }}</h6>
                      <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div><!-- End Revenue Card -->

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- MODAL CETAK LAPORAN POKJA 1 -->
  <div class="modal fade" id="modalLaporanPokja1" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Cetak Laporan Pokja 1</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <form id="formExportPokja1">
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
                <option value="penghayatan">Penghayatan & Pengamalan Pancasila</option>
                <option value="gotongroyong">Gotong Royong</option>
                <option value="kader">Kader Pokja 1</option>
              </select>
            </div>

            <!-- FORMAT -->
            <div class="mb-3">
              <label>Format <span class="text-danger">*</span></label>
              <select name="format" id="formatExportPokja1" class="form-select" required>
                <option value="">-- Pilih Format --</option>
                <option value="pdf">📄 PDF (Download)</option>
                <option value="excel">📊 Google Sheets (Online)</option>
              </select>
              <small class="text-muted">
                <i class="bi bi-info-circle"></i> 
                Pilih Google Sheets untuk menyimpan data langsung ke spreadsheet online
              </small>
            </div>

            <!-- INFO LINK GOOGLE SHEETS (Disembunyikan default, muncul otomatis jika pilih excel) -->
            <div class="alert alert-primary mt-3" id="infoLinkSheet" style="display: none; border-left: 4px solid #0d6efd;">
              <h6 class="alert-heading fw-bold mb-1" style="font-size: 14px;"><i class="bi bi-link-45deg"></i> Link Spreadsheet Tujuan</h6>
              <p class="mb-2" style="font-size: 13px;">Semua data bidang Pokja 1 akan terekspor dan dikelompokkan ke dalam tab di link berikut:</p>
              <a href="https://docs.google.com/spreadsheets/d/1sW8NzwzGyx9iBfTyjX7gZ17rFpg8PWgAU7OM4QMVUjo/edit?usp=sharing" target="_blank" class="btn btn-sm btn-light text-primary" style="font-size: 12px; font-weight: 600;">
                <i class="bi bi-box-arrow-up-right"></i> Buka Spreadsheet Pokja 1
              </a>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bi bi-x-circle"></i> Batal
            </button>
            <button type="submit" class="btn btn-success" id="btnExportPokja1">
              <i class="bi bi-download"></i> <span id="btnTextPokja1">Export</span>
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Template Main JS File -->
  <script src="backend/assets/js/main.js"></script>

  {{-- SCRIPT EXPORT POKJA 1 KE GOOGLE SPREADSHEET --}}
  <script>
    const APPS_SCRIPT_URL_POKJA1 = "https://script.google.com/macros/s/AKfycbxV-t515AuxJz2iN5wmuQfPDpJhC8t9Rb12oNu_fcQ9aGumvebosvG8SDhz2hcYDZkj/exec";

    // FUNGSI UNTUK MEMUNCULKAN KOTAK INFO LINK JIKA FORMAT EXCEL DIPILIH
    document.getElementById("formatExportPokja1").addEventListener("change", function() {
      const infoBox = document.getElementById("infoLinkSheet");
      if (this.value === "excel") {
        infoBox.style.display = "block";
      } else {
        infoBox.style.display = "none";
      }
    });

    document.getElementById("formExportPokja1").addEventListener("submit", async function(e){
      e.preventDefault();
      
      const format = document.getElementById("formatExportPokja1").value;
      const btn = document.getElementById("btnExportPokja1");
      const btnText = document.getElementById("btnTextPokja1");
      const form = e.target;
      
      // Mengambil inputan dari form
      const formData = new FormData(form);
      const bulan = formData.get('bulan');
      const tahun = formData.get('tahun');
      const bidang = formData.get('bidang');
      
      if(!format) {
        Swal.fire({ icon: 'warning', title: 'Pilih Format!', text: 'Silakan pilih format export terlebih dahulu' });
        return;
      }
      
      if(format === "pdf"){
        // Export PDF - redirect ke route Laravel cetak
        const params = new URLSearchParams(formData).toString();
        window.location.href = "{{ route('gotongroyong.filter') }}?" + params;
        
      } else if(format === "excel"){

        // --- KONFIRMASI SEBELUM EXPORT ---
        const confirmExport = await Swal.fire({
          title: 'Mulai Ekspor?',
          html: `Data akan ditimpa/diperbarui ke dalam <b>Google Sheets POKJA 1</b>.<br><br>
                 <a href="https://docs.google.com/spreadsheets/d/1sW8NzwzGyx9iBfTyjX7gZ17rFpg8PWgAU7OM4QMVUjo/edit?usp=sharing" target="_blank" style="text-decoration: none; color: #0d6efd; font-weight: 600; background: #f8f9fa; padding: 5px 10px; border-radius: 5px;">
                   <i class="bi bi-box-arrow-up-right"></i> Pratinjau Spreadsheet Saat Ini
                 </a>`,
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#198754', // Warna hijau success
          cancelButtonColor: '#6c757d',
          confirmButtonText: '<i class="bi bi-send"></i> Ya, Ekspor Sekarang!',
          cancelButtonText: 'Batal',
          reverseButtons: true
        });

        // Jika user klik batal, hentikan fungsi
        if (!confirmExport.isConfirmed) {
          return; 
        }
        
        btn.disabled = true;
        btnText.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';
        
        Swal.fire({
          title: 'Mengekspor data...',
          text: 'Sedang mengambil data dari Database...',
          allowOutsideClick: false,
          didOpen: () => { Swal.showLoading(); }
        });

        try {
          // --- LANGKAH 1: AMBIL DATA DARI LARAVEL ---
          const urlTarget = `{{ route('laporanpokja1.exportJson') }}?bulan=${bulan}&tahun=${tahun}&bidang=${bidang}`;
          
          const dbResponse = await fetch(urlTarget);
          
          // Cek apakah response OK (status 200-299)
          if (!dbResponse.ok) {
              const textError = await dbResponse.text();
              console.error("Error dari Laravel:", textError);
              throw new Error(`Gagal mengambil data dari server lokal (Status: ${dbResponse.status}). Cek console browser.`);
          }

          const dbResult = await dbResponse.json();

          // Cek jika data kosong
          if(!dbResult.data || dbResult.data.length === 0) {
            Swal.fire('Data Kosong', 'Tidak ada laporan yang Disetujui pada bulan dan tahun tersebut.', 'info');
            btn.disabled = false;
            btnText.textContent = 'Export';
            return;
          }

          Swal.update({ text: `Ditemukan ${dbResult.data.length} baris data. Menyiapkan dan merapikan tabel di Google Sheets...` });

          // --- LANGKAH 2: KIRIM DATA KE GOOGLE APPS SCRIPT ---
          const googleResponse = await fetch(APPS_SCRIPT_URL_POKJA1, {
            method: 'POST',
            redirect: 'follow', 
            headers: { 'Content-Type': 'text/plain;charset=utf-8' },
            body: JSON.stringify(dbResult)
          });

          // Ambil response sebagai teks dulu untuk berjaga-jaga jika isinya HTML
          const textResult = await googleResponse.text();

          try {
             const result = JSON.parse(textResult);
             
             if(result.status === "success") {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil!',
                  html: `✅ ${result.message}<br><br>
                         🔗 Silahkan buka tautan berikut untuk melihat hasilnya:<br><br>
                         <a href="https://docs.google.com/spreadsheets/d/1sW8NzwzGyx9iBfTyjX7gZ17rFpg8PWgAU7OM4QMVUjo/edit?usp=sharing" target="_blank" class="btn btn-sm btn-outline-primary">
                            Buka Laporan Pokja 1
                         </a>`,
                  confirmButtonText: 'Tutup',
                }).then(() => {
                  form.reset();
                  document.getElementById("infoLinkSheet").style.display = "none";
                  const modal = bootstrap.Modal.getInstance(document.getElementById('modalLaporanPokja1'));
                  if(modal) modal.hide();
                });
              } else {
                throw new Error(result.message);
              }
          } catch(e) {
             console.error("Respons dari Google Script:", textResult);
             throw new Error("Google Apps Script gagal memproses data. Pastikan Deploy as Web App di-set ke 'Who has access: Anyone'.");
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

{{-- </html> --}}
{{-- @endsection --}}
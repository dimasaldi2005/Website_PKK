{{-- @extends('backend/layouts.template') --}}

{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan</title>
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

          <!-- CARD CETAK LAPORAN POKJA 3 -->
          <div class="col-12">
            <div class="card info-card sales-card">
              <div class="card-body">

                <h5 class="card-title">Laporan Pokja 3</h5>
                <p class="text-muted">Cetak laporan berdasarkan bulan, tahun, bidang dan format file</p>

                <button type="button"
                  class="btn btn-primary btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#modalLaporanPokja3">

                  <i class="bi bi-file-earmark-arrow-down"></i> Cetak Laporan
                </button>

              </div>
            </div>
          </div><!-- End Sales Card -->

          <!-- Sales Card -->
          <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">
              <a href="{{ route('accpangan.index') }}">

                <div class="card-body">
                  <h5 class="card-title">Program Pangan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-sharp fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $modelPertama }}</h6>
                      <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">
              <a href="{{ route('accsandang.index') }}">

                <div class="card-body">
                  <h5 class="card-title">Program Industri Rumah Tangga</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-sharp fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $modelKedua }}</h6>
                      <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div><!-- End Revenue Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">
              <a href="{{ route('accperumahan.index') }}">

                <div class="card-body">
                  <h5 class="card-title">Program Perumahan Dan Tata Laksana Rumah Tangga</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-sharp fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $modelKetiga }}</h6>
                      <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div><!-- End Revenue Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">
              <a href="{{ route('acclaporanpokja3.index') }}">
                <div class="card-body">
                  <h5 class="card-title">Kader Pokja 3</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-sharp fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $modelKeempat }}</h6>
                      <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div><!-- End Revenue Card -->

          <div class="col-md-12 mx-auto mt-2">
          </div>


        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <!-- MODAL CETAK LAPORAN POKJA 3 -->
  <div class="modal fade" id="modalLaporanPokja3" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Cetak Laporan Pokja 3</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <form id="formExportPokja3">
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
                <option value="pangan">Program Pangan</option>
                <option value="sandang">Program Sandang</option>
                <option value="perumahan">Perumahan dan Tata Laksana Rumah Tangga</option>
                <option value="kader">Kader Pokja 3</option>
              </select>
            </div>

            <!-- FORMAT -->
            <div class="mb-3">
              <label>Format <span class="text-danger">*</span></label>
              <select name="format" id="formatExportPokja3" class="form-select" required>
                <option value="">-- Pilih Format --</option>
                <option value="pdf">📄 PDF (Download)</option>
                <option value="excel">📊 Google Sheets (Online)</option>
              </select>
              <small class="text-muted">
                <i class="bi bi-info-circle"></i> 
                Pilih Google Sheets untuk menyimpan data langsung ke spreadsheet online
              </small>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bi bi-x-circle"></i> Batal
            </button>
            <button type="submit" class="btn btn-success" id="btnExportPokja3">
              <i class="bi bi-download"></i> <span id="btnTextPokja3">Export</span>
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="backend/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="backend/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="backend/assets/vendor/echarts/echarts.min.js"></script>
  <script src="backend/assets/vendor/quill/quill.min.js"></script>
  <script src="backend/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="backend/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="backend/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="backend/assets/js/main.js"></script>

  <script type="text/javascript">
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone('#pdf', {
      maxFilesize: 1,
      acceptedFiles: ".pdf",
      addRemoveLinks: true,
      autoProcessQueue: false,
      init: function () {
        $("button").click(function (e) {
          e.preventDefault();
          myDropzone.processQueue();
        });

        this.on('sending', function (file, xhr, formData) {
          var data = $('#pdf').serializeArray();
          $.each(data, function (key, el) {
            formData.append(el.name, el.value);
          });
        });
      }
    });
  </script>

  {{-- SCRIPT EXPORT POKJA 3 --}}
  <script>
    // URL Google Apps Script kamu
    const APPS_SCRIPT_URL_POKJA3 = "https://script.google.com/macros/s/AKfycbwtoylVdJDYPyT8FDY5edEtOfszK5bdK1nOyWyrnxwdUX_NZ0IAbMz6A0LgEGqlcRPD/exec";

    document.getElementById("formExportPokja3").addEventListener("submit", function(e){
      e.preventDefault();
      
      const format = document.getElementById("formatExportPokja3").value;
      const btn = document.getElementById("btnExportPokja3");
      const btnText = document.getElementById("btnTextPokja3");
      
      console.log('Format dipilih:', format);
      console.log('URL Apps Script:', APPS_SCRIPT_URL_POKJA3);
      
      // Validasi
      if(!format) {
        Swal.fire({
          icon: 'warning',
          title: 'Pilih Format!',
          text: 'Silakan pilih format export terlebih dahulu',
        });
        return;
      }
      
      if(format === "pdf"){
        // Export PDF - redirect ke route Laravel
        const form = e.target;
        const params = new URLSearchParams(new FormData(form)).toString();
        console.log('Redirect ke PDF:', "{{ route('pangan.filter') }}?" + params);
        window.location.href = "{{ route('pangan.filter') }}?" + params;
        
      } else if(format === "excel"){
        // Export ke Google Sheets via Apps Script
        btn.disabled = true;
        btnText.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...';
        
        // Ambil data form
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());
        
        // Tambahkan metadata
        data.timestamp = new Date().toISOString();
        data.source = "Laravel_PKK_Pokja3";
        data.user = "{{ Auth::user()->name ?? 'Guest' }}";
        data.pokja = "POKJA_3";
        
        console.log('Data yang akan dikirim:', data);
        
        // Tampilkan loading
        Swal.fire({
          title: 'Mengirim data...',
          text: 'Mohon tunggu, data sedang dikirim ke Google Sheets',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });
        
        // Kirim ke Apps Script
        fetch(APPS_SCRIPT_URL_POKJA3, {
          method: 'POST',
          mode: 'no-cors',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data)
        })
        .then(() => {
          console.log('✓ Berhasil mengirim (no-cors mode)');
          
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            html: '✅ Data telah dikirim ke Google Sheets!<br><br>' +
                  '📋 Detail:<br>' +
                  '• Bulan: ' + data.bulan + '<br>' +
                  '• Tahun: ' + data.tahun + '<br>' +
                  '• Bidang: ' + data.bidang + '<br>' +
                  '• Pokja: 3<br><br>' +
                  '⏱ Data akan muncul dalam 1-2 menit<br>' +
                  '🔗 Buka Google Sheet kamu untuk melihat',
            confirmButtonText: 'Oke, Mengerti',
            timer: 10000,
            timerProgressBar: true
          }).then(() => {
            // Reset form dan modal
            e.target.reset();
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalLaporanPokja3'));
            if(modal) modal.hide();
          });
        })
        .catch(error => {
          console.error('❌ Error:', error);
          Swal.fire({
            icon: 'error',
            title: 'Gagal Mengirim!',
            html: 'Terjadi kesalahan:<br><br>' +
                  '<code>' + error.message + '</code><br><br>' +
                  '💡 Tips:<br>' +
                  '• Periksa koneksi internet<br>' +
                  '• Pastikan Apps Script sudah di-deploy<br>' +
                  '• Cek console browser (F12) untuk detail error',
            footer: '<a href="#" onclick="testConnectionPokja3()">🔍 Test Koneksi</a>'
          });
        })
        .finally(() => {
          // Reset button
          btn.disabled = false;
          btnText.textContent = 'Export';
        });
      }
    });

    // Fungsi untuk test koneksi ke Apps Script
    function testConnectionPokja3() {
      Swal.fire({
        title: 'Testing koneksi...',
        text: 'Menguji koneksi ke Google Apps Script',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });
      
      fetch(APPS_SCRIPT_URL_POKJA3, {
        method: 'GET',
        mode: 'no-cors'
      })
      .then(() => {
        Swal.fire({
          icon: 'success',
          title: 'Koneksi OK!',
          text: 'Apps Script dapat diakses. Coba export lagi.'
        });
      })
      .catch(error => {
        Swal.fire({
          icon: 'error',
          title: 'Koneksi Gagal!',
          html: 'Tidak dapat mengakses Apps Script<br><br>' +
                'Error: ' + error.message + '<br><br>' +
                'Periksa:<br>' +
                '1. URL Apps Script sudah benar<br>' +
                '2. Apps Script sudah di-deploy<br>' +
                '3. Akses diset "Anyone"'
        });
      });
    }

    // Expose function ke window agar bisa dipanggil dari HTML
    window.testConnectionPokja3 = testConnectionPokja3;
  </script>

</body>

{{--

</html> --}}
{{-- @endsection --}}
{{-- @extends('backend/layouts.template') --}}
{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Review Laporan Program Pangan</title>

  <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center w-100">
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center" style="text-decoration:none;">
        <img src="{{ asset('backend/assets/img/pkk.png') }}" alt="PKK">
        <span class="d-none d-lg-block">
          Pemberdayaan Kesejahteraan Keluarga<br>Kabupaten Nganjuk
        </span>
      </a>
    </div>
    <nav class="header-nav ms-auto"></nav>
  </header>

  @include('backend.includes.sidebar')

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-md-10 mx-auto mt-2">
          <div class="pagetitle">
            <h1>Review Laporan Program Pangan</h1>
          </div>
          
          <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body mt-4">
              <form action="{{ route('pangan.update', $data->id_pokja3_bidang1) }}" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); confirmSubmission(event)">
                @csrf
                @method('PUT')
                
                <h5 class="card-title text-primary border-bottom pb-2 mb-4">Detail Data Laporan</h5>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-secondary">ID Laporan Program Pangan</label>
                      <input type="text" name="id_pokja3_bidang1" class="form-control bg-light" required readonly value="{{ $data->id_pokja3_bidang1 }}" />
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-secondary">Beras</label>
                      <input type="number" name="beras" class="form-control bg-light" required readonly value="{{ $data->beras }}" />
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-secondary">Non Beras</label>
                      <input type="number" name="non_beras" class="form-control bg-light" required readonly value="{{ $data->non_beras }}" />
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-secondary">Peternakan</label>
                      <input type="number" name="peternakan" class="form-control bg-light" required readonly value="{{ $data->peternakan }}" />
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-secondary">Perikanan</label>
                      <input type="number" name="perikanan" class="form-control bg-light" required readonly value="{{ $data->perikanan }}" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-secondary">Warung Hidup</label>
                      <input type="number" name="warung_hidup" class="form-control bg-light" required readonly value="{{ $data->warung_hidup }}" />
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-secondary">Lumbung Hidup</label>
                      <input type="number" name="lumbung_hidup" class="form-control bg-light" required readonly value="{{ $data->lumbung_hidup }}" />
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-secondary">Toga</label>
                      <input type="number" name="toga" class="form-control bg-light" required readonly value="{{ $data->toga }}" />
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-secondary">Tanaman Keras</label>
                      <input type="number" name="tanaman_keras" class="form-control bg-light" required readonly value="{{ $data->tanaman_keras }}" />
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold text-primary">Tanaman Lainnya</label>
                      <input type="number" name="tanaman_lainnya" class="form-control bg-light border-primary" required readonly value="{{ $data->tanaman_lainnya }}" />
                    </div>
                  </div>
                </div>

                <hr class="my-4">
                <h5 class="card-title text-primary border-bottom pb-2 mb-4">Persetujuan & Status</h5>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold">Status Laporan <span class="text-danger">*</span></label>
                      <select name="status" class="form-select border-primary" required onchange="toggleCatatan(this.value);">
                        <option value="">-- Pilih Keputusan --</option>
                        <option value="Revisi">Revisi (Kembalikan ke Desa)</option>
                        @if(Auth::guard('pengguna')->check())
                          <option value="Disetujui1">Disetujui (Teruskan ke Kabupaten)</option>
                        @else
                          <option value="Disetujui2">Disetujui (Final)</option>
                        @endif
                      </select>
                      <div id="statusAlert" class="text-danger small d-none mt-1"><i class="bi bi-exclamation-circle"></i> Harap pilih status laporan.</div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-outline mb-3">
                      <label class="form-label fw-bold">Catatan Revisi</label>
                      <textarea name="catatan" id="catatan" class="form-control" rows="2" placeholder="Masukkan alasan revisi (Wajib jika status Revisi)">{{ $data->catatan }}</textarea>
                      <small class="text-muted"><i class="bi bi-info-circle"></i> Hanya diisi jika laporan ditolak / butuh revisi.</small>
                    </div>
                  </div>
                </div>

                <div class="text-end pt-3 mt-4 border-top">
                  <a href="{{ route('pangan.index') }}" class="btn btn-secondary me-2"><i class="bi bi-arrow-left"></i> Kembali</a>
                  <button class="btn btn-success fw-bold px-4" type="submit"><i class="bi bi-save"></i> Simpan Keputusan</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/main.js') }}"></script>
  
  <script>
    // UX Tambahan: Otomatis memfokuskan textarea catatan jika pilih revisi
    function toggleCatatan(val) {
      if(val === 'Revisi') {
        document.getElementById('catatan').focus();
      }
    }

    function confirmSubmission(e) {
      var status = document.querySelector('select[name="status"]').value;
      var catatan = document.getElementById('catatan').value;
      var alertBox = document.getElementById('statusAlert');
      
      alertBox.classList.add('d-none');

      if (status === "Revisi") {
        if(catatan.trim() === '') {
          Swal.fire('Catatan Kosong', 'Harap isi alasan revisi di kolom catatan.', 'warning');
          return false;
        }

        Swal.fire({
          title: 'Konfirmasi Revisi',
          text: 'Apakah Anda yakin ingin mengembalikan laporan ini untuk direvisi?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#ffc107',
          confirmButtonText: 'Ya, Kembalikan',
          cancelButtonText: 'Batal',
        }).then((result) => {
          if (result.isConfirmed) e.target.submit(); 
        });
        return false; 

      } else if (status === "Disetujui1" || status === "Disetujui2") {
        Swal.fire({
          title: 'Konfirmasi Persetujuan',
          text: 'Apakah Anda yakin ingin menyetujui laporan ini?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#198754',
          confirmButtonText: 'Ya, Setujui',
          cancelButtonText: 'Batal',
        }).then((result) => {
          if (result.isConfirmed) e.target.submit();
        });
        return false;

      } else {
        alertBox.classList.remove('d-none');
        return false;
      }
    }
  </script>

</body>
</html>
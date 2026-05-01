{{-- @extends('backend/layouts.template') --}}

{{-- @section('content1') --}}

<!DOCTYPE html>
,<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan</title>
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

  {{-- fontawesome --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">

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
  <!-- End Sidebar-->

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-md-12 mx-auto mt-2">
          <div class="pagetitle">
            <h1>Review Laporan Kesehatan</h1>
          </div><!-- End Page Title -->
          <div class="card">
            <div class="card-body mt-4">
              <form action="{{ route('kesehatan.update', $data->id_pokja4_bidang1) }}" method="POST"
                enctype="multipart/form-data" onsubmit="event.preventDefault(); confirmSubmission(event)">

                @csrf
                @method('PUT')
                <div class="form-outline mb-4">

                  <div class="form-outline mb-4 mt-3">
                    <label for="id_pokja4_bidang1" class="form-label">ID Laporan Kesehatan</label>
                    <input type="text" name="id_pokja4_bidang1" id="id_pokja4_bidang1" class="form-control" required
                      readonly oninvalid="this.setCustomValidity('Harap lengkapi id laporan kesehat')"
                      oninput="this.setCustomValidity('')" placeholder="Masukkan Judul"
                      value="{{ $data->id_pokja4_bidang1 }}" />
                  </div>

                  <div class="form-outline mb-4 mt-3">
                    <label for="jumlah_posyandu" class="form-label">Jumlah Posyandu</label>
                    <input type="text" name="jumlah_posyandu" id="jumlah_posyandu" class="form-control" required
                      readonly oninvalid="this.setCustomValidity('Harap lengkapi jumlah posyandu')"
                      oninput="this.setCustomValidity('')" placeholder="Masukkan Judul"
                      value="{{ $data->jumlah_posyandu }}" />
                  </div>

                  <div class="form-outline mb-4 mt-3">
                    <label for="jumlah_posyandu_iterasi" class="form-label">Jumlah Posyandu Terintegrasi</label>
                    <input type="text" name="jumlah_posyandu_iterasi" id="jumlah_posyandu_iterasi" class="form-control"
                      required readonly
                      oninvalid="this.setCustomValidity('Harap lengkapi jumlah posyandu terintegrasi')"
                      oninput="this.setCustomValidity('')" placeholder="Masukkan Judul"
                      value="{{ $data->jumlah_posyandu_iterasi }}" />
                  </div>

                  <div class="form-outline mb-4 mt-3">
                    <label for="jumlah_klp" class="form-label">Jumlah Klp</label>
                    <input type="text" name="jumlah_klp" id="jumlah_klp" class="form-control" required readonly
                      oninvalid="this.setCustomValidity('Harap lengkapi jumlah klp')"
                      oninput="this.setCustomValidity('')" placeholder="Masukkan Judul"
                      value="{{ $data->jumlah_klp }}" />
                  </div>

                  <div class="form-outline mb-4 mt-3">
                    <label for="jumlah_anggota" class="form-label">Jumlah Anggota</label>
                    <input type="text" name="jumlah_anggota" id="jumlah_anggota" class="form-control" required readonly
                      oninvalid="this.setCustomValidity('Harap lengkapi jumlah anggota')"
                      oninput="this.setCustomValidity('')" placeholder="Masukkan Judul"
                      value="{{ $data->jumlah_anggota }}" />
                  </div>

                  <div class="form-outline mb-4 mt-3">
                    <label for="jumlah_kartu_gratis" class="form-label">Jumlah Kartu Gratis</label>
                    <input type="text" name="jumlah_kartu_gratis" id="jumlah_kartu_gratis" class="form-control" required
                      readonly oninvalid="this.setCustomValidity('Harap lengkapi jumlah kartu gratis')"
                      oninput="this.setCustomValidity('')" placeholder="Masukkan Judul"
                      value="{{ $data->jumlah_kartu_gratis }}" />
                  </div>

                  <div class="form-outline mb-4 mt-3">
                    <label for="id_user" class="form-label">Id Pengguna</label>
                    <input type="text" name="id_user" id="id_user" class="form-control" required readonly
                      oninvalid="this.setCustomValidity('Harap lengkapi id pengguna')"
                      oninput="this.setCustomValidity('')" placeholder="Masukkan Judul" value="{{ $data->id_user }}" />
                  </div>

                  <div id="statusAlert" class="alert alert-danger d-none" role="alert">
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
                    <label for="catatan" class="form-label">Catatan</label>
                    <input type="text" name="catatan" id="catatan" class="form-control" placeholder="Masukkan Catatan"
                      value="{{ $data->catatan }}" />
                  </div>
                  <p class="mb-4">*Jika laporan perlu di revisi maka bisa menambahkan catatan dan catatan hanya di isi
                    jika status laporan menjadi <b>Revisi</b></p>

                  <div class="form-outline mb-4 mt-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" class="form-control" required readonly
                      oninvalid="this.setCustomValidity('Harap lengkapi judul')" oninput="this.setCustomValidity('')"
                      placeholder="Masukkan Judul" value="{{ $data->created_at }}" />
                  </div>

                  <div class="text-end pt-1 pb-1 mt-4">
                    <button class="btn btn-success ps-xxl-5 pe-xxl-5 mr-auto background-blue-1 mb-2 fw-semibold fs-5"
                      type="submit">Upload</button>
                  </div>

              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('backend/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
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
          text: 'Apakah Anda yakin ingin mengubah status menjadi Revisi? Catatan perlu diisi.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Ubah',
          cancelButtonText: 'Batal',
        }).then((result) => {
          if (result.isConfirmed) {
            e.target.submit(); // ✅ submit form jika user klik "Ya, Ubah"
          }
        });
        return false; // ⛔ cegah submit default
      } else if (status === "Disetujui1" || status === "Disetujui2") {
        Swal.fire({
          title: 'Konfirmasi Persetujuan',
          text: 'Apakah Anda yakin ingin menyetujui laporan ini?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya, Setujui',
          cancelButtonText: 'Batal',
        }).then((result) => {
          if (result.isConfirmed) {
            e.target.submit(); // ✅ submit form jika disetujui
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

{{--

</html> --}}
{{-- @endsection --}}
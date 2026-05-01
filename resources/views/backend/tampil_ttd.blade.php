{{-- @extends('backend/layouts.template') --}}



{{-- @section('content1') --}}



<!DOCTYPE html>

,<html lang="en">



<head>

  <meta charset="utf-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">



  <title>Edit Tanda Tangan</title>

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

      <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">

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

            <h1>Edit Tanda Tangan</h1>

          </div><!-- End Page Title -->

          <div class="card">

            <div class="card-body mt-4">

              <form action="{{ route('ttd.update', $data->id_ttds) }}" method="POST" enctype="multipart/form-data">



                @csrf

                @method('PUT')



                <div class="form-outline mb-4">

                  <label for="nama_terang" class="form-label">Nama Terang</label>

                  <input type="text" name="nama_terang" id="nama_terang" class="form-control" required
                    oninvalid="this.setCustomValidity('Harap lengkapi nama terang')"
                    oninput="this.setCustomValidity('')" placeholder="Masukkan Nama Terang"
                    value="{{ $data->nama_terang }}" />

                </div>



                <div class="form-outline mb-4">

                  <label for="jabatan" class="form-label">Jabatan</label>

                  <select name="jabatan" class="datepicker-trigger form-control hasDatepicker"
                    onchange="exibeMsg(this.value);">

                    <option value="">{{ $data->jabatan }}</option>

                    <option value="Ketua">Ketua</option>

                    <option value="Wakil Ketua">Wakil Ketua</option>

                    <option value="Sekretaris">Sekretaris</option>

                    <option value="Bendahara">Bendahara</option>

                  </select>

                </div>



                <div class="form-outline mb-4">

                  <label for="pokja" class="form-label">Pokja</label>

                  <select name="pokja" class="datepicker-trigger form-control hasDatepicker"
                    onchange="exibeMsg(this.value);">

                    <option value="">{{ $data->pokja }}</option>

                    <option value="Bidang Umum">Bidang Umum</option>

                    <option value="Kelompok Kerja I">Kelompok Kerja I</option>

                    <option value="Kelompok Kerja II">Kelompok Kerja II</option>

                    <option value="Kelompok Kerja III">Kelompok Kerja III</option>

                    <option value="Kelompok Kerja IV">Kelompok Kerja IV</option>

                  </select>

                </div>



                <div class="text-end pt-1 pb-1 mt-4">

                  <button class="btn btn-primary ps-xxl-5 pe-xxl-5 mr-auto background-blue-1 mb-2 fw-semibold fs-5"
                    type="submit">Edit</button>

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



</body>



{{--

</html> --}}

{{-- @endsection --}}
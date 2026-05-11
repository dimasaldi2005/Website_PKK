{{-- @extends('backend/layouts.template') --}}
{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan ACC Kesehatan</title>

  <!-- Favicons -->
  <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
          <img src="{{asset('backend/assets/img/pkk.png')}}" alt="">
          <span class="d-none d-lg-block">PKK NGANJUK</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
    </header>
  
    <!-- ======= Sidebar ======= -->
    @include('backend.includes.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Laporan Kesehatan</h1>
        </div>

      <section class="section dashboard">
        <div class="row">
              <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-6 col-md-6">
                  <div class="card info-card sales-card">
                    <a href="{{ route('kesehatan.index') }}">
                    <div class="card-body">
                      <h5 class="card-title">Menunggu Persetujuan</h5>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="fa-sharp fa-solid fa-xmark"></i>
                        </div>
                        <div class="ps-3">
                          <h6>{{ $kes1 ?? 0 }}</h6>
                          <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                        </div>
                      </div>
                    </div>
                </a>
                  </div>
                </div>

                <!-- Revenue Card -->
                <div class="col-xxl-6 col-md-6">
                  <div class="card info-card sales-card">
                    <a href="{{ route('deckesehatan.index') }}">
                    <div class="card-body">
                      <h5 class="card-title">Sudah Disetujui</h5>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="ps-3">
                          <h6>{{ $kes2 ?? 0 }}</h6>
                          <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                        </div>
                      </div>
                    </div>
                </a>
                  </div>
                </div>
                
          </div>
        </div>
      </section>
    
      </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/main.js') }}"></script>

</body>
</html>
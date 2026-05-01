@extends('backend/layouts.template')

@section('content')

<main id="main" class="main">
  @if ($message = Session::get('success'))
  <div class="alert alert-success" role="alert">
    {{ $message }}
  </div>
  @endif

  <section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->

          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Pengguna</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $jmlh_user }}</h6>
                      <span class="text-muted small pt-2 ps-1">Jumlah total pengguna</span>
                    </div>
                    </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

               <!-- Sales Card -->
               <div class="col-xxl-6 col-md-6">
                <div class="card info-card sales-card">
                  <a href="{{ route('accbidangumum.index') }}">
  
                  <div class="card-body">
                    <h5 class="card-title">Laporan Bidang Umum</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $bidangumum }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total Laporan Bidang Umum</span>
                      </div>
                      </div>
                  </div>
                </a>
                </div>
              </div>
              <!-- End Sales Card -->

                             <!-- Sales Card -->
               <div class="col-xxl-6 col-md-6">
                <div class="card info-card sales-card">
                  <a href="{{ route('pokja1.index') }}">
  
                  <div class="card-body">
                    <h5 class="card-title">Laporan Kelompok Kerja 1</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $totalbidang1 }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total Laporan Kelompok Kerja 1</span>
                      </div>
                      </div>
                  </div>
                </a>
                </div>
              </div><!-- End Sales Card -->

                             <!-- Sales Card -->
               <div class="col-xxl-6 col-md-6">
                <div class="card info-card sales-card">
                  <a href="{{ route('pokja2.index') }}">
  
                  <div class="card-body">
                    <h5 class="card-title">Laporan Kelompok Kerja 2</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $totalbidang2 }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total Laporan Kelompok Kerja 2</span>
                      </div>
                      </div>
                  </div>
                </a>
                </div>
              </div><!-- End Sales Card -->

                             <!-- Sales Card -->
               <div class="col-xxl-6 col-md-6">
                <div class="card info-card sales-card">
                  <a href="{{ route('pokja3.index') }}">
  
                  <div class="card-body">
                    <h5 class="card-title">Laporan Kelompok Kerja 3</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $totalbidang3 }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total Laporan Kelompok Kerja 3</span>
                      </div>
                      </div>
                  </div>
                </a>
                </div>
              </div><!-- End Sales Card -->

                                           <!-- Sales Card -->
               <div class="col-xxl-6 col-md-6">
                <div class="card info-card sales-card">
                  <a href="{{ route('pokja4.index') }}">
  
                  <div class="card-body">
                    <h5 class="card-title">Laporan Kelompok Kerja 4</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $totalbidang4 }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total Laporan Kelompok Kerja 4</span>
                      </div>
                      </div>
                  </div>
                </a>
                </div>
              </div><!-- End Sales Card -->
  

                     
            <div class="col-md-12 mx-auto mt-2">

    </div>


      </div>
    </div>
  </section>

  </main><!-- End #main -->

  @endsection
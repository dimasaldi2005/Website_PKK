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
      <div class="row">

        {{-- CARD PENGGUNA --}}
        <div class="col-xxl-6 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Pengguna</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background: #e0f2fe;">
                  <i class="bi bi-people-fill" style="color: #0284c7;"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $jmlh_user }}</h6>
                  <span class="text-muted small pt-2 ps-1">Jumlah total pengguna</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- CARD BIDANG UMUM --}}
        <div class="col-xxl-6 col-md-6">
          <div class="card info-card sales-card">
            <a href="{{ route('accbidangumum.index') }}">
              <div class="card-body">
                <h5 class="card-title">Laporan Bidang Umum</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background: #fef9c3;">
                    <i class="bi bi-clipboard2-data-fill" style="color: #ca8a04;"></i>
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

        {{-- CARD POKJA 1 --}}
        <div class="col-xxl-6 col-md-6">
          <div class="card info-card sales-card">
            <a href="{{ route('pokja1.index') }}">
              <div class="card-body">
                <h5 class="card-title">Laporan Kelompok Kerja 1</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background: #dcfce7;">
                    <i class="bi bi-shield-fill-check" style="color: #16a34a;"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalbidang1 }}</h6>
                    <span class="text-muted small pt-2 ps-1">Jumlah total Laporan Kelompok Kerja 1</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        {{-- CARD POKJA 2 --}}
        <div class="col-xxl-6 col-md-6">
          <div class="card info-card sales-card">
            <a href="{{ route('pokja2.index') }}">
              <div class="card-body">
                <h5 class="card-title">Laporan Kelompok Kerja 2</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background: #ede9fe;">
                    <i class="bi bi-mortarboard-fill" style="color: #7c3aed;"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalbidang2 }}</h6>
                    <span class="text-muted small pt-2 ps-1">Jumlah total Laporan Kelompok Kerja 2</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        {{-- CARD POKJA 3 --}}
        <div class="col-xxl-6 col-md-6">
          <div class="card info-card sales-card">
            <a href="{{ route('pokja3.index') }}">
              <div class="card-body">
                <h5 class="card-title">Laporan Kelompok Kerja 3</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background: #ffedd5;">
                    <i class="bi bi-house-fill" style="color: #ea580c;"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalbidang3 }}</h6>
                    <span class="text-muted small pt-2 ps-1">Jumlah total Laporan Kelompok Kerja 3</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        {{-- CARD POKJA 4 --}}
        <div class="col-xxl-6 col-md-6">
          <div class="card info-card sales-card">
            <a href="{{ route('pokja4.index') }}">
              <div class="card-body">
                <h5 class="card-title">Laporan Kelompok Kerja 4</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background: #fce7f3;">
                    <i class="bi bi-heart-pulse-fill" style="color: #db2777;"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalbidang4 }}</h6>
                    <span class="text-muted small pt-2 ps-1">Jumlah total Laporan Kelompok Kerja 4</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-md-12 mx-auto mt-2"></div>

      </div>
    </div>
  </section>

</main>

@endsection
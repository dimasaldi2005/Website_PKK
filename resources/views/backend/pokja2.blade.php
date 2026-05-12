@extends('backend.layouts.template')

@section('content1')

<style>
  * { font-family: 'Poppins', sans-serif !important; }
  .page-heading { font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 600; color: #1e293b; margin-bottom: 20px; }
  .pokja-card:hover { transform: translateY(-4px); box-shadow: 0 8px 16px rgba(0,0,0,0.12) !important; }
</style>

<main id="main" class="main">
  <section class="section">
    <h1 class="page-heading">Laporan Pokja 2</h1>

    @if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Perhatian!</strong> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- CARDS LAPORAN --}}
    <div class="row mb-3">

      {{-- PENDIDIKAN --}}
      <div class="col-md-6 mb-3">
        <a href="{{ route('accpendidikan.index') }}" style="text-decoration:none;">
          <div class="form-card pokja-card" style="background:white; border-radius:16px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:all 0.3s; cursor:pointer;">
            <div class="d-flex align-items-center mb-3">
              <div style="background:#ede9fe; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                <i class="bi bi-mortarboard-fill" style="font-size:26px; color:#7c3aed;"></i>
              </div>
              <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Pendidikan Dan Ketrampilan</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $modelPertama ?? 0 }}</span>
              <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
            </div>
          </div>
        </a>
      </div>

      {{-- PENGEMBANGAN --}}
      <div class="col-md-6 mb-3">
        <a href="{{ route('accpengembangan.index') }}" style="text-decoration:none;">
          <div class="form-card pokja-card" style="background:white; border-radius:16px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:all 0.3s; cursor:pointer;">
            <div class="d-flex align-items-center mb-3">
              <div style="background:#fef9c3; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                <i class="bi bi-graph-up-arrow" style="font-size:26px; color:#ca8a04;"></i>
              </div>
              <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Pengembangan Kehidupan Berkoperasi</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $modelKedua ?? 0 }}</span>
              <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
            </div>
          </div>
        </a>
      </div>

    </div>

    {{-- CETAK --}}
    <div class="row mt-2">
      <div class="col-md-6 mb-3">
        <div class="form-card" style="background:white; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
          <h5 style="font-weight:600; font-size:14px; margin-bottom:12px; color:#2d3748;">Cetak Perbulan</h5>
          <form action="{{ route('pendidikan.filter') }}" method="GET">
            <div class="d-flex align-items-end gap-2">
              <div style="flex:1;">
                <label style="font-size:12px; font-weight:500; color:#6b7280; margin-bottom:6px; display:block;">Bulan :</label>
                <input type="month" name="search" class="form-control" style="height:38px; font-size:13px;">
              </div>
              <button type="submit" class="btn-kirim" style="margin-bottom:0; font-size:13px; padding:8px 20px;">Cetak</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="form-card" style="background:white; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
          <h5 style="font-weight:600; font-size:14px; margin-bottom:12px; color:#2d3748;">Cetak Pertahun</h5>
          <form action="{{ route('pendidikan.filter') }}" method="GET">
            <div class="d-flex align-items-end gap-2">
              <div style="flex:1;">
                <label style="font-size:12px; font-weight:500; color:#6b7280; margin-bottom:6px; display:block;">Tahun :</label>
                <select name="search2" class="form-control" style="height:38px; font-size:13px;">
                  <option value="">-- Pilih Tahun --</option>
                  @for ($year = now()->year; $year >= 2021; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                  @endfor
                </select>
              </div>
              <button type="submit" class="btn-kirim" style="margin-bottom:0; font-size:13px; padding:8px 20px;">Cetak</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </section>
</main>

@endsection

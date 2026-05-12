@extends('backend.layouts.template')

@section('content1')

<main id="main" class="main">
    <section class="section">
        <h1 class="page-heading">Laporan Bidang Umum</h1>

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Filter Section Cetak -->
        <div class="row">
            <!-- Cetak Perbulan -->
            <div class="col-md-6 mb-3">
                <div class="form-card">
                    <h5 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; margin-bottom: 12px; color: #2d3748;">Cetak Perbulan</h5>
                    <form action="{{ route('bidangumum.filter') }}" method="GET">
                        <div class="d-flex align-items-end gap-2">
                            <div style="flex: 1;">
                                <label style="font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; color: #6b7280; margin-bottom: 6px; display: block;">Bulan :</label>
                                <input type="month" name="search" class="form-control" style="height: 38px; font-size: 13px;">
                            </div>
                            <button type="submit" class="btn-kirim" style="margin-bottom: 0; font-size: 13px; padding: 8px 20px;">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cetak Pertahun -->
            <div class="col-md-6 mb-3">
                <div class="form-card">
                    <h5 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; margin-bottom: 12px; color: #2d3748;">Cetak Pertahun</h5>
                    <form action="{{ route('bidangumum.filter') }}" method="GET">
                        <div class="d-flex align-items-end gap-2">
                            <div style="flex: 1;">
                                <label style="font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; color: #6b7280; margin-bottom: 6px; display: block;">Tahun :</label>
                                <select name="search2" class="form-control" style="height: 38px; font-size: 13px;">
                                    <option value="">-- Pilih Tahun --</option>
                                    @for ($year = now()->year; $year >= 2021; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" class="btn-kirim" style="margin-bottom: 0; font-size: 13px; padding: 8px 20px;">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cards Section -->
        <div class="row mt-3">
            <!-- Menunggu Persetujuan -->
            <div class="col-md-6 mb-3">
                <a href="{{ route('bidangumum.index') }}" style="text-decoration: none;">
                    <div class="form-card" style="cursor:pointer; transition:all 0.3s; border-radius:16px; box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                        <div class="d-flex align-items-center mb-3">
                            <div style="background:#fef2f2; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                                <i class="bi bi-hourglass-split" style="font-size:26px; color:#ef4444;"></i>
                            </div>
                            <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Menunggu Persetujuan</h5>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $got1 }}</span>
                            <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Sudah Disetujui -->
            <div class="col-md-6 mb-3">
                <a href="{{ route('decbidangumum.index') }}" style="text-decoration: none;">
                    <div class="form-card" style="cursor:pointer; transition:all 0.3s; border-radius:16px; box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                        <div class="d-flex align-items-center mb-3">
                            <div style="background:#f0fdf4; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                                <i class="bi bi-patch-check-fill" style="font-size:26px; color:#10b981;"></i>
                            </div>
                            <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Sudah Disetujui</h5>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $got2 }}</span>
                            <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</main>

<style>
    .form-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }
</style>

@endsection

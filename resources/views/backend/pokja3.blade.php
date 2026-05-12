@extends('backend.layouts.template')

@section('content1')

<style>
  * { font-family: 'Poppins', sans-serif !important; }
  .page-heading { font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 600; color: #1e293b; margin-bottom: 20px; }
  .pokja-card:hover { transform: translateY(-4px); box-shadow: 0 8px 16px rgba(0,0,0,0.12) !important; }
</style>

<main id="main" class="main">
  <section class="section">
    <h1 class="page-heading">Laporan Pokja 3</h1>

    @if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Perhatian!</strong> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- CARDS LAPORAN --}}
    <div class="row mb-3">

      {{-- PANGAN --}}
      <div class="col-md-6 col-lg-3 mb-3">
        <a href="{{ route('accpangan.index') }}" style="text-decoration:none;">
          <div class="form-card pokja-card" style="background:white; border-radius:16px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:all 0.3s; cursor:pointer;">
            <div class="d-flex align-items-center mb-3">
              <div style="background:#fef9c3; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                <i class="bi bi-basket2-fill" style="font-size:26px; color:#ca8a04;"></i>
              </div>
              <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Program Pangan</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $modelPertama ?? 0 }}</span>
              <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
            </div>
          </div>
        </a>
      </div>

      {{-- SANDANG --}}
      <div class="col-md-6 col-lg-3 mb-3">
        <a href="{{ route('accsandang.index') }}" style="text-decoration:none;">
          <div class="form-card pokja-card" style="background:white; border-radius:16px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:all 0.3s; cursor:pointer;">
            <div class="d-flex align-items-center mb-3">
              <div style="background:#fce7f3; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                <i class="bi bi-bag-heart-fill" style="font-size:26px; color:#db2777;"></i>
              </div>
              <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Program Industri Rumah Tangga</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $modelKedua ?? 0 }}</span>
              <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
            </div>
          </div>
        </a>
      </div>

      {{-- PERUMAHAN --}}
      <div class="col-md-6 col-lg-3 mb-3">
        <a href="{{ route('accperumahan.index') }}" style="text-decoration:none;">
          <div class="form-card pokja-card" style="background:white; border-radius:16px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:all 0.3s; cursor:pointer;">
            <div class="d-flex align-items-center mb-3">
              <div style="background:#ffedd5; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                <i class="bi bi-house-fill" style="font-size:26px; color:#ea580c;"></i>
              </div>
              <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Program Perumahan Dan Tata Laksana Rumah Tangga</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $modelKetiga ?? 0 }}</span>
              <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
            </div>
          </div>
        </a>
      </div>

      {{-- KADER POKJA 3 --}}
      <div class="col-md-6 col-lg-3 mb-3">
        <a href="{{ route('acclaporanpokja3.index') }}" style="text-decoration:none;">
          <div class="form-card pokja-card" style="background:white; border-radius:16px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:all 0.3s; cursor:pointer;">
            <div class="d-flex align-items-center mb-3">
              <div style="background:#e0f2fe; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                <i class="bi bi-person-badge-fill" style="font-size:26px; color:#0284c7;"></i>
              </div>
              <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Kader Pokja 3</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $modelKeempat ?? 0 }}</span>
              <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
            </div>
          </div>
        </a>
      </div>

    </div>

    {{-- CARD CETAK --}}
    <div class="row">
      <div class="col-12">
        <div class="form-card" style="background:white; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
          <h5 style="font-weight:600; font-size:16px; color:#2d3748; margin-bottom:6px;">Laporan Pokja 3</h5>
          <p style="font-size:13px; color:#6b7280; margin-bottom:16px;">Cetak laporan berdasarkan bulan, tahun, bidang dan format file</p>
          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalLaporanPokja3">
            <i class="bi bi-file-earmark-arrow-down me-1"></i> Cetak Laporan
          </button>
        </div>
      </div>
    </div>
  </section>
</main>

{{-- MODAL CETAK LAPORAN POKJA 3 --}}
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
          <div class="mb-3">
            <label>Bulan <span class="text-danger">*</span></label>
            <select name="bulan" class="form-select" required>
              <option value="">-- Pilih Bulan --</option>
              <option value="1">Januari</option><option value="2">Februari</option>
              <option value="3">Maret</option><option value="4">April</option>
              <option value="5">Mei</option><option value="6">Juni</option>
              <option value="7">Juli</option><option value="8">Agustus</option>
              <option value="9">September</option><option value="10">Oktober</option>
              <option value="11">November</option><option value="12">Desember</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Tahun <span class="text-danger">*</span></label>
            <select name="tahun" class="form-select" required>
              <option value="">-- Pilih Tahun --</option>
              @for ($year = now()->year; $year >= 2021; $year--)
                <option value="{{ $year }}">{{ $year }}</option>
              @endfor
            </select>
          </div>
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
          <div class="mb-3">
            <label>Format <span class="text-danger">*</span></label>
            <select name="format" id="formatExportPokja3" class="form-select" required>
              <option value="">-- Pilih Format --</option>
              <option value="pdf">📄 PDF (Download)</option>
              <option value="excel">📊 Google Sheets (Online)</option>
            </select>
            <small class="text-muted"><i class="bi bi-info-circle"></i> Pilih Google Sheets untuk menyimpan data langsung ke spreadsheet online</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Batal</button>
          <button type="submit" class="btn btn-success" id="btnExportPokja3"><i class="bi bi-download"></i> <span id="btnTextPokja3">Export</span></button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  const APPS_SCRIPT_URL_POKJA3 = "https://script.google.com/macros/s/AKfycbwtoylVdJDYPyT8FDY5edEtOfszK5bdK1nOyWyrnxwdUX_NZ0IAbMz6A0LgEGqlcRPD/exec";

  document.getElementById("formExportPokja3").addEventListener("submit", function(e) {
    e.preventDefault();
    const format = document.getElementById("formatExportPokja3").value;
    const btn = document.getElementById("btnExportPokja3");
    const btnText = document.getElementById("btnTextPokja3");
    if (!format) { Swal.fire({ icon: 'warning', title: 'Pilih Format!', text: 'Silakan pilih format export terlebih dahulu' }); return; }
    if (format === "pdf") {
      const params = new URLSearchParams(new FormData(e.target)).toString();
      window.location.href = "{{ route('pangan.filter') }}?" + params;
    } else if (format === "excel") {
      btn.disabled = true;
      btnText.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Mengirim...';
      const data = Object.fromEntries(new FormData(e.target).entries());
      data.timestamp = new Date().toISOString();
      data.pokja = "POKJA_3";
      Swal.fire({ title: 'Mengirim data...', text: 'Mohon tunggu...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
      fetch(APPS_SCRIPT_URL_POKJA3, { method: 'POST', mode: 'no-cors', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data) })
        .then(() => {
          Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data telah dikirim ke Google Sheets!', confirmButtonText: 'Oke' })
            .then(() => { e.target.reset(); bootstrap.Modal.getInstance(document.getElementById('modalLaporanPokja3'))?.hide(); });
        })
        .catch(error => { Swal.fire({ icon: 'error', title: 'Gagal!', html: `<code>${error.message}</code>` }); })
        .finally(() => { btn.disabled = false; btnText.textContent = 'Export'; });
    }
  });
</script>

@endsection

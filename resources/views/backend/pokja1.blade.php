@extends('backend.layouts.template')

@section('content1')

<style>
  * { font-family: 'Poppins', sans-serif !important; }
  .page-heading { font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 600; color: #1e293b; margin-bottom: 20px; }
  .pokja-card:hover { transform: translateY(-4px); box-shadow: 0 8px 16px rgba(0,0,0,0.12) !important; }
</style>

<main id="main" class="main">
  <section class="section">
    <h1 class="page-heading">Laporan Pokja 1</h1>

    @if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Perhatian!</strong> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- CARD CETAK --}}
    <div class="row mb-3">
      <div class="col-12">
        <div class="form-card" style="background:white; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
          <h5 style="font-weight:600; font-size:16px; color:#2d3748; margin-bottom:6px;">Laporan Pokja 1</h5>
          <p style="font-size:13px; color:#6b7280; margin-bottom:16px;">Cetak laporan berdasarkan bulan, tahun, bidang dan format file</p>
          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalLaporanPokja1">
            <i class="bi bi-file-earmark-arrow-down me-1"></i> Cetak Laporan
          </button>
        </div>
      </div>
    </div>

    {{-- CARDS LAPORAN --}}
    <div class="row mb-3">

      {{-- PENGHAYATAN --}}
      <div class="col-md-4 mb-3">
        <a href="{{ route('accpenghayatan.index') }}" style="text-decoration:none;">
          <div class="form-card pokja-card" style="background:white; border-radius:16px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:all 0.3s; cursor:pointer;">
            <div class="d-flex align-items-center mb-3">
              <div style="background:#e0f2fe; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                <i class="bi bi-shield-fill-check" style="font-size:26px; color:#0284c7;"></i>
              </div>
              <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Penghayatan Dan Pengamalan Pancasila</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $modelPertama ?? 0 }}</span>
              <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
            </div>
          </div>
        </a>
      </div>

      {{-- GOTONG ROYONG --}}
      <div class="col-md-4 mb-3">
        <a href="{{ route('accgotongroyong.index') }}" style="text-decoration:none;">
          <div class="form-card pokja-card" style="background:white; border-radius:16px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:all 0.3s; cursor:pointer;">
            <div class="d-flex align-items-center mb-3">
              <div style="background:#dcfce7; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                <i class="bi bi-people-fill" style="font-size:26px; color:#16a34a;"></i>
              </div>
              <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Gotong Royong</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $modelKedua ?? 0 }}</span>
              <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
            </div>
          </div>
        </a>
      </div>

      {{-- KADER POKJA 1 --}}
      <div class="col-md-4 mb-3">
        <a href="{{ route('acclaporanpokja1.index') }}" style="text-decoration:none;">
          <div class="form-card pokja-card" style="background:white; border-radius:16px; padding:24px; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:all 0.3s; cursor:pointer;">
            <div class="d-flex align-items-center mb-3">
              <div style="background:#ede9fe; width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-right:16px; flex-shrink:0;">
                <i class="bi bi-person-badge-fill" style="font-size:26px; color:#7c3aed;"></i>
              </div>
              <h5 style="font-weight:600; font-size:14px; color:#1e293b; margin:0; line-height:1.4;">Kader Pokja 1</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
              <span style="font-size:28px; font-weight:600; color:#0369a1;">{{ $modelKetiga ?? 0 }}</span>
              <span style="font-size:13px; color:#94a3b8;">Jumlah total laporan</span>
            </div>
          </div>
        </a>
      </div>

    </div>
  </section>
</main>

{{-- MODAL CETAK LAPORAN POKJA 1 --}}
<div class="modal fade" id="modalLaporanPokja1" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cetak Laporan Pokja 1</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="formExportPokja1">
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
              <option value="penghayatan">Penghayatan & Pengamalan Pancasila</option>
              <option value="gotongroyong">Gotong Royong</option>
              <option value="kader">Kader Pokja 1</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Format <span class="text-danger">*</span></label>
            <select name="format" id="formatExportPokja1" class="form-select" required>
              <option value="">-- Pilih Format --</option>
              <option value="pdf">📄 PDF (Download)</option>
              <option value="excel">📊 Google Sheets (Online)</option>
            </select>
            <small class="text-muted"><i class="bi bi-info-circle"></i> Pilih Google Sheets untuk menyimpan data langsung ke spreadsheet online</small>
          </div>
          <div class="alert alert-primary mt-3" id="infoLinkSheet" style="display:none; border-left:4px solid #0d6efd;">
            <h6 class="alert-heading fw-bold mb-1" style="font-size:14px;"><i class="bi bi-link-45deg"></i> Link Spreadsheet Tujuan</h6>
            <p class="mb-2" style="font-size:13px;">Semua data bidang Pokja 1 akan terekspor ke dalam tab di link berikut:</p>
            <a href="https://docs.google.com/spreadsheets/d/1sW8NzwzGyx9iBfTyjX7gZ17rFpg8PWgAU7OM4QMVUjo/edit?usp=sharing" target="_blank" class="btn btn-sm btn-light text-primary" style="font-size:12px; font-weight:600;">
              <i class="bi bi-box-arrow-up-right"></i> Buka Spreadsheet Pokja 1
            </a>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Batal</button>
          <button type="submit" class="btn btn-success" id="btnExportPokja1"><i class="bi bi-download"></i> <span id="btnTextPokja1">Export</span></button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  const APPS_SCRIPT_URL_POKJA1 = "https://script.google.com/macros/s/AKfycbxV-t515AuxJz2iN5wmuQfPDpJhC8t9Rb12oNu_fcQ9aGumvebosvG8SDhz2hcYDZkj/exec";

  document.getElementById("formatExportPokja1").addEventListener("change", function() {
    document.getElementById("infoLinkSheet").style.display = this.value === "excel" ? "block" : "none";
  });

  document.getElementById("formExportPokja1").addEventListener("submit", async function(e) {
    e.preventDefault();
    const format = document.getElementById("formatExportPokja1").value;
    const btn = document.getElementById("btnExportPokja1");
    const btnText = document.getElementById("btnTextPokja1");
    const form = e.target;
    const formData = new FormData(form);
    const bulan = formData.get('bulan');
    const tahun = formData.get('tahun');
    const bidang = formData.get('bidang');

    if (!format) { Swal.fire({ icon: 'warning', title: 'Pilih Format!', text: 'Silakan pilih format export terlebih dahulu' }); return; }

    if (format === "pdf") {
      const params = new URLSearchParams(formData).toString();
      window.location.href = "{{ route('gotongroyong.filter') }}?" + params;
    } else if (format === "excel") {
      const confirmExport = await Swal.fire({
        title: 'Mulai Ekspor?',
        html: `Data akan ditimpa/diperbarui ke dalam <b>Google Sheets POKJA 1</b>.`,
        icon: 'question', showCancelButton: true,
        confirmButtonColor: '#198754', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Ekspor!', cancelButtonText: 'Batal', reverseButtons: true
      });
      if (!confirmExport.isConfirmed) return;

      btn.disabled = true;
      btnText.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';
      Swal.fire({ title: 'Mengekspor data...', text: 'Sedang mengambil data...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

      try {
        const urlTarget = `{{ route('laporanpokja1.exportJson') }}?bulan=${bulan}&tahun=${tahun}&bidang=${bidang}`;
        const dbResponse = await fetch(urlTarget);
        if (!dbResponse.ok) throw new Error(`Status: ${dbResponse.status}`);
        const dbResult = await dbResponse.json();
        if (!dbResult.data || dbResult.data.length === 0) {
          Swal.fire('Data Kosong', 'Tidak ada laporan yang Disetujui pada bulan dan tahun tersebut.', 'info');
          btn.disabled = false; btnText.textContent = 'Export'; return;
        }
        const googleResponse = await fetch(APPS_SCRIPT_URL_POKJA1, {
          method: 'POST', redirect: 'follow',
          headers: { 'Content-Type': 'text/plain;charset=utf-8' },
          body: JSON.stringify(dbResult)
        });
        const result = JSON.parse(await googleResponse.text());
        if (result.status === "success") {
          Swal.fire({ icon: 'success', title: 'Berhasil!', html: `✅ ${result.message}`, confirmButtonText: 'Tutup' })
            .then(() => { form.reset(); document.getElementById("infoLinkSheet").style.display = "none"; bootstrap.Modal.getInstance(document.getElementById('modalLaporanPokja1'))?.hide(); });
        } else { throw new Error(result.message); }
      } catch (error) {
        Swal.fire({ icon: 'error', title: 'Gagal!', html: `<code>${error.message}</code>` });
      } finally {
        btn.disabled = false; btnText.textContent = 'Export';
      }
    }
  });
</script>

@endsection

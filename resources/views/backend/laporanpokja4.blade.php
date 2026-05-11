<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Laporan Pokja 4</title>

    <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <img src="{{ asset('backend/assets/img/pkk.png') }}" alt="">
            <span class="d-none d-lg-block">PKK NGANJUK</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
</header>

@include('backend.includes.sidebar')

<main id="main" class="main">

@if (session('error'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Perhatian!</strong> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<section class="section dashboard">
<div class="row">

<!-- CARD CETAK -->
<div class="col-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Laporan Pokja 4</h5>
            <p class="text-muted">Cetak laporan berdasarkan bulan, tahun, bidang dan format file</p>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalLaporan">
                <i class="bi bi-file-earmark-arrow-down"></i> Cetak Laporan
            </button>
        </div>
    </div>
</div>

<!-- CARD KESEHATAN -->
<div class="col-xxl-6 col-md-6">
    <div class="card info-card sales-card">
        <a href="{{ route('acckesehatan.index') }}">
            <div class="card-body">
                <h5 class="card-title">Kesehatan</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $modelPertama ?? 0 }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- CARD KELESTARIAN -->
<div class="col-xxl-6 col-md-6">
    <div class="card info-card sales-card">
        <a href="{{ route('acckelestarian.index') }}">
            <div class="card-body">
                <h5 class="card-title">Kelestarian Lingkungan Hidup</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $modelKedua ?? 0 }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- CARD PERENCANAAN -->
<div class="col-xxl-6 col-md-6">
    <div class="card info-card sales-card">
        <a href="{{ route('accperencanaan.index') }}">
            <div class="card-body">
                <h5 class="card-title">Perencanaan Sehat</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $modelKetiga ?? 0 }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- CARD KADER -->
<div class="col-xxl-6 col-md-6">
    <div class="card info-card sales-card">
        <a href="{{ route('acclaporanpokja4.index') }}">
            <div class="card-body">
                <h5 class="card-title">Jumlah Kader Pokja 4</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $modelKeempat ?? 0 }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- CARD INOVASI -->
<div class="col-xxl-6 col-md-6">
    <div class="card info-card sales-card">
        <a href="{{ route('inovasi.index') }}">
            <div class="card-body">
                <h5 class="card-title">Inovasi</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $modelKelima ?? 0 }}</h6>
                        <span class="text-muted small pt-2 ps-1">Jumlah total laporan</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

</div>

<!-- Card Tabel Data -->
<div class="card mt-2">
    <div class="card-body" style="overflow-x: auto;">
        <h5 class="card-title">Data Laporan Pokja 4</h5>
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    @if (Auth::guard('web')->check())
                        <th class="text-center" scope="col">Kecamatan</th>
                        <th class="text-center" scope="col">Desa</th>
                    @elseif (Auth::guard('pengguna')->check())
                        <th class="text-center" scope="col">Desa</th>
                    @endif
                    <th class="text-center" scope="col">Posyandu</th>
                    <th class="text-center" scope="col">Gizi</th>
                    <th class="text-center" scope="col">Kesling</th>
                    <th class="text-center" scope="col">Narkoba</th>
                    <th class="text-center" scope="col">PHBS</th>
                    <th class="text-center" scope="col">KB</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Tanggal</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse ($data as $row)
                <tr>
                    <th scope="row" class="text-center">{{ $no++ }}</th>
                    @if (Auth::guard('web')->check())
                        <td class="text-center">{{ $row->nama_kec ?? '-' }}</td>
                        <td class="text-center">{{ $row->nama_desa ?? '-' }}</td>
                    @elseif (Auth::guard('pengguna')->check())
                        <td class="text-center">{{ $row->nama_desa ?? '-' }}</td>
                    @endif
                    <td class="text-center">{{ $row->posyandu ?? '-' }}</td>
                    <td class="text-center">{{ $row->gizi ?? '-' }}</td>
                    <td class="text-center">{{ $row->kesling ?? '-' }}</td>
                    <td class="text-center">{{ $row->penyuluhan_narkoba ?? '-' }}</td>
                    <td class="text-center">{{ $row->PHBS ?? '-' }}</td>
                    <td class="text-center">{{ $row->KB ?? '-' }}</td>
                    <td class="text-center"><span class="badge bg-primary">{{ $row->status }}</span></td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i:s') }}</td>
                    <td class="text-center" style="white-space: nowrap;">
                        <a href="{{ route('laporanpokja4.edit', $row->id_kader_pokja4) }}" class="btn btn-sm btn-info text-white">Review</a>
                        <form action="{{ route('laporanpokja4.destroy', $row->id_kader_pokja4) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)">Hapus</button>
                        </form> 
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center py-4">
                        <div class="alert alert-danger mb-0">Tidak ada data laporan.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</section>
</main>

<!-- MODAL CETAK -->
<div class="modal fade" id="modalLaporan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cetak Laporan Pokja 4</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formExport">
                @csrf
                <div class="modal-body">
                    <!-- BULAN -->
                    <div class="mb-3">
                        <label>Bulan <span class="text-danger">*</span></label>
                        <select name="bulan" class="form-select" required>
                            <option value="">-- Pilih Bulan --</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    <!-- TAHUN -->
                    <div class="mb-3">
                        <label>Tahun <span class="text-danger">*</span></label>
                        <select name="tahun" class="form-select" required>
                            <option value="">-- Pilih Tahun --</option>
                            @for ($year = now()->year; $year >= 2021; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- BIDANG -->
                    <div class="mb-3">
                        <label>Bidang <span class="text-danger">*</span></label>
                        <select name="bidang" class="form-select" required>
                            <option value="">-- Pilih Bidang --</option>
                            <option value="kesehatan">Kesehatan</option>
                            <option value="kelestarian">Kelestarian Lingkungan Hidup</option>
                            <option value="perencanaan">Perencanaan Sehat</option>
                            <option value="kader">Kader Pokja 4</option>
                        </select>
                    </div>

                    <!-- FORMAT -->
                    <div class="mb-3">
                        <label>Format <span class="text-danger">*</span></label>
                        <select name="format" id="formatExport" class="form-select" required>
                            <option value="">-- Pilih Format --</option>
                            <option value="pdf">📄 PDF (Download)</option>
                            <option value="excel">📊 Google Sheets (Online)</option>
                        </select>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> 
                            Pilih Google Sheets untuk menyimpan data langsung ke spreadsheet online
                        </small>
                    </div>

                    <!-- INFO LINK GOOGLE SHEETS -->
                    <div class="alert alert-primary mt-3" id="infoLinkSheet" style="display: none; border-left: 4px solid #0d6efd;">
                        <h6 class="alert-heading fw-bold mb-1" style="font-size: 14px;"><i class="bi bi-link-45deg"></i> Link Spreadsheet Tujuan</h6>
                        <p class="mb-2" style="font-size: 13px;">Data akan diekspor otomatis ke dalam tab di Google Sheets berikut:</p>
                        <a href="https://docs.google.com/spreadsheets/d/1sG9520UiJQIXg3u7YHXPPIpjU41w8fkyrw3fP37u-9c/edit?usp=sharing" target="_blank" class="btn btn-sm btn-light text-primary" style="font-size: 12px; font-weight: 600;">
                            <i class="bi bi-box-arrow-up-right"></i> Buka Spreadsheet Laporan
                        </a>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success" id="btnExport">
                        <i class="bi bi-download"></i> <span id="btnText">Export</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/main.js') }}"></script>

<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data yang dihapus tidak bisa dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) button.closest('form').submit();
        });
    }

    document.getElementById("formatExport").addEventListener("change", function() {
        document.getElementById("infoLinkSheet").style.display = this.value === "excel" ? "block" : "none";
    });

    document.getElementById("formExport").addEventListener("submit", async function(e){
        e.preventDefault();
        
        const format = document.getElementById("formatExport").value;
        const btn = document.getElementById("btnExport");
        const btnText = document.getElementById("btnText");
        const form = e.target;
        
        if(!format) {
            Swal.fire({ icon: 'warning', title: 'Pilih Format!' });
            return;
        }
        
        if(format === "pdf"){
            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();
            window.location.href = "{{ route('kesehatan.filter') }}?" + params; 
            
        } else if(format === "excel"){
            const confirmExport = await Swal.fire({
              title: 'Mulai Ekspor?',
              text: 'Data akan dikirim via Server Backend ke Google Sheets.',
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#198754', 
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Ekspor Sekarang!'
            });

            if (!confirmExport.isConfirmed) return; 

            btn.disabled = true;
            btnText.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';
            
            Swal.fire({
                title: 'Mengekspor data...',
                text: 'Server Laravel sedang bekerja...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            try {
                // 1. KITA TEMBAK LANGSUNG KE CONTROLLER POKJA 4 (TIDAK ADA URL GOOGLE DI SINI!)
                const urlTarget = `{{ route('export.pokja4') }}`;
                const formDataExport = new FormData(form);

                const response = await fetch(urlTarget, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formDataExport
                });
                
                if (!response.ok) throw new Error(`Gagal terhubung ke server lokal (Status: ${response.status}).`);
                
                const result = await response.json();

                if(result.status === 'empty') {
                    Swal.fire('Data Kosong', 'Tidak ada laporan pada bulan dan tahun tersebut.', 'info');
                } else if(result.status === 'success') {
                    Swal.fire({
                        icon: 'success', title: 'Berhasil!',
                        html: `Laporan berhasil masuk ke Google Sheets.<br><br><a href="https://docs.google.com/spreadsheets/d/1sG9520UiJQIXg3u7YHXPPIpjU41w8fkyrw3fP37u-9c/edit?usp=sharing" target="_blank" class="btn btn-sm btn-outline-primary">Buka Spreadsheet</a>`,
                    });
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalLaporan'));
                    if(modal) modal.hide();
                } else {
                    // Jika error dari Controller/Google
                    throw new Error(result.message || "Gagal diproses oleh Backend.");
                }

            } catch (error) {
                Swal.fire({ icon: 'error', title: 'Gagal!', html: `Pesan Error: <br><code>${error.message}</code>` });
            } finally {
                btn.disabled = false; btnText.textContent = 'Export';
            }
        }
    });
</script>

</body>
</html>
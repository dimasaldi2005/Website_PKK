<!-- resources/views/backend/unggulan_bulanan.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Rekap Desa Bulanan - Unggulan</title>

  <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .table-responsive { overflow-x: auto; border-radius: 10px; box-shadow: 0 4px 18px rgba(0,0,0,0.06); }
    .table-responsive table { min-width: 1500px; white-space: nowrap; margin-bottom: 0; }
    .table-responsive thead th { position: sticky; top: 0; background: #f8fafc; color: #334155; font-size: 12px; font-weight: 600; padding: 15px 10px; vertical-align: middle; border: 1px solid #e2e8f0; text-transform: uppercase; }
    .table-responsive tbody td { font-size: 13px; padding: 12px 10px; vertical-align: middle; background-color: white; color: #475569; }
    .table-responsive tbody tr:hover td { background-color: #f1f5f9; }
    .table-bordered th, .table-bordered td { border: 1px solid #e2e8f0; }
    .table-responsive::-webkit-scrollbar { height: 8px; }
    .table-responsive::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .table-responsive::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .table-responsive::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    * { font-family: "Poppins", sans-serif !important; }
  </style>
</head>

<body>

  @include('backend.includes.sidebar')

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Rekap Desa Bulanan - Unggulan</h1>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
      <i class="bi bi-check-circle me-1"></i> {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mt-2">
      <div class="card-body">
        
        <div class="row mt-3">
            <div class="col-md-4">
                <form method="GET">
                    <label class="form-label fw-bold">Status Laporan</label>
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        @if(Auth::guard('web')->check())
                            <option value="Disetujui1" {{ request('status', $status) == 'Disetujui1' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                            <option value="Disetujui2" {{ request('status', $status) == 'Disetujui2' ? 'selected' : '' }}>Sudah Disetujui</option>
                        @elseif(Auth::guard('pengguna')->check())
                            <option value="Proses" {{ request('status', $status) == 'Proses' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                            <option value="Disetujui1" {{ request('status', $status) == 'Disetujui1' ? 'selected' : '' }}>Sudah Disetujui</option>
                        @endif
                    </select>
                </form>
            </div>
        </div>

        <div class="alert alert-info d-flex align-items-center mt-3" role="alert">
          <i class="bi bi-info-circle-fill me-2"></i>
          <div>Scroll horizontal untuk melihat semua kolom data.</div>
        </div>

        <div class="table-responsive mt-3">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th rowspan="3" class="text-center align-middle">No</th>
                @if (Auth::guard('web')->check())
                <th rowspan="3" class="text-center align-middle">Kecamatan</th>
                <th rowspan="3" class="text-center align-middle">Desa</th>
                @elseif (Auth::guard('pengguna')->check())
                <th rowspan="3" class="text-center align-middle">Desa</th>
                @endif
                <th colspan="3" class="text-center align-middle">JUMLAH</th>
                <th colspan="4" class="text-center align-middle">JUMLAH IBU</th>
                <th colspan="6" class="text-center align-middle">JUMLAH BAYI</th>
                <th colspan="2" class="text-center align-middle">BALITA MENINGGAL</th>
                <th rowspan="3" class="text-center align-middle">Status</th>
                <th rowspan="3" class="text-center align-middle">Tanggal</th>
                <th rowspan="3" class="text-center align-middle">Aksi</th>
              </tr>
              <tr>
                <th rowspan="2" class="text-center align-middle">RW</th>
                <th rowspan="2" class="text-center align-middle">RT</th>
                <th rowspan="2" class="text-center align-middle">DASA WISMA</th>
                <th rowspan="2" class="text-center align-middle">HAMIL</th>
                <th rowspan="2" class="text-center align-middle">MELAHIRKAN</th>
                <th rowspan="2" class="text-center align-middle">NIFAS</th>
                <th rowspan="2" class="text-center align-middle">MENINGGAL</th>
                <th colspan="2" class="text-center align-middle">LAHIR</th>
                <th colspan="2" class="text-center align-middle">AKTE</th>
                <th colspan="2" class="text-center align-middle">MENINGGAL</th>
                <th colspan="2"></th>
              </tr>
              <tr>
                <th class="text-center align-middle">L</th>
                <th class="text-center align-middle">P</th>
                <th class="text-center align-middle">ADA</th>
                <th class="text-center align-middle">TIDAK</th>
                <th class="text-center align-middle">L</th>
                <th class="text-center align-middle">P</th>
                <th class="text-center align-middle">L</th>
                <th class="text-center align-middle">P</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @forelse ($data as $item)
              <tr>
                <th scope="row" class="text-center">{{ $no++ }}</th>
                @if (Auth::guard('web')->check())
                  <td class="text-center">{{ $item->nama_kec ?? '-' }}</td>
                  <td class="text-center">{{ $item->nama_desa ?? '-' }}</td>
                @elseif (Auth::guard('pengguna')->check())
                  <td class="text-center">{{ $item->nama_desa ?? '-' }}</td>
                @endif
                
                <td class="text-center">{{ $item->rw ?? '0' }}</td>
                <td class="text-center">{{ $item->rt ?? '0' }}</td>
                <td class="text-center">{{ $item->dasa_wisma ?? '0' }}</td>
                <td class="text-center">{{ $item->hamil ?? '0' }}</td>
                <td class="text-center">{{ $item->melahirkan ?? '0' }}</td>
                <td class="text-center">{{ $item->nifas ?? '0' }}</td>
                <td class="text-center">{{ $item->meninggal ?? '0' }}</td>
                <td class="text-center">{{ $item->bayi_lahir_l ?? '0' }}</td>
                <td class="text-center">{{ $item->bayi_lahir_p ?? '0' }}</td>
                <td class="text-center">{{ $item->akte_kelahiran_ada ?? '0' }}</td>
                <td class="text-center">{{ $item->akte_kelahiran_tidak ?? '0' }}</td>
                <td class="text-center">{{ $item->bayi_meninggal_l ?? '0' }}</td>
                <td class="text-center">{{ $item->bayi_meninggal_p ?? '0' }}</td>
                <td class="text-center">{{ $item->balita_meninggal_l ?? '0' }}</td>
                <td class="text-center">{{ $item->balita_meninggal_p ?? '0' }}</td>
                
                <td class="text-center">
                  @if(in_array(strtolower($item->status), ['proses', 'revisi']))
                    <span class="badge bg-warning text-dark">{{ $item->status }}</span>
                  @elseif(in_array(strtolower($item->status), ['disetujui1', 'disetujui2']))
                    <span class="badge bg-success">{{ $item->status }}</span>
                  @else
                    <span class="badge bg-secondary">{{ $item->status }}</span>
                  @endif
                </td>
                
                <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                
                <td class="text-center" style="white-space: nowrap;">
                    
                    {{-- LOGIKA HAPUS DATA TOK --}}
                    @php
                        $bolehEdit = false;
                        if(Auth::guard('web')->check() && strtolower($item->status) == 'disetujui1') $bolehEdit = true;
                        if(Auth::guard('pengguna')->check() && strtolower($item->status) == 'proses') $bolehEdit = true;
                    @endphp

                    @if($bolehEdit)
                        <a href="{{ route('unggulan.bulanan.edit', $item->id_rekap_desa_bulanan) }}" class="btn btn-sm btn-info text-white me-1" data-bs-toggle="tooltip" title="Review Data">
                            <i class="bi bi-search"></i>
                        </a>
                    @endif

                    <form action="{{ route('unggulan.bulanan.destroy', $item->id_rekap_desa_bulanan)}}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)" data-bs-toggle="tooltip" title="Hapus Data">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form> 
                </td>

              </tr>
              @empty
              <tr>
                <td colspan="20" class="text-center py-5">
                  <div class="alert alert-danger mb-0">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Tidak ada data laporan.
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/main.js') }}"></script>

  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

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
        if (result.isConfirmed) {
          button.closest('form').submit();
        }
      });
    }
  </script>

</body>
</html>
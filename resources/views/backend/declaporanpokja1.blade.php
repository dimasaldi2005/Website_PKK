{{-- @extends('backend/layouts.template')

@section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan Kader Pokja 1 (Riwayat)</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">

  {{-- fontawesome --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">

  <style>
    .table-responsive {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      border-radius: 10px;
      box-shadow: 0 4px 18px rgba(0,0,0,0.06);
    }

    .table-responsive table {
      min-width: 900px;
      white-space: nowrap;
      margin-bottom: 0;
    }

    .table-responsive thead th {
      position: sticky;
      top: 0;
      background: #f8fafc; 
      color: #334155; 
      z-index: 2;
      font-size: 12px;
      font-weight: 600;
      padding: 15px 10px;
      vertical-align: middle;
      border: 1px solid #e2e8f0;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .table-responsive tbody td {
      font-size: 13px;
      padding: 12px 10px;
      vertical-align: middle;
      background-color: white;
      color: #475569;
    }

    .table-responsive tbody tr:hover td {
      background-color: #f1f5f9;
    }

    .table-bordered th,
    .table-bordered td {
      border: 1px solid #e2e8f0;
    }

    .table-responsive::-webkit-scrollbar {
      height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>

</head>

<body>

  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{asset('backend/assets/img/pkk.png')}}" alt="">
        <span class="d-none d-lg-block">PKK NGANJUK</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto"></nav>
  </header>

  @include('backend.includes.sidebar')

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Daftar Laporan Kader Pokja 1 (Riwayat)</h1>
    </div>@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mt-2">
      <div class="card-body">

        <div class="table-responsive mt-3">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th scope="col" class="text-center align-middle">No</th>
                
                @if (Auth::guard('web')->check())
                  <th class="text-center align-middle" scope="col">Kecamatan</th>
                  <th class="text-center align-middle" scope="col">Desa</th>
                @elseif (Auth::guard('pengguna')->check())
                  <th class="text-center align-middle" scope="col">Desa</th>
                @endif
                
                <th class="text-center align-middle" scope="col">PKBN</th>
                <th class="text-center align-middle" scope="col">PKDRT</th>
                <th class="text-center align-middle" scope="col">Pola Asuh</th>
                <th class="text-center align-middle" scope="col">Status</th>
                <th class="text-center align-middle" scope="col">Tanggal</th>
                <th class="text-center align-middle" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @forelse ($data2 as $got1)
                <tr>
                  <th scope="row" class="text-center">{{ $no++ }}</th>
                  
                  @if (Auth::guard('web')->check())
                    <td class="text-center">{{ $got1->nama_kec }}</td>
                    <td class="text-center">{{ $got1->nama_desa }}</td>
                  @elseif (Auth::guard('pengguna')->check())
                    <td class="text-center">{{ $got1->nama_desa }}</td>
                  @endif
                  
                  <td class="text-center">{{ $got1->PKBN ?? '0' }}</td>
                  <td class="text-center">{{ $got1->PKDRT ?? '0' }}</td>
                  <td class="text-center">{{ $got1->pola_asuh ?? '0' }}</td>
                  
                  <td class="text-center">
                    @if(in_array(strtolower($got1->status), ['proses', 'revisi']))
                      <span class="badge bg-warning text-dark">{{ $got1->status }}</span>
                    @elseif(in_array(strtolower($got1->status), ['disetujui1', 'disetujui2']))
                      <span class="badge bg-success">{{ $got1->status }}</span>
                    @else
                      <span class="badge bg-secondary">{{ $got1->status }}</span>
                    @endif
                  </td>
                  
                  <td class="text-center">{{ \Carbon\Carbon::parse($got1->created_at)->format('d/m/Y H:i') }}</td>
                  
                  <td class="text-center">
                    <form action="{{ route('declaporanpokja1.destroy', $got1->id_kader_pokja1)}}" method="POST" class="d-inline delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9" class="text-center py-5">
                    <div class="alert alert-danger mb-0">
                      <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                      Tidak ada data laporan kader pokja 1
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </main><a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('backend/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="{{ asset('backend/assets/js/main.js') }}"></script>

  <script>
    // Initialize tooltips
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
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          button.closest('form').submit();
        }
      });
    }
  </script>

</body>
</html>
{{-- @endsection --}}
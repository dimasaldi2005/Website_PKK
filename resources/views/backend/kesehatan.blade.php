{{-- @extends('backend/layouts.template') --}}
{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan Kesehatan</title>

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
  <link href="{{ asset('backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">

  <!-- fontawesome -->
  <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1>Daftar Laporan Kesehatan</h1>
        </div>
        
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif

        <div class="card mt-2">
            <div class="card-body" style="overflow-x: auto;">
                <table class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            @if (Auth::guard('web')->check())
                                <th class="text-center" scope="col">Kecamatan</th>
                                <th class="text-center" scope="col">Desa</th>
                            @elseif (Auth::guard('pengguna')->check())
                                <th class="text-center" scope="col">Desa</th>
                            @endif
                            <th class="text-center" scope="col">Posyandu</th>
                            <th class="text-center" scope="col">Posyandu Integrasi</th>
                            <th class="text-center" scope="col">Klp</th>
                            <th class="text-center" scope="col">Anggota</th>
                            <th class="text-center" scope="col">Kartu Gratis</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($data as $sehat)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            @if (Auth::guard('web')->check())
                                <td class="text-center">{{ $sehat->nama_kec ?? '-' }}</td>
                                <td class="text-center">{{ $sehat->nama_desa ?? '-' }}</td>
                            @elseif (Auth::guard('pengguna')->check())
                                <td class="text-center">{{ $sehat->nama_desa ?? '-' }}</td>
                            @endif
                            <td class="text-center">{{ $sehat->jumlah_posyandu }}</td>
                            <td class="text-center">{{ $sehat->jumlah_posyandu_iterasi }}</td>
                            <td class="text-center">{{ $sehat->jumlah_klp }}</td>
                            <td class="text-center">{{ $sehat->jumlah_anggota }}</td>
                            <td class="text-center">{{ $sehat->jumlah_kartu_gratis }}</td>
                            <td><span class="badge bg-primary">{{ $sehat->status }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($sehat->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('kesehatan.edit', $sehat->id_pokja4_bidang1) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i> Review</a>
                                <form action="{{ route('kesehatan.destroy', $sehat->id_pokja4_bidang1)}}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)"><i class="bi bi-trash"></i> Hapus</button>
                                </form> 
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <div class="alert alert-danger mb-0">Tidak ada data laporan kesehatan</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
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
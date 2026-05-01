{{-- @extends('backend/layouts.template')

@section('content') --}}

<!DOCTYPE html>
,<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

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

  {{-- fontawesome --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{asset('backend/assets/img/pkk.png')}}" alt="">
        <span class="d-none d-lg-block">PKK NGANJUK</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('backend.includes.sidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Daftar Laporan Perencanaan Sehat</h1>
    </div><!-- End Page Title -->

    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
      {{ $message }}
    </div>
  @endif

    <div class="card mt-2">
      <div class="card-body">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              @if (Auth::guard('web')->check())
          <th class="text-center" scope="col">Kecamatan</th>
          <th class="text-center" scope="col">Desa</th>
        @elseif (Auth::guard('pengguna')->check())
          <th class="text-center" scope="col">Desa</th>
        @endif
              <th class="text-center" scope="col">Perempuan Subur</th>
              <th class="text-center" scope="col">Wanita subur</th>
              <th class="text-center" scope="col">Kb Perempuan</th>
              <th class="text-center" scope="col">Kb Wanita</th>
              <th class="text-center" scope="col">Kk Tbg</th>
              <th scope="col">Status</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
        $no = 1;
      @endphp
            @forelse ($data as $p_sehat)
          <tr>
            <th scope="row">{{ $no++ }}</th>
            @if (Auth::guard('web')->check())
          <td class="text-center">{{ $p_sehat->nama_kec }}</td>
          <td class="text-center">{{ $p_sehat->nama_desa }}</td>
        @elseif (Auth::guard('pengguna')->check())
          <td class="text-center">{{ $p_sehat->nama_desa }}</td>
        @endif
            <td class="text-center">{{ $p_sehat->J_Psubur }}</td>
            <td class="text-center">{{ $p_sehat->J_Wsubur }}</td>
            <td class="text-center">{{ $p_sehat->Kb_p }}</td>
            <td class="text-center">{{ $p_sehat->Kb_w }}</td>
            <td class="text-center">{{ $p_sehat->Kk_tbg }}</td>
            <td>{{ $p_sehat->status }}</td>
            <td>{{ $p_sehat->created_at }}</td>
            <td>
            <a href="{{ route('perencanaan_sehat.edit', $p_sehat->id_pokja4_bidang3) }}"
              class="btn btn-sm btn-tambah">Review</a>

            <form action="{{ route('perencanaan_sehat.destroy', $p_sehat->id_pokja4_bidang3)}}" method="POST"
              class="d-inline delete-form">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)">Hapus</button>
            </form>

            </td>
          </tr>
      @empty
        <div class="alert alert-danger mt-4">
          Tidak ada data laporan perencanaan sehat
        </div>
      @endforelse

          </tbody>
        </table>

      </div>
    </div>

    </div>
    </div>
    </section>

    <!-- Vendor JS Files -->
    <script src="{{ asset('backend/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Main JS File -->
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
            // Cari form terdekat dan submit
            button.closest('form').submit();
          }
        });
      }
    </script>

    {{-- @endsection --}}
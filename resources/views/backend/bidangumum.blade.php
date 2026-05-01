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


  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Daftar Laporan Bidang Umum</h1>
    </div><!-- End Page Title -->
    <div class="box-list">
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
      {{ $message }}
    </div>
  @endif



    <div class="card mt-2">
      <div class="card-body">
        <div class="table-responsive">
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
                <th class="text-center" scope="col">Dusun Lingkungan</th>
                <th class="text-center" scope="col">PKK RW</th>
                <th class="text-center" scope="col">Desa Wisma</th>
                <th class="text-center" scope="col">KRT</th>
                <th class="text-center" scope="col">KK</th>
                <th class="text-center" scope="col">Jiwa Laki</th>
                <th class="text-center" scope="col">JIwa Perempuan</th>
                <th class="text-center" scope="col">Anggota Laki</th>
                <th class="text-center" scope="col">Anggota Perempuan</th>
                <th class="text-center" scope="col">Umum Laki</th>
                <th class="text-center" scope="col">Umum Perempuan</th>
                <th class="text-center" scope="col">Khusus Laki</th>
                <th class="text-center" scope="col">Khusus Perempuan</th>
                <th class="text-center" scope="col">Honorer Laki</th>
                <th class="text-center" scope="col">Honorer Perempuan</th>
                <th class="text-center" scope="col">Bantuan Laki</th>
                <th class="text-center" scope="col">Bantuan Perempuan</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>

              </tr>
            </thead>
            <tbody>
              @php
        $no = 1;
      @endphp
              @forelse ($data as $umum)
            <tr>
            <th scope="row">{{ $no++ }}</th>
            @if (Auth::guard('web')->check())
          <td class="text-center">{{ $umum->nama_kec }}</td>
          <td class="text-center">{{ $umum->nama_desa }}</td>
        @elseif (Auth::guard('pengguna')->check())
          <td class="text-center">{{ $umum->nama_desa }}</td>
        @endif
            <td class="text-center">{{ $umum->dusun_lingkungan }}</td>
            <td class="text-center">{{ $umum->PKK_RW }}</td>
            <td class="text-center">{{ $umum->desa_wisma }}</td>
            <td class="text-center">{{ $umum->KRT }}</td>
            <td class="text-center">{{ $umum->KK }}</td>
            <td class="text-center">{{ $umum->jiwa_laki }}</td>
            <td class="text-center">{{ $umum->jiwa_perempuan }}</td>
            <td class="text-center">{{ $umum->anggota_laki }}</td>
            <td class="text-center">{{ $umum->anggota_perempuan }}</td>
            <td class="text-center">{{ $umum->umum_laki }}</td>
            <td class="text-center">{{ $umum->umum_perempuan }}</td>
            <td class="text-center">{{ $umum->khusus_laki }}</td>
            <td class="text-center">{{ $umum->khusus_perempuan }}</td>
            <td class="text-center">{{ $umum->honorer_laki }}</td>
            <td class="text-center">{{ $umum->honorer_perempuan }}</td>
            <td class="text-center">{{ $umum->bantuan_laki }}</td>
            <td class="text-center">{{ $umum->bantuan_perempuan }}</td>
            <td>{{ $umum->status }}</td>
            <td>{{ $umum->created_at }}</td>
            <td>
              <a href="{{ route('bidangumum.edit', $umum->id_laporan_umum) }}"
              class="btn btn-sm btn-tambah">Review</a>
              <br><br>
              <form action="{{ route('bidangumum.destroy', $umum->id_laporan_umum)}}" method="POST"
              class="d-inline delete-form">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)">Hapus</button>
              </form>

            </td>
            </tr>
        @empty
          <div class="alert alert-danger mt-4">
          Tidak ada data laporan bidang umum
          </div>
        @endforelse

            </tbody>
          </table>
        </div>

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

    <!-- Template Main JS File -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
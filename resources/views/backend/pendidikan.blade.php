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
      <h1>Daftar Laporan Pendidikan Dan Keterampilan</h1>
    </div><!-- End Page Title -->

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
                <th class="text-center" scope="col">Warga Buta</th>
                <th class="text-center" scope="col">Kel Belajar A</th>
                <th class="text-center" scope="col">Warga Belajar A</th>
                <th class="text-center" scope="col">Kel Belajar B</th>
                <th class="text-center" scope="col">Warga Belajar B</th>
                <th class="text-center" scope="col">Kel Belajar C</th>
                <th class="text-center" scope="col">Warga Belajar C</th>
                <th class="text-center" scope="col">Kel Belajar KF</th>
                <th class="text-center" scope="col">Warga Belajar KF</th>
                <th class="text-center" scope="col">Paud</th>
                <th class="text-center" scope="col">Taman Bacaan</th>
                <th class="text-center" scope="col">J. Klp</th>
                <th class="text-center" scope="col">J. Ibu Peserta</th>
                <th class="text-center" scope="col">J. Ape</th>
                <th class="text-center" scope="col">J. Kel Simulasi</th>
                <th class="text-center" scope="col">KF</th>
                <th class="text-center" scope="col">Paud Tutor</th>
                <th class="text-center" scope="col">BKB</th>
                <th class="text-center" scope="col">Koperasi</th>
                <th class="text-center" scope="col">Ketrampilan</th>
                <th class="text-center" scope="col">LP3PKK</th>
                <th class="text-center" scope="col">TP3PKK</th>
                <th class="text-center" scope="col">Damas PKK</th>
                <th scope="col">Status</th>
                <th scope="col">tanggal</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
        $no = 1;
        @endphp
              @forelse ($data as $peng1)
            <tr>
            <th scope="row">{{ $no++ }}</th>
            @if (Auth::guard('web')->check())
          <td class="text-center">{{ $peng1->nama_kec }}</td>
          <td class="text-center">{{ $peng1->nama_desa }}</td>
        @elseif (Auth::guard('pengguna')->check())
          <td class="text-center">{{ $peng1->nama_desa }}</td>
        @endif
            <td class="text-center">{{ $peng1->warga_buta }}</td>
            <td class="text-center">{{ $peng1->kel_belajarA }}</td>
            <td class="text-center">{{ $peng1->warga_belajarA }}</td>
            <td class="text-center">{{ $peng1->kel_belajarB }}</td>
            <td class="text-center">{{ $peng1->warga_belajarB }}</td>
            <td class="text-center">{{ $peng1->kel_belajarC }}</td>
            <td class="text-center">{{ $peng1->warga_belajarC }}</td>
            <td class="text-center">{{ $peng1->kel_belajarKF }}</td>
            <td class="text-center">{{ $peng1->warga_belajarKF }}</td>
            <td class="text-center">{{ $peng1->paud }}</td>
            <td class="text-center">{{ $peng1->taman_bacaan }}</td>
            <td class="text-center">{{ $peng1->jumlah_klp }}</td>
            <td class="text-center">{{ $peng1->jumlah_ibu_peserta }}</td>
            <td class="text-center">{{ $peng1->jumlah_ape }}</td>
            <td class="text-center">{{ $peng1->jumlah_kel_simulasi }}</td>
            <td class="text-center">{{ $peng1->KF }}</td>
            <td class="text-center">{{ $peng1->paud_tutor }}</td>
            <td class="text-center">{{ $peng1->BKB }}</td>
            <td class="text-center">{{ $peng1->koperasi }}</td>
            <td class="text-center">{{ $peng1->ketrampilan }}</td>
            <td class="text-center">{{ $peng1->LP3PKK }}</td>
            <td class="text-center">{{ $peng1->TP3PKK }}</td>
            <td class="text-center">{{ $peng1->damas_pkk }}</td>
            <td>{{ $peng1->status }}</td>
            <td>{{ $peng1->created_at}}</td>
            <td>
              <a href="{{ route('pendidikan.edit', $peng1->id_pokja2_bidang1)}}"
              class="btn btn-sm btn-tambah">Review</a>
              <br><br>

              <form action="{{ route('pendidikan.destroy', $peng1->id_pokja2_bidang1)}}" method="POST"
              class="d-inline delete-form">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)">Hapus</button>
              </form>
            </td>
            </tr>
        @empty
          <div class="alert alert-danger mt-4">
          Tidak ada data laporan pendidikan dan keterampilan
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
{{-- @extends('backend/layouts.template') --}}

{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="backend/assets/img/favicon.png" rel="icon">
  <link href="backend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="backend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="backend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="backend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="backend/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="backend/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="backend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="backend/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="backend/assets/css/style.css" rel="stylesheet">

  {{-- fontawesome --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.min.css') }}">

  <style>
.table-responsive {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  border-radius: 10px;
  box-shadow: 0 2px 12px rgba(0,0,0,0.05);
  background: white;
}

/* TABLE WIDTH */
.table-responsive table {
  min-width: 1500px;
  white-space: nowrap;
  border-collapse: collapse;
}

/* HEADER */
.table-responsive thead th {
  position: sticky;
  top: 0;
  background-color: #f1f5f9; /* soft gray-blue */
  color: #334155;
  font-size: 12px;
  font-weight: 600;
  padding: 10px 8px;
  vertical-align: middle;
  border-bottom: 2px solid #e2e8f0;
  z-index: 2;
}

/* BODY */
.table-responsive tbody td {
  font-size: 12px;
  padding: 10px 8px;
  vertical-align: middle;
  color: #475569;
  background-color: white;
}

/* HOVER */
.table-responsive tbody tr:hover td {
  background-color: #f8fafc;
}

/* BORDER */
.table-bordered th,
.table-bordered td {
  border: 1px solid #e2e8f0;
}

/* SCROLLBAR */
.table-responsive::-webkit-scrollbar {
  height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 6px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 6px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
  </style>

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
      <h1>Daftar Laporan Pangan</h1>
    </div><!-- End Page Title -->

    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
      {{ $message }}
    </div>
  @endif

    <div class="card mt-2">
      <div class="card-body mt-2">
        <div class="alert alert-info" role="alert">
          <i class="bi bi-info-circle"></i> Scroll horizontal untuk melihat semua kolom
        </div>
        <div class="table-responsive">
        <table class="table table-bordered table-hover">
         <thead>
  <tr class="table-primary">
    <th scope="col" rowspan="3" class="text-center align-middle">No</th>
    @if (Auth::guard('web')->check())
      <th scope="col" rowspan="3" class="text-center align-middle">Kecamatan</th>
      <th scope="col" rowspan="3" class="text-center align-middle">Desa</th>
    @elseif (Auth::guard('pengguna')->check())
      <th scope="col" rowspan="3" class="text-center align-middle">Desa</th>
    @endif
    <th scope="col" colspan="3" class="text-center">JUMLAH KADER</th>
    <th scope="col" colspan="2" class="text-center">MAKANAN POKOK</th>
    <th scope="col" colspan="6" class="text-center">PEMANFAATAN PEKARANGAN/HATINYA PKK</th>
    <th scope="col" colspan="3" class="text-center">JUMLAH INDUSTRI RUMAH TANGGA</th>
    <th scope="col" colspan="2" class="text-center">JUMLAH RUMAH</th>
    <th scope="col" rowspan="3" class="text-center align-middle">Status</th>
    <th scope="col" rowspan="3" class="text-center align-middle">Tanggal</th>
    <th scope="col" rowspan="3" class="text-center align-middle">Aksi</th>
  </tr>
  <tr class="table-primary">
    <th scope="col" class="text-center">Pangan</th>
    <th scope="col" class="text-center">Sandang</th>
    <th scope="col" class="text-center">Tata Laksana RT</th>
    <th scope="col" class="text-center">Beras</th>
    <th scope="col" class="text-center">Non Beras</th>
    <th scope="col" class="text-center">Peternakan</th>
    <th scope="col" class="text-center">Perikanan</th>
    <th scope="col" class="text-center">Warung Hidup</th>
    <th scope="col" class="text-center">Lumbung Hidup</th>
    <th scope="col" class="text-center">Toga</th>
    <th scope="col" class="text-center">Tanaman Keras</th>
    <th scope="col" class="text-center">Pangan</th>
    <th scope="col" class="text-center">Sandang</th>
    <th scope="col" class="text-center">Jasa</th>
    <th scope="col" class="text-center">Sehat & Layak Huni</th>
    <th scope="col" class="text-center">Tidak Sehat & Tidak Layak Huni</th>
  </tr>

</thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @forelse ($data2 as $sehat1)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td class="text-center">{{ $sehat1->nama_kec }}</td>
                <td class="text-center">{{ $sehat1->nama_desa }}</td>
                <td class="text-center">{{ $sehat1->kader_pangan ?? '-' }}</td>
                <td class="text-center">{{ $sehat1->kader_sandang ?? '-' }}</td>
                <td class="text-center">{{ $sehat1->kader_tata_laksana_rt ?? '-' }}</td>
                <td class="text-center">{{ $sehat1->beras }}</td>
                <td class="text-center">{{ $sehat1->non_beras }}</td>
                <td class="text-center">{{ $sehat1->peternakan }}</td>
                <td class="text-center">{{ $sehat1->perikanan }}</td>
                <td class="text-center">{{ $sehat1->warung_hidup }}</td>
                <td class="text-center">{{ $sehat1->lumbung_hidup }}</td>
                <td class="text-center">{{ $sehat1->toga }}</td>
                <td class="text-center">{{ $sehat1->tanaman_keras }}</td>
                <td class="text-center">{{ $sehat1->industri_pangan ?? '-' }}</td>
                <td class="text-center">{{ $sehat1->industri_sandang ?? '-' }}</td>
                <td class="text-center">{{ $sehat1->industri_jasa ?? '-' }}</td>
                <td class="text-center">{{ $sehat1->rumah_sehat_layak ?? '-' }}</td>
                <td class="text-center">{{ $sehat1->rumah_tidak_sehat_tidak_layak ?? '-' }}</td>
                <td>{{ $sehat1->status }}</td>
                <td>{{ \Carbon\Carbon::parse($sehat1->created_at)->format('d/m/Y') }}</td>
                <td class="text-center">
                  <form action="{{ route('declaporanpokja3.destroy', $sehat1->id_pokja3_bidang1)}}" method="POST"
                    class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="21" class="text-center">
                  <div class="alert alert-danger mt-4 mb-4">
                    <i class="bi bi-exclamation-triangle"></i> Tidak ada data laporan pangan
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
        </div>
      </div>
    </div>

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="backend/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="backend/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="backend/assets/vendor/echarts/echarts.min.js"></script>
  <script src="backend/assets/vendor/quill/quill.min.js"></script>
  <script src="backend/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="backend/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="backend/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="backend/assets/js/main.js"></script>

  <script type="text/javascript">
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone('#pdf', {
      maxFilesize: 1,
      acceptedFiles: ".pdf",
      addRemoveLinks: true,
      autoProcessQueue: false,
      init: function () {
        $("button").click(function (e) {
          e.preventDefault();
          myDropzone.processQueue();
        });

        this.on('sending', function (file, xhr, formData) {
          var data = $('#pdf').serializeArray();
          $.each(data, function (key, el) {
            formData.append(el.name, el.value);
          });
        });
      }
    });
  </script>

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
</body>

</html>
{{-- @endsection --}}
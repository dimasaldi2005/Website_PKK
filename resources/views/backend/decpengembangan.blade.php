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
  box-shadow: 0 4px 14px rgba(0,0,0,0.06);
  background: #ffffff;
}

/* TABLE */
.table-responsive table {
  min-width: 1400px;
  white-space: nowrap;
  margin-bottom: 0;
  border-collapse: collapse;
}

/* HEADER */
.table-responsive thead th {
  position: sticky;
  top: 0;
  background: #f8fafc; /* soft gray */
  color: #334155;
  z-index: 2;
  font-size: 11px;
  font-weight: 600;
  padding: 12px 8px;
  vertical-align: middle;
  border-bottom: 1px solid #e2e8f0;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* OPTIONAL HEADER VARIANT */
.table-responsive thead th.bg-light {
  background: #eef2ff; /* soft indigo tint */
  color: #1e293b;
}

/* BODY */
.table-responsive tbody td {
  font-size: 12px;
  padding: 10px 8px;
  vertical-align: middle;
  background-color: #ffffff;
  color: #475569;
}

/* HOVER ROW */
.table-responsive tbody tr:hover td {
  background-color: #f1f5f9;
}

/* BORDER */
.table-bordered th,
.table-bordered td {
  border: 1px solid #e2e8f0;
}

/* STICKY FIRST COLUMN (FIXED IMPROVEMENT) */
.table-responsive thead th:first-child {
  position: sticky;
  left: 0;
  z-index: 3;
  background: #f8fafc;
}

/* SCROLLBAR */
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

/* TEXT STYLE */
.header-group-title {
  font-size: 12px;
  font-weight: 700;
  color: #1e293b;
}

.header-sub-title {
  font-size: 10px;
  font-weight: 600;
  color: #64748b;
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
      <h1>Daftar Laporan Pengambangan Kehidupan Berkoperasi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Laporan Pengembangan Kehidupan Berkoperasi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mt-2">
      <div class="card-body">
        <div class="alert alert-info d-flex align-items-center" role="alert">
          <i class="bi bi-info-circle-fill me-2"></i>
          <div>Scroll horizontal untuk melihat semua kolom</div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th scope="col" rowspan="4" class="text-center align-middle">No</th>
                @if (Auth::guard('web')->check())
                  <th scope="col" rowspan="4" class="text-center align-middle">Kecamatan</th>
                  <th scope="col" rowspan="4" class="text-center align-middle">Desa</th>
                @elseif (Auth::guard('pengguna')->check())
                  <th scope="col" rowspan="4" class="text-center align-middle">Desa</th>
                @endif
                <th scope="col" colspan="8" class="text-center header-group-title">PRAKOPERASI / USAHA BERSAMA / UP2K</th>
                <th scope="col" colspan="2" class="text-center header-group-title">KEPUTUSAN HUKUM</th>
                <th scope="col" rowspan="4" class="text-center align-middle">Status</th>
                <th scope="col" rowspan="4" class="text-center align-middle">Tanggal</th>
                <th scope="col" rowspan="4" class="text-center align-middle">Aksi</th>
              </tr>
              <tr>
                <th scope="col" colspan="2" class="text-center header-sub-title">PEMULA</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">MADYA</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">UTAMA</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">MANDIRI</th>
                <th scope="col" rowspan="3" class="text-center align-middle">J. Kel</th>
                <th scope="col" rowspan="3" class="text-center align-middle">J. Anggt</th>
              </tr>
              <tr>
                <th scope="col" class="text-center header-sub-title">Jml Kel</th>
                <th scope="col" class="text-center header-sub-title">Peserta</th>
                <th scope="col" class="text-center header-sub-title">Jml Kel</th>
                <th scope="col" class="text-center header-sub-title">Peserta</th>
                <th scope="col" class="text-center header-sub-title">Jml Kel</th>
                <th scope="col" class="text-center header-sub-title">Peserta</th>
                <th scope="col" class="text-center header-sub-title">Jml Kel</th>
                <th scope="col" class="text-center header-sub-title">Peserta</th>
              </tr>

            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @forelse ($data2 as $peng1)
                <tr>
                  <th scope="row" class="text-center">{{ $no++ }}</th>
                  @if (Auth::guard('web')->check())
                    <td class="text-center">{{ $peng1->nama_kec }}</td>
                    <td class="text-center">{{ $peng1->nama_desa }}</td>
                  @elseif (Auth::guard('pengguna')->check())
                    <td class="text-center">{{ $peng1->nama_desa }}</td>
                  @endif
                  <td class="text-center">{{ $peng1->jumlah_kelompok_pemula ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_peserta_pemula ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_kelompok_madya ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_peserta_madya ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_kelompok_utama ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_peserta_utama ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_kelompok_mandiri ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_peserta_mandiri ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_kelompok_hukum ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_peserta_hukum ?? '-' }}</td>
                  <td class="text-center">
                    @if($peng1->status == 'Aktif')
                      <span class="badge bg-success">{{ $peng1->status }}</span>
                    @else
                      <span class="badge bg-secondary">{{ $peng1->status }}</span>
                    @endif
                  </td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($peng1->created_at)->format('d/m/Y H:i') }}</td>
                  <td class="text-center">
                    <form action="{{ route('decpengembangan.destroy', $peng1->id_pokja2_bidang2)}}" method="POST"
                      class="d-inline delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)" 
                              data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="16" class="text-center py-5">
                    <div class="alert alert-danger mb-0">
                      <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                      Tidak ada data laporan pengembangan kehidupan berkoperasi
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
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
  box-shadow: 0 4px 16px rgba(0,0,0,0.06);
  background: white;
}

/* TABLE */
.table-responsive table {
  min-width: 2000px;
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
  background-color: white;
  color: #475569;
}

/* ROW HOVER */
.table-responsive tbody tr:hover td {
  background-color: #f1f5f9;
}

/* BORDER */
.table-bordered th,
.table-bordered td {
  border: 1px solid #e2e8f0;
}

/* FIRST COLUMN STICKY FIX */
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

/* HEADER TEXT */
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
      <h1>Daftar Laporan Pendidikan Dan Keterampilan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Laporan Pendidikan dan Keterampilan</li>
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
                <th scope="col" rowspan="3" class="text-center align-middle">No</th>
                @if (Auth::guard('web')->check())
                  <th scope="col" rowspan="3" class="text-center align-middle">Kecamatan</th>
                  <th scope="col" rowspan="3" class="text-center align-middle">Desa</th>
                @elseif (Auth::guard('pengguna')->check())
                  <th scope="col" rowspan="3" class="text-center align-middle">Desa</th>
                @endif
                <th scope="col" rowspan="3" class="text-center align-middle">Warga Buta</th>
                <th scope="col" colspan="8" class="text-center header-group-title">JUMLAH KELOMPOK BELAJAR</th>
                <th scope="col" colspan="2" class="text-center header-group-title">PENDIDIKAN DAN KETERAMPILAN</th>
                <th scope="col" colspan="4" class="text-center header-group-title">BKB</th>
                <th scope="col" colspan="6" class="text-center header-group-title">KADER KHUSUS</th>
                <th scope="col" colspan="3" class="text-center header-group-title">JUMLAH KADER YANG SUDAH DILATIH</th>
                <th scope="col" rowspan="3" class="text-center align-middle">Status</th>
                <th scope="col" rowspan="3" class="text-center align-middle">Tanggal</th>
                <th scope="col" rowspan="3" class="text-center align-middle">Aksi</th>
              </tr>
              <tr>
                <th scope="col" colspan="2" class="text-center header-sub-title">PAKET A</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">PAKET B</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">PAKET C</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">KF</th>
                <th scope="col" class="text-center header-sub-title">Paud</th>
                <th scope="col" class="text-center header-sub-title">Taman Bacaan</th>
                <th scope="col" class="text-center header-sub-title">J. Klp</th>
                <th scope="col" class="text-center header-sub-title">J. Ibu Peserta</th>
                <th scope="col" class="text-center header-sub-title">J. Ape</th>
                <th scope="col" class="text-center header-sub-title">J. Kel Simulasi</th>
                <th scope="col" class="text-center header-sub-title">Tutor</th>
                <th scope="col" class="text-center header-sub-title">KF</th>
                <th scope="col" class="text-center header-sub-title">Paud/TK</th>
                <th scope="col" class="text-center header-sub-title">BKB</th>
                <th scope="col" class="text-center header-sub-title">Koperasi</th>
                <th scope="col" class="text-center header-sub-title">Ketrampilan</th>
                <th scope="col" class="text-center header-sub-title">LP3PKK</th>
                <th scope="col" class="text-center header-sub-title">TP3PKK</th>
                <th scope="col" class="text-center header-sub-title">Damas PKK</th>
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
                  <td class="text-center">{{ $peng1->warga_buta ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->kel_belajarA ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->warga_belajarA ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->kel_belajarB ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->warga_belajarB ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->kel_belajarC ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->warga_belajarC ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->kel_belajarKF ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->warga_belajarKF ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->paud ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->taman_bacaan ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_klp ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_ibu_peserta ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_ape ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->jumlah_kel_simulasi ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->KF ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->paud_tutor ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->BKB ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->koperasi ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->ketrampilan ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->LP3PKK ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->TP3PKK ?? '-' }}</td>
                  <td class="text-center">{{ $peng1->damas_pkk ?? '-' }}</td>
                  <td class="text-center">
                    @if($peng1->status == 'Aktif')
                      <span class="badge bg-success">{{ $peng1->status }}</span>
                    @else
                      <span class="badge bg-secondary">{{ $peng1->status }}</span>
                    @endif
                  </td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($peng1->created_at)->format('d/m/Y H:i') }}</td>
                  <td class="text-center">
                    <form action="{{ route('decpendidikan.destroy', $peng1->id_pokja2_bidang1)}}" method="POST"
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
                  <td colspan="28" class="text-center py-5">
                    <div class="alert alert-danger mb-0">
                      <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                      Tidak ada data laporan pendidikan dan keterampilan
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
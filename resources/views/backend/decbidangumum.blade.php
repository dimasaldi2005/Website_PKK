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
  box-shadow: 0 4px 18px rgba(0,0,0,0.06);
}

/* TABLE */
.table-responsive table {
  min-width: 1800px;
  white-space: nowrap;
  margin-bottom: 0;
}

/* HEADER */
.table-responsive thead th {
  position: sticky;
  top: 0;
  background: #f8fafc; /* soft light gray */
  color: #334155; /* slate */
  z-index: 2;
  font-size: 11px;
  font-weight: 600;
  padding: 12px 8px;
  vertical-align: middle;
  border: 1px solid #e2e8f0;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* HEADER GROUP (optional accent) */
.table-responsive thead th.bg-light {
  background: #eef2ff; /* soft lavender */
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

/* HOVER */
.table-responsive tbody tr:hover td {
  background-color: #f1f5f9;
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
  border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}

/* TEXT */
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


  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Daftar Laporan Bidang Umum</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Laporan Bidang Umum</li>
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
                <th scope="col" colspan="4" class="text-center header-group-title">JUMLAH KELOMPOK</th>
                <th scope="col" colspan="2" class="text-center header-group-title">JUMLAH</th>
                <th scope="col" colspan="2" class="text-center header-group-title">JUMLAH JIWA</th>
                <th scope="col" colspan="6" class="text-center header-group-title">JUMLAH KADER</th>
                <th scope="col" colspan="4" class="text-center header-group-title">JUMLAH TENAGA SEKRETARIAT</th>
                <th scope="col" rowspan="3" class="text-center align-middle">Status</th>
                <th scope="col" rowspan="3" class="text-center align-middle">Tanggal</th>
                <th scope="col" rowspan="3" class="text-center align-middle">Aksi</th>
              </tr>
              <tr>
                <th scope="col" class="text-center header-sub-title">Dusun/<br>Lingkungan</th>
                <th scope="col" class="text-center header-sub-title">PKK/<br>RW</th>
                <th scope="col" class="text-center header-sub-title">PKK/<br>RT</th>
                <th scope="col" class="text-center header-sub-title">Desa/<br>Wisma</th>
                <th scope="col" class="text-center header-sub-title">KRT</th>
                <th scope="col" class="text-center header-sub-title">KK</th>
                <th scope="col" class="text-center header-sub-title">Laki-laki</th>
                <th scope="col" class="text-center header-sub-title">Perempuan</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">ANGGOTA TP PKK</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">UMUM</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">KHUSUS</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">HONORER</th>
                <th scope="col" colspan="2" class="text-center header-sub-title">BANTUAN</th>
              </tr>
              <tr>
                <th scope="col" class="text-center" style="font-size: 9px;">Dusun/<br>Lingkungan</th>
                <th scope="col" class="text-center" style="font-size: 9px;">PKK/<br>RW</th>
                <th scope="col" class="text-center" style="font-size: 9px;">PKK/<br>RT</th>
                <th scope="col" class="text-center" style="font-size: 9px;">Desa/<br>Wisma</th>
                <th scope="col" class="text-center" style="font-size: 9px;">KRT</th>
                <th scope="col" class="text-center" style="font-size: 9px;">KK</th>
                <th scope="col" class="text-center" style="font-size: 9px;">L</th>
                <th scope="col" class="text-center" style="font-size: 9px;">P</th>
                <th scope="col" class="text-center" style="font-size: 9px;">L</th>
                <th scope="col" class="text-center" style="font-size: 9px;">P</th>
                <th scope="col" class="text-center" style="font-size: 9px;">L</th>
                <th scope="col" class="text-center" style="font-size: 9px;">P</th>
                <th scope="col" class="text-center" style="font-size: 9px;">L</th>
                <th scope="col" class="text-center" style="font-size: 9px;">P</th>
                <th scope="col" class="text-center" style="font-size: 9px;">L</th>
                <th scope="col" class="text-center" style="font-size: 9px;">P</th>
                <th scope="col" class="text-center" style="font-size: 9px;">L</th>
                <th scope="col" class="text-center" style="font-size: 9px;">P</th>
              </tr>
            </thead>  
            <tbody>
              @php
                $no = 1;
              @endphp
              @forelse ($data as $umum)
                <tr>
                  <th scope="row" class="text-center">{{ $no++ }}</th>
                  @if (Auth::guard('web')->check())
                    <td class="text-center">{{ $umum->nama_kec }}</td>
                    <td class="text-center">{{ $umum->nama_desa }}</td>
                  @elseif (Auth::guard('pengguna')->check())
                    <td class="text-center">{{ $umum->nama_desa }}</td>
                  @endif
                  <td class="text-center">{{ $umum->dusun_lingkungan ?? '-' }}</td>
                  <td class="text-center">{{ $umum->PKK_RW ?? '-' }}</td>
                  <td class="text-center">{{ $umum->PKK_RT ?? '-' }}</td>
                  <td class="text-center">{{ $umum->desa_wisma ?? '-' }}</td>
                  <td class="text-center">{{ $umum->KRT ?? '-' }}</td>
                  <td class="text-center">{{ $umum->KK ?? '-' }}</td>
                  <td class="text-center">{{ $umum->jiwa_laki ?? '0' }}</td>
                  <td class="text-center">{{ $umum->jiwa_perempuan ?? '0' }}</td>
                  <td class="text-center">{{ $umum->anggota_laki ?? '0' }}</td>
                  <td class="text-center">{{ $umum->anggota_perempuan ?? '0' }}</td>
                  <td class="text-center">{{ $umum->umum_laki ?? '0' }}</td>
                  <td class="text-center">{{ $umum->umum_perempuan ?? '0' }}</td>
                  <td class="text-center">{{ $umum->khusus_laki ?? '0' }}</td>
                  <td class="text-center">{{ $umum->khusus_perempuan ?? '0' }}</td>
                  <td class="text-center">{{ $umum->honorer_laki ?? '0' }}</td>
                  <td class="text-center">{{ $umum->honorer_perempuan ?? '0' }}</td>
                  <td class="text-center">{{ $umum->bantuan_laki ?? '0' }}</td>
                  <td class="text-center">{{ $umum->bantuan_perempuan ?? '0' }}</td>
                  <td class="text-center">
                    @if($umum->status == 'Aktif')
                      <span class="badge bg-success">{{ $umum->status }}</span>
                    @else
                      <span class="badge bg-secondary">{{ $umum->status }}</span>
                    @endif
                  </td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($umum->created_at)->format('d/m/Y H:i') }}</td>
                  <td class="text-center">
                    <form action="{{ route('decbidangumum.destroy', $umum->id_laporan_umum)}}" method="POST"
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
                  <td colspan="23" class="text-center py-5">
                    <div class="alert alert-danger mb-0">
                      <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                      Tidak ada data laporan bidang umum
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
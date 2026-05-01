{{-- @extends('backend/layouts.template') --}}



{{-- @section('content1') --}}



<!DOCTYPE html>

,<html lang="en">



<head>

  <meta charset="utf-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">



  <title>Tanda Tangan</title>

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



</head>



<body>



  <!-- ======= Header ======= -->

  <header id="header" class="header fixed-top d-flex align-items-center">



    <div class="d-flex align-items-center justify-content-between">

      <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">

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



    <section class="section">

      <div class="row">

        <div class="col-md-12 mx-auto mt-2">

          <div class="pagetitle">

            <h1>Input Tanda Tangan Ketua</h1>

          </div><!-- End Page Title -->



          <div class="card">

            <div class="card-body mt-4">

              <form action="{{ route('ttdketua.store') }}" method="POST" enctype="multipart/form-data">

                @csrf



                <div class="form-outline mb-4">

                  <label for="nama_terang" class="form-label">Nama Terang</label>

                  <input type="text" name="nama_terang" id="nama_terang" class="form-control" required
                    oninvalid="this.setCustomValidity('Harap lengkapi nama terang')"
                    oninput="this.setCustomValidity('')" placeholder="Masukkan nama terang" />

                </div>



                <div class="form-outline mb-4">

                  <label for="jabatan" class="form-label">Jabatan</label>

                  <textarea class="form-control" name="jabatan" rows="6" id="jabatan" placeholder="Masukkan jabatan"
                    required oninvalid="this.setCustomValidity('Harap lengkapi jabatan')"
                    oninput="this.setCustomValidity('')"></textarea>

                </div>



                <div class="form-outline mb-4">

                  <label for="pokja" class="form-label">Pokja</label>

                  <textarea class="form-control" name="pokja" rows="6" id="pokja" placeholder="Masukkan pokja" required
                    oninvalid="this.setCustomValidity('Harap lengkapi pokja')"
                    oninput="this.setCustomValidity('')"></textarea>

                </div>





                <div class="text-end pt-1 pb-1 mt-4">

                  <button class="btn btn-primary ps-xxl-5 pe-xxl-5 mr-auto background-blue-1 mb-2 fw-semibold fs-5"
                    type="submit">Kirim</button>

                </div>

              </form>





            </div>

          </div>



          <div class="pagetitle">

            <h1>Daftar Tanda Tangan</h1>

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

                    <th scope="col">Nama Terang</th>

                    <th scope="col">Jabatan</th>

                    <th scope="col">Pokja</th>

                    <th scope="col">Aksi</th>

                  </tr>

                </thead>

                <tbody>

                  @php

          $no = 1;

          @endphp

                  @forelse ($data as $berita)

            <tr>

            <th scope="row">{{ $no++ }}</th>

            <td>{{ Str::limit($berita->nama_terang, 25) }}</td>

            <td>{{ Str::limit($berita->jabatan, 25) }}</td>

            <td>{{ Str::limit($berita->pokja, 20) }}</td>

            <td>

              <form action="{{ route('ttdketua.destroy', $berita->id_ttds)}}" method="POST" class="d-inline">

              @csrf

              @method('DELETE')

              <button type="submit" class="btn btn-sm btn-danger"
                onclick="return confirm('Apakah anda yakin ingin menghapus tanda tangan?')">Delete</button>

              </form>



            </td>

            </tr>

          @empty

            <div class="alert alert-danger mt-4">

            Tidak ada data tanda tangan

            </div>

          @endforelse



                </tbody>

              </table>



            </div>

          </div>



        </div>

      </div>

    </section>



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



</body>



{{--

</html> --}}

{{-- @endsection --}}
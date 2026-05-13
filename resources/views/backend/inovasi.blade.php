<!-- resources/views/backend/accinovasi.blade.php -->

{{-- @extends('backend/layouts.template') --}}
{{-- @section('content1') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Inovasi Pokja 4</title>

    <!-- Favicons -->
    <link href="backend/assets/img/favicon.png" rel="icon">
    <link href="backend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="backend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="backend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="backend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="backend/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="backend/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="backend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="backend/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="backend/assets/css/style.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

</head>

<body>

    <!-- HEADER -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">

            <a href="#" class="logo d-flex align-items-center">

                <img src="{{ asset('backend/assets/img/pkk.png') }}" alt="">

                <span class="d-none d-lg-block">
                    PKK NGANJUK
                </span>

            </a>

            <i class="bi bi-list toggle-sidebar-btn"></i>

        </div>

    </header>

    <!-- SIDEBAR -->
    @include('backend.includes.sidebar')

    <!-- MAIN -->
    <main id="main" class="main">

        <!-- PAGE TITLE -->
        <div class="pagetitle">

            <h1>Inovasi Pokja 4</h1>

        </div>

        <!-- SECTION -->
        <section class="section dashboard">

            <div class="row">

                <!-- CARD PRIORITAS -->
                <div class="col-xxl-6 col-md-6">

                    <div class="card info-card sales-card">

                        <a href="{{ route('inovasi.prioritas') }}">

                            <div class="card-body">

                                <h5 class="card-title">
                                    Prioritas
                                </h5>

                                <div class="d-flex align-items-center">

                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                        <i class="bi bi-star-fill text-warning"></i>

                                    </div>

                                    <div class="ps-3">

                                        <h6>{{ $prioritas ?? 0 }}</h6>

                                        <span class="text-muted small pt-2 ps-1">
                                            Jumlah total prioritas
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>

                </div>

                <!-- CARD UNGGULAN -->
                <div class="col-xxl-6 col-md-6">

                    <div class="card info-card sales-card">

                        <a href="{{ route('inovasi.unggulan') }}">

                            <div class="card-body">

                                <h5 class="card-title">
                                    Unggulan
                                </h5>

                                <div class="d-flex align-items-center">

                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                        <i class="bi bi-award-fill text-primary"></i>

                                    </div>

                                    <div class="ps-3">

                                        <h6>{{ $unggulan ?? 0 }}</h6>

                                        <span class="text-muted small pt-2 ps-1">
                                            Jumlah total unggulan
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <!-- BACK TO TOP -->
    <a href="#"
        class="back-to-top d-flex align-items-center justify-content-center">

        <i class="bi bi-arrow-up-short"></i>

    </a>

    <!-- JS -->
    <script src="backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="backend/assets/js/main.js"></script>

</body>

</html>

{{-- @endsection --}}
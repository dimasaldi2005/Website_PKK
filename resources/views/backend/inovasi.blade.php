<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Inovasi</title>

    <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

@include('backend.includes.sidebar')

<main id="main" class="main">

<div class="pagetitle">
    <h1>Inovasi Pokja 4</h1>
</div>

<section class="section dashboard">
<div class="row">

    <!-- CARD TOTAL -->
    <div class="col-12">
        <div class="card info-card sales-card">
            <div class="card-body pt-3">
                <h5 class="card-title">Total Data Inovasi</h5>
                <h3>{{ $modelKelima }}</h3>
            </div>
        </div>
    </div>

    <!-- PRIORITAS -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body pt-3 text-center">
                <h5 class="card-title">Prioritas</h5>

                <a href="#" class="btn btn-primary">
                    <i class="bi bi-folder2-open"></i> Buka Prioritas
                </a>
            </div>
        </div>
    </div>

    <!-- KEUNGGULAN -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body pt-3 text-center">
                <h5 class="card-title">Keunggulan</h5>

                <a href="#" class="btn btn-success">
                    <i class="bi bi-folder2-open"></i> Buka Keunggulan
                </a>
            </div>
        </div>
    </div>

</div>
</section>

</main>

<script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
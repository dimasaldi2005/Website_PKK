{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success" id="alert-success">
  {{ session('success') }}
</div>

<script>
  setTimeout(function() {
    const alert = document.getElementById('alert-success');
    if (alert) {
      alert.style.transition = 'opacity 0.5s ease';
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    }
  }, 3000);
</script>
@endif

@extends('frontend/layouts.template')

@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="overlay"></div>

  <div class="container">
    <div class="hero-content d-flex align-items-center gap-2">
      <!-- LOGO -->
      <img src="{{ asset('frontend/assets/img/favicon.png') }}" class="hero-logo">
      <!-- TEXT -->
      <div>
        <h1 id="typing-text"></h1>
        <p id="typing-sub"></p>
      </div>

    </div>
  </div>
</section>
<!-- End Hero -->

<main id="main">

  <section class="app-section">
    <div class="container">
      <div class="row align-items-center">

        <!-- KIRI (GAMBAR HP) -->
        <div class="col-lg-6 text-center">
          <div class="app-img">
            <img src="{{ asset('frontend/assets/img/gadget.png') }}" class="img-fluid" alt="">
          </div>
        </div>

        <!-- KANAN (TEXT) -->
        <div class="col-lg-6">
          <h3 class="app-title">E-PKK Kab.Nganjuk App</h3>
          <p>
            E-PKK Kab. Nganjuk adalah aplikasi digital yang digunakan untuk mendukung pelaksanaan program PKK agar lebih mudah, cepat, dan teratur. Aplikasi ini memudahkan pengguna dalam melakukan pelaporan kegiatan secara langsung melalui perangkat genggam.

            Selain itu, E-PKK juga menyediakan fitur unggah galeri untuk mendokumentasikan kegiatan PKK dalam bentuk foto maupun laporan. Dengan fitur ini, seluruh aktivitas dapat tercatat dengan rapi, mudah diakses, dan terdokumentasi dengan baik dalam satu sistem.
          </p>

          <a href="#" class="btn-app">Download Sekarang</a>
        </div>

      </div>
    </div>
  </section>

  <!-- ======= About Section ======= -->
  <section id="about" class="about section-bg">
    <div class="container">

      <div class="row align-items-center">

        <!-- KIRI -->
        <div class="col-lg-4">
          <h5>
            <b>Ketua PPK Kab. Nganjuk</b>
          </h5>
          <p>
            Ketua Tim Penggerak PKK (TP PKK) Kabupaten Nganjuk saat ini adalah
            Ny. S. Wahyuni Marhaen, S.E. Beliau aktif memimpin program pemberdayaan keluarga,
            penurunan stunting, dan kesehatan masyarakat, didampingi pengurus TP PKK lainnya di Kabupaten Nganjuk.
          </p>
        </div>

        <!-- TENGAH (FOTO) -->
        <div class="col-lg-4 text-center">
          <div class="img-box">
            <img src="{{ asset('frontend/assets/img/ketuapkk.png') }}" class="img-fluid">
          </div>
        </div>

        <!-- KANAN -->
        <div class="col-lg-4">
          <h5><b>Visi Utama</b></h5>
          <p>
            Mewujudkan keluarga sehat, cerdas, berdaya, beriman, dan bertaqwa menuju Nganjuk Melesat
            (Maju, Sejahtera, Bermartabat).
          </p>

          <h5 class="mt-3"><b>Misi Utama</b></h5>
          <ul>
            <li>Sinergi Daerah</li>
            <li>Digitalisasi PKK</li>
            <li>Pemberdayaan Keluarga</li>
            <li>Kolaborasi</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- End About -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Galeri</h2>
        <h3>Galeri PKK <span>Kabupaten Nganjuk</span></h3>
        <p>Galeri kegiatan PKK Kabupaten Nganjuk.</p>
      </div>

      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        @forelse ($galerys as $tampil)
        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <img src="{{ asset('frontend2/gallery2/' . $tampil->gambar) }}"
            class="img-fluid" alt="">

          <div class="portfolio-info">
            <h4>{{ $tampil->deskripsi }}</h4>
            <p>{{ $tampil->created_at }}</p>
          </div>
        </div>
        @empty
        Data Post belum Tersedia.
        @endforelse

      </div>
    </div>

    <div class="d-flex justify-content-center fs-2 gap-4 p-4">
      <a href="{{ route('galery.index') }}" class="btn btn-primary">
        Galeri Lainnya
      </a>
    </div>

  </section>
  <!-- End Portfolio -->

  <!-- ======= Services Section ======= -->
  <section id="service" class="services section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Program Kerja</h2>
        <h3>Program Kerja PKK <span>Kabupaten Nganjuk</span></h3>
        <p>Program Kerja yang akan dikerjakan Ketua PKK Kabupaten Nganjuk.</p>
      </div>

      <div class="row gy-3">

        <!-- Card 1 -->
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="card">
            <div class="card-img">
              <img src="{{ asset('frontend/assets/img/l.jpg') }}" class="img-fluid" alt="">
            </div>
            <h3>
              <a href="{{ route('pokja.index') }}" class="stretched-link">
                Kelompok Kerja 1
              </a>
            </h3>
            <p>
              Membidangi Pembinaan Karakter dalam Keluarga...
            </p>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="card">
            <div class="card-img">
              <img src="{{ asset('frontend/assets/img/p.jpeg') }}" class="img-fluid" alt="">
            </div>
            <h3>
              <a href="{{ route('pokjathu.index') }}" class="stretched-link">
                Kelompok Kerja 2
              </a>
            </h3>
            <p>
              Membidangi Pendidikan & Peningkatan Ekonomi Keluarga...
            </p>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="card">
            <div class="card-img">
              <img src="{{ asset('frontend/assets/img/t.jpeg') }}" class="img-fluid" alt="">
            </div>
            <h3>
              <a href="{{ route('pokjatre.index') }}" class="stretched-link">
                Kelompok Kerja 3
              </a>
            </h3>
            <p>
              Membidangi penguatan ketahanan keluarga...
            </p>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="card">
            <div class="card-img">
              <img src="{{ asset('frontend/assets/img/i.jpeg') }}" class="img-fluid" alt="">
            </div>
            <h3>
              <a href="{{ route('pokjafou.index') }}" class="stretched-link">
                Kelompok Kerja 4
              </a>
            </h3>
            <p>
              Membidangi Kesehatan Keluarga dan Lingkungan...
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- End Services -->

</main>
<!-- End Main -->

@endsection
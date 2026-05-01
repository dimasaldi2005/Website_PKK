@extends('frontend/layouts.template')

@section('content')

<!-- ======= Hero Section ======= -->


<!-- Main -->
<main id="main">
  <div id="cekk">
    <p class="text-center fs-1">Galeri kegiatan PKK Kabupaten Nganjuk</p>
  </div>

  <section id="portfolio" class="portfolio section-bg">
    <div class="row g-3  mt-4 mb-4 ">

      <div class="col-auto" style="margin-left: 100px;">

        <form action="" method="GET">
          <input type="search" name="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Cari">
        </form>
      </div>
    </div>
    <div class="container" data-aos="fade-up">


      @forelse ($galerys as $tampil)
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <img src="{{ asset('frontend2/gallery2/'.$tampil->gambar) }}" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4 class="text-break">{{ $tampil->deskripsi }}</h4>
            <p>{{ $tampil->tanggal }}</p>
          </div>
        </div>
        @empty
        Data Post belum Tersedia.
        @endforelse
      </div>

    </div>
  </section>
  <!-- End Portfolio Section -->
</main><!-- End #main -->
@endsection
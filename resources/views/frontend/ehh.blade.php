@extends('frontend/layouts.template')

@section('content')

        <!-- Breadcrumb -->
        <div class="container">
            <nav aria-label="breadcrumb" style="background-color: #fff" class="mt-3">
                <ol class="breadcrumb p-3">
                    <li class="breadcrumb-item"><a href="landing-page" class="text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active"><a aria-current="page" value="">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->judulPengumuman }}</li>
                </ol>
            </nav>
        </div>
        <!-- Akhir Breadcrumb -->

<!-- Awal Main -->
<section id="about" class="about section-bg">
      <div class="container text-center">
        
          <div class=" text-center">
            <h3 class="text-center">{{ $post->judulPengumuman }}</h3>
              <div class="garis-nama"></div>
              <div class="justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <p>{{ $post->deskripsiPengumuman }}</p>
                <p class="text-end">{{ $post->tanggalPengumuman }}</p>
              </div>
          </div>
        
      </div>
      
      
      <!-- Akhir Main -->
    </section><!-- End About Section -->
@endsection
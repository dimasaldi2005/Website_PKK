@extends('frontend/layouts.template')

@section('content')

        <!-- Breadcrumb -->
        <div class="container">
            <nav aria-label="breadcrumb" style="background-color: #f4eeee" class="mt-3">
                <ol class="breadcrumb p-3">
                    <li class="breadcrumb-item"><a href="landing-page" class="text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active"><a aria-current="page" value="">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->judul }}</li>
                </ol>
            </nav>
        </div>
        <!-- Akhir Breadcrumb -->

<!-- Awal Main -->
<section id="about" class="about section-bg">
      <div class="container">
        <div class="row row-berita">
            <div class="col-lg-5">
              <figure class="figure">
                <img src="{{ asset('/storage/berita/'.$post->image) }}" class="figure-img img-fluid" style="border-radius: 5px; width: 450px;">
                <figcaption class="figure-caption d-flex justify-content-evenly">
                </figcaption>
              </figure>
            </div>

          <div class="col-lg-7">
            <h3>{{ $post->judul }}</h3>
              <div class="garis-nama"></div>
              <div class="justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <p>{{ $post->deskripsi }}</p>
                <div class="container">
                <p> PDF FILE <a href="{{ asset('/storage/berita/file/'.$post->file) }}">{{$post->file}}</a>.</p>
                </div>
              </div>
          </div>
        </div>
      </div>
      
      
      <!-- Akhir Main -->
    </section><!-- End About Section -->
@endsection
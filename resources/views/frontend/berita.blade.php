@extends('frontend/layouts.template')

@section('content')

<div id="cekk">
    <p class="text-center fs-1">Berita PKK Kabupaten Nganjuk</p>
    </div>
<!-- Breadcrumb -->

<div class="container">
    <nav aria-label="breadcrumb" style="background-color: #fff" class="mt-3">
        <ol class="breadcrumb p-3">
            <li class="breadcrumb-item"><a href="landing-page" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item active"><a aria-current="page" value="">Berita</a></li>
        </ol>
    </nav>
</div>
<!-- Akhir Breadcrumb -->
{{-- <div class="my-1 ">
            <form action="" method="get">
                <div class="input-grub mb-2">
                    <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Username">
                    <button class="input-group-text btn btn-primary">search</button>
                </div>
            </form>
        </div> --}}
        <section id="ml" class="about section-bg">
        <div class="row g-3  mt-4 mb-4 " > 
   
            <div class="col-auto" style="margin-left: 100px;">
              
              <form action="" method="GET">  
              <input type="search"  name="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Cari" >
              </form>
            </div>
          </div>
<!-- Main -->
@forelse ($beritas as $tampil)

            <div class="container">
                <div class="row ">
                    <a href=""> </a>
                    <div class="box">
                        <div class="col-lg-2 mx-3" style="float: left">
                            <img src="{{ asset('/storage/berita/'.$tampil->image) }}" class="img-thumbnail" alt="...">
                        </div>
                        <div class="mx-3 md-1">
                            <h5>{{ $tampil->judul }}</h5>
                            <p>{{ Str::limit($tampil->deskripsi, 80) }}</p>

                            @csrf
                        </div>
                    
                    

                        <p><small class="text-muted">Tanggal Upload : {{ $tampil->created_at }}</small></p>
                        <p><small class="text-muted">Terakhir Diubah : {{ $tampil->updated_at }}</small></p>
                        <a href="{{ route('berita.show', $tampil->id) }}" name="detail"
                            class="btn btn-primary d-grid me-auto">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>

@empty
Data Post belum Tersedia.
@endforelse
<div class="pagination justify-content-center">
            
    {{ $beritas->links() }}
    
</div>
</section><!-- End About Section -->
@endsection
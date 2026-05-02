@extends('backend.layouts.template')

@section('content1')

<main id="main" class="main">

    <section class="section">
        <h1 class="page-heading">Review Galeri</h1>
        
        <div class="form-card">
            <form action="{{ route('galerilaporanpokja4.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="gambar" class="form-label">Gambar :</label>
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="max-width: 800px; margin-top: 10px;">
                        <div class="carousel-inner" style="border-radius: 8px; overflow: hidden;">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <img src="{{ asset('frontend2/gallery2/' . $data->gambar) }}" class="d-block w-100" alt="Gallery Image">
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="{{ asset('frontend2/gallery2/' . $data->gambar) }}" class="d-block w-100" alt="Gallery Image">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('frontend2/gallery2/' . $data->gambar) }}" class="d-block w-100" alt="Gallery Image">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('frontend2/gallery2/' . $data->gambar) }}" class="d-block w-100" alt="Gallery Image">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('frontend2/gallery2/' . $data->gambar) }}" class="d-block w-100" alt="Gallery Image">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">Deskripsi :</label>
                    <input type="text" name="deskripsi" id="deskripsi" class="form-control" required readonly
                        oninvalid="this.setCustomValidity('Harap lengkapi Deskripsi')"
                        oninput="this.setCustomValidity('')" placeholder="Masukkan Deskripsi"
                        value="{{ $data->deskripsi }}" />
                </div>

                <div class="form-group">
                    <label for="tanggal" class="form-label">Tanggal :</label>
                    <input type="text" name="tanggal" id="tanggal" class="form-control" required readonly
                        oninvalid="this.setCustomValidity('Harap lengkapi tanggal')"
                        oninput="this.setCustomValidity('')" placeholder="Masukkan tanggal"
                        value="{{ $data->created_at }}" />
                </div>

                <div class="text-end">
                    @if (strtolower($data->status) == 'upload')
                        <a href="{{ route('galerilaporanpokja4.index') }}" class="btn-kirim" style="background-color: #6c757d !important; text-decoration: none; display: inline-block;">
                            Kembali
                        </a>
                    @else
                        <button class="btn-kirim" type="submit" style="background-color: #22c55e !important;">
                            Upload
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </section>

</main>

@endsection

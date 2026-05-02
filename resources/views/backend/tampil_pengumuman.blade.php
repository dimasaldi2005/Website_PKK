@extends('backend.layouts.template')

@section('content1')

<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-heading">Edit Pengumuman</h1>

          <div class="form-card">
            <form action="{{ route('input_pengumuman.update', $pengu->id) }}" method="POST"
              enctype="multipart/form-data">

              @csrf
              @method('PUT')

              <div class="form-group">
                <label for="judulPengumuman" class="form-label">Judul :</label>
                <input type="text" name="judulPengumuman" id="judulPengumuman" class="form-control" required
                  oninvalid="this.setCustomValidity('Harap lengkapi judul')" oninput="this.setCustomValidity('')"
                  placeholder="Masukkan judul" value="{{ $pengu->judulPengumuman }}" />
              </div>

              <div class="form-group">
                <label for="deskripsiPengumuman" class="form-label">Deskripsi :</label>
                <textarea class="form-control" name="deskripsiPengumuman" rows="4" id="deskripsiPengumuman"
                  placeholder="Masukkan deskripsi pengumuman" required
                  oninvalid="this.setCustomValidity('Harap lengkapi deskripsi')"
                  oninput="this.setCustomValidity('')" style="height: auto !important;">{{ $pengu->deskripsiPengumuman }}</textarea>
              </div>

              <div class="form-group">
                <label for="tempatPengumuman" class="form-label">Tempat :</label>
                <input type="text" name="tempatPengumuman" id="tempatPengumuman" class="form-control"
                  placeholder="Masukkan tempat" value="{{ $pengu->tempatPengumuman }}" />
              </div>

              <div class="form-group">
                <label for="tanggalPengumuman" class="form-label">Tanggal :</label>
                <input type="date" name="tanggalPengumuman" id="tanggalPengumuman" class="form-control" required
                  oninvalid="this.setCustomValidity('Harap lengkapi tanggal')" oninput="this.setCustomValidity('')"
                  placeholder="yyyy/mm/dd" value="{{ $pengu->tanggalPengumuman }}" />
              </div>

              <div class="text-end">
                <button class="btn-kirim" type="submit">Simpan</button>
              </div>

            </form>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection
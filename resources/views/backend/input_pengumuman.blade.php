@extends('backend.layouts.template')

@section('content1')

<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-heading">Tambahkan Pengumuman Baru</h1>

          <div class="form-card">
            <form action="{{ route('input_pengumuman.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="judulPengumuman" class="form-label">Judul :</label>
                <input type="text" name="judulPengumuman" id="judulPengumuman" class="form-control" required
                  oninvalid="this.setCustomValidity('Harap lengkapi judul')" oninput="this.setCustomValidity('')"
                  placeholder="Masukkan judul" />
              </div>

              <div class="form-group">
                <label for="deskripsiPengumuman" class="form-label">Deskripsi :</label>
                <textarea class="form-control" name="deskripsiPengumuman" rows="4" id="deskripsiPengumuman"
                  placeholder="Masukkan deskripsi pengumuman" required
                  oninvalid="this.setCustomValidity('Harap lengkapi deskripsi')"
                  oninput="this.setCustomValidity('')" style="height: auto !important;"></textarea>
              </div>

              <div class="form-group">
                <label for="tempatPengumuman" class="form-label">Tempat :</label>
                <input type="text" name="tempatPengumuman" id="tempatPengumuman" class="form-control" required
                  oninvalid="this.setCustomValidity('Harap lengkapi tempat')" oninput="this.setCustomValidity('')"
                  placeholder="Masukkan judul" />
              </div>

              <div class="form-group">
                <label for="tanggalPengumuman" class="form-label">Tanggal :</label>
                <input type="date" name="tanggalPengumuman" id="tanggalPengumuman" class="form-control" required
                  oninvalid="this.setCustomValidity('Harap lengkapi tanggal')" oninput="this.setCustomValidity('')"
                  placeholder="yyyy/mm/dd" />
              </div>

              <div class="text-end">
                <button class="btn-kirim" type="submit">Kirim</button>
              </div>

            </form>
          </div>

          <h1 class="page-heading" style="margin-top: 40px;">Daftar Pengumuman</h1>

          @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
              {{ $message }}
            </div>
          @endif

          <div class="table-card">
            <table class="table-ttd">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col">Tempat</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @forelse ($pengu as $peng)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ Str::limit($peng->judulPengumuman, 25) }}</td>
                    <td>{{ Str::limit($peng->deskripsiPengumuman, 25) }}</td>
                    <td>{{ Str::limit($peng->tempatPengumuman, 25) }}</td>
                    <td>{{ \Carbon\Carbon::parse($peng->tanggalPengumuman)->isoFormat('D MMMM Y') }}</td>
                    <td>
                      <a href="{{ route('input_pengumuman.edit', $peng->id) }}" class="btn-act btn-act-edit">
                        <i class="bi bi-pencil-square"></i>
                      </a>

                      <form action="{{ route('input_pengumuman.destroy', $peng->id)}}" method="POST"
                        class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-act btn-act-delete" onclick="confirmDelete(this)">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center" style="padding: 24px;">
                      <div class="alert alert-danger mb-0">
                        Tidak ada data pengumuman
                      </div>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function confirmDelete(button) {
      Swal.fire({
        title: 'Yakin hapus data?',
        text: "Data yang dihapus tidak bisa dikembalikan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          button.closest('form').submit();
        }
      });
    }
  </script>

@endsection
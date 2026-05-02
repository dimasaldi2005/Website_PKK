@extends('backend.layouts.template')

@section('content1')

<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-heading">Input Tanda Tangan Ketua</h1>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-card">
                    <form action="{{ route('ttd.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nama_terang" class="form-label">Nama Terang :</label>
                            <input type="text" name="nama_terang" id="nama_terang" class="form-control @error('nama_terang') is-invalid @enderror" value="{{ old('nama_terang') }}" required oninvalid="this.setCustomValidity('Harap lengkapi nama terang')" oninput="this.setCustomValidity('')" placeholder="Masukkan nama terang" />
                            @error('nama_terang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jabatan" class="form-label">Jabatan :</label>
                            <select name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="Ketua" {{ old('jabatan') == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                                <option value="Wakil Ketua" {{ old('jabatan') == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                                <option value="Sekretaris" {{ old('jabatan') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                                <option value="Bendahara" {{ old('jabatan') == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                            </select>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pokja" class="form-label">Pokja :</label>
                            <select name="pokja" id="pokja" class="form-control @error('pokja') is-invalid @enderror" required>
                                <option value="">-- Pilih Pokja --</option>
                                <option value="Bidang Umum" {{ old('pokja') == 'Bidang Umum' ? 'selected' : '' }}>Bidang Umum</option>
                                <option value="Kelompok Kerja I" {{ old('pokja') == 'Kelompok Kerja I' ? 'selected' : '' }}>Kelompok Kerja I</option>
                                <option value="Kelompok Kerja II" {{ old('pokja') == 'Kelompok Kerja II' ? 'selected' : '' }}>Kelompok Kerja II</option>
                                <option value="Kelompok Kerja III" {{ old('pokja') == 'Kelompok Kerja III' ? 'selected' : '' }}>Kelompok Kerja III</option>
                                <option value="Kelompok Kerja IV" {{ old('pokja') == 'Kelompok Kerja IV' ? 'selected' : '' }}>Kelompok Kerja IV</option>
                            </select>
                            @error('pokja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button class="btn-kirim" type="submit">Kirim</button>
                        </div>

                    </form>
                </div>

                <h1 class="page-heading" style="margin-top: 40px;">Daftar Tanda Tangan</h1>

                <div class="table-card">
                    <table class="table-ttd">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Nama Terang</th>
                                <th>Jabatan</th>
                                <th>Pokja</th>
                                <th style="width: 120px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_terang }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->pokja }}</td>
                                    <td style="text-align: center;">
                                        <div style="display: inline-flex; gap: 6px; align-items: center;">
                                            <a href="{{ route('ttd.edit', $item->id_ttds) }}" class="btn-act btn-act-edit" title="Edit" style="margin-right: 0 !important;">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('ttd.destroy', $item->id_ttds) }}" method="POST" class="delete-form" style="margin: 0; display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-act btn-act-delete" onclick="confirmDelete(this)" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px; color: #9ca3af;">
                                        <i class="bi bi-inbox" style="font-size: 48px; display: block; margin-bottom: 10px;"></i>
                                        Tidak ada data tanda tangan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data yang dihapus tidak bisa dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'logout-popup',
                title: 'logout-title',
                confirmButton: 'logout-confirm-btn',
                cancelButton: 'logout-cancel-btn'
            },
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }
</script>

@endsection

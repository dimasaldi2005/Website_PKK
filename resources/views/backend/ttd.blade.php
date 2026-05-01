@extends('backend/layouts.template')

@section('content1')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Input Tanda Tangan Ketua</h1>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-12">

                {{-- Form Card --}}
                <div class="card">
                    <div class="card-body" style="padding: 24px 28px 28px;">
                        <form action="{{ route('ttd.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_terang" class="form-label fw-normal">Nama Terang :</label>
                                <input type="text"
                                    name="nama_terang"
                                    id="nama_terang"
                                    class="form-control @error('nama_terang') is-invalid @enderror"
                                    value="{{ old('nama_terang') }}"
                                    required
                                    oninvalid="this.setCustomValidity('Harap lengkapi nama terang')"
                                    oninput="this.setCustomValidity('')">
                                @error('nama_terang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jabatan" class="form-label fw-normal">Jabatan :</label>
                                <select name="jabatan"
                                    id="jabatan"
                                    class="form-select @error('jabatan') is-invalid @enderror"
                                    required>
                                    <option value="">--Pilih--</option>
                                    <option value="Ketua"       {{ old('jabatan') == 'Ketua'       ? 'selected' : '' }}>Ketua</option>
                                    <option value="Wakil Ketua" {{ old('jabatan') == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                                    <option value="Sekretaris"  {{ old('jabatan') == 'Sekretaris'  ? 'selected' : '' }}>Sekretaris</option>
                                    <option value="Bendahara"   {{ old('jabatan') == 'Bendahara'   ? 'selected' : '' }}>Bendahara</option>
                                </select>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="pokja" class="form-label fw-normal">PokJa :</label>
                                <select name="pokja"
                                    id="pokja"
                                    class="form-select @error('pokja') is-invalid @enderror"
                                    required>
                                    <option value="">--Pilih--</option>
                                    <option value="Bidang Umum"      {{ old('pokja') == 'Bidang Umum'      ? 'selected' : '' }}>Bidang Umum</option>
                                    <option value="Kelompok Kerja I"  {{ old('pokja') == 'Kelompok Kerja I'  ? 'selected' : '' }}>Kelompok Kerja I</option>
                                    <option value="Kelompok Kerja II" {{ old('pokja') == 'Kelompok Kerja II' ? 'selected' : '' }}>Kelompok Kerja II</option>
                                    <option value="Kelompok Kerja III"{{ old('pokja') == 'Kelompok Kerja III'? 'selected' : '' }}>Kelompok Kerja III</option>
                                    <option value="Kelompok Kerja IV" {{ old('pokja') == 'Kelompok Kerja IV' ? 'selected' : '' }}>Kelompok Kerja IV</option>
                                </select>
                                @error('pokja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit"
                                    class="btn btn-primary px-4"
                                    style="background-color:#1a73e8; border-color:#1a73e8; font-size:15px; padding: 8px 28px;">
                                    Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Daftar Tanda Tangan --}}
                <div class="pagetitle mt-3">
                    <h1>Daftar Tanda Tangan</h1>
                </div>

                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" style="font-size:14px;">
                                <thead style="background-color:#f8f9fa;">
                                    <tr>
                                        <th class="text-center" style="width:60px; padding:12px 16px;">No</th>
                                        <th style="padding:12px 16px;">Nama Terang</th>
                                        <th style="padding:12px 16px;">Jabatan</th>
                                        <th style="padding:12px 16px;">Pokja</th>
                                        <th style="width:90px; padding:12px 16px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @forelse ($data as $item)
                                        <tr>
                                            <td class="text-center" style="padding:12px 16px; vertical-align:middle;">{{ $no++ }}</td>
                                            <td style="padding:12px 16px; vertical-align:middle;">{{ Str::limit($item->nama_terang, 30) }}</td>
                                            <td style="padding:12px 16px; vertical-align:middle;">{{ $item->jabatan }}</td>
                                            <td style="padding:12px 16px; vertical-align:middle;">{{ $item->pokja }}</td>
                                            <td style="padding:10px 12px; vertical-align:middle; text-align:center;">
                                                <a href="{{ route('ttd.edit', $item->id_ttds) }}"
                                                    title="Edit"
                                                    style="display:inline-flex; align-items:center; justify-content:center;
                                                           width:30px; height:30px; background:#28a745; border-radius:4px;
                                                           color:#fff; text-decoration:none; margin-right:4px;">
                                                    <i class="bi bi-pencil-fill" style="font-size:12px;"></i>
                                                </a>
                                                <form action="{{ route('ttd.destroy', $item->id_ttds) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete(this)"
                                                        title="Hapus"
                                                        style="display:inline-flex; align-items:center; justify-content:center;
                                                               width:30px; height:30px; background:#dc3545; border:none;
                                                               border-radius:4px; color:#fff; cursor:pointer;">
                                                        <i class="bi bi-trash-fill" style="font-size:12px;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                Tidak ada data tanda tangan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
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

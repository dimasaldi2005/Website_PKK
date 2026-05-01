@extends('backend/layouts.template')

@section('content1')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Tanda Tangan</h1>
    </div>

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

                <div class="card">
                    <div class="card-body" style="padding: 24px 28px 28px;">
                        <form action="{{ route('ttd.update', $data->id_ttds) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_terang" class="form-label fw-normal">Nama Terang :</label>
                                <input type="text"
                                    name="nama_terang"
                                    id="nama_terang"
                                    class="form-control @error('nama_terang') is-invalid @enderror"
                                    value="{{ old('nama_terang', $data->nama_terang) }}"
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
                                    @foreach(['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'] as $jab)
                                        <option value="{{ $jab }}"
                                            {{ old('jabatan', $data->jabatan) == $jab ? 'selected' : '' }}>
                                            {{ $jab }}
                                        </option>
                                    @endforeach
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
                                    @foreach(['Bidang Umum', 'Kelompok Kerja I', 'Kelompok Kerja II', 'Kelompok Kerja III', 'Kelompok Kerja IV'] as $pk)
                                        <option value="{{ $pk }}"
                                            {{ old('pokja', $data->pokja) == $pk ? 'selected' : '' }}>
                                            {{ $pk }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pokja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('ttd.index') }}"
                                    class="btn btn-secondary px-4"
                                    style="font-size:15px; padding: 8px 28px;">
                                    Kembali
                                </a>
                                <button type="submit"
                                    class="btn btn-primary px-4"
                                    style="background-color:#1a73e8; border-color:#1a73e8; font-size:15px; padding: 8px 28px;">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

@endsection

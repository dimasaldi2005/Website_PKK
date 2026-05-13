<!-- resources/views/backend/unggulan_bulanan_edit.blade.php -->

@extends('backend.layouts.template')

@section('content1')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Review Laporan Unggulan</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card mt-2">
                    <div class="card-body">
                        
                        <form action="{{ route('unggulan.bulanan.update', $data->id_rekap_desa_bulanan) }}" method="POST" class="mt-4">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">ID Laporan Unggulan</label>
                                <input type="text" class="form-control" value="{{ $data->id_rekap_desa_bulanan }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah RW</label>
                                <input type="number" class="form-control" name="rw" value="{{ $data->rw }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah RT</label>
                                <input type="number" class="form-control" name="rt" value="{{ $data->rt }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah Dasa Wisma</label>
                                <input type="number" class="form-control" name="dasa_wisma" value="{{ $data->dasa_wisma }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ibu Hamil</label>
                                <input type="number" class="form-control" name="hamil" value="{{ $data->hamil }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ibu Melahirkan</label>
                                <input type="number" class="form-control" name="melahirkan" value="{{ $data->melahirkan }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ibu Nifas</label>
                                <input type="number" class="form-control" name="nifas" value="{{ $data->nifas }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ibu Meninggal</label>
                                <input type="number" class="form-control" name="meninggal" value="{{ $data->meninggal }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bayi Lahir (Laki-laki)</label>
                                <input type="number" class="form-control" name="bayi_lahir_l" value="{{ $data->bayi_lahir_l }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bayi Lahir (Perempuan)</label>
                                <input type="number" class="form-control" name="bayi_lahir_p" value="{{ $data->bayi_lahir_p }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Akte Kelahiran (Ada)</label>
                                <input type="number" class="form-control" name="akte_kelahiran_ada" value="{{ $data->akte_kelahiran_ada }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Akte Kelahiran (Tidak)</label>
                                <input type="number" class="form-control" name="akte_kelahiran_tidak" value="{{ $data->akte_kelahiran_tidak }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bayi Meninggal (Laki-laki)</label>
                                <input type="number" class="form-control" name="bayi_meninggal_l" value="{{ $data->bayi_meninggal_l }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bayi Meninggal (Perempuan)</label>
                                <input type="number" class="form-control" name="bayi_meninggal_p" value="{{ $data->bayi_meninggal_p }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Balita Meninggal (Laki-laki)</label>
                                <input type="number" class="form-control" name="balita_meninggal_l" value="{{ $data->balita_meninggal_l }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Balita Meninggal (Perempuan)</label>
                                <input type="number" class="form-control" name="balita_meninggal_p" value="{{ $data->balita_meninggal_p }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="">--Pilih--</option>
                                    @if(Auth::guard('web')->check())
                                        <option value="Disetujui2" {{ strtolower($data->status) == 'disetujui1' ? 'selected' : '' }}>Setujui Kabupaten (Disetujui2)</option>
                                        <option value="Revisi" {{ strtolower($data->status) == 'revisi' ? 'selected' : '' }}>Revisi</option>
                                    @elseif(Auth::guard('pengguna')->check())
                                        <option value="Disetujui1" {{ strtolower($data->status) == 'proses' ? 'selected' : '' }}>Setujui Kecamatan (Disetujui1)</option>
                                        <option value="Revisi" {{ strtolower($data->status) == 'revisi' ? 'selected' : '' }}>Revisi</option>
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <input type="text" class="form-control" name="catatan" value="{{ $data->catatan }}">
                                <small class="text-muted">*Jika laporan perlu di revisi maka bisa menambahkan catatan dan catatan hanya di isi jika status laporan menjadi <b>Revisi</b></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Tanggal</label>
                                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d H:i:s') }}" disabled>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success px-4">Upload</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection
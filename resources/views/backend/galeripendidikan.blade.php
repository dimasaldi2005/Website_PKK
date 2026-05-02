@extends('backend.layouts.template')

@section('content1')

<main id="main" class="main">
    <section class="section">
        <h1 class="page-heading">Galeri Pendidikan Dan Ketrampilan</h1>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-card">
            <table class="table-ttd">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th style="width: 150px;">Gambar</th>
                        <th>Deskripsi</th>
                        <th style="width: 180px;">Tanggal</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 120px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($data as $tampil)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <img src="{{ asset('frontend2/gallery2/' . $tampil->gambar) }}" 
                                     alt="{{ $tampil->deskripsi }}" 
                                     class="rounded" 
                                     style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #e2e8f0;">
                            </td>
                            <td>{{ $tampil->deskripsi }}</td>
                            <td>{{ $tampil->created_at }}</td>
                            <td>
                                @if(strtolower($tampil->status) == 'upload')
                                    <span style="background-color: #22c55e; color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: 600;">Upload</span>
                                @else
                                    <span style="background-color: #f59e0b; color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: 600;">{{ $tampil->status }}</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div style="display: inline-flex; gap: 6px; align-items: center;">
                                    <a href="{{ route('galeripendidikan.edit', $tampil->id) }}" class="btn-act btn-act-edit" title="Review" style="margin-right: 0 !important;">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('galeripendidikan.destroy', $tampil->id) }}" method="POST" class="delete-form" style="margin: 0; display: inline;">
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
                            <td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;">
                                <i class="bi bi-inbox" style="font-size: 48px; display: block; margin-bottom: 10px;"></i>
                                Tidak ada data galeri
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

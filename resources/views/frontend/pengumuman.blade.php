@extends('frontend/layouts.template')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Pengumuman PKK</h1>
        <p class="page-subtitle">Kabupaten Nganjuk</p>
    </div>
</div>

<!-- Main Content -->
<section class="pengumuman-section">
    <div class="container">
        
        <!-- Pengumuman List -->
        @forelse ($pengumumen as $tampil)
        <div class="pengumuman-card">
            <div class="pengumuman-content">
                <h3 class="pengumuman-title">{{ $tampil->judulPengumuman }}</h3>
                <div class="pengumuman-meta">
                    <span class="meta-item">Tanggal Upload : {{ $tampil->created_at }}</span>
                    <span class="meta-item">Terakhir Diubah : {{ $tampil->updated_at }}</span>
                </div>
            </div>
            <div class="pengumuman-action">
                <a href="{{ route('pengumuman.destroy', $tampil->id) }}" class="btn-detail">Lihat Selengkapnya</a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <p>Data pengumuman belum tersedia.</p>
        </div>
        @endforelse
        
        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $pengumumen->links() }}
        </div>
    </div>
</section>

<!-- Custom Styles -->
<style>
    /* Page Header */
    .page-header {
        background: #f8f9fa;
        padding: 60px 0 40px;
        text-align: center;
    }

    .page-title {
        font-size: 36px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 8px 0;
        font-family: 'Poppins', sans-serif;
    }

    .page-subtitle {
        font-size: 18px;
        font-weight: 400;
        color: #7f8c8d;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    /* Pengumuman Section */
    .pengumuman-section {
        background: #f8f9fa;
        padding: 60px 0;
        min-height: 60vh;
    }

    /* Pengumuman Card */
    .pengumuman-card {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 32px;
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        position: relative;
    }

    .pengumuman-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transform: translateY(-4px);
    }

    /* Pengumuman Content */
    .pengumuman-content {
        flex: 1;
        padding-bottom: 20px;
    }

    .pengumuman-title {
        font-size: 20px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0 0 16px 0;
        line-height: 1.4;
        font-family: 'Poppins', sans-serif;
    }

    .pengumuman-meta {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .meta-item {
        font-size: 13px;
        color: #95a5a6;
        font-family: 'Poppins', sans-serif;
    }

    /* Pengumuman Action */
    .pengumuman-action {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .btn-detail {
        display: inline-block;
        padding: 10px 24px;
        background: #1C6EA4;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(28, 110, 164, 0.2);
    }

    .btn-detail:hover {
        background: #155a8a;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(28, 110, 164, 0.3);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #95a5a6;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 40px 0 30px;
        }

        .page-title {
            font-size: 28px;
        }

        .page-subtitle {
            font-size: 16px;
        }

        .pengumuman-section {
            padding: 40px 0;
        }

        .pengumuman-card {
            flex-direction: column;
            align-items: flex-start;
            padding: 24px;
        }

        .pengumuman-title {
            font-size: 18px;
        }

        .btn-detail {
            width: 100%;
            text-align: center;
        }
    }
</style>

@endsection
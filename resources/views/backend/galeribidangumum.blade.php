@extends('backend.layouts.template')

@section('content1')

<main id="main" class="main">
    <section class="section">
        <h1 class="page-heading">Galeri Bidang Umumm</h1>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="form-card" style="margin-bottom: 20px; padding: 20px 32px;">
            <form action="{{ route('galeribidangumum.filter') }}" method="GET" id="filterForm">
                <!-- Baris Atas: Pilih Bulan dan Tahun -->
                <div class="d-flex align-items-center gap-3 mb-3">
                    <!-- Pilih Bulan -->
                    <div class="d-flex align-items-center gap-2">
                        <label for="bulan" class="form-label" style="margin-bottom: 0; font-size: 14px; color: #6b7280; white-space: nowrap; font-weight: 500;">Pilih Bulan</label>
                        <select name="bulan" id="bulan" class="form-control" style="height: 40px; width: 180px; font-size: 13px; border: 1px solid #cbd5e0; border-radius: 6px; padding: 8px 12px; color: #4a5568;">
                            <option value="">-- Pilih Bulan --</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    <!-- Pilih Tahun -->
                    <div class="d-flex align-items-center gap-2">
                        <label for="tahun" class="form-label" style="margin-bottom: 0; font-size: 14px; color: #6b7280; white-space: nowrap; font-weight: 500;">Pilih Tahun</label>
                        <select name="tahun" id="tahun" class="form-control" style="height: 40px; width: 180px; font-size: 13px; border: 1px solid #cbd5e0; border-radius: 6px; padding: 8px 12px; color: #4a5568;">
                            <option value="">-- Pilih Tahun --</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                </div>

                <!-- Baris Bawah: Tombol Refresh dan Filter (Kanan) -->
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn d-flex align-items-center justify-content-center" onclick="resetFilter()" style="background-color: #9ca3af; color: white; border: none; height: 40px; padding: 0 24px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px;">
                        Refresh
                    </button>
                    <button type="button" class="btn d-flex align-items-center justify-content-center gap-2" onclick="submitFilter()" style="background-color: #0369a1; color: white; border: none; height: 40px; padding: 0 24px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px;">
                        <i class="bi bi-funnel-fill" style="font-size: 14px;"></i>
                        <span>Filter</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tombol Cetak Galeri (Di Luar Frame) -->
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn d-flex align-items-center justify-content-center gap-2" onclick="cetakGaleri()" style="background-color: #0369a1; color: white; border: none; height: 40px; padding: 0 24px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px;">
                <i class="bi bi-download" style="font-size: 14px;"></i>
                <span>Cetak Galeri</span>
            </button>
        </div>

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
                                    <a href="{{ route('galeribidangumum.edit', $tampil->id) }}" class="btn-act btn-act-edit" title="Review" style="margin-right: 0 !important;">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('galeribidangumum.destroy', $tampil->id) }}" method="POST" class="delete-form" style="margin: 0; display: inline;">
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

    function submitFilter() {
        const bulan = document.getElementById('bulan').value;
        const tahun = document.getElementById('tahun').value;
        
        if (!bulan && !tahun) {
            alert('Silakan pilih bulan atau tahun terlebih dahulu');
            return;
        }
        
        // Ambil semua baris tabel
        const tableRows = document.querySelectorAll('.table-ttd tbody tr');
        let visibleCount = 0;
        
        tableRows.forEach(row => {
            const tanggalCell = row.querySelectorAll('td')[3]; // Kolom tanggal adalah index 3
            
            if (!tanggalCell) return;
            
            const tanggalText = tanggalCell.textContent.trim();
            let isVisible = true;
            
            // Parse tanggal dari format "YYYY-MM-DD HH:MM:SS"
            const tanggalParts = tanggalText.split(' ')[0].split('-');
            const rowTahun = tanggalParts[0];
            const rowBulan = tanggalParts[1];
            
            // Filter berdasarkan bulan dan tahun
            if (bulan && tahun) {
                // Jika kedua dipilih
                isVisible = (rowBulan === bulan && rowTahun === tahun);
            } else if (bulan) {
                // Jika hanya bulan dipilih
                isVisible = (rowBulan === bulan);
            } else if (tahun) {
                // Jika hanya tahun dipilih
                isVisible = (rowTahun === tahun);
            }
            
            // Tampilkan atau sembunyikan baris
            if (isVisible) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Jika tidak ada data yang cocok, tampilkan pesan
        if (visibleCount === 0) {
            // Cek apakah sudah ada pesan "tidak ada data"
            const existingMessage = document.querySelector('.no-data-message');
            if (!existingMessage) {
                const tbody = document.querySelector('.table-ttd tbody');
                const messageRow = document.createElement('tr');
                messageRow.className = 'no-data-message';
                messageRow.innerHTML = '<td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;"><i class="bi bi-inbox" style="font-size: 48px; display: block; margin-bottom: 10px;"></i>Tidak ada data yang sesuai dengan filter</td>';
                tbody.appendChild(messageRow);
            }
        } else {
            // Hapus pesan "tidak ada data" jika ada
            const existingMessage = document.querySelector('.no-data-message');
            if (existingMessage) {
                existingMessage.remove();
            }
        }
    }

    function resetFilter() {
        // Tampilkan semua baris tabel
        const tableRows = document.querySelectorAll('.table-ttd tbody tr');
        tableRows.forEach(row => {
            row.style.display = '';
        });
        
        // Hapus pesan "tidak ada data" jika ada
        const existingMessage = document.querySelector('.no-data-message');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        // Reset form
        document.getElementById('bulan').value = '';
        document.getElementById('tahun').value = '';
    }

    function cetakGaleri() {
        const bulan = document.getElementById('bulan').value;
        const tahun = document.getElementById('tahun').value;
        
        if (!bulan && !tahun) {
            alert('Silakan pilih bulan atau tahun terlebih dahulu untuk mencetak galeri');
            return;
        }
        
        // Buat URL untuk cetak PDF
        let url = '{{ route("galeribidangumum.filter") }}?';
        
        if (bulan && tahun) {
            // Format: YYYY-MM untuk cetak perbulan
            url += 'search=' + tahun + '-' + bulan;
        } else if (tahun) {
            // Cetak pertahun
            url += 'search2=' + tahun;
        } else if (bulan) {
            // Jika hanya bulan dipilih, gunakan tahun sekarang
            const currentYear = new Date().getFullYear();
            url += 'search=' + currentYear + '-' + bulan;
        }
        
        // Redirect ke halaman cetak PDF
        window.location.href = url;
    }
</script>

@endsection

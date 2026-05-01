<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Menu</li>

        <!-- Dashboard - Akses semua -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @auth('web')
            <!-- Tanda Tangan -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('ttd.*') ? '' : 'collapsed' }}" href="{{ route('ttd.index') }}">
                    <i class="bi bi-pencil-square"></i>
                    <span>Tanda Tangan</span>
                </a>
            </li>

            <!-- Berita -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('input_berita.*') ? '' : 'collapsed' }}"
                    href="{{ route('input_berita.index') }}">
                    <i class="bi bi-newspaper"></i>
                    <span>Berita</span>
                </a>
            </li>

            <!-- Pengumuman -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('input_pengumuman.*') ? '' : 'collapsed' }}"
                    href="{{ route('input_pengumuman.index') }}">
                    <i class="bi bi-megaphone"></i>
                    <span>Pengumuman</span>
                </a>
            </li>
        @endauth

        <!-- Galeri - Akses semua -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('galeribidangumum.*', 'galeripokja1.*', 'galeripokja2.*', 'galeripokja3.*', 'galeripokja4.*') ? '' : 'collapsed' }}"
                data-bs-target="#galeri_nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-image"></i><span>Galeri</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="galeri_nav" class="nav-content collapse {{ request()->routeIs('galeri*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('galeribidangumum.index') }}">
                        <i class="bi bi-circle"></i><span>Bidang Umum</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeripokja1.index') }}">
                        <i class="bi bi-circle"></i><span>Kelompok Kerja 1</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeripokja2.index') }}">
                        <i class="bi bi-circle"></i><span>Kelompok Kerja 2</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeripokja3.index') }}">
                        <i class="bi bi-circle"></i><span>Kelompok Kerja 3</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeripokja4.index') }}">
                        <i class="bi bi-circle"></i><span>Kelompok Kerja 4</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Kelompok Kerja - Akses semua -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('accbidangumum.*', 'pokja1.*', 'pokja2.*', 'pokja3.*', 'pokja4.*') ? '' : 'collapsed' }}"
                data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-book"></i><span>Kelompok Kerja</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav"
                class="nav-content collapse {{ request()->routeIs('accbidangumum.*', 'pokja*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('accbidangumum.index') }}">
                        <i class="bi bi-circle"></i><span>Bidang Umum</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pokja1.index') }}">
                        <i class="bi bi-circle"></i><span>Kelompok Kerja 1</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pokja2.index') }}">
                        <i class="bi bi-circle"></i><span>Kelompok Kerja 2</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pokja3.index') }}">
                        <i class="bi bi-circle"></i><span>Kelompok Kerja 3</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pokja4.index') }}">
                        <i class="bi bi-circle"></i><span>Kelompok Kerja 4</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Halaman -->
        <li class="nav-heading">Halaman</li>

        <!-- Profil - Akses semua -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile.*') ? '' : 'collapsed' }}"
                href="{{ route('profile.index') }}">
                <i class="bi bi-person"></i>
                <span>Profil</span>
            </a>
        </li>

        <!-- Keluar - Akses semua -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>

<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-box-arrow-right"></i> Konfirmasi Logout
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</div>
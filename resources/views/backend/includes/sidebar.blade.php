<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @auth('web')
        {{-- Tanda Tangan --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ttd.*') ? '' : 'collapsed' }}"
                href="{{ route('ttd.index') }}">
                <i class="bi bi-pencil-square"></i>
                <span>Tanda Tangan</span>
            </a>
        </li>

        {{-- Berita --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('input_berita.*') ? '' : 'collapsed' }}"
                href="{{ route('input_berita.index') }}">
                <i class="bi bi-newspaper"></i>
                <span>Berita</span>
            </a>
        </li>

        {{-- Pengumuman --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('input_pengumuman.*') ? '' : 'collapsed' }}"
                href="{{ route('input_pengumuman.index') }}">
                <i class="bi bi-megaphone"></i>
                <span>Pengumuman</span>
            </a>
        </li>
        @endauth

        {{-- Galeri --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('galeribidangumum.*','galeripokja1.*','galeripokja2.*','galeripokja3.*','galeripokja4.*') ? '' : 'collapsed' }}"
                data-bs-target="#galeri_nav"
                data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-image"></i>
                <span>Galeri</span>
            </a>
            <ul id="galeri_nav"
                class="nav-content collapse {{ request()->routeIs('galeribidangumum.*','galeripokja1.*','galeripokja2.*','galeripokja3.*','galeripokja4.*') ? 'show' : '' }}">
                <li>
                    <a href="{{ route('galeribidangumum.index') }}"
                        class="{{ request()->routeIs('galeribidangumum.*') ? 'active' : '' }}">
                        <span>Bidang Umum</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeripokja1.index') }}"
                        class="{{ request()->routeIs('galeripokja1.*') ? 'active' : '' }}">
                        <span>Kelompok Kerja 1</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeripokja2.index') }}"
                        class="{{ request()->routeIs('galeripokja2.*') ? 'active' : '' }}">
                        <span>Kelompok Kerja 2</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeripokja3.index') }}"
                        class="{{ request()->routeIs('galeripokja3.*') ? 'active' : '' }}">
                        <span>Kelompok Kerja 3</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeripokja4.index') }}"
                        class="{{ request()->routeIs('galeripokja4.*') ? 'active' : '' }}">
                        <span>Kelompok Kerja 4</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Kelompok Kerja --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('accbidangumum.*','pokja1.*','pokja2.*','pokja3.*','pokja4.*') ? '' : 'collapsed' }}"
                data-bs-target="#pokja_nav"
                data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-briefcase"></i>
                <span>Kelompok Kerja</span>
            </a>
            <ul id="pokja_nav"
                class="nav-content collapse {{ request()->routeIs('accbidangumum.*','pokja1.*','pokja2.*','pokja3.*','pokja4.*') ? 'show' : '' }}">
                <li>
                    <a href="{{ route('accbidangumum.index') }}"
                        class="{{ request()->routeIs('accbidangumum.*') ? 'active' : '' }}">
                        <span>Bidang Umum</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pokja1.index') }}"
                        class="{{ request()->routeIs('pokja1.*') ? 'active' : '' }}">
                        <span>Kelompok Kerja 1</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pokja2.index') }}"
                        class="{{ request()->routeIs('pokja2.*') ? 'active' : '' }}">
                        <span>Kelompok Kerja 2</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pokja3.index') }}"
                        class="{{ request()->routeIs('pokja3.*') ? 'active' : '' }}">
                        <span>Kelompok Kerja 3</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pokja4.index') }}"
                        class="{{ request()->routeIs('pokja4.*') ? 'active' : '' }}">
                        <span>Kelompok Kerja 4</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Garis pemisah --}}
        <li><hr class="sidebar-divider"></li>

        {{-- Profil --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile.*') ? '' : 'collapsed' }}"
                href="{{ route('profile.index') }}">
                <i class="bi bi-person"></i>
                <span>Profil</span>
            </a>
        </li>

        {{-- Logout --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" onclick="confirmLogout(event)">
                <i class="bi bi-box-arrow-left"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>
</aside>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmLogout(event) {
    event.preventDefault();
    Swal.fire({
      title: '<span style="color: white; font-family: \'Poppins\', sans-serif; font-weight: 700; font-size: 22px;">Logout</span>',
      html: '<p style="font-family: \'Poppins\', sans-serif; font-size: 15px; font-weight: 500; color: #4a5568; margin: 20px 0 25px 0;">Apakah anda yakin ingin Logout?</p>',
      showCancelButton: true,
      confirmButtonColor: '#ef4444',
      cancelButtonColor: '#d1d5db',
      confirmButtonText: '<span style="font-family: \'Poppins\', sans-serif; font-weight: 700; font-size: 14px;">Logout</span>',
      cancelButtonText: '<span style="font-family: \'Poppins\', sans-serif; font-weight: 700; font-size: 14px; color: #4a5568;">Batal</span>',
      customClass: {
        popup: 'logout-popup-custom',
        title: 'logout-title-custom',
        htmlContainer: 'logout-content-custom',
        confirmButton: 'logout-confirm-btn-custom',
        cancelButton: 'logout-cancel-btn-custom',
        actions: 'logout-actions-custom'
      },
      buttonsStyling: false,
      reverseButtons: true,
      width: '420px'
    }).then((result) => {
      if (result.isConfirmed) {
        // Submit form logout
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("logout") }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
      }
    });
  }
</script>

<style>
  .logout-popup-custom {
    border-radius: 16px !important;
    padding: 0 !important;
    overflow: hidden !important;
    font-family: 'Poppins', sans-serif !important;
  }
  
  .logout-popup-custom * {
    font-family: 'Poppins', sans-serif !important;
  }
  
  .logout-title-custom {
    background-color: #ef4444 !important;
    padding: 14px 22px !important;
    margin: 0 !important;
    text-align: left !important;
    font-family: 'Poppins', sans-serif !important;
  }
  
  .logout-content-custom {
    padding: 0 28px !important;
    margin: 0 !important;
    font-family: 'Poppins', sans-serif !important;
  }
  
  .logout-content-custom p {
    font-family: 'Poppins', sans-serif !important;
  }
  
  .logout-actions-custom {
    padding: 0 28px 28px 28px !important;
    gap: 10px !important;
    justify-content: center !important;
  }
  
  .logout-confirm-btn-custom {
    background-color: #ef4444 !important;
    color: white !important;
    font-family: 'Poppins', sans-serif !important;
    font-weight: 700 !important;
    padding: 11px 35px !important;
    border-radius: 8px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.2s !important;
    flex: 1 !important;
    max-width: 160px !important;
  }
  
  .logout-confirm-btn-custom span {
    font-family: 'Poppins', sans-serif !important;
  }
  
  .logout-confirm-btn-custom:hover {
    background-color: #dc2626 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3) !important;
  }
  
  .logout-cancel-btn-custom {
    background-color: #e5e7eb !important;
    color: #4a5568 !important;
    font-family: 'Poppins', sans-serif !important;
    font-weight: 700 !important;
    padding: 11px 35px !important;
    border-radius: 8px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.2s !important;
    flex: 1 !important;
    max-width: 160px !important;
  }
  
  .logout-cancel-btn-custom span {
    font-family: 'Poppins', sans-serif !important;
  }
  
  .logout-cancel-btn-custom:hover {
    background-color: #d1d5db !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 10px rgba(209, 213, 219, 0.3) !important;
  }
</style>

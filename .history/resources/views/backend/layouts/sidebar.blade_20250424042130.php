<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link" href="dashboard.user">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('ttd.index') }}">
        <i class="fa-solid fa-signature"></i>
        <span>Tanda Tangan</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="input_berita">
        <i class="fa-solid fa-newspaper"></i>
        <span>Berita</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="input_pengumuman">
        <i class="fa-sharp fa-solid fa-bullhorn"></i>
        <span>Pengumuman</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#galeri_nav" data-bs-toggle="collapse" href="#">
        <i class="fa-solid fa-image"></i><span>Galeri</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="galeri_nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
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
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="fa-solid fa-book"></i><span>Kelompok Kerja</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
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
    </li><!-- End Components Nav -->

    <li class="nav-heading">Halaman</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="profile">
        <i class="fa-solid fa-user"></i>
        <span>Profil</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="logout" onclick="return confirm('Apakah anda yakin ingin keluar?')">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Keluar</span>
      </a>
    </li><!-- End Contact Page Nav -->
  </ul>

</aside><!-- End Sidebar-->
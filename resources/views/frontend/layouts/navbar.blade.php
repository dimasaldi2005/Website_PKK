<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <img src="{{ asset('frontend/assets/img/favicon.png') }}" class="logo-img" alt="">

      <div class="site-title">
        <h1 class="mb-0">
          <a href="home">
            Pemberdayaan Kesejahteraan Keluarga <br>
            Kabupaten Nganjuk
          </a>
        </h1>
      </div>
    </div>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" href="{{ route('home.index') }}#hero">Beranda</a></li>
        <li><a class="nav-link scrollto" href="{{ route('home.index') }}#portfolio">Galeri</a></li>
        <li><a class="nav-link scrollto " href="{{ route('home.index') }}#service">Program Kerja</a></li>

        <li class="dropdown"><a href="#informasi"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="{{ route('berita.index') }}">Berita</a></li>
            {{-- <li><a href="{{ route('showkes.index') }}">Laporan Kesehatan</a>
        </li>
        <li><a href="{{ route('showling.index') }}">Laporan Kelestarian Lingkungan Hidup</a></li>
        <li><a href="{{ route('showhat.index') }}">Laporan Perencanaan Sehat</a></li> --}}
        <li><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
      </ul>
      </li>
      <li class="dropdown"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
        <ul>
          <li><a href="{{ route('visimisi.index') }}">Visi Misi</a></li>
          <li><a href="lambangpkk">Arti Lambang PKK</a></li>
          <li><a href="sejarah">Sejarah</a></li>
          <li><a href="mars">Mars PKK</a></li>
        </ul>
      </li>
      <li class="login"><a href="{{ route('login') }}">Masuk</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
  </div>
</header>
<!-- End Header -->
@extends('frontend/layouts.template')

@section('content')

<!-- Hero Section -->
<section id="heroo" class="pokja-hero">
  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <div class="hero-content">
      <div class="hero-text">
        <h2 class="hero-subtitle">Sekilas Tentang</h2>
        <h1 class="hero-title">Kelompok Kerja 1</h1>
        <p class="hero-description" style="color: #333 !important; display: block !important; visibility: visible !important;">
          Membidangi Pembinaan Karakter dalam Keluarga, yang di antaranya menglola program Penghayatan dan Pengamalan Pancasila serta Gotong Royong.
        </p>
      </div>
      <div class="hero-logo">
        <img src="{{ asset('frontend/assets/img/favicon.png') }}" alt="Logo PKK">
      </div>
    </div>
  </div>
</section>

<!-- Main Content -->
<section class="pokja-content">
  <div class="container">

    <!-- Visi Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">Visi Pokja 1 :</h3>
      <p class="section-text text-center">
        Menumbuhkan karakter keluarga yang bahagia, aman dan damai melalui penghayatan dan pengamalan Pancasila serta semangat gotong royong.
      </p>
    </div>

    <!-- Program Pokok Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">Program Pokok Pokja 1 :</h3>
      <p class="section-text text-center">Penghayatan dan Pengamalan Pancasila</p>
      <p class="section-text text-center">Gotong Royong</p>
    </div>

    <!-- Tugas Section -->
    <div class="content-section bg-light" data-aos="fade-up">
      <h3 class="section-title">Tugas :</h3>
      <div class="tugas-list">
        <p>1. Memantapkan kerukunan dan toleransi antar umat beragama, saling menghormati dan menghargai dalam wadah Negara Kesatuan Republik Indonesia.</p>
        <p>2. Meningkatkan ketahanan keluarga dalam rangka mewujudkan kesadaran setiap warga tentang Penghayatan dan Pengamalan Pancasila melalui Pembinaan Kesadaran Bela Negara (PKBN)</p>
        <p>3. Memantapan Pola Asuh Anak dan remaja dalam keluarga serta perlindungan anak melalui Lokakarya dan Ujicoba.</p>
        <p>4. Peningkatan pemahaman dan pengamalan perilaku budi pekerti dan sopan santun dalam keluarga dan lingkungan</p>
        <p>5. Meningkatkan pemahaman peraturan perundangan yang berkait dengan pencegahan Kekerasan Dalam Rumah Tangga (KDRT), pencegahan perdagangan orang (trafficking), peningkatan pemahaman penyalahgunaan narkoba melalui life skill dan parenting skill.</p>
        <p>6. Meningkatkan kesadaran hidup bergotong royong, kesetiakawanan sosial, keamanan lingkungan, Tentara Manunggal Membangun Desa (TMMD) dan lain lainnya.</p>
        <p>7. Memberdayakan LANSIA dalam kegiatan yang produktif dan menjadi teladan dalam keluarga dan lingkungannya.</p>
      </div>
    </div>

    <!-- Prioritas Program Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">PRIORITAS PROGRAM</h3>
      
      <div class="program-item">
        <h4 class="program-title">Penghayatan dan Pengamalan Pancasila</h4>
        <p class="program-text">Menumbuhkan ketahanan keluarga melalui kesadaran bermasyarakat, berbangsa dan bernegara perlu dilaksanakan pemahaman secara terpadu</p>
      </div>

      <div class="program-item">
        <h4 class="program-title">PEMBINAAN KESADARAN BELA NEGARA (PKBN)</h4>
        <p class="program-text">PKBN mencakup 5 (lima) unsur: Kecintaan tanah air, Kesadaran berbangsa dan bernegara, Keyakinan atas kebenaran Pancasila, Kerelaan berkorban untuk Bangsa dan Negara serta Memiliki kemampuan awal bela Negara.</p>
      </div>

      <div class="program-item">
        <h4 class="program-title">KESADARAN HUKUM (KEDARKUM)</h4>
        <p class="program-text">ADARKUM adalah upaya untuk meningkatkan pemahaman tentang peraturan perundang-undangan diprioritaskan di PKK untuk pencegahan PKDRT, Trafficking, Perlindungan Anak, NARKOBA Dan lain-lain</p>
      </div>

      <div class="program-item">
        <h4 class="program-title">POLA ASUH ANAK DAN REMAJA</h4>
        <p class="program-text">Pola Asuh anak dan remaja adalah upaya untuk menumbuhkan dan membangun perilaku, budi pekerti, sopan santun didalam keluarga sesuai budaya bangsa</p>
      </div>

      <div class="program-item">
        <h4 class="program-title">PEMAHAMAN DAN KETRAMPILAN HIDUP</h4>
        <p class="program-text">Pemahaman dan ketrampilan hidup adalah upaya menumbuhkan kesadaran orang tua dalam upaya pencegahan penyalahgunaan Narkoba.</p>
      </div>
    </div>

    <!-- Gotong Royong Section -->
    <div class="content-section bg-light" data-aos="fade-up">
      <h3 class="section-title">Gotong Royong</h3>
      <p class="section-text">Kegiatan gotong royong dilaksanakan dengan membangun kerjasama yang baik antar sesama: keluarga, warga dan kelompok untuk mewujudkan semangat persatuan dan kesatuan.</p>
      
      <div class="tugas-list">
        <p>1. Menumbuhkan kesadaran, kesetiakawanan sosial, bertenggang rasa dan kebersamaan serta saling menghormati antar umat beragama</p>
        <p>2. Memberdayakan LANSIA agar dapat menjaga kesehatan fisik dan mental, kebugaran, keterampilan agar dapat melaksanakan kegiatan secara produktif dan menjadi teladan bagi keluarga dan lingkungannya.</p>
        <p>3. Berpartisipasi dalam pelaksanaan kegiatan bakti sosial, kegiatan Tentara Manunggal Membangun Desa (TMMD).</p>
      </div>
    </div>

  </div>
</section>

<!-- Custom Styles -->
<style>
  /* Hero Section */
  .pokja-hero {
    background: #e8e8e8;
    padding: 70px 0;
    overflow: hidden;
  }

  .hero-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 80px;
  }

  .hero-text {
    flex: 1;
    max-width: 600px;
  }

  .hero-logo {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .hero-logo img {
    width: 180px;
    height: 180px;
    object-fit: contain;
  }

  .hero-subtitle {
    font-size: 22px;
    font-weight: 500;
    margin-bottom: 8px;
    font-family: 'Poppins', sans-serif;
    color: #2c2c2c;
  }

  .hero-title {
    font-size: 38px;
    font-weight: 700;
    margin-bottom: 20px;
    font-family: 'Poppins', sans-serif;
    color: #2c2c2c;
    line-height: 1.3;
  }

  .hero-description {
    font-size: 17px;
    line-height: 1.7;
    font-family: 'Poppins', sans-serif;
    color: #333333 !important;
    font-weight: 400;
    display: block;
    margin-top: 15px;
  }

  /* Main Content */
  .pokja-content {
    background: #ffffff;
    padding: 80px 0;
  }

  .logo-section {
    text-align: center;
    margin-bottom: 60px;
  }

  .logo-section img {
    max-height: 300px;
  }

  /* Content Section */
  .content-section {
    padding: 40px 0;
    margin-bottom: 40px;
  }

  .content-section.bg-light {
    background: #f8f9fa;
    padding: 60px 40px;
    border-radius: 16px;
  }

  .section-title {
    font-size: 28px;
    font-weight: 700;
    color: #2c3e50;
    text-align: center;
    margin-bottom: 30px;
    font-family: 'Poppins', sans-serif;
  }

  .section-text {
    font-size: 17px;
    line-height: 1.8;
    color: #555;
    margin-bottom: 20px;
    font-family: 'Poppins', sans-serif;
  }

  /* Tugas List */
  .tugas-list p {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
    margin-bottom: 16px;
    font-family: 'Poppins', sans-serif;
  }

  /* Program Item */
  .program-item {
    margin-bottom: 40px;
  }

  .program-title {
    font-size: 22px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 12px;
    font-family: 'Poppins', sans-serif;
  }

  .program-text {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
    font-family: 'Poppins', sans-serif;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .pokja-hero {
      padding: 40px 0;
    }

    .hero-content {
      flex-direction: column;
      gap: 30px;
      text-align: center;
    }

    .hero-text {
      max-width: 100%;
    }

    .hero-logo img {
      width: 150px;
      height: 150px;
    }

    .hero-subtitle {
      font-size: 18px;
    }

    .hero-title {
      font-size: 28px;
    }

    .hero-description {
      font-size: 15px;
    }

    .pokja-content {
      padding: 40px 0;
    }

    .content-section.bg-light {
      padding: 40px 20px;
    }

    .section-title {
      font-size: 20px;
    }

    .logo-section img {
      max-height: 200px;
    }
  }
</style>

@endsection

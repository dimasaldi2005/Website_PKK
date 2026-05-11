@extends('frontend/layouts.template')

@section('content')

<!-- Hero Section -->
<section id="heroo" class="pokja-hero">
  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <div class="hero-content">
      <div class="hero-text">
        <h2 class="hero-subtitle">Sekilas Tentang</h2>
        <h1 class="hero-title">Kelompok Kerja 4</h1>
        <p class="hero-description" style="color: #333 !important; display: block !important; visibility: visible !important;">
          Membidangi Kesehatan Keluarga dan Lingkungan, diantaranya mengelola program kesehatan, kelestarian lingkungan hidup dan perencanaan sehat.
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

    <!-- Misi Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">Misi Pokja 4 :</h3>
      <p class="section-text text-center">
        Menciptakan keluarga sehat melalui pembiasaan pola hidup bersih dan sehat, peningkatan kelestarian lingkungan hidup dan perencanaan sehat
      </p>
    </div>

    <!-- Program Pokok Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">Program Pokok Pokja 4 :</h3>
      <p class="section-text text-center">Kesehatan</p>
      <p class="section-text text-center">Kelestarian Lingkungan Hidup</p>
      <p class="section-text text-center">Perencanaan Sehat</p>
    </div>

    <!-- Tugas Section -->
    <div class="content-section bg-light" data-aos="fade-up">
      <h3 class="section-title">Tugas :</h3>
      <div class="tugas-list">
        <p>1. Meningkatkan pencapaian tujuan pembangunan millennium</p>
        <p>2. Meningkatkan budaya Perilaku Hidup Bersih dan Sehat (PHBS)</p>
        <p>3. Mengembangkan dan membina pelaksanaan kegiatan POSYANDU</p>
        <p>4. Memonitor pelaksanaan Sistem Informasi Posyandu (SIP)</p>
        <p>5. Melaksanakan pencatatan Ibu hamil, melahirkan, nifas, ibu meninggal, kelahiran dan kematian bayi dan balita</p>
        <p>6. Tanam dan pelihara pohon dalam rangka mewujudkan kelestarian lingkungan.</p>
        <p>7. Mewujudkan keluarga kecil, bahagia, sejahtera dengan melaksanakan program KB agar tercapai generasi yang sehat, cerdas dan tangguh.</p>
        <p>8. Meningkatkan pengetahuan tentang budaya hidup hemat, membudayakan kebiasaan menabung dan melaksanakan tatalaksana keuangan keluarga dalam rangka mendukung perencanaan sehat.</p>
      </div>
    </div>

    <!-- Prioritas Program Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">PRIORITAS PROGRAM</h3>
      
      <div class="program-item">
        <h4 class="program-title">Kesehatan</h4>
        <p class="program-text">1. Memantapkan Keluarga Sadar Gizi (KADARZI) dalam upaya menurunkan prefalensi anak balita kurang gizi.</p>
        <p class="program-text">2. Penyediaan Makanan Tambahan bagi Anak Sekolah (PMT-AS)</p>
        <p class="program-text">3. Menjadikan PHBS sebagai kebiasaan hidup sehari-hari</p>
        <p class="program-text">4. Usaha Kesehatan Sekolah</p>
        <p class="program-text">5. Membudayakan Lima Imunisasi Dasar Lengkap (LIL) dan rutin untuk menurunkan angka kematian anak dan ibu.</p>
        <p class="program-text">6. Meningkatkan kesadaran Pasangan Usia Subur (PUS) tentang manfaat pemakaian alat kontrasepsi.</p>
        <p class="program-text">7. Meningkatkan penyuluhan pencegahan penyakit menular dan tidak menular.</p>
        <p class="program-text">8. Meningkatkan tanam dan pelihara pohon dalam upaya kelestarian lingkungan hidup, mengurangi dampak global warming (pemanasan global).</p>
        <p class="program-text">9. Mendorong swadaya masyarakat dalam upaya penurunan Angka Kematian Ibu (AKI), Angka Kematian Bayi (AKB), Angka Kematian Balita (AKBAL)</p>
        <p class="program-text">10. Pemahaman tertib administrasi dalam rangka meningkatkan dan mewujudkan tertib administrasi kependudukan di keluarga.</p>
        <p class="program-text">11. Optimalisasi Posyandu.</p>
        <p class="program-text">12. Meningkatkan pengetahuan dan kemampuan keluarga</p>
      </div>

      <div class="program-item">
        <h4 class="program-title">Kelestarian Lingkungan Hidup</h4>
        <p class="program-text">1. Lingkungan Bersih dan Sehat - Menanamkan kesadaran tentang kebersihan pengelolaan kamar mandi dan jamban keluarga, Saluran Pembuangan Air Limbah (SPAL)</p>
        <p class="program-text">2. Menanamkan kebiasaan memilah sampah organik dan non organik serta Bahan Berbahaya dan Beracun (B3) di tempat yang benar.</p>
        <p class="program-text">3. Mendaur ulang limbah</p>
        <p class="program-text">4. Mengadakan lomba/ Pelaksana Terbaik Lingkungan Bersih dan Sehat.</p>
        <p class="program-text">5. Peningkatan pengetahuan tentang pengadaan, pemakaian dan penghematan air bersih dan sehat dalam keluarga.</p>
        <p class="program-text">6. Kelestarian Lingkungan Hidup</p>
        <p class="program-text">7. Pengembangan kualitas lingkungan dan pemukiman, kebersihan dan kesehatan, pada pemukiman yang padat, dalam rangka terwujudnya kota bersih dan sehat (Health Cities).</p>
        <p class="program-text">8. Pencegahan banjir dengan tidak menebang pohon sembarangan. Program sejuta pohon sebagai paru-paru kota dan pencegahan polusi udara.</p>
        <p class="program-text">9. Pemanfaatan jamban dan air bersih dalam rangka mewujudkan Indonesia Sehat.</p>
        <p class="program-text">10. Memasyarakatkan biopori (lubang resapan) untuk mencegah genangan dan resapan air</p>
      </div>

      <div class="program-item">
        <h4 class="program-title">Perencanaan Sehat</h4>
        <p class="program-text">1. Meningkatkan penyuluhan tentang pentingnya pemahaman dan kesertaan dalam program keluarga berencana menuju keluarga berkualitas.</p>
        <p class="program-text">2. Meningkatkan kemampuan perencanaan kehidupan keluarga sehari-hari dengan berorientasi pada masa depan dengan cara membiasakan menabung.</p>
        <p class="program-text">3. Kegiatan Kesatuan Gerak PKK KB-KES dalam upaya meningkatkan cakupan hasil pelayanan KB-KES.</p>
        <p class="program-text">4. Peringatan Hari Keluarga Nasional (HARGANAS) dalam upaya peningkatan ketahanan keluarga untuk mewujudkan keluarga berkualitas.</p>
        <p class="program-text">5. Meningkatkan penyuluhan kesehatan reproduksi bagi remaja dan calon pengantin.</p>
        <p class="program-text">6. Mengatur keseimbangan antara pemasukan dan pengeluaran keuangan keluarga.</p>
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
    margin-bottom: 12px;
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

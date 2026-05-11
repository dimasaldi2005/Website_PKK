@extends('frontend/layouts.template')

@section('content')

<!-- Hero Section -->
<section id="heroo" class="pokja-hero">
  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <div class="hero-content">
      <div class="hero-text">
        <h2 class="hero-subtitle">Sekilas Tentang</h2>
        <h1 class="hero-title">Kelompok Kerja 2</h1>
        <p class="hero-description" style="color: #333 !important; display: block !important; visibility: visible !important;">
          Membidangi Pendidikan & Peningkatan Ekonomi Keluarga, mengelola program pendidikan &keterampilan, serta pengembangan kehidupan berkoperasi.
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
      <h3 class="section-title">Misi Pokja 2 :</h3>
      <p class="section-text text-center">
        Menumbuhkan lingkungan keluarga yang cerdas, kreatif, terampil, sejahtera dan mandiri melalui upaya Pendidikan, peningkatan keterampilan dan pengembangan kehidupan berkoperasi.
      </p>
    </div>

    <!-- Program Pokok Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">Program Pokok Pokja 2 :</h3>
      <p class="section-text text-center">Pendidikan dan Keterampilan</p>
      <p class="section-text text-center">Pengembangan Kehidupan Berkoperasi</p>
    </div>

    <!-- Tugas Section -->
    <div class="content-section bg-light" data-aos="fade-up">
      <h3 class="section-title">Tugas :</h3>
      <div class="tugas-list">
        <p>1. Meningkatkan pendidikan dan ketrampilan dalam keluarga, peningkatan jenis dan mutu kader, peningkatan pengetahuan TP PKK dan kelompok-kelompok PKK dan Dasawisma melalui penyuluhan, orientasi dan pelatihan.</p>
        <p>2. Melaksanakan dan mengembangkan kegiatan program Bina Keluarga Balita (BKB).</p>
        <p>3. Memantapkan Kelompok Belajar (Kejar) Paket A dan B dan C</p>
        <p>4. Meningkatkan pengetahuan dan menumbuhkan kesadaran dalam keluarga tentang pentingnya pendidikan anak sejak usia dini (0-6) tahun agar anak tumbuh dan berkembang secara optimal sesuai dengan usianya.</p>
        <p>5. Membantu program Keaksaraan Fungsional (KF) dalam rangka meningkatkan pendidikan keluarga.</p>
        <p>6. Meningkatkan kelompok dan kualitas Usaha Peningkatan Pendapatan Keluarga (UP2K) PKK.</p>
        <p>7. Memotivasi keluarga tentang manfaat koperasi sebagai salah satu upaya perbaikan ekonomi keluarga dan mendorong terbentuknya koperasi yang dikelola oleh PKK.</p>
        <p>8. Identifikasi kebutuhan pelatihan.</p>
        <p>9. Menyusun modul-modul pelatihan.</p>
        <p>10. Berparitisipasi dalam Forum PAUD bekerjasama dengan Pokja IV yang difasilitasi oleh Kementerian Pendidikan Nasional.</p>
        <p>11. Meningkatkan pengetahuan masyarakt tentang pentingnya pendidikan dasar untuk semua sesuai dengan tujuan MGDs yaitu agar setiap anak laki-laki dan perempuan mendapatkan dan menyelesaikan pendidikan dasar.</p>
      </div>
    </div>

    <!-- Prioritas Program Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">PRIORITAS PROGRAM</h3>
      
      <div class="program-item">
        <h4 class="program-title">Pendidikan dan Ketrampilan</h4>
        <p class="program-text">1. Meningkatkan kemampuan yang berkaitan dengan pengetahuan, kesadaran dan ketrampilan keluarga yang mempunyai anak balita mengenai tumbuh kembang anak balita secara optimal.</p>
        <p class="program-text">2. Menyusun modul pelatihan BKB bagi TP PKK dan mengadakan pelatihan BKB</p>
        <p class="program-text">3. Meningkatkan mutu dan jumlah pelatih PKK dengan mengadakan pelatihan pelatih/ Training of Trainer (TOT).</p>
        <p class="program-text">4. Menyempurnakan modul-modul pelatihan TPK3PKK, LP3PKK dan DAMAS PKK sesuai dengan perkembangan serta mensosialisasikannya antara lain melalui pelatihan-pelatihan : TPK3PKK, LP3PKK dan DAMAS PKK.</p>
        <p class="program-text">5. Meningkatkan pengetahuan TP PKK dalam kegiatan Pos PAUD melalui kegiatan PAUD yang diintegrasikan dengan BKB dan Posyandu dengan pertemuan mitra PAUD bekerja sama dengan Pokja IV.</p>
        <p class="program-text">6. Meningkatkan jumlah, pengetahuan dan ketrampilan kader dalam mendidik anak usia dini melalui pelatihan bekerja sama dengan instansi terkait dan HIMPAUDI.</p>
        <p class="program-text">7. Meningkatkan ketrampilan kecakapan hidup (LIFE SKILL) perempuan maupun laki laki sehingga mampu berusaha secara bersama atau mandiri untuk memperkuat kehidupan diri dan keluarganya.</p>
        <p class="program-text">8. Mengadakan monitoring dan evaluasi kegiatan Pos PAUD di TP PKK Provinsi untuk mengetahui sejauh mana pengintegrasian PAUD, BKB dan Posyandu</p>
        <p class="program-text">9. Meningkatkan kejar Paket A, B dan C melalui pelatihan Tutor Kejar Paket A, B dan C bekerja sama dengan instansi terkait.</p>
        <p class="program-text">10. Meningkatkan dan menyuluh keluarga tentang Wajib Belajar Pendidikan Dasar Sembilan Tahun (WAJAR DIKDAS 9 tahun)</p>
        <p class="program-text">11. Meningkatkan pendidikan dan ketrampilan keluarga serta pengembangan Keaksaraan Fungsional (KF) dengan pendampingan melalui penyuluhan, orientasi dan pelatihan.</p>
        <p class="program-text">12. Meningkatkan pengetahuan dan kemampuan baca tulis, serta membudayakan minat baca masyarakat melalui Taman Bacaan Masyarakat (TBM) dan Sudut Baca bekerja sama dengan instansi terkait.</p>
        <p class="program-text">13. Meningkatkan pelaksanaan kerjasama dengan mitra sebagai pendamping, yaitu lintas sektoral dan lintas kelembagaan.</p>
      </div>
    </div>

    <!-- Pengembangan Kehidupan Berkoperasi Section -->
    <div class="content-section bg-light" data-aos="fade-up">
      <h3 class="section-title">Pengembangan Kehidupan Berkoperasi</h3>
      
      <div class="tugas-list">
        <p>1. Melaksanakan evaluasi UP2K-PKK dan mengadakan lomba UP2K untuk mengetahui sejauh mana pelaksanaan kegiatan UP2K-PKK didaeah dan mengetahuai keberhasilannya.</p>
        <p>2. Mengadakan pelatihan UP2K-PKK dalam rangka meningkatkan pengetahuan tentang program UP2K-PKK agar TP PKK Provinsi mempunyai tenaga terampil dalam pengembangan program UP2K-PKK</p>
        <p>3. Mendata ulang jumlah kelompok-kelompok UP2K-PKK</p>
        <p>4. Mengatatasi cara pemecahan masalah mengenai permodalan untuk kegiatan UP2K PKK melalui APBD, Lembaga Keuangan Mikro yang ada, baik yang bersifat bank seperti BRI Unit Desa, Bank Perkreditan Rakyat, Program Nasional Pemberdayaan Masyarakat (PNPM) Mandiri Pedesaan, Alokasi Dana Desa (ADD) dan lain lain.</p>
        <p>5. Mengupayakan pemasaran UP2K PKK melalui pasar, warung, ikut pada pameran, bazar baik lokal maupun nasional dan menjalin kemitraan dengan Dekranas / Dekranasda.</p>
        <p>6. Memotifasi keluarga agar mau menjadi anggota koperasi untuk meningkatkan pendapatan keluarga.</p>
        <p>7. Mendorong terbentuknya koperasi yang berbadan hukum yang dikelola oleh TP PKK</p>
        <p>8. Dalam pelaksanaa prioritas program disesuaikan dengan kemampuan daerah dan menjalin kemitraan dengan instansi terkait.</p>
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
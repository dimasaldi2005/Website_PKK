@extends('frontend/layouts.template')

@section('content')

<!-- Hero Section -->
<section id="heroo" class="pokja-hero">
  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <div class="hero-content">
      <div class="hero-text">
        <h2 class="hero-subtitle">Sekilas Tentang</h2>
        <h1 class="hero-title">Kelompok Kerja 3</h1>
        <p class="hero-description" style="color: #333 !important; display: block !important; visibility: visible !important;">
          Membidangi penguatan ketahanan keluarga, yang diantaranya mengelola program Pangan, Sandang, serta Perumahan dan Tata Laksana Rumah Tangga.
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
      <h3 class="section-title">Misi Pokja 3 :</h3>
      <p class="section-text text-center">
        Menciptakan ketahanan keluarga melalui peningkatan keterampilan dalam pengelolaan sandang, pangan, dan rumah tangga yang sehat dan layak.
      </p>
    </div>

    <!-- Program Pokok Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">Program Pokok Pokja 3 :</h3>
      <p class="section-text text-center">Pangan</p>
      <p class="section-text text-center">Sandang</p>
      <p class="section-text text-center">Perumahan dan Tatalaksana Rumah Tangga</p>
    </div>

    <!-- Tugas Section -->
    <div class="content-section bg-light" data-aos="fade-up">
      <h3 class="section-title">Tugas :</h3>
      <div class="tugas-list">
        <p>1. Mengupayakan ketahanan keluarga dibidang pangan sesuai dengan UU No. 7 Tahun 1996 tentang Pangan.</p>
        <p>2. Meningkatkan penganekaragaman tanaman pangan dalam upaya peningkatan gizi keluarga menuju keluarga yang berkualitas.</p>
        <p>3. Menumbuhkan kesadaran masyarakat untuk mengkonsumsi makanan yang Beragam, Bergizi, Berimbang (3B), yang aman dan berbasis sumber daya lokal.</p>
        <p>4. Mengusahakan pemanfaatan lahan baik darat maupun air, minimal untuk pemenuhan kebutuhan pangan keluarga.</p>
        <p>5. Berperan dan membantu dalam program Cadangan Pangan Masyarakat.</p>
        <p>6. Memantapkan Gerakan Halaman, Asri, Teratur, Indah dan Nyaman (HATINYA PKK).</p>
        <p>7. Memanfaatan Teknologi Tepat Guna (TTG) dalam upaya meringankan beban kerja sehingga hasilnya lebih efektif dan efisien.</p>
        <p>8. Membudayakan "Aku Cinta Makanan Indonesia" dan "Aku Cinta Produksi Indonesia" sehingga menumbuhkan rasa bangga.</p>
        <p>9. Mensosialisasikan pola pangan 3B untuk keluarga khususnya bagi balita dan lansia.</p>
        <p>10. Meningkatkan penggunaan bahan sandang dalam negeri serta mendorong peningkatan kualitas dan kuantitas produksi dan pemasarannya.</p>
        <p>11. Mengembangkan kreatifitas Usaha Kecil Mikro (UKM) dengan berbagai produk busana, cinderamata khas daerah untuk menunjang pariwisata.</p>
        <p>12. Mendorong terciptanya lapangan/kesempatan kerja di bidang jasa, sandang, pangan dan perumahan.</p>
        <p>13. Memasyarakatkan rumah sehat dan layak huni sebagai upaya terwujudnya kualitas hidup keluarga.</p>
        <p>14. Memantapkan pemahaman tentang fungsi rumah sebagai tempat tumbuh kembang keluarga harmonis.</p>
        <p>15. Meningkatkan jalinan kerjasama dengan institusi terkait.</p>
        <p>16. Melaksanakan PMT- AS terkoordinasi dan terpadu.</p>
        <p>17. Sosialisasi program nasional Gerakan Memasyarakatkan Makan Ikan (GEMARIKAN) dalam rangka mencerdaskan bangsa.</p>
        <p>18. Melaksanakan Program Nasional Gerakan Perempuan, Tanam, Tebar dan Pelihara Pohon untuk mengantisipasi akibat perubahan iklim yang berdampak pada ketahanan pangan keluarga.</p>
        <p>19. Menjaga kelestarian hutan</p>
      </div>
    </div>

    <!-- Prioritas Program Section -->
    <div class="content-section" data-aos="fade-up">
      <h3 class="section-title">PRIORITAS PROGRAM</h3>
      
      <div class="program-item">
        <h4 class="program-title">Pangan</h4>
        <p class="program-text">1. Mewujudkan Ketahanan Pangan Keluarga melalui penganekaragaman pangan yang bergizi sesuai potensi daerah.</p>
        <p class="program-text">2. Peningkatan pangan keluarga sehari-hari dengan mendorong terciptanya sikap dan perilaku masyarakat melalui penganekaragaman makanan dengan menerapkan pola pangan 3B (beragam, bergizi, berimbang), sesuai potensi daerah.</p>
        <p class="program-text">3. Mewaspadai terjadinya keracunan pangan, mulai dari menanam, memilih, mengolah sampai terhidangnya makanan, menghindari bahan tambahan makanan yang berbahaya, antara lain : zat pewarna, bahan pengawet, produk kedaluwarsa, dan penggunaan pestisida.</p>
        <p class="program-text">4. Meminimalkan budaya / tradisi pangan yang merugikan kesehatan misalnya orang hamil / balita banyak pantangan makan.</p>
        <p class="program-text">5. Mengoptimalkan HATINYA PKK dengan tananam pangan dan tanaman produktif/keras (bernilai ekonomis tinggi), minimal untuk memenuhi keperluan dan tabungan keluarga serta meningkatkan Tanaman Obat Keluarga (TOGA).</p>
        <p class="program-text">6. Mengembangkan industri pangan rumah tangga dan mengadakan penyuluhan, orientasi dan pelatihan untuk menunjang pemasaran.</p>
        <p class="program-text">7. Mengadakan lomba masak secara berjenjang guna meningikatkan kreativitas cipta makanan.</p>
        <p class="program-text">8. Pemanfaatan Teknologi Tepat Guna (TTG) untuk menunjang usaha agrobisnis, hortikultura, tanaman buah, perikanan, peternakan dan lain-lain untuk meningkatkan kualitas dan kuantitas produksi dalam mencapai taraf hidup dan kesejahteraan keluarga.</p>
        <p class="program-text">9. Menyempurnakan dan sosialisasi buku Peran PKK Dalam Mendukung Gerakan Percepatan Keanekaragaman Konsumsi Pangan</p>
      </div>

      <div class="program-item">
        <h4 class="program-title">Sandang</h4>
        <p class="program-text">1. Mengupayakan adanya hak paten untuk melindungi hak cipta desain.</p>
        <p class="program-text">2. Mengupayakan keikutsertaan dalam pameran dan lomba baik tingkat lokal, nasional dan internasional.</p>
        <p class="program-text">3. Mengadakan kerja sama dengan para disainer, pengusaha, industri sandang dan pariwisata.</p>
        <p class="program-text">4. Membudayakan perilaku berbusana sesuai dengan moral budaya Indonesia dan meningkatkan kesadaran masyarakat mencintai produksi dalam negeri (Aku Cinta Produksi Indonesia)</p>
      </div>
    </div>

    <!-- Perumahan dan Tata Laksana Section -->
    <div class="content-section bg-light" data-aos="fade-up">
      <h3 class="section-title">Perumahan dan Tata Laksana Rumahtangga</h3>
      
      <div class="tugas-list">
        <p>1. Menumbuh kembangkan kembali program Pemugaran Perumahan dan Lingkungan Desa Terpadu (P2LDT) melalui pemugaran rumah layak huni terutama keluarga miskin dan pengungsi dengan azas Tri Bina (bina usaha, bina manusia dan bina lingkungan), gotong royong serta mengupayakan bantuan dari instansi/dinas terkait, bank, swasta dan masyarakat.</p>
        <p>2. Meningkatkan pemasyarakatan tentang perumahan sehat dan layak huni serta menumbuhkan kesadaran akan bahaya bertempat tinggal di daerah tegangan listrik tinggi, bantaran sungai, timbunan sampah, tepian jalan rel kereta api dan menumbuhkan kesadaran hukum tentang kepemilikan rumah dan tanah.</p>
        <p>3. Pemasyarakatan dan pemanfaatan TTG dalam rumahtangga, sarana dan prasarana perumahan serta hemat energi dan mencegah pemborosan.</p>
        <p>4. Meningkatkan pengetahuan dan keterampilan tentang tata laksana rumah tangga dalam mengharmoniskan dan membahagiakan kehidupan keluarga.</p>
        <p>5. Meningkatkan penerapan pola hidup /perilaku bagi penghuni rumah susun.</p>
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

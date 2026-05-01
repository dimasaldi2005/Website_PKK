@extends('frontend/layouts.template')

@section('content')

<section id="heroo" class="d-flex align-items-center">
  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <!-- <h1>Selamat Datang <span>PKK Kabupaten Nganjuk</span></h1> -->
    <h2 class="">Sekilas Tentang</h2>
          <h4 class="">Kelompok Kerja 4</h4>
          <p class="">
            Membidangi Kesehatan Keluarga dan Lingkungan, diantaranya </br>mengelola program kesehatan, kelestarian lingkungan hidup dan </br>perencanaan sehat.
          </p>
    
  </div>
</section><!-- End Hero -->
    
  <!-- ======= Service Details Section ======= -->
  <section id="service-details" class="service-details">
    <div class="container" data-aos="fade-up">
      
      

        

        
          {{-- <ul>
            <li><i class="bi "></i> <span>Aut eum totam accusantium voluptatem.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Assumenda et porro nisi nihil nesciunt voluptatibus.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea</span></li>
          </ul>
          <p>
            Est reprehenderit voluptatem necessitatibus asperiores neque sed ea illo. Deleniti quam sequi optio iste veniam repellat odit. Aut pariatur itaque nesciunt fuga.
          </p>
          <p>
            Sunt rem odit accusantium omnis perspiciatis officia. Laboriosam aut consequuntur recusandae mollitia doloremque est architecto cupiditate ullam. Quia est ut occaecati fuga. Distinctio ex repellendus eveniet velit sint quia sapiente cumque. Et ipsa perferendis ut nihil. Laboriosam vel voluptates tenetur nostrum. Eaque iusto cupiditate et totam et quia dolorum in. Sunt molestiae ipsum at consequatur vero. Architecto ut pariatur autem ad non cumque nesciunt qui maxime. Sunt eum quia impedit dolore alias explicabo ea.
          </p> --}}
        

        

      </div>

      <section id="about" class="about ">
        <div class="text-center">
        <img src="{{ asset ('frontend/assets/img/logopkk.png')}}" class="img-fluid" alt="" style="max-height: 400px;margin-bottom: 43px">
        </div>
        <div class="container" data-aos="fade-up">
                <p class="fw-bold fs-4 text-center" id="bold">Misi Pokja 4 :</p></br>
                <p class="fw-normal text-center" id="cek" >Menciptakan keluarga sehat melalui pembiasaan pola hidup bersih dan sehat, peningkatan kelestarian lingkungan hidup dan perencanaan sehat</p></br>
                <p class="fw-bold fs-4 text-center" id="bold">Program Pokok Pokja 4 :</p></br>
            <div id="cek">
                <p class="fw-normal text-center">Kesehatan</p>
                <p class="fw-normal text-center">
                    Kelestarian Lingkungan Hidup</p>
                    <p class="fw-normal text-center">
                        Perencanaan Sehat</p>
                    
              
            </div>
        </div>
        
      </section><!-- End About Section -->
      
      <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">
          <p class="fw-bold fs-4 text-center" id="bold">Tugas :</p></br>
          
          <div id="cek">
          <p class="fw-normal">1. Meningkatkan pencapaian tujuan pembangunan millennium</p>
          <p class="fw-normal">2. Meningkatkan budaya Perilaku Hidup Bersih dan Sehat (PHBS)</p>
          <p class="fw-normal">3. Mengembangkan dan membina pelaksanaan kegiatan POSYANDU</p>
          <p class="fw-normal">4. Memonitor pelaksanaan Sistem Informasi Posyandu (SIP)</p>
          <p class="fw-normal">5. Melaksanakan pencatatan Ibu hamil, melahirkan, nifas, ibu meninggal, kelahiran dan kematian bayi dan balita</p>
          <p class="fw-normal">6. Tanam dan pelihara pohon dalam rangka mewujudkan kelestarian lingkungan.</p>
          <p class="fw-normal">7. Mewujudkan keluarga kecil, bahagia, sejahtera dengan melaksanakan program KB agar tercapai generasi yang sehat, cerdas dan tangguh.</p>
          <p class="fw-normal">8. Meningkatkan pengetahuan tentang budaya hidup hemat, membudayakan kebiasaan menabung dan melaksanakan  tatalaksana keuangan keluarga dalam rangka mendukung perencanaan sehat.</p>
          

          </div>
        </div>
        
      </section><!-- End About Section -->

      <section id="about" class="about ">
        <img src="{{ asset ('frontend/assets/p.jpeg')}}" alt="" class="rounded float-start" style="min-height: 1000px;"
         >
        <div class="container" data-aos="fade-up">
          
                <p class="fw-bold fs-4 text-center" id="bold">PRIORITAS PROGRAM</p></br>
                <p class="fw-bold fs-4" id="bold">
                    Kesehatan</p>
                <p class="fw-normal" id="cek" >1. Memantapkan Keluarga Sadar Gizi (KADARZI) dalam upaya menurunkan prefalensi anak balita kurang gizi.</p>
                <p class="fw-normal" id="cek" >2. Penyediaan Makanan Tambahan bagi Anak Sekolah (PMT-AS)</p>
                <p class="fw-normal" id="cek" >3. Menjadikan PHBS  sebagai kebiasaan hidup sehari-hari</p>
                <p class="fw-normal" id="cek" >4. Usaha Kesehatan Sekolah </p>
                <p class="fw-normal" id="cek" >5. Membudayakan Lima Imunisasi Dasar Lengkap (LIL) dan rutin untuk menurunkan angka kematian anak dan ibu.</p>
                <p class="fw-normal" id="cek" >6. Meningkatkan kesadaran Pasangan Usia Subur (PUS) tentang manfaat pemakaian alat kontrasepsi.</p>
                <p class="fw-normal" id="cek" >7. Meningkatkan penyuluhan pencegahan penyakit menular dan tidak menular.</p>
                <p class="fw-normal" id="cek" >8. Meningkatkan tanam dan pelihara pohon dalam upaya kelestarian lingkungan hidup, mengurangi dampak global warming (pemanasan global).</p>
                <p class="fw-normal" id="cek" >9. Mendorong swadaya masyarakat dalam upaya penurunan Angka Kematian Ibu (AKI), Angka Kematian Bayi (AKB), Angka Kematian Balita (AKBAL)</p>
                <p class="fw-normal" id="cek" >10. Pemahaman tertib administrasi dalam rangka meningkatkan dan mewujudkan tertib administrasi kependudukan di keluarga.</p>
                <p class="fw-normal" id="cek" >11. Optimalisasi Posyandu.</p>
                <p class="fw-normal" id="cek" >12. Meningkatkan pengetahuan dan kemampuan keluarga</p>
                

                <p class="fw-bold fs-4" id="bold">
                    Kelestarian Lingkungan Hidup</p>
                <p class="fw-normal" id="cek" >1. Lingkungan Bersih dan Sehat
                    Menanamkan kesadaran tentang kebersihan pengelolaan kamar mandi dan jamban keluarga, Saluran Pembuangan Air Limbah (SPAL)</p>
                <p class="fw-normal" id="cek" >2. Menanamkan kebiasaan memilah sampah organik dan non organik serta Bahan Berbahaya dan Beracun (B3) di tempat yang benar.</p>
                <p class="fw-normal" id="cek" >3. Mendaur ulang limbah</p>
                <p class="fw-normal" id="cek" >4. Mengadakan lomba/ Pelaksana Terbaik Lingkungan Bersih dan Sehat.</p>
                <p class="fw-normal" id="cek" >5. Peningkatan pengetahuan tentang pengadaan, pemakaian dan penghematan air bersih dan sehat dalam keluarga.</p>
                <p class="fw-normal" id="cek" >6. Kelestarian Lingkungan Hidup</p>
                <p class="fw-normal" id="cek" >7. Pengembangan kualitas lingkungan dan pemukiman, kebersihan dan kesehatan, pada pemukiman yang padat, dalam rangka terwujudnya kota bersih dan sehat (Health Cities).</p>
                <p class="fw-normal" id="cek" >8. Pencegahan banjir dengan tidak menebang pohon sembarangan.
                    Program sejuta pohon sebagai paru-paru kota dan pencegahan polusi udara.</p>
                <p class="fw-normal" id="cek" >9. Pemanfaatan jamban dan air bersih dalam rangka mewujudkan Indonesia Sehat.</p>
                <p class="fw-normal" id="cek" >10. Memasyarakatkan biopori (lubang resapan) untuk mencegah genangan dan resapan airc</p>
               

                <p class="fw-bold fs-4" id="bold">
                    Perencanaan Sehat</p>
                <p class="fw-normal" id="cek" >1. Meningkatkan penyuluhan tentang  pentingnya pemahaman dan kesertaan dalam program keluarga berencana menuju keluarga berkualitas.</p>
                <p class="fw-normal" id="cek" >2. Meningkatkan kemampuan perencanaan kehidupan keluarga sehari-hari dengan berorientasi pada masa depan dengan cara membiasakan menabung.</p>
                <p class="fw-normal" id="cek" >3. Kegiatan Kesatuan Gerak PKK KB-KES dalam upaya meningkatkan cakupan hasil pelayanan KB-KES.</p>
                <p class="fw-normal" id="cek" >4. Peringatan Hari Keluarga Nasional (HARGANAS) dalam upaya peningkatan ketahanan keluarga untuk mewujudkan keluarga berkualitas.</p>
                <p class="fw-normal" id="cek" >5. Meningkatkan penyuluhan kesehatan reproduksi bagi remaja dan calon pengantin.</p>
                <p class="fw-normal" id="cek" >6. Mengatur keseimbangan antara pemasukan dan pengeluaran keuangan keluarga.</p>
                

                
            </div>
        </div>
        
      </section><!-- End About Section -->

      <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">
                <p class="fw-bold fs-4 text-center" id="bold">Pengembangan Kehidupan Berkoperasi</p></br>
                {{-- <p class="fw-normal" id="cek" >Kegiatan gotong royong dilaksanakan dengan membangun kerjasama yang baik antar sesama: keluarga, warga dan kelompok untuk mewujudkan semangat persatuan dan kesatuan.</p></br> --}}
                {{-- <p class="fw-bold fs-4" id="bold">Misi Tim Penggerak PKK :</p></br> --}}
            <div id="cek">
                <p class="fw-normal">1. Melaksanakan evaluasi UP2K-PKK dan mengadakan lomba UP2K untuk mengetahui sejauh mana pelaksanaan kegiatan UP2K-PKK didaeah dan mengetahuai keberhasilannya.</p>
                <p class="fw-normal">2. Mengadakan pelatihan UP2K-PKK dalam rangka meningkatkan pengetahuan tentang program UP2K-PKK agar TP PKK Provinsi mempunyai tenaga terampil dalam pengembangan program UP2K-PKK</p>
                <p class="fw-normal">4. Mendata ulang jumlah kelompok-kelompok UP2K-PKK</p>
                <p class="fw-normal">5. Mengatatasi cara pemecahan masalah mengenai permodalan untuk kegiatan UP2K PKK melalui APBD, Lembaga Keuangan Mikro yang ada, baik yang bersifat bank seperti BRI Unit Desa, Bank Perkreditan Rakyat, Program Nasional Pemberdayaan Masyarakat (PNPM) Mandiri Pedesaan, Alokasi Dana Desa (ADD) dan lain lain.</p>
                <p class="fw-normal">6. Mengupayakan pemasaran UP2K PKK melalui pasar, warung, ikut pada pameran, bazar baik lokal maupun nasional dan menjalin kemitraan dengan Dekranas / Dekranasda.</p>
                <p class="fw-normal">7. Memotifasi keluarga agar mau menjadi anggota koperasi untuk meningkatkan pendapatan keluarga.</p>
                <p class="fw-normal">8. Mendorong terbentuknya koperasi yang berbadan hukum yang dikelola oleh TP PKK</p>
                <p class="fw-normal">9. Dalam pelaksanaa prioritas program disesuaikan dengan kemampuan daerah dan menjalin kemitraan dengan instansi terkait.</p>
            </div>
          
        
      </section><!-- End About Section -->
  </section><!-- End Service Details Section -->

      
</section><!-- End Services Section -->
@endsection
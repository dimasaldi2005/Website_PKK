@extends('frontend/layouts.template')

@section('content')

<section id="heroo" class="d-flex align-items-center">
  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <!-- <h1>Selamat Datang <span>PKK Kabupaten Nganjuk</span></h1> -->
    <h2 class="">Sekilas Tentang</h2>
          <h4 class="">Kelompok Kerja 2</h4>
          <p class="">
            Membidangi Pendidikan & Peningkatan Ekonomi Keluarga, </br>mengelola program pendidikan &keterampilan, </br>serta pengembangan kehidupan berkoperasi.
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
                <p class="fw-bold fs-4 text-center" id="bold">Misi Pokja 2 :</p></br>
                <p class="fw-normal text-center" id="cek" >Menumbuhkan lingkungan keluarga yang cerdas, kreatif, terampil, sejahtera dan mandiri melalui upaya Pendidikan, peningkatan keterampilan dan pengembangan kehidupan berkoperasi.</p></br>
                <p class="fw-bold fs-4 text-center" id="bold">Program Pokok Pokja 2 :</p></br>
            <div id="cek">
                <p class="fw-normal text-center">Pendidikan dan Keterampilan</p>
                <p class="fw-normal text-center">Pengembangan Kehidupan Berkoperasi</p>
              
            </div>
        </div>
        
      </section><!-- End About Section -->
      
      <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">
          <p class="fw-bold fs-4 text-center" id="bold">Tugas :</p></br>
          
          <div id="cek">
          <p class="fw-normal">1. Meningkatkan pendidikan dan ketrampilan dalam keluarga, peningkatan jenis dan mutu kader, peningkatan pengetahuan TP PKK dan kelompok-kelompok PKK dan Dasawisma melalui penyuluhan, orientasi dan pelatihan.</p>
          <p class="fw-normal">2. Melaksanakan dan mengembangkan kegiatan program Bina Keluarga Balita (BKB).</p>
          <p class="fw-normal">3. Memantapkan Kelompok Belajar (Kejar) Paket A dan B dan C</p>
          <p class="fw-normal">4. Meningkatkan pengetahuan dan menumbuhkan kesadaran dalam keluarga tentang pentingnya pendidikan anak sejak usia dini (0-6) tahun agar anak tumbuh dan berkembang secara optimal sesuai dengan usianya.</p>
          <p class="fw-normal">5. Membantu program Keaksaraan Fungsional (KF) dalam rangka meningkatkan pendidikan keluarga.</p>
          <p class="fw-normal">6. Meningkatkan kelompok dan kualitas Usaha Peningkatan Pendapatan Keluarga (UP2K) PKK.</p>
          <p class="fw-normal">7. Memotivasi keluarga tentang manfaat koperasi sebagai salah satu upaya perbaikan ekonomi keluarga dan mendorong terbentuknya koperasi yang dikelola oleh PKK.</p>
          <p class="fw-normal">9. Identifikasi kebutuhan pelatihan.</p>
          <p class="fw-normal">10. Menyusun modul-modul pelatihan.</p>
          <p class="fw-normal">11. Berparitisipasi dalam Forum PAUD bekerjasama dengan Pokja IV yang difasilitasi oleh Kementerian Pendidikan Nasional.</p>
          <p class="fw-normal">12. Meningkatkan pengetahuan masyarakt tentang pentingnya pendidikan dasar untuk semua sesuai dengan tujuan MGDs yaitu agar setiap anak laki-laki dan perempuan mendapatkan dan menyelesaikan pendidikan dasar.</p>

          </div>
        </div>
        
      </section><!-- End About Section -->

      <section id="about" class="about ">
        <img src="{{ asset ('frontend/assets/p.jpeg')}}" alt="" class="rounded float-start" style="min-height: 1000px;"
         >
        <div class="container" data-aos="fade-up">
          
                <p class="fw-bold fs-4 text-center" id="bold">PRIORITAS PROGRAM</p></br>
                <p class="fw-bold fs-4" id="bold">
                    Pendidikan dan Ketrampilan</p>
                <p class="fw-normal" id="cek" >1. Meningkatkan kemampuan yang berkaitan dengan pengetahuan, kesadaran dan ketrampilan keluarga yang mempunyai anak balita mengenai tumbuh kembang anak balita secara optimal.</p>
                <p class="fw-normal" id="cek" >2. Menyusun modul pelatihan BKB bagi TP PKK dan mengadakan pelatihan BKB</p>
                <p class="fw-normal" id="cek" >3. Meningkatkan mutu dan jumlah pelatih PKK dengan mengadakan pelatihan pelatih/ Training of Trainer (TOT).</p>
                <p class="fw-normal" id="cek" >4. Menyempurnakan modul-modul pelatihan TPK3PKK, LP3PKK dan DAMAS PKK sesuai dengan perkembangan serta mensosialisasikannya antara lain melalui pelatihan-pelatihan : TPK3PKK, LP3PKK dan DAMAS PKK.</p>
                <p class="fw-normal" id="cek" >5. Meningkatkan pengetahuan TP PKK dalam kegiatan Pos PAUD melalui kegiatan PAUD yang diintegrasikan dengan BKB dan Posyandu dengan pertemuan mitra PAUD bekerja sama dengan Pokja IV.</p>
                <p class="fw-normal" id="cek" >6. Meningkatkan jumlah, pengetahuan dan ketrampilan kader dalam mendidik anak usia dini melalui pelatihan bekerja sama dengan instansi terkait dan HIMPAUDI.</p>
                <p class="fw-normal" id="cek" >7. Meningkatkan ketrampilan kecakapan hidup (LIFE SKILL) perempuan maupun laki laki sehingga mampu berusaha secara bersama atau mandiri untuk memperkuat kehidupan diri dan keluarganya.</p>
                <p class="fw-normal" id="cek" >8. Mengadakan monitoring dan evaluasi kegiatan Pos PAUD di TP PKK Provinsi untuk mengetahui sejauh mana pengintegrasian PAUD, BKB dan Posyandu</p>
                <p class="fw-normal" id="cek" >9. Meningkatkan kejar Paket A, B dan C melalui pelatihan Tutor Kejar Paket A, B dan C bekerja sama dengan instansi terkait.</p>
                <p class="fw-normal" id="cek" >10. Meningkatkan dan menyuluh keluarga tentang Wajib Belajar Pendidikan Dasar Sembilan Tahun (WAJAR DIKDAS 9 tahun)</p>
                <p class="fw-normal" id="cek" >11. Meningkatkan pendidikan dan ketrampilan keluarga serta pengembangan Keaksaraan Fungsional (KF) dengan pendampingan melalui penyuluhan, orientasi dan pelatihan.</p>
                <p class="fw-normal" id="cek" >12. Meningkatkan pengetahuan dan kemampuan baca tulis, serta membudayakan minat baca masyarakat melalui Taman Bacaan Masyarakat (TBM) dan Sudut Baca bekerja sama dengan instansi terkait.</p>
                <p class="fw-normal" id="cek" >13. Meningkatkan pelaksanaan kerjasama dengan mitra sebagai pendamping, yaitu lintas sektoral dan lintas kelembagaan.</p>

                
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
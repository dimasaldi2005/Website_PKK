@extends('frontend/layouts.template')

@section('content')

    <div id="cekk">
    <p class="text-center fs-1">Arti Lambang PKK</p>
    </div>

        <!-- Breadcrumb -->
        <div class="container">
            <nav aria-label="breadcrumb" style="background-color: #fff" class="mt-3">
                <ol class="breadcrumb p-3">
                    <li class="breadcrumb-item"><a href="landing-page" class="text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active"><a aria-current="page" value="">Arti Lambang PKK</a></li>
                </ol>
            </nav>
        </div>

      <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-4 rounded mx-auto d-block" data-aos="fade-right" data-aos-delay="100">
                <img src="{{ asset ('frontend/assets/img/logopkk.png')}}" class="img-fluid" alt="" style="margin-top: 10px">
              </div>
                <p class="fw-bold fs-4" id="bold">Warna :</p></br>
                <p class="fw-normal" id="cek" >a. Biru melambangkan suasana damai, aman, tenteram dan sejahtera</p>
                <p class="fw-normal" id="cek" >b. Putih melambangkan kesucian dan ketulusan untuk satu tujuan dan itikad</p>
                <p class="fw-normal" id="cek" >c. Kuning melambangkan keagungan dan cita - cita. Hitam melambangkan kekekalan/keabadian</p>
                <p class="fw-bold fs-4" id="bold">Komponen :</p></br>
            <div id="cek">
                <p class="fw-normal">a. Segilima melambangkan Pancasila sebagai dasar Gerakan PKK</p>
                <p class="fw-normal">b. Bintang melambangkan Ketuhanan Yang Maha Esa</p>
                <p class="fw-normal">c. 17 butir kapas, 8 buah simpul pengikat, 45 butir padi melambangkan kemerdekaan RI dan 
                    kemakmuran Akolade melingkar melambangkan wahana partisipasi masyarakat - masyarakat 
                    dalam pembangunan yang memadukan pelaksanaan segala kegiatan dan prakarsa serta 
                    swadaya gotong royong masyarakat dalam segala aspek kehidupan dan penghidupan untuk 
                    mewujudkan Ketahanan Nasional. Rangkaian Mata Rantai melambangkan masyarakat yang 
                    terdiri dari keluarga - keluarga sebagi unit terkecil yang merupakan sasaran Gerakan PKK.</p>
                <p class="fw-normal">d. Lingkaran Putih melambangkan Pemberdayaan dan Kesejahteraan Keluarga dilaksanakan 
                    secara terus menerus dan berkesinambungan. </p>
                <p class="fw-normal">e. 10 buah ujung tombak yang tersusun merupakan bunga melambangkan gerakan masyarakat 
                    dalam pembangunan dengan melaksanakan 10 Program Pokok PKK dan sasarannya keluarga 
                    sebagai unit terkecil dalam masyarakat.</p>
            </div>
          
        
      </section><!-- End About Section -->
  

      
</section><!-- End Services Section -->
@endsection
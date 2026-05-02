@extends('frontend/layouts.template')

@section('content')

<section class="lambang-section" style="background-color: #f5f5f5; padding: 60px 0; min-height: 100vh;">
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 36px; color: #1a1a1a; margin-bottom: 10px;">Arti Dan Lambang PKK</h1>
            <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 18px; color: #666;">Kabupaten Nganjuk</p>
        </div>

        <!-- Logo PKK -->
        <div class="text-center mb-5">
            <img src="{{ asset ('frontend/assets/img/logopkk.png')}}" alt="Logo PKK" style="max-width: 250px; height: auto;">
        </div>

        <!-- Warna Section -->
        <div class="mb-5" style="max-width: 900px; margin-left: auto; margin-right: auto;">
            <h2 style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 24px; color: #1a1a1a; margin-bottom: 20px;">Warna :</h2>
            
            <div style="margin-bottom: 15px;">
                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin: 0;">
                    <strong>a.</strong> Biru melambangkan suasana damai, aman, tenteram dan sejahtera
                </p>
            </div>

            <div style="margin-bottom: 15px;">
                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin: 0;">
                    <strong>b.</strong> Putih melambangkan kesucian dan ketulusan untuk satu tujuan dan itikad
                </p>
            </div>

            <div>
                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin: 0;">
                    <strong>c.</strong> Kuning melambangkan keagungan dan cita - cita. Hitam melambangkan kekekalan/keabadian
                </p>
            </div>
        </div>

        <!-- Komponen Section -->
        <div style="max-width: 900px; margin-left: auto; margin-right: auto;">
            <h2 style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 24px; color: #1a1a1a; margin-bottom: 20px;">Komponen :</h2>
            
            <div style="margin-bottom: 20px;">
                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin: 0;">
                    <strong>a.</strong> Segilima melambangkan Pancasila sebagai dasar Gerakan PKK
                </p>
            </div>

            <div style="margin-bottom: 20px;">
                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin: 0;">
                    <strong>b.</strong> Bintang melambangkan Ketuhanan Yang Maha Esa
                </p>
            </div>

            <div style="margin-bottom: 20px;">
                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin: 0;">
                    <strong>c.</strong> 17 butir kapas, 8 buah simpul pengikat, 45 butir padi melambangkan kemerdekaan RI dan kemakmuran Akolade melingkar melambangkan wahana partisipasi masyarakat - masyarakat dalam pembangunan yang memadukan pelaksanaan segala kegiatan dan prakarsa serta swadaya gotong royong masyarakat dalam segala aspek kehidupan dan penghidupan untuk mewujudkan Ketahanan Nasional. Rangkaian Mata Rantai melambangkan masyarakat yang terdiri dari keluarga - keluarga sebagai unit terkecil yang merupakan sasaran Gerakan PKK.
                </p>
            </div>

            <div style="margin-bottom: 20px;">
                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin: 0;">
                    <strong>d.</strong> Lingkaran Putih melambangkan Pemberdayaan dan Kesejahteraan Keluarga dilaksanakan secara terus menerus dan berkesinambungan.
                </p>
            </div>

            <div>
                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin: 0;">
                    <strong>e.</strong> 10 buah ujung tombak yang tersusun merupakan bunga melambangkan gerakan masyarakat dalam pembangunan dengan melaksanakan 10 Program Pokok PKK dan sasarannya keluarga sebagai unit terkecil dalam masyarakat.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
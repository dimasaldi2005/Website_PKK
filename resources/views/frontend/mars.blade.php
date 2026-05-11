@extends('frontend/layouts.template')

@section('content')

<section class="mars-section" style="background-color: #f5f5f5; padding: 60px 0; min-height: 100vh;">
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 36px; color: #1a1a1a; margin-bottom: 10px;">Mars PKK</h1>
            <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 18px; color: #666;">Kabupaten Nganjuk</p>
        </div>

        <!-- Content with 2 columns -->
        <div class="row align-items-start" style="max-width: 1200px; margin: 0 auto;">
            <!-- Left Column - Mars Text -->
            <div class="col-lg-6 col-md-12 mb-4">
                <!-- Bait 1 -->
                <div style="margin-bottom: 35px;">
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Marilah hai Rakyat Indonesia
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Membangun segera
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Membangun kluarga yang sejahtera
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 0;">
                        Dengan PKK
                    </p>
                </div>

                <!-- Bait 2 -->
                <div style="margin-bottom: 35px;">
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Hayatilah dan amalkan Pancasila
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Untuk negara
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Hidup gotong royong, makmur pangan dan sandang
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 0;">
                        Rumah sehat sentosa
                    </p>
                </div>

                <!-- Bait 3 -->
                <div style="margin-bottom: 35px;">
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Tata laksana di dalam rumah tangga
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Rapi dan indah
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Didiklah putra berpribadi bangsa
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 0;">
                        Trampil dan sehat
                    </p>
                </div>

                <!-- Bait 4 -->
                <div>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Kembangkan koprasi jagalah lingkungan
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Dan sekitarnya
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 8px;">
                        Aman dan bahagia kluarga berencana
                    </p>
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; color: #4a4a4a; line-height: 1.8; margin-bottom: 0;">
                        Hidup jaya PKK
                    </p>
                </div>
            </div>

            <!-- Right Column - YouTube Video -->
            <div class="col-lg-6 col-md-12">
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    <iframe 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" 
                        src="https://www.youtube.com/embed/x3l71HRDwbs" 
                        title="Mars PKK" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
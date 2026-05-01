<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags dan CSS tetap sama seperti halaman login -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- style -->
    <link rel="stylesheet" href="frontend/assets/css/login.css">
</head>

<body>
    <section class="scrollbar-hidden-x h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-1 text-black">
                        <div class="row g-0">

                            <!-- Bagian kiri (sama dengan login) -->
                            <div class="col-lg-6 align-items-center background-blue-1">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4 text-center m-auto">
                                    <h4 class="mb-4 mt-4">PKK KABUPATEN NGANJUK</h4>
                                    <p class="small mb-5">Pusat Informasi Seputar Kegiatan PKK di Kabupaten Nganjuk</p>
                                    <img src="frontend/assets/img/favicon.png" style="width: 200px;" alt="logo"
                                        class="mb-5">
                                </div>
                            </div>

                            <!-- Bagian kanan (form registrasi) -->
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <h2 class="mt-1 mb-5 pb-1 font-col">Daftar Akun</h2>
                                    </div>

                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf

                                        <!-- Nama Lengkap -->
                                        <div class="form-outline mb-4">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror" required
                                                placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="form-outline mb-4">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror" required
                                                placeholder="Masukkan Email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="form-outline mb-4">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror" required
                                                placeholder="Buat Password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Konfirmasi Password -->
                                        <div class="form-outline mb-4">
                                            <label for="password_confirmation" class="form-label">Konfirmasi
                                                Password</label>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation" class="form-control" required
                                                placeholder="Ulangi Password">
                                        </div>

                                        <!-- Dropdown Kecamatan -->
                                        <div class="form-outline mb-4">
                                            <label for="kecamatan" class="form-label">Kecamatan</label>
                                            <select name="kecamatan" id="kecamatan"
                                                class="form-select @error('kecamatan') is-invalid @enderror" required>
                                                <option value="">Pilih Kecamatan</option>
                                                <option value="Kecamatan 1">Kecamatan 1</option>
                                                <option value="Kecamatan 2">Kecamatan 2</option>
                                                <option value="Kecamatan 3">Kecamatan 3</option>
                                                <!-- Tambahkan options sesuai data kecamatan -->
                                            </select>
                                            @error('kecamatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Dropdown Desa -->
                                        <div class="form-outline mb-4">
                                            <label for="desa" class="form-label">Desa</label>
                                            <select name="desa" id="desa"
                                                class="form-select @error('desa') is-invalid @enderror" required>
                                                <option value="">Pilih Desa</option>
                                                <option value="Desa 1">Desa 1</option>
                                                <option value="Desa 2">Desa 2</option>
                                                <option value="Desa 3">Desa 3</option>
                                                <!-- Tambahkan options sesuai data desa -->
                                            </select>
                                            @error('desa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Dropdown Role Bidang -->
                                        <div class="form-outline mb-5">
                                            <label for="role_bidang" class="form-label">Role Bidang</label>
                                            <select name="role_bidang" id="role_bidang"
                                                class="form-select @error('role_bidang') is-invalid @enderror" required>
                                                <option value="">Pilih Role</option>
                                                <option value="Ketua">Ketua</option>
                                                <option value="Sekretaris">Sekretaris</option>
                                                <option value="Bendahara">Bendahara</option>
                                                <option value="Anggota">Anggota</option>
                                            </select>
                                            @error('role_bidang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button type="submit"
                                                class="btn btn-primary form-control background-blue-1 mb-3 fw-semibold fs-5">
                                                Daftar
                                            </button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Sudah punya akun?</p>
                                            <a href="{{ route('login') }}" class="text-primary">Masuk di sini</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts tetap sama -->
    <!-- Vendor JS Files -->
    <script src="backend/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ... (script lainnya) ... -->

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
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
    <section class="scrollbar-hidden-x hmin-vh-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-1 text-black">
                        <div class="row g-0">

                            <!-- Bagian kiri -->
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

                                        <!-- Jenis Kantor Baru -->
                                        <div class="form-outline mb-4">
                                            <label for="jenis_kantor" class="form-label">Jenis Kantor</label>
                                            <select name="jenis_kantor" id="jenis_kantor"
                                                class="form-select @error('jenis_kantor') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Jenis Kantor</option>
                                                <option value="kecamatan">Kantor Kecamatan</option>
                                                <option value="desa">Kantor Desa</option>
                                            </select>
                                            @error('jenis_kantor')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

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
                                                class="form-select @error('kecamatan') is-invalid @enderror">
                                                <option value="">Pilih Kecamatan</option>
                                                <option value="Sawahan">Sawahan</option>
                                                <option value="Ngetos">Ngetos</option>
                                                <option value="Berbek">Berbek</option>
                                                <option value="Loceret">Loceret</option>
                                                <option value="Pace">Pace</option>
                                                <option value="Tanjunganom">Tanjunganom</option>
                                                <option value="Prambon">Prambon</option>
                                                <option value="Ngronggot">Ngronggot</option>
                                                <option value="Kertosono">Kertosono</option>
                                                <option value="Patianrowo">Patianrowo</option>
                                                <option value="Baron">Baron</option>
                                                <option value="Gondang">Gondang</option>
                                                <option value="Sukomoro">Sukomoro</option>
                                                <option value="Nganjuk">Nganjuk</option>
                                                <option value="Bagor">Bagor</option>
                                                <option value="Wilangan">Wilangan</option>
                                                <option value="Rejoso">Rejoso</option>
                                                <option value="Ngluyu">Ngluyu</option>
                                                <option value="Lengkong">Lengkong</option>
                                                <option value="Jatikalen">Jatikalen</option>
                                            </select>
                                            @error('kecamatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Dropdown Desa -->
                                        <div class="form-outline mb-4">
                                            <label for="desa" class="form-label">Desa</label>
                                            <select name="desa" id="desa"
                                                class="form-select @error('desa') is-invalid @enderror">
                                                <option value="">Pilih Desa</option>
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
                                                <option value=" Pokja 1">Pokja 1</option>
                                                <option value="Pokja 2">Pokja 2</option>
                                                <option value="Pokja 3">Pokja 3</option>
                                                <option value="Pokja 4">Pokja 4</option>
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

    <script>
        // Inisialisasi elemen dropdown
        const jenisKantor = document.getElementById('jenis_kantor');
        const kecamatanSelect = document.getElementById('kecamatan');
        const desaSelect = document.getElementById('desa');

        // Fungsi untuk mengatur status dropdown
        function updateDropdowns() {
            const selectedJenis = jenisKantor.value;

            // Reset semua kondisi
            kecamatanSelect.disabled = true;
            desaSelect.disabled = true;
            kecamatanSelect.required = false;
            desaSelect.required = false;

            if (selectedJenis === 'kecamatan') {
                kecamatanSelect.disabled = false;
                kecamatanSelect.required = true;
                desaSelect.value = ''; // Kosongkan nilai desa
            } else if (selectedJenis === 'desa') {
                kecamatanSelect.disabled = false;
                desaSelect.disabled = false;
                kecamatanSelect.required = true;
                desaSelect.required = true;
            }
        }

        // Event listener untuk jenis kantor
        jenisKantor.addEventListener('change', updateDropdowns);

        // Fungsi untuk memuat data desa
        async function loadDesaData() {
            const response = await fetch('/Data_desa/data_desa.json');
            return await response.json();
        }

        // Event listener untuk perubahan kecamatan
        kecamatanSelect.addEventListener('change', async function () {
            const selectedKecamatan = this.value;
            desaSelect.innerHTML = '<option value="">Pilih Desa</option>';

            if (selectedKecamatan) {
                const desaData = await loadDesaData();
                const desaList = desaData[selectedKecamatan];

                if (desaList) {
                    desaList.forEach(desa => {
                        const option = document.createElement('option');
                        option.value = desa;
                        option.textContent = desa;
                        desaSelect.appendChild(option);
                    });
                }
            }
        });

        // Inisialisasi awal
        window.addEventListener('DOMContentLoaded', function () {
            updateDropdowns();
            if (kecamatanSelect.value) {
                kecamatanSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>

    <!-- Vendor JS Files -->
    <script src="backend/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ... (script lainnya) ... -->

</body>

</html>
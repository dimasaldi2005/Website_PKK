<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - PKK Nganjuk</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .background-blue-1 {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }

        .card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .form-floating>label {
            padding: 1rem 1.25rem;
            color: #6c757d;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(30, 60, 114, 0.25);
            border-color: #1e3c72;
        }

        .btn-primary {
            background-color: #1e3c72;
            border-color: #1e3c72;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2a5298;
            border-color: #2a5298;
        }

        .divider {
            display: block;
            width: 80px;
            height: 3px;
            background: #1e3c72;
            margin: 1.5rem auto;
        }
    </style>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 overflow-hidden">
                        <div class="row g-0">
                            <!-- Left Side -->
                            <div class="col-lg-6 d-flex align-items-center background-blue-1">
                                <div class="text-white p-4 p-md-5 text-center w-100">
                                    <h4 class="mb-4 mt-2 fw-bold display-5">PKK KABUPATEN NGANJUK</h4>
                                    <p class="lead mb-5 opacity-75">Pusat Informasi Kegiatan PKK Kabupaten Nganjuk</p>
                                    <img src="frontend/assets/img/favicon.png" class="img-fluid mb-4"
                                        style="max-width: 200px; filter: drop-shadow(2px 2px 6px rgba(0,0,0,0.3))"
                                        alt="Logo PKK">
                                </div>
                            </div>

                            <!-- Right Side -->
                            <div class="col-lg-6">
                                <div class="card-body p-md-5">
                                    <div class="text-center mb-5">
                                        <h2 class="h1 fw-bold text-primary mb-3">Daftar Akun</h2>
                                        <div class="divider"></div>
                                    </div>

                                    @if($errors->any())
                                        <div class="alert alert-danger mb-4">
                                            <ul class="mb-0 ps-3">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf

                                        <div class="row g-3">
                                            <!-- Jenis Kantor -->
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <select class="form-select" id="jenis_kantor" name="jenis_kantor"
                                                        required>
                                                        <option value="">Pilih Jenis Kantor</option>
                                                        <option value="kecamatan">Kantor Kecamatan</option>
                                                        <option value="desa">Kantor Desa</option>
                                                    </select>
                                                    <label for="jenis_kantor">Jenis Kantor</label>
                                                </div>
                                            </div>

                                            <!-- Nama Lengkap -->
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Nama Lengkap" required>
                                                    <label for="name">Nama Lengkap</label>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Email" required>
                                                    <label for="email">Alamat Email</label>
                                                </div>
                                            </div>

                                            <!-- Password -->
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" placeholder="Password" required>
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>

                                            <!-- Konfirmasi Password -->
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <input type="password" class="form-control"
                                                        id="password_confirmation" name="password_confirmation"
                                                        placeholder="Konfirmasi Password" required>
                                                    <label for="password_confirmation">Konfirmasi Password</label>
                                                </div>
                                            </div>

                                            <!-- Kecamatan -->
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <select class="form-select" id="kecamatan" name="kecamatan">
                                                        <option value="">Pilih Kecamatan</option>
                                                        <!-- Kecamatan Options -->
                                                    </select>
                                                    <label for="kecamatan">Kecamatan</label>
                                                </div>
                                            </div>

                                            <!-- Desa -->
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <select class="form-select" id="desa" name="desa">
                                                        <option value="">Pilih Desa</option>
                                                    </select>
                                                    <label for="desa">Desa</label>
                                                </div>
                                            </div>

                                            <!-- Role Bidang -->
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <select class="form-select" id="role_bidang" name="role_bidang"
                                                        required>
                                                        <option value="">Pilih Role</option>
                                                        <option value="Pokja 1">Pokja 1</option>
                                                        <option value="Pokja 2">Pokja 2</option>
                                                        <option value="Pokja 3">Pokja 3</option>
                                                        <option value="Pokja 4">Pokja 4</option>
                                                    </select>
                                                    <label for="role_bidang">Role Bidang</label>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-12 mt-4">
                                                <button class="btn btn-primary w-100 py-3 fw-bold" type="submit">
                                                    Daftar Sekarang
                                                </button>
                                            </div>

                                            <!-- Login Link -->
                                            <div class="col-12 text-center mt-4">
                                                <p class="mb-0">Sudah punya akun?
                                                    <a href="{{ route('login') }}" class="text-primary fw-semibold">
                                                        Masuk disini
                                                    </a>
                                                </p>
                                            </div>
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

    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jenisKantor = document.getElementById('jenis_kantor');
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaSelect = document.getElementById('desa');

            // Update dropdown status
            function updateDropdowns() {
                const selectedType = jenisKantor.value;

                kecamatanSelect.disabled = true;
                desaSelect.disabled = true;
                kecamatanSelect.required = false;
                desaSelect.required = false;

                if (selectedType === 'kecamatan') {
                    kecamatanSelect.disabled = false;
                    kecamatanSelect.required = true;
                } else if (selectedType === 'desa') {
                    kecamatanSelect.disabled = false;
                    desaSelect.disabled = false;
                    kecamatanSelect.required = true;
                    desaSelect.required = true;
                }
            }

            // Load Desa Data
            async function loadDesa() {
                const response = await fetch('/Data_desa/data_desa.json');
                return await response.json();
            }

            // Kecamatan Change Handler
            kecamatanSelect.addEventListener('change', async function () {
                const kecamatan = this.value;
                desaSelect.innerHTML = '<option value="">Pilih Desa</option>';

                if (kecamatan) {
                    const data = await loadDesa();
                    const desaList = data[kecamatan];

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

            // Initial Setup
            jenisKantor.addEventListener('change', updateDropdowns);
            updateDropdowns();
        });
    </script>
</body>

</html>
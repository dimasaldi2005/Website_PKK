<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Kata Sandi - PKK Kabupaten Nganjuk</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
      height: 100vh;
      position: relative;
    }

    /* Video Background Full Screen */
    .video-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1;
    }

    /* Container */
    .forgot-container {
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      min-height: 100vh;
      padding: 20px;
      padding-right: 80px;
    }

    /* Glassmorphism Card */
    .glass-card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(40px) saturate(200%);
      -webkit-backdrop-filter: blur(40px) saturate(200%);
      border-radius: 32px;
      padding: 60px 50px;
      width: 100%;
      max-width: 520px;
      box-shadow: 
        0 8px 32px rgba(31, 38, 135, 0.1),
        0 2px 8px rgba(0, 0, 0, 0.05),
        inset 0 1px 1px rgba(255, 255, 255, 0.6),
        inset 0 -1px 1px rgba(255, 255, 255, 0.2);
      border: 1.5px solid rgba(255, 255, 255, 0.3);
      animation: fadeInUp 0.6s ease-out;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .glass-card:hover {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(50px) saturate(220%);
      -webkit-backdrop-filter: blur(50px) saturate(220%);
      box-shadow: 
        0 12px 48px rgba(31, 38, 135, 0.2),
        0 4px 16px rgba(0, 0, 0, 0.1),
        inset 0 2px 4px rgba(255, 255, 255, 0.8),
        inset 0 -2px 4px rgba(255, 255, 255, 0.4),
        inset -2px -2px 8px rgba(0, 0, 0, 0.05),
        inset 2px 2px 8px rgba(255, 255, 255, 0.6);
      border: 1.5px solid rgba(255, 255, 255, 0.5);
      transform: translateY(-5px) scale(1.02);
    }

    /* Logo Section */
    .logo-section {
      text-align: center;
      margin-bottom: 40px;
    }

    .logo-section h1 {
      font-size: 24px;
      font-weight: 600;
      color: #2c3e50;
      margin: 0 0 16px 0;
      line-height: 1.3;
    }

    .logo-section p {
      font-size: 14px;
      font-weight: 400;
      color: #7f8c8d;
      margin: 0;
      line-height: 1.6;
    }

    /* Form Styles */
    .form-group {
      margin-bottom: 28px;
    }

    .form-group label {
      display: block;
      font-size: 15px;
      font-weight: 500;
      color: #7f8c8d;
      margin-bottom: 10px;
    }

    .form-group input {
      width: 100%;
      padding: 16px 20px;
      font-size: 15px;
      font-family: 'Poppins', sans-serif;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 16px;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.4);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      color: #2c3e50;
    }

    .form-group input::placeholder {
      color: #bdc3c7;
    }

    .form-group input:focus {
      outline: none;
      border-color: rgba(8, 145, 178, 0.6);
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      box-shadow: 
        0 0 0 4px rgba(8, 145, 178, 0.1),
        0 4px 12px rgba(8, 145, 178, 0.15);
      transform: translateY(-2px);
    }

    .alert {
      padding: 14px 18px;
      border-radius: 12px;
      margin-bottom: 24px;
      font-size: 14px;
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
    }

    .alert-success {
      background: rgba(212, 237, 218, 0.6);
      color: #155724;
      border: 1px solid rgba(195, 230, 203, 0.5);
    }

    .alert-danger {
      background: rgba(248, 215, 218, 0.6);
      color: #721c24;
      border: 1px solid rgba(245, 198, 203, 0.5);
    }

    .alert ul {
      margin: 0;
      padding-left: 20px;
    }

    /* Button */
    .btn-submit {
      width: 100%;
      padding: 16px;
      font-size: 17px;
      font-weight: 600;
      font-family: 'Poppins', sans-serif;
      color: white;
      background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
      border: none;
      border-radius: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 15px;
      box-shadow: 0 4px 16px rgba(8, 145, 178, 0.3);
    }

    .btn-submit:hover {
      background: linear-gradient(135deg, #0e7490 0%, #155e75 100%);
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(8, 145, 178, 0.4);
    }

    .btn-submit:active {
      transform: translateY(-1px);
    }

    /* Link */
    .whatsapp-link {
      text-align: center;
      margin-top: 24px;
    }

    .whatsapp-link a {
      color: #0891b2;
      font-size: 14px;
      text-decoration: none;
      transition: color 0.3s ease;
      font-weight: 500;
    }

    .whatsapp-link a:hover {
      color: #0e7490;
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .forgot-container {
        justify-content: center;
        padding: 20px;
      }

      .glass-card {
        padding: 40px 30px;
        border-radius: 24px;
        max-width: 100%;
      }

      .logo-section img {
        width: 70px;
        height: 70px;
      }

      .logo-section h1 {
        font-size: 20px;
      }

      .logo-section p {
        font-size: 13px;
      }

      .form-group input {
        padding: 14px 16px;
        font-size: 14px;
      }

      .btn-submit {
        padding: 14px;
        font-size: 16px;
      }
    }

    @media (max-width: 480px) {
      .forgot-container {
        padding: 15px;
      }

      .glass-card {
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>

  <!-- Video Background Full Screen -->
  <video class="video-background" autoplay loop muted playsinline>
    <source src="{{ asset('frontend/assets/img/backgroundlogin.MP4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Forgot Password Container -->
  <div class="forgot-container">
    <!-- Glassmorphism Card -->
    <div class="glass-card">
      <!-- Logo Section -->
      <div class="logo-section">
        <h1>Lupa Kata Sandi</h1>
        <p>Lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimi Anda tautan setel ulang kata sandi melalui email yang anda inputkan.</p>
      </div>

      <!-- Alert Messages -->
      @if ($message = Session::get('errors'))
      <div class="alert alert-danger" role="alert">
        {{ $message }}
      </div>
      @endif

      @if ($message = Session::get('success'))
      <div class="alert alert-success" role="alert">
        {{ $message }}
      </div>
      @endif

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <!-- Form -->
      <form action="{{ route('password.email') }}" method="POST">
        @csrf
        
        <div class="form-group">
          <label for="email">Email :</label>
          <input 
            type="email" 
            name="email" 
            id="email"
            required 
            oninvalid="this.setCustomValidity('Harap masukkan email anda')"
            oninput="this.setCustomValidity('')"
            placeholder="Masukkan email anda"
          />
        </div>

        <button type="submit" class="btn-submit">Kirim</button>

        <div class="whatsapp-link">
          <a href="{{ url('/otp') }}">Atur sandi dengan nomor WhatsApp</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>
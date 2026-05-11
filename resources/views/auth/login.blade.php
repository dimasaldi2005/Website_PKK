<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - PKK Kabupaten Nganjuk</title>

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

    /* Login Container */
    .login-container {
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      min-height: 100vh;
      padding: 20px;
      padding-right: 80px;
    }

    /* Glassmorphism Card - iOS 26 Style */
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

    /* Logo Section */
    .logo-section {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      margin-bottom: 50px;
    }

    .logo-section img {
      width: 90px;
      height: 90px;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
    }

    .logo-text {
      text-align: left;
    }

    .logo-text h1 {
      font-size: 22px;
      font-weight: 600;
      color: #2c3e50;
      margin: 0;
      line-height: 1.3;
    }

    .logo-text .subtitle {
      font-size: 16px;
      font-weight: 400;
      color: #95a5a6;
      margin-top: 2px;
    }

    /* Form Styles */
    .form-group {
      margin-bottom: 28px;
      position: relative;
    }

    .form-group label {
      display: block;
      font-size: 15px;
      font-weight: 500;
      color: #7f8c8d;
      margin-bottom: 10px;
    }

    .password-wrapper {
      position: relative;
      width: 100%;
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

    .password-wrapper input {
      padding-right: 50px;
    }

    .toggle-password {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #7f8c8d;
      font-size: 20px;
      transition: color 0.3s ease;
      user-select: none;
      z-index: 10;
    }

    .toggle-password:hover {
      color: #0891b2;
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

    .form-group input.is-invalid {
      border-color: #e74c3c;
      background: rgba(255, 245, 245, 0.8);
    }

    .invalid-feedback {
      color: #e74c3c;
      font-size: 13px;
      margin-top: 6px;
      display: block;
      font-weight: 500;
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

    /* Button */
    .btn-login {
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

    .btn-login:hover {
      background: linear-gradient(135deg, #0e7490 0%, #155e75 100%);
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(8, 145, 178, 0.4);
    }

    .btn-login:active {
      transform: translateY(-1px);
    }

    /* Forgot Password Link */
    .forgot-password {
      text-align: center;
      margin-top: 24px;
    }

    .forgot-password a {
      color: #7f8c8d;
      font-size: 14px;
      text-decoration: none;
      transition: color 0.3s ease;
      font-weight: 500;
    }

    .forgot-password a:hover {
      color: #0891b2;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .glass-card {
        padding: 40px 30px;
        border-radius: 24px;
        max-width: 100%;
      }

      .logo-section {
        flex-direction: column;
        gap: 15px;
        margin-bottom: 35px;
      }

      .logo-section img {
        width: 70px;
        height: 70px;
      }

      .logo-text {
        text-align: center;
      }

      .logo-text h1 {
        font-size: 18px;
      }

      .logo-text .subtitle {
        font-size: 14px;
      }

      .form-group input {
        padding: 14px 16px;
        font-size: 14px;
      }

      .btn-login {
        padding: 14px;
        font-size: 16px;
      }
    }

    @media (max-width: 480px) {
      .login-container {
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

  <!-- Login Container -->
  <div class="login-container">
    <!-- Glassmorphism Card -->
    <div class="glass-card">
      <!-- Logo Section -->
      <div class="logo-section">
        <img src="{{ asset('frontend/assets/img/favicon.png') }}" alt="Logo PKK">
        <div class="logo-text">
          <h1>Pemberdayaan<br>Kesejahteraan Keluarga</h1>
          <p class="subtitle">Kabupaten Nganjuk</p>
        </div>
      </div>

      <!-- Alert Messages -->
      @if ($message = Session::get('success'))
      <div class="alert alert-success" role="alert">
        {{ $message }}
      </div>
      @endif

      @if ($message = Session::get('reset'))
      <div class="alert alert-success" role="alert">
        {{ $message }}
      </div>
      @endif

      <!-- Login Form -->
      <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="form-group">
          <label for="email">Email atau Nomor WhatsApp :</label>
          <input 
            type="text" 
            name="email" 
            id="email"
            class="@error('email') is-invalid @enderror" 
            required 
            autocomplete="email"
            oninvalid="this.setCustomValidity('Harap lengkapi email/nomor WhatsApp')"
            oninput="this.setCustomValidity('')"
            value="{{ old('email') }}" 
          />
          @error('email')
          <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="password">Kata sandi :</label>
          <div class="password-wrapper">
            <input 
              type="password" 
              name="password" 
              id="password"
              class="@error('password') is-invalid @enderror" 
              required 
              autocomplete="current-password"
              oninvalid="this.setCustomValidity('Harap lengkapi kata sandi anda')"
              oninput="this.setCustomValidity('')"
            />
            <span class="toggle-password" onclick="togglePassword()">
              <svg class="eye-open" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5C7 5 2.73 8.11 1 12.5C2.73 16.89 7 20 12 20C17 20 21.27 16.89 23 12.5C21.27 8.11 17 5 12 5ZM12 17.5C9.24 17.5 7 15.26 7 12.5C7 9.74 9.24 7.5 12 7.5C14.76 7.5 17 9.74 17 12.5C17 15.26 14.76 17.5 12 17.5ZM12 9.5C10.34 9.5 9 10.84 9 12.5C9 14.16 10.34 15.5 12 15.5C13.66 15.5 15 14.16 15 12.5C15 10.84 13.66 9.5 12 9.5Z" fill="currentColor"/>
              </svg>
              <svg class="eye-closed" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <path d="M12 7C14.76 7 17 9.24 17 12C17 12.65 16.87 13.26 16.64 13.83L19.56 16.75C21.07 15.49 22.26 13.86 23 12C21.27 7.61 17 4.5 12 4.5C10.6 4.5 9.26 4.75 8.04 5.2L10.17 7.33C10.74 7.11 11.35 7 12 7ZM2 4.27L4.28 6.55L4.74 7.01C3.08 8.3 1.78 10.02 1 12C2.73 16.39 7 19.5 12 19.5C13.55 19.5 15.03 19.2 16.38 18.66L16.8 19.08L19.73 22L21 20.73L3.27 3L2 4.27ZM7.53 9.8L9.08 11.35C9.03 11.56 9 11.78 9 12C9 13.66 10.34 15 12 15C12.22 15 12.44 14.97 12.65 14.92L14.2 16.47C13.53 16.8 12.79 17 12 17C9.24 17 7 14.76 7 12C7 11.21 7.2 10.47 7.53 9.8ZM11.84 9.02L14.99 12.17L15.01 12.01C15.01 10.35 13.67 9.01 12.01 9.01L11.84 9.02Z" fill="currentColor"/>
              </svg>
            </span>
          </div>
          @error('password')
          <span class="invalid-feedback">Password yang anda masukkan salah</span>
          @enderror
        </div>

        <button type="submit" class="btn-login">Masuk</button>

        <div class="forgot-password">
          <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyeOpen = document.querySelector('.eye-open');
      const eyeClosed = document.querySelector('.eye-closed');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeOpen.style.display = 'none';
        eyeClosed.style.display = 'block';
      } else {
        passwordInput.type = 'password';
        eyeOpen.style.display = 'block';
        eyeClosed.style.display = 'none';
      }
    }
  </script>

</body>

</html>
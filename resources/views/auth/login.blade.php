<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login - SIMILA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #0284c7;
      --primary-dark: #0369a1;
      --navy: #0f172a;
      --navy-light: #1e293b;
      --gray-50: #f8fafc;
      --gray-100: #f1f5f9;
      --gray-200: #e2e8f0;
      --gray-500: #64748b;
      --gray-700: #334155;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    body {
      display: flex;
      min-height: 100vh;
      background-color: var(--gray-50);
      color: var(--gray-700);
    }

    .left-panel {
      flex: 1;
      background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px;
      position: relative;
      overflow: hidden;
    }

    .left-panel::before {
      content: '';
      position: absolute;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%);
      top: -50px;
      left: -50px;
      border-radius: 50%;
    }

    .brand-logo-container {
      background: white;
      padding: 16px;
      border-radius: 20px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
      margin-bottom: 24px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .left-panel img {
      width: 110px;
      height: auto;
      display: block;
    }

    .brand-title {
      font-size: 26px;
      font-weight: 800;
      letter-spacing: 0.5px;
      color: #ffffff;
      margin-bottom: 8px;
      text-align: center;
    }

    .brand-subtitle {
      font-size: 13px;
      color: #94a3b8;
      max-width: 320px;
      text-align: center;
      line-height: 1.5;
    }

    .right-panel {
      flex: 1.2;
      background-color: var(--gray-50);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 24px;
    }

    .login-card {
      width: 100%;
      max-width: 420px;
      background: white;
      padding: 40px 36px;
      border-radius: 20px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.05);
      border: 1px solid var(--gray-200);
    }

    .login-card h2 {
      font-size: 26px;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 6px;
    }

    .login-card p.subtitle {
      font-size: 14px;
      color: var(--gray-500);
      margin-bottom: 28px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--navy-light);
      margin-bottom: 8px;
    }

    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      font-size: 14px;
      border: 1.5px solid var(--gray-200);
      border-radius: 10px;
      outline: none;
      background-color: #fff;
      transition: all 0.2s ease;
    }

    .form-group input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.12);
    }

    .login-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      font-size: 13px;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 6px;
      color: var(--gray-500);
      cursor: pointer;
    }

    .login-options a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
    }

    .login-options a:hover {
      text-decoration: underline;
    }

    .btn-submit {
      width: 100%;
      background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
      color: white;
      padding: 13px;
      border: none;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
      transition: all 0.2s ease;
    }

    .btn-submit:hover {
      background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(2, 132, 199, 0.35);
    }

    .btn-submit:active {
      transform: translateY(0);
    }

    .footer-text {
      text-align: center;
      margin-top: 24px;
      font-size: 13px;
      color: var(--gray-500);
    }

    .footer-text a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 700;
    }

    .footer-text a:hover {
      text-decoration: underline;
    }

    /* ========================================= */
    /* RESPONSIVE DESIGN UNTUK SMARTPHONE / TABLET */
    /* ========================================= */
    @media (max-width: 768px) {
      body {
        flex-direction: column;
        min-height: 100vh;
      }

      .left-panel {
        flex: none;
        padding: 30px 20px 24px 20px;
      }

      .brand-logo-container {
        padding: 10px;
        border-radius: 14px;
        margin-bottom: 12px;
      }

      .left-panel img {
        width: 60px;
      }

      .brand-title {
        font-size: 20px;
        margin-bottom: 4px;
      }

      .brand-subtitle {
        font-size: 12px;
        max-width: 280px;
      }

      .right-panel {
        flex: 1;
        padding: 20px 16px 36px 16px;
        align-items: flex-start;
      }

      .login-card {
        padding: 28px 20px;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
      }

      .login-card h2 {
        font-size: 22px;
      }

      .login-card p.subtitle {
        font-size: 13px;
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>

  <!-- Left Side: Brand Panel -->
  <div class="left-panel">
    <div class="brand-logo-container">
      <img src="{{ asset('img/logo.jpg') }}" alt="Logo SIMILA">
    </div>
    <div class="brand-title">SIMILA</div>
    <div class="brand-subtitle">
      Sistem Informasi Kemitraan Industri dan Penyelarasan Kejuruan
    </div>
  </div>

  <!-- Right Side: Login Form Panel -->
  <div class="right-panel">
    <div class="login-card">
      <h2>Masuk ke Akun</h2>
      <p class="subtitle">Silakan masukkan email dan password Anda</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
          <label for="email">Email Pengguna</label>
          <input type="email" id="email" name="email" required placeholder="nama@domain.com" value="{{ old('email') }}" autofocus>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>

        <div class="login-options">
          <label class="remember-me">
            <input type="checkbox" name="remember">
            <span>Ingat saya</span>
          </label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Lupa password?</a>
          @endif
        </div>

        <button type="submit" class="btn-submit">Masuk Sekarang</button>

        @if (Route::has('register'))
          <p class="footer-text">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
          </p>
        @endif
      </form>
    </div>
  </div>

</body>
</html>
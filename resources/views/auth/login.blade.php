<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login - SIMILA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
      font-family: 'Poppins', sans-serif !important;
    }

    body {
      display: flex;
      min-height: 100vh;
      background-color: var(--gray-50);
      color: var(--gray-700);
    }

    .left-panel {
      flex: 1.1;
      background: linear-gradient(135deg, rgba(15, 23, 42, 0.94) 0%, rgba(30, 58, 138, 0.9) 55%, rgba(2, 132, 199, 0.85) 100%),
                  url('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=1200&auto=format&fit=crop') center center / cover no-repeat;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 50px 40px;
      position: relative;
      overflow: hidden;
    }

    .left-panel::before {
      content: '';
      position: absolute;
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(56, 189, 248, 0.2) 0%, transparent 70%);
      top: -60px;
      left: -60px;
      border-radius: 50%;
      pointer-events: none;
    }

    .btn-back-home {
      position: absolute;
      top: 24px;
      left: 24px;
      color: #ffffff;
      text-decoration: none;
      font-size: 0.85rem;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(8px);
      padding: 8px 16px;
      border-radius: 50px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.25s ease;
      z-index: 10;
    }

    .btn-back-home:hover {
      background: rgba(255, 255, 255, 0.25);
      color: #ffffff;
      transform: translateX(-2px);
    }

    .brand-logo-container {
      background: white;
      padding: 14px;
      border-radius: 18px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
      margin-bottom: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .left-panel img.logo-img {
      width: 44px;
      height: 44px;
      object-fit: contain;
      display: block;
    }

    .brand-title {
      font-size: 28px;
      font-weight: 800;
      letter-spacing: 0.5px;
      color: #ffffff;
      margin-bottom: 8px;
      text-align: center;
    }

    .brand-subtitle {
      font-size: 13.5px;
      color: #cbd5e1;
      max-width: 360px;
      text-align: center;
      line-height: 1.6;
      margin-bottom: 28px;
    }

    .left-feature-box {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.18);
      border-radius: 14px;
      padding: 14px 18px;
      width: 100%;
      max-width: 380px;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 14px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .left-feature-icon {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: rgba(2, 132, 199, 0.3);
      border: 1px solid rgba(56, 189, 248, 0.3);
      color: #38bdf8;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .left-feature-text h6 {
      font-size: 13.5px;
      font-weight: 600;
      color: #ffffff;
      margin: 0;
    }

    .left-feature-text p {
      font-size: 11.5px;
      color: #94a3b8;
      margin: 0;
      line-height: 1.4;
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
    <a href="{{ url('/') }}" class="btn-back-home">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6"/>
      </svg>
      <span>Kembali ke Beranda</span>
    </a>

    <div class="brand-logo-container">
      <img src="{{ asset('template/assets/img/kaiadmin/favicon.png') }}" class="logo-img" alt="Logo SIMILA">
    </div>
    <div class="brand-title">SIMILA</div>
    <div class="brand-subtitle">
      Sistem Informasi Kemitraan Industri &amp; Penyelarasan Vokasi 8+i
    </div>

    <!-- Frosted Glass Feature Highlights -->
    <div class="left-feature-box">
      <div class="left-feature-icon">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/>
          <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
        </svg>
      </div>
      <div class="left-feature-text">
        <h6>Praktik Kerja Lapangan (PKL)</h6>
        <p>E-Logbook, absensi presensi &amp; monitoring digital</p>
      </div>
    </div>

    <div class="left-feature-box">
      <div class="left-feature-icon">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
          <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
        </svg>
      </div>
      <div class="left-feature-text">
        <h6>Penyelarasan Kurikulum</h6>
        <p>Sinkronisasi kompetensi bersama mitra DUDI</p>
      </div>
    </div>

    <div class="left-feature-box">
      <div class="left-feature-icon">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="7"/>
          <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>
        </svg>
      </div>
      <div class="left-feature-text">
        <h6>Sertifikasi LSP / BNSP</h6>
        <p>Uji kompetensi online &amp; sertifikat terstandar</p>
      </div>
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
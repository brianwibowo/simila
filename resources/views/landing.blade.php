<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIMILA - Sistem Informasi Kemitraan & Penyelarasan Vokasi 8+i</title>
    <link rel="icon" href="{{ asset('template/assets/img/kaiadmin/favicon.png') }}" type="image/x-icon" />

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons CDN: Font Awesome 6, Bootstrap Icons, Boxicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- AOS (Animate on Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- Custom Landing Page Styling -->
    <style>
        :root {
            --simila-primary: #1572e8;
            --simila-primary-dark: #1269db;
            --simila-primary-light: #e8f2fe;
            --simila-navy: #1a2035;
            --simila-navy-dark: #0f172a;
            --simila-accent: #38bdf8;
            --simila-warning: #ffad46;
            --simila-success: #31ce36;
            --simila-danger: #f25961;
            --simila-gray-50: #f8fafc;
            --simila-gray-100: #f1f5f9;
            --simila-gray-200: #e2e8f0;
            --simila-gray-600: #64748b;
            --simila-gray-800: #1e293b;
        }

        * {
            font-family: 'Poppins', sans-serif !important;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }

        body {
            background-color: var(--simila-gray-50);
            color: var(--simila-gray-800);
            overflow-x: hidden;
        }

        /* -------------------------------------------------------------
           NAVBAR
        ------------------------------------------------------------- */
        .landing-navbar {
            background-color: rgba(26, 32, 53, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.3s ease-in-out;
            padding: 16px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            z-index: 1050;
        }

        .landing-navbar.scrolled {
            background-color: rgba(15, 23, 42, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 12px 0;
        }

        .navbar-brand-logo {
            width: 38px;
            height: 38px;
            background: #ffffff;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand-text {
            font-weight: 700;
            font-size: 1.35rem;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .navbar-brand-badge {
            font-size: 0.65rem;
            background: rgba(56, 189, 248, 0.2);
            color: #38bdf8;
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: 600;
            border: 1px solid rgba(56, 189, 248, 0.3);
            text-transform: uppercase;
        }

        .nav-link {
            color: #cbd5e1 !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.25s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2.5px;
            background: #38bdf8;
            border-radius: 2px;
        }

        .btn-nav-login {
            background: linear-gradient(135deg, var(--simila-primary) 0%, #1d4ed8 100%);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 9px 22px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 14px rgba(21, 114, 232, 0.4);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav-login:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            box-shadow: 0 6px 20px rgba(21, 114, 232, 0.6);
            transform: translateY(-1px);
        }

        /* -------------------------------------------------------------
           HERO SECTION
        ------------------------------------------------------------- */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 130px 0 80px 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92) 0%, rgba(26, 32, 53, 0.88) 50%, rgba(21, 114, 232, 0.82) 100%),
                        url('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=1920&auto=format&fit=crop') center center / cover no-repeat;
            color: #ffffff;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(56, 189, 248, 0.25) 0%, transparent 60%);
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #38bdf8;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.2;
            color: #ffffff;
            margin-bottom: 24px;
            letter-spacing: -0.5px;
        }

        .hero-title span {
            background: linear-gradient(135deg, #38bdf8 0%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 1.15rem;
            line-height: 1.7;
            color: #cbd5e1;
            margin-bottom: 36px;
            max-width: 620px;
            font-weight: 400;
        }

        .btn-hero-primary {
            background: #ffffff;
            color: var(--simila-primary-dark) !important;
            font-weight: 700;
            font-size: 1rem;
            padding: 14px 30px;
            border-radius: 50px;
            border: none;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-hero-primary:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .btn-hero-outline {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 1rem;
            padding: 13px 28px;
            border-radius: 50px;
            border: 1.5px solid rgba(255, 255, 255, 0.4);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-hero-outline:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: #ffffff;
            transform: translateY(-2px);
        }

        /* Hero Right Card Glass */
        .hero-glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .hero-mini-badge {
            background: rgba(21, 114, 232, 0.3);
            border: 1px solid rgba(56, 189, 248, 0.3);
            color: #38bdf8;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* -------------------------------------------------------------
           STATS COUNTER BAR
        ------------------------------------------------------------- */
        .stats-section {
            position: relative;
            margin-top: -50px;
            z-index: 20;
        }

        .stats-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px 24px;
            box-shadow: 0 10px 30px rgba(26, 32, 53, 0.08);
            border: 1px solid var(--simila-gray-200);
            transition: transform 0.25s ease;
        }

        .stats-card:hover {
            transform: translateY(-4px);
        }

        .stats-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 16px;
        }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--simila-navy);
            line-height: 1.1;
            margin-bottom: 4px;
        }

        .stats-label {
            font-size: 0.9rem;
            color: var(--simila-gray-600);
            font-weight: 500;
            margin: 0;
        }

        /* -------------------------------------------------------------
           SECTION HEADINGS
        ------------------------------------------------------------- */
        .section-padding {
            padding: 100px 0;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--simila-primary-light);
            color: var(--simila-primary);
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 6px 14px;
            border-radius: 50px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--simila-navy);
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .section-desc {
            font-size: 1.05rem;
            color: var(--simila-gray-600);
            max-width: 650px;
            margin: 0 auto 50px auto;
            line-height: 1.7;
        }

        /* -------------------------------------------------------------
           TENTANG SECTION
        ------------------------------------------------------------- */
        .about-img-box {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .about-img-box img {
            width: 100%;
            height: 480px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .about-img-box:hover img {
            transform: scale(1.03);
        }

        .about-floating-badge {
            position: absolute;
            bottom: 24px;
            left: 24px;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(10px);
            color: #ffffff;
            padding: 16px 20px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .pilar-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid var(--simila-gray-200);
            transition: all 0.25s ease;
            margin-bottom: 14px;
        }

        .pilar-item:hover {
            border-color: var(--simila-primary);
            box-shadow: 0 6px 18px rgba(21, 114, 232, 0.08);
            transform: translateX(4px);
        }

        .pilar-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--simila-primary-light);
            color: var(--simila-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        /* -------------------------------------------------------------
           KEUNGGULAN SECTION
        ------------------------------------------------------------- */
        .advantage-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 32px 26px;
            border: 1px solid var(--simila-gray-200);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .advantage-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--simila-primary) 0%, var(--simila-accent) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .advantage-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(21, 114, 232, 0.12);
            border-color: rgba(21, 114, 232, 0.3);
        }

        .advantage-card:hover::before {
            opacity: 1;
        }

        .advantage-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .advantage-card:hover .advantage-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* -------------------------------------------------------------
           FITUR SECTION
        ------------------------------------------------------------- */
        .feature-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 28px;
            border: 1px solid var(--simila-gray-200);
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 30px rgba(26, 32, 53, 0.09);
            border-color: var(--simila-primary);
        }

        .feature-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .feature-icon-badge {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .feature-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--simila-navy);
            margin: 0;
        }

        .feature-desc {
            font-size: 0.92rem;
            color: var(--simila-gray-600);
            line-height: 1.6;
            margin-bottom: 18px;
            flex-grow: 1;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            border-top: 1px solid var(--simila-gray-100);
            padding-top: 14px;
        }

        .feature-list li {
            font-size: 0.85rem;
            color: var(--simila-gray-800);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .feature-list li i {
            color: var(--simila-success);
            font-size: 0.75rem;
        }

        /* -------------------------------------------------------------
           KERJASAMA SECTION
        ------------------------------------------------------------- */
        .step-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px 24px;
            border: 1px solid var(--simila-gray-200);
            position: relative;
            text-align: center;
            height: 100%;
            transition: all 0.25s ease;
        }

        .step-box:hover {
            border-color: var(--simila-primary);
            box-shadow: 0 10px 25px rgba(21, 114, 232, 0.08);
            transform: translateY(-4px);
        }

        .step-number {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--simila-primary);
            color: #ffffff;
            font-weight: 800;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 4px 12px rgba(21, 114, 232, 0.35);
        }

        .partner-logo-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 18px 24px;
            border: 1px solid var(--simila-gray-200);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 700;
            color: var(--simila-gray-600);
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .partner-logo-card:hover {
            color: var(--simila-primary);
            border-color: var(--simila-primary);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(21, 114, 232, 0.08);
        }

        /* -------------------------------------------------------------
           INFORMASI & FAQ SECTION
        ------------------------------------------------------------- */
        .faq-accordion .accordion-item {
            background: #ffffff;
            border: 1px solid var(--simila-gray-200);
            border-radius: 12px !important;
            margin-bottom: 14px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .faq-accordion .accordion-button {
            font-weight: 600;
            font-size: 1rem;
            color: var(--simila-navy);
            background-color: #ffffff;
            padding: 18px 22px;
        }

        .faq-accordion .accordion-button:not(.collapsed) {
            color: var(--simila-primary);
            background-color: var(--simila-primary-light);
            box-shadow: none;
        }

        .faq-accordion .accordion-body {
            font-size: 0.95rem;
            line-height: 1.7;
            color: var(--simila-gray-600);
            padding: 20px 22px;
            background: #ffffff;
        }

        .cta-banner {
            background: linear-gradient(135deg, var(--simila-navy) 0%, var(--simila-primary-dark) 100%);
            border-radius: 24px;
            padding: 60px 40px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(21, 114, 232, 0.25);
        }

        .cta-banner::before {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.2) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            border-radius: 50%;
        }

        /* -------------------------------------------------------------
           FOOTER
        ------------------------------------------------------------- */
        .landing-footer {
            background-color: #0f172a;
            color: #94a3b8;
            padding: 80px 0 30px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-title {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 20px;
            position: relative;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.92rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .footer-links a:hover {
            color: #38bdf8;
            transform: translateX(4px);
        }

        .social-link-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.08);
            color: #cbd5e1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .social-link-btn:hover {
            background: var(--simila-primary);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding-top: 24px;
            margin-top: 50px;
            font-size: 0.88rem;
        }

        /* -------------------------------------------------------------
           BACK TO TOP BUTTON
        ------------------------------------------------------------- */
        .btn-back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--simila-primary);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 6px 18px rgba(21, 114, 232, 0.4);
            border: none;
            cursor: pointer;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .btn-back-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .btn-back-to-top:hover {
            background: var(--simila-primary-dark);
            transform: translateY(-3px);
        }

        @media (max-width: 991.98px) {
            .hero-title {
                font-size: 2.3rem;
            }
            .hero-section {
                padding: 110px 0 60px 0;
                min-height: auto;
            }
            .stats-section {
                margin-top: 20px;
            }
            .section-title {
                font-size: 2rem;
            }
            .about-img-box img {
                height: 340px;
            }
        }
    </style>
</head>
<body>

    <!-- =============================================================
         NAVBAR
    ============================================================= -->
    <nav class="navbar navbar-expand-lg fixed-top landing-navbar" id="mainNavbar">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="#beranda">
                <span class="navbar-brand-logo">
                    <img src="{{ asset('template/assets/img/kaiadmin/favicon.png') }}" alt="SIMILA" style="width: 24px; height: 24px; object-fit: contain;" />
                </span>
                <div class="d-flex flex-column">
                    <span class="navbar-brand-text">SIMILA</span>
                </div>
                <span class="navbar-brand-badge ms-1">Link & Match 8+i</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0 text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars fs-4"></i>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 py-2 py-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#keunggulan">Keunggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kerjasama">Kerjasama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#informasi">Informasi</a>
                    </li>
                </ul>

                <!-- Right Action: Login Button (New Tab) -->
                <div class="d-flex align-items-center">
                    <a href="{{ route('login') }}" target="_blank" class="btn-nav-login text-decoration-none">
                        <span>Masuk ke Sistem</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- =============================================================
         HERO SECTION [BERANDA]
    ============================================================= -->
    <section class="hero-section" id="beranda">
        <div class="container position-relative z-1">
            <div class="row align-items-center g-5">
                <div class="col-lg-7" data-aos="fade-up" data-aos-duration="1000">
                    <div class="hero-badge">
                        <i class="fas fa-award"></i>
                        <span>Platform Penyelarasan Vokasi & DUDI Terpadu</span>
                    </div>
                    <h1 class="hero-title">
                        Sinergi Nyata <span>Pendidikan Vokasi</span> &amp; Dunia Industri
                    </h1>
                    <p class="hero-subtitle">
                        SIMILA mengintegrasikan seluruh ekosistem kemitraan SMK, Politeknik, Guru, Siswa, dan Dunia Usaha &amp; Industri (DUDI) dalam satu platform terstandarisasi 8+i Link and Match.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#fitur" class="btn-hero-primary text-decoration-none">
                            <i class="fas fa-layer-group"></i>
                            <span>Jelajahi Fitur</span>
                        </a>
                        <a href="{{ route('login') }}" target="_blank" class="btn-hero-outline text-decoration-none">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Masuk Portal</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="hero-glass-card">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-circle-check text-success fs-5"></i>
                                <span class="fw-bold text-white fs-6">Ekosistem 8 Pilar Vokasi</span>
                            </div>
                            <span class="hero-mini-badge">Terakreditasi</span>
                        </div>

                        <div class="mb-3 p-3 rounded-3" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.12);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3 bg-primary text-white">
                                    <i class="fas fa-briefcase fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-0 fw-semibold">Praktik Kerja Lapangan (PKL)</h6>
                                    <small class="text-white-50">E-Logbook, absensi digital &amp; monitoring</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 p-3 rounded-3" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.12);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3 bg-info text-white">
                                    <i class="fas fa-book-bookmark fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-0 fw-semibold">Kurikulum Bersama</h6>
                                    <small class="text-white-50">Penyelarasan standar kompetensi DUDI</small>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 rounded-3" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.12);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3 bg-warning text-dark">
                                    <i class="fas fa-certificate fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-0 fw-semibold">Sertifikasi LSP / BNSP</h6>
                                    <small class="text-white-50">Ujian kompetensi online &amp; sertifikat</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
         STATS SECTION
    ============================================================= -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-3">
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stats-card text-center">
                        <div class="stats-icon-wrap bg-primary-subtle text-primary mx-auto">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_siswa'] ?? 1250) }}+</div>
                        <p class="stats-label">Siswa &amp; Talenta Vokasi</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-card text-center">
                        <div class="stats-icon-wrap bg-info-subtle text-info mx-auto">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_mitra'] ?? 85) }}+</div>
                        <p class="stats-label">Mitra Industri (DUDI)</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-card text-center">
                        <div class="stats-icon-wrap bg-success-subtle text-success mx-auto">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_pkl'] ?? 340) }}+</div>
                        <p class="stats-label">Program PKL &amp; Proyek</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="stats-card text-center">
                        <div class="stats-icon-wrap bg-warning-subtle text-warning mx-auto">
                            <i class="fas fa-medal"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_sertifikasi'] ?? 48) }}+</div>
                        <p class="stats-label">Skema Sertifikasi LSP</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
         TENTANG SECTION [TENTANG]
    ============================================================= -->
    <section class="section-padding" id="tentang">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="900">
                    <div class="about-img-box">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop" alt="Kolaborasi Vokasi dan Industri" />
                        <div class="about-floating-badge">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-circle bg-primary text-white">
                                    <i class="fas fa-handshake fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-white">Standar 8+i Link and Match</h6>
                                    <small class="text-white-50">Kementerian Pendidikan &amp; Kebudayaan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="900">
                    <span class="section-tag">
                        <i class="fas fa-info-circle"></i>
                        <span>Tentang SIMILA</span>
                    </span>
                    <h2 class="section-title">
                        Jembatan Digital Transformasi Pendidikan Kejuruan
                    </h2>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        <strong>SIMILA (Sistem Informasi Kemitraan &amp; Penyelarasan)</strong> dirancang untuk mengatasi kesenjangan kompetensi antara lulusan vokasi dengan kebutuhan riil dunia kerja. Kami menghadirkan ruang kolaborasi terstruktur, transparan, dan terukur.
                    </p>

                    <div class="pilar-item">
                        <div class="pilar-icon">
                            <i class="fas fa-sliders"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Penyelarasan Kurikulum Mendalam</h6>
                            <p class="text-muted small mb-0">Memastikan kompetensi yang diajarkan di kelas selalu sinkron dengan standar teknologi industri terkini.</p>
                        </div>
                    </div>

                    <div class="pilar-item">
                        <div class="pilar-icon">
                            <i class="fas fa-chalkboard-user"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Penguatan Guru &amp; Dosen Tamu</h6>
                            <p class="text-muted small mb-0">Praktisi industri hadir langsung ke kelas untuk membimbing siswa dan berbagi wawasan praktis dunia kerja.</p>
                        </div>
                    </div>

                    <div class="pilar-item">
                        <div class="pilar-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Magang &amp; Penyerapan Kerja Cepat</h6>
                            <p class="text-muted small mb-0">Program PKL termonitor penuh secara real-time yang bermuara pada perekrutan talenta terbaik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
         KEUNGGULAN SECTION [KEUNGGULAN]
    ============================================================= -->
    <section class="section-padding bg-white" id="keunggulan">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <span class="section-tag">
                    <i class="fas fa-star"></i>
                    <span>Nilai Tambah Platform</span>
                </span>
                <h2 class="section-title">Keunggulan Utama SIMILA</h2>
                <p class="section-desc">
                    Dibangun dengan arsitektur modern untuk memberikan kemudahan, keamanan, dan efisiensi optimal bagi seluruh pemangku kepentingan vokasi.
                </p>
            </div>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="advantage-card">
                        <div class="advantage-icon bg-primary-subtle text-primary">
                            <i class="fas fa-network-wired"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Terintegrasi 8 Pilar</h5>
                        <p class="text-muted small mb-0">
                            Mencakup seluruh spektrum 8+i Link and Match mulai dari kurikulum, PKL, project, guru tamu, MOOC, sertifikasi, riset, hingga beasiswa.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="advantage-card">
                        <div class="advantage-icon bg-info-subtle text-info">
                            <i class="fas fa-users-gear"></i>
                        </div>
                        <h5 class="fw-bold mb-2">8 Role Kolaborasi Terpadu</h5>
                        <p class="text-muted small mb-0">
                            Akses spesifik dan terotorisasi penuh untuk Admin, Perusahaan, Guru, Siswa, Alumni, LSP, Waka Kurikulum, dan Waka Humas.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="advantage-card">
                        <div class="advantage-icon bg-success-subtle text-success">
                            <i class="fas fa-book-open-reader"></i>
                        </div>
                        <h5 class="fw-bold mb-2">E-Logbook &amp; Tracking PKL</h5>
                        <p class="text-muted small mb-0">
                            Pencatatan kegiatan harian magang terverifikasi oleh pembimbing sekolah dan mentor industri secara transparan dan akurat.
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="advantage-card">
                        <div class="advantage-icon bg-warning-subtle text-warning">
                            <i class="fas fa-stamp"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Sertifikasi Standar BNSP</h5>
                        <p class="text-muted small mb-0">
                            Pelaksanaan ujian sertifikasi kompetensi LSP digital dengan validasi hasil uji yang diakui secara nasional.
                        </p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="advantage-card">
                        <div class="advantage-icon bg-danger-subtle text-danger">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Talent Scouting Cepat</h5>
                        <p class="text-muted small mb-0">
                            Perusahaan mitra dapat menjaring dan merekrut lulusan terbaik secara langsung berdasarkan rekam jejak portofolio digital.
                        </p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="advantage-card">
                        <div class="advantage-icon bg-secondary-subtle text-secondary">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Analitik &amp; Laporan Akurat</h5>
                        <p class="text-muted small mb-0">
                            Dashboard visual informatif yang menyajikan data statistik ketercapaian program kemitraan secara real-time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
         FITUR SECTION [FITUR]
    ============================================================= -->
    <section class="section-padding" id="fitur">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <span class="section-tag">
                    <i class="fas fa-cubes"></i>
                    <span>Fitur Lengkap Platform</span>
                </span>
                <h2 class="section-title">Modul Ekosistem 8+i SIMILA</h2>
                <p class="section-desc">
                    Jelajahi berbagai modul dirancang khusus untuk mempercepat sinergi antara sekolah kejuruan dan industri mitra.
                </p>
            </div>

            <div class="row g-4">
                <!-- Fitur 1: PKL -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge bg-primary text-white">
                                <i class="fas fa-building-user"></i>
                            </div>
                            <h4 class="feature-title">Praktik Kerja Lapangan</h4>
                        </div>
                        <p class="feature-desc">
                            Manajemen siklus PKL mulai dari pemilihan tempat magang, pembagian kelompok, penugasan guru pembimbing, hingga rekapitulasi nilai akhir.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> E-Logbook harian siswa</li>
                            <li><i class="fas fa-check-circle"></i> Validasi pembimbing DUDI &amp; guru</li>
                            <li><i class="fas fa-check-circle"></i> Laporan evaluasi magang digital</li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 2: Kurikulum -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge bg-info text-white">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h4 class="feature-title">Kurikulum Bersama</h4>
                        </div>
                        <p class="feature-desc">
                            Ruang pengajuan dan sinkronisasi draft kurikulum kejuruan bersama industri mitra untuk memastikan relevansi keahlian di dunia kerja.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Pengajuan draft kurikulum online</li>
                            <li><i class="fas fa-check-circle"></i> Validasi &amp; revisi oleh industri</li>
                            <li><i class="fas fa-check-circle"></i> Arsip dokumen kurikulum terpadu</li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 3: Project Mitra -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge bg-success text-white">
                                <i class="fas fa-diagram-project"></i>
                            </div>
                            <h4 class="feature-title">Project Based Learning</h4>
                        </div>
                        <p class="feature-desc">
                            Pemberian project riil dari perusahaan kepada siswa kejuruan sebagai sarana pembelajaran praktis berbasis kebutuhan pasar.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Brief proyek dari perusahaan</li>
                            <li><i class="fas fa-check-circle"></i> Tracking progres pengerjaan tim</li>
                            <li><i class="fas fa-check-circle"></i> Upload laporan &amp; penilaian hasil</li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 4: Guru Tamu -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge bg-warning text-dark">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h4 class="feature-title">Program Guru Tamu</h4>
                        </div>
                        <p class="feature-desc">
                            Fasilitasi penjadwalan dan pengajuan praktisi industri untuk mengajar dan mentransfer ilmu langsung ke ruang kelas sekolah.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Pengajuan materi &amp; jadwal praktisi</li>
                            <li><i class="fas fa-check-circle"></i> Konfirmasi kehadiran pengajar</li>
                            <li><i class="fas fa-check-circle"></i> Dokumentasi &amp; evaluasi sesi kelas</li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 5: Talent Scouting -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge bg-danger text-white">
                                <i class="fas fa-id-card-clip"></i>
                            </div>
                            <h4 class="feature-title">Talent Scouting</h4>
                        </div>
                        <p class="feature-desc">
                            Mekanisme pencarian dan penyaluran lulusan berprestasi ke mitra DUDI untuk kebutuhan rekrutmen tenaga kerja siap pakai.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Profil portofolio kompetensi siswa</li>
                            <li><i class="fas fa-check-circle"></i> Batch seleksi rekrutmen industri</li>
                            <li><i class="fas fa-check-circle"></i> Tracking status penerimaan kerja</li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 6: MOOC & Sertifikasi -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge bg-primary text-white">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h4 class="feature-title">MOOC &amp; Uji Sertifikasi LSP</h4>
                        </div>
                        <p class="feature-desc">
                            Pusat pelatihan digital mandiri dengan modul multimedia serta pelaksanaan Computer Based Test (CBT) sertifikasi profesi LSP.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Materi &amp; video kursus interaktif</li>
                            <li><i class="fas fa-check-circle"></i> Ujian CBT online terenkripsi</li>
                            <li><i class="fas fa-check-circle"></i> Penerbitan sertifikat kelulusan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
         KERJASAMA SECTION [KERJASAMA]
    ============================================================= -->
    <section class="section-padding bg-white" id="kerjasama">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <span class="section-tag">
                    <i class="fas fa-handshake-angle"></i>
                    <span>Kemitraan Industri</span>
                </span>
                <h2 class="section-title">Alur &amp; Jaringan Kerjasama</h2>
                <p class="section-desc">
                    Bagaimana sekolah kejuruan dan perusahaan berkolaborasi secara seamless di dalam ekosistem digital SIMILA.
                </p>
            </div>

            <!-- 4 Steps Alur -->
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-box">
                        <div class="step-number">1</div>
                        <h6 class="fw-bold mb-2">Registrasi &amp; Verifikasi</h6>
                        <p class="text-muted small mb-0">Institusi sekolah dan mitra DUDI mendaftarkan profil resmi dan diverifikasi oleh admin.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-box">
                        <div class="step-number">2</div>
                        <h6 class="fw-bold mb-2">Penyusunan Program</h6>
                        <p class="text-muted small mb-0">Pilih skema kemitraan yang disepakati (PKL, kurikulum bersama, guru tamu, atau project).</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-box">
                        <div class="step-number">3</div>
                        <h6 class="fw-bold mb-2">Pelaksanaan &amp; Monitoring</h6>
                        <p class="text-muted small mb-0">Seluruh kegiatan tercatat rapi di portal dengan pemantauan bersama guru dan mentor industri.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-box">
                        <div class="step-number">4</div>
                        <h6 class="fw-bold mb-2">Sertifikasi &amp; Rekrutmen</h6>
                        <p class="text-muted small mb-0">Pemberian sertifikat kompetensi LSP dan penyerapan lulusan terbaik langsung ke dunia kerja.</p>
                    </div>
                </div>
            </div>

            <!-- Mitra Industri Grid -->
            <div class="mt-5 text-center" data-aos="fade-up">
                <h6 class="text-muted fw-semibold text-uppercase tracking-wider mb-4" style="font-size: 0.85rem; letter-spacing: 1px;">
                    Didukung Jaringan Mitra Industri &amp; Asosiasi Profesi
                </h6>
                <div class="row g-3 justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-logo-card">
                            <i class="fas fa-microchip text-primary fs-5"></i>
                            <span>Tech Corp</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-logo-card">
                            <i class="fas fa-car text-info fs-5"></i>
                            <span>Auto Astra</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-logo-card">
                            <i class="fas fa-tower-broadcast text-success fs-5"></i>
                            <span>Telkom Infra</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-logo-card">
                            <i class="fas fa-gears text-warning fs-5"></i>
                            <span>Indo Manufaktur</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-logo-card">
                            <i class="fas fa-building-columns text-danger fs-5"></i>
                            <span>Digital Banking</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-logo-card">
                            <i class="fas fa-award text-primary fs-5"></i>
                            <span>LSP Vokasi BNSP</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
         INFORMASI & FAQ SECTION [INFORMASI]
    ============================================================= -->
    <section class="section-padding" id="informasi">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="section-tag">
                        <i class="fas fa-circle-question"></i>
                        <span>Pusat Informasi &amp; Bantuan</span>
                    </span>
                    <h2 class="section-title">Pertanyaan yang Sering Diajukan (FAQ)</h2>
                    <p class="text-muted mb-4">
                        Temukan jawaban cepat seputar tata cara pendaftaran, mekanisme PKL, validasi kurikulum, dan pelaksanaan sertifikasi.
                    </p>

                    <!-- Accordion FAQ -->
                    <div class="accordion faq-accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                    Bagaimana cara perusahaan mendaftar sebagai mitra DUDI?
                                </button>
                            </h2>
                            <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Perusahaan dapat menghubungi admin sekolah atau melakukan pendaftaran melalui kontak helpdesk. Setelah diverifikasi, akun perusahaan akan dibuatkan untuk langsung mengelola kuota PKL, kurikulum, dan pengajuan guru tamu.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                    Bagaimana siswa mengisi logbook kegiatan harian PKL?
                                </button>
                            </h2>
                            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Siswa masuk ke portal dengan akun masing-masing, memilih menu <strong>Ruang PKL &gt; E-Logbook</strong>, lalu mengisi rincian kegiatan dan mengunggah foto dokumentasi yang akan langsung divalidasi oleh pembimbing industri.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                    Apakah sertifikat kompetensi LSP diakui secara nasional?
                                </button>
                            </h2>
                            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, skema sertifikasi yang terdaftar di SIMILA terafiliasi dengan Lembaga Sertifikasi Profesi (LSP) berlisensi resmi Badan Nasional Sertifikasi Profesi (BNSP).
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                    Bisakah sekolah mengajukan kurikulum ke beberapa mitra DUDI?
                                </button>
                            </h2>
                            <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sangat bisa. Waka Kurikulum dapat mengajukan draft kurikulum secara spesifik ke masing-masing perusahaan mitra untuk mendapatkan catatan penyelarasan yang akurat.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="cta-banner h-100 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold mb-3">
                                <i class="fas fa-rocket me-1"></i> Akses Portal
                            </span>
                            <h3 class="text-white fw-bold mb-3 fs-2">
                                Siap Bersinergi Bersama Ekosistem SIMILA?
                            </h3>
                            <p class="text-white-50 mb-4" style="line-height: 1.7;">
                                Akses portal sekarang untuk memulai pengelolaan kemitraan vokasi, evaluasi PKL, dan sertifikasi kompetensi secara praktis dan terpadu.
                            </p>

                            <div class="d-flex flex-column gap-3 mb-4">
                                <div class="d-flex align-items-center gap-3 text-white">
                                    <i class="fas fa-shield-halved text-info fs-5"></i>
                                    <span class="small">Autentikasi aman terenkripsi multi-role</span>
                                </div>
                                <div class="d-flex align-items-center gap-3 text-white">
                                    <i class="fas fa-cloud-arrow-up text-info fs-5"></i>
                                    <span class="small">Penyimpanan berkas kurikulum &amp; logbook di cloud</span>
                                </div>
                                <div class="d-flex align-items-center gap-3 text-white">
                                    <i class="fas fa-headset text-info fs-5"></i>
                                    <span class="small">Layanan bantuan helpdesk responsif</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('login') }}" target="_blank" class="btn btn-light btn-lg rounded-pill px-4 py-3 fw-bold text-primary shadow d-inline-flex align-items-center gap-2">
                                <span>Buka Halaman Login</span>
                                <i class="fas fa-arrow-up-right-from-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
         FOOTER
    ============================================================= -->
    <footer class="landing-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="navbar-brand-logo bg-white">
                            <img src="{{ asset('template/assets/img/kaiadmin/favicon.png') }}" alt="SIMILA" style="width: 22px; height: 22px; object-fit: contain;" />
                        </span>
                        <span class="text-white fw-bold fs-4">SIMILA</span>
                    </div>
                    <p class="small text-muted mb-4" style="line-height: 1.7;">
                        Sistem Informasi Kemitraan &amp; Penyelarasan Vokasi berbasis 8+i Link and Match. Membangun generasi unggul yang kompeten dan siap diserap industri.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="social-link-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link-btn"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link-btn"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-link-btn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="footer-title">Tautan Cepat</h6>
                    <ul class="footer-links">
                        <li><a href="#beranda"><i class="fas fa-chevron-right fs-xs"></i> Beranda</a></li>
                        <li><a href="#tentang"><i class="fas fa-chevron-right fs-xs"></i> Tentang Kami</a></li>
                        <li><a href="#keunggulan"><i class="fas fa-chevron-right fs-xs"></i> Keunggulan</a></li>
                        <li><a href="#fitur"><i class="fas fa-chevron-right fs-xs"></i> Modul Fitur</a></li>
                        <li><a href="#kerjasama"><i class="fas fa-chevron-right fs-xs"></i> Kerjasama</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title">Pilar Program 8+i</h6>
                    <ul class="footer-links">
                        <li><a href="#fitur"><i class="fas fa-angle-right"></i> Praktik Kerja Lapangan</a></li>
                        <li><a href="#fitur"><i class="fas fa-angle-right"></i> Kurikulum Bersama DUDI</a></li>
                        <li><a href="#fitur"><i class="fas fa-angle-right"></i> Guru Tamu / Praktisi</a></li>
                        <li><a href="#fitur"><i class="fas fa-angle-right"></i> Sertifikasi Profesi LSP</a></li>
                        <li><a href="#fitur"><i class="fas fa-angle-right"></i> Riset &amp; Inovasi Terapan</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title">Hubungi Kami</h6>
                    <ul class="footer-links">
                        <li>
                            <span class="d-flex align-items-start gap-2 small text-muted">
                                <i class="fas fa-location-dot mt-1 text-primary"></i>
                                <span>Pusat Pengembangan Vokasi &amp; Kemitraan Industri</span>
                            </span>
                        </li>
                        <li class="mt-2">
                            <span class="d-flex align-items-center gap-2 small text-muted">
                                <i class="fas fa-envelope text-primary"></i>
                                <span>info@simila.vokasi.id</span>
                            </span>
                        </li>
                        <li class="mt-2">
                            <span class="d-flex align-items-center gap-2 small text-muted">
                                <i class="fas fa-phone text-primary"></i>
                                <span>+62 (024) 8508001</span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start">
                <div>
                    &copy; {{ date('Y') }} <strong>SIMILA</strong> - Sistem Informasi Kemitraan &amp; Penyelarasan Vokasi. Hak Cipta Dilindungi.
                </div>
                <div class="d-flex gap-3 small">
                    <a href="#" class="text-muted text-decoration-none">Kebijakan Privasi</a>
                    <span class="text-muted">&bull;</span>
                    <a href="#" class="text-muted text-decoration-none">Syarat &amp; Ketentuan</a>
                    <span class="text-muted">&bull;</span>
                    <a href="{{ route('login') }}" target="_blank" class="text-primary text-decoration-none fw-semibold">Login Portal</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button type="button" class="btn-back-to-top" id="backToTopBtn" aria-label="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Interactive Scripts -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 80,
            easing: 'ease-out-cubic'
        });

        // Navbar Scrolled Glass Effect & Active Link Highlight
        const navbar = document.getElementById('mainNavbar');
        const backToTopBtn = document.getElementById('backToTopBtn');
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('section[id]');

        window.addEventListener('scroll', () => {
            const scrollY = window.pageYOffset;

            // Navbar Scrolled Effect
            if (scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Back to top button
            if (scrollY > 400) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }

            // Active section highlighting in navbar
            sections.forEach(section => {
                const sectionHeight = section.offsetHeight;
                const sectionTop = section.offsetTop - 120;
                const sectionId = section.getAttribute('id');

                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        });

        // Back to top action
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Close mobile navbar on link click
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.getElementById('navbarContent');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                }
            });
        });
    </script>
</body>
</html>

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

    <!-- AOS (Animate on Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- Custom Landing Page Styling - Matched to KaiAdmin & Login System Colors -->
    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --navy: #0f172a;
            --navy-light: #1e293b;
            --navy-card: #1e293b;
            --accent: #38bdf8;
            --accent-soft: rgba(56, 189, 248, 0.15);
            --warning: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-500: #64748b;
            --gray-700: #334155;
            --gray-800: #1e293b;
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
            background-color: var(--gray-50);
            color: var(--gray-700);
            overflow-x: hidden;
        }

        /* -------------------------------------------------------------
           SVG ICON HELPER STYLES
        ------------------------------------------------------------- */
        .svg-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            vertical-align: middle;
            flex-shrink: 0;
        }

        /* -------------------------------------------------------------
           NAVBAR
        ------------------------------------------------------------- */
        .landing-navbar {
            background-color: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.3s ease-in-out;
            padding: 16px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            z-index: 1050;
        }

        .landing-navbar.scrolled {
            background-color: rgba(15, 23, 42, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand-text {
            font-weight: 700;
            font-size: 1.35rem;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .navbar-brand-badge {
            font-size: 0.65rem;
            background: var(--accent-soft);
            color: var(--accent);
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: 600;
            border: 1px solid rgba(56, 189, 248, 0.3);
            text-transform: uppercase;
        }

        .nav-link {
            color: #94a3b8 !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 8px 16px !important;
            background: transparent !important;
            border-radius: 0 !important;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link:hover {
            color: #ffffff !important;
            background: transparent !important;
        }

        .nav-link.active {
            color: #ffffff !important;
            font-weight: 600;
            background: transparent !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0px;
            left: 50%;
            transform: translateX(-50%);
            width: 24px;
            height: 2.5px;
            background: var(--accent);
            border-radius: 2px;
        }

        .btn-nav-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 9px 22px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.4);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav-login:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #075985 100%);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.6);
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
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.94) 0%, rgba(30, 58, 138, 0.88) 55%, rgba(2, 132, 199, 0.82) 100%),
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
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--accent);
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
            background: linear-gradient(135deg, #38bdf8 0%, #93c5fd 100%);
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
            color: var(--primary-dark) !important;
            font-weight: 700;
            font-size: 1rem;
            padding: 14px 30px;
            border-radius: 50px;
            border: none;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-hero-primary:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
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
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }

        .hero-mini-badge {
            background: rgba(2, 132, 199, 0.25);
            border: 1px solid rgba(56, 189, 248, 0.3);
            color: var(--accent);
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
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
            border: 1px solid var(--gray-200);
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
            margin-bottom: 16px;
        }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--navy);
            line-height: 1.1;
            margin-bottom: 4px;
        }

        .stats-label {
            font-size: 0.9rem;
            color: var(--gray-500);
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
            background: var(--primary-light);
            color: var(--primary);
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
            color: var(--navy);
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .section-desc {
            font-size: 1.05rem;
            color: var(--gray-500);
            max-width: 650px;
            margin: 0 auto 50px auto;
            line-height: 1.7;
        }

        /* -------------------------------------------------------------
           TENTANG SECTION (MULTI-PHOTO SHOWCASE)
        ------------------------------------------------------------- */
        .photo-grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .photo-grid-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--gray-200);
        }

        .photo-grid-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
            display: block;
        }

        .photo-grid-item:hover img {
            transform: scale(1.05);
        }

        .photo-badge-label {
            position: absolute;
            bottom: 10px;
            left: 10px;
            right: 10px;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(6px);
            color: #ffffff;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-align: center;
        }

        .pilar-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid var(--gray-200);
            transition: all 0.25s ease;
            margin-bottom: 14px;
        }

        .pilar-item:hover {
            border-color: var(--primary);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.1);
            transform: translateX(4px);
        }

        .pilar-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* -------------------------------------------------------------
           KEUNGGULAN SECTION
        ------------------------------------------------------------- */
        .advantage-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 32px 26px;
            border: 1px solid var(--gray-200);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
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
            background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .advantage-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(2, 132, 199, 0.12);
            border-color: rgba(2, 132, 199, 0.3);
        }

        .advantage-card:hover::before {
            opacity: 1;
        }

        .advantage-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .advantage-card:hover .advantage-icon {
            transform: scale(1.1);
        }

        /* -------------------------------------------------------------
           FITUR SECTION
        ------------------------------------------------------------- */
        .feature-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 28px;
            border: 1px solid var(--gray-200);
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
            border-color: var(--primary);
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
            flex-shrink: 0;
        }

        .feature-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--navy);
            margin: 0;
        }

        .feature-desc {
            font-size: 0.92rem;
            color: var(--gray-500);
            line-height: 1.6;
            margin-bottom: 18px;
            flex-grow: 1;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            border-top: 1px solid var(--gray-100);
            padding-top: 14px;
        }

        .feature-list li {
            font-size: 0.85rem;
            color: var(--gray-700);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .feature-list li svg {
            color: var(--success);
        }

        /* -------------------------------------------------------------
           KERJASAMA SECTION
        ------------------------------------------------------------- */
        .step-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px 24px;
            border: 1px solid var(--gray-200);
            position: relative;
            text-align: center;
            height: 100%;
            transition: all 0.25s ease;
        }

        .step-box:hover {
            border-color: var(--primary);
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.1);
            transform: translateY(-4px);
        }

        .step-number {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--primary);
            color: #ffffff;
            font-weight: 800;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.35);
        }

        .workshop-banner-box {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--gray-200);
        }

        .workshop-banner-box img {
            width: 100%;
            height: 360px;
            object-fit: cover;
            display: block;
        }

        .workshop-banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.3) 60%, transparent 100%);
            display: flex;
            align-items: flex-end;
            padding: 32px;
            color: #ffffff;
        }

        /* -------------------------------------------------------------
           INFORMASI & FAQ SECTION
        ------------------------------------------------------------- */
        .faq-accordion .accordion-item {
            background: #ffffff;
            border: 1px solid var(--gray-200);
            border-radius: 12px !important;
            margin-bottom: 14px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .faq-accordion .accordion-button {
            font-weight: 600;
            font-size: 1rem;
            color: var(--navy);
            background-color: #ffffff;
            padding: 18px 22px;
        }

        .faq-accordion .accordion-button:not(.collapsed) {
            color: var(--primary);
            background-color: var(--primary-light);
            box-shadow: none;
        }

        .faq-accordion .accordion-body {
            font-size: 0.95rem;
            line-height: 1.7;
            color: var(--gray-500);
            padding: 20px 22px;
            background: #ffffff;
        }

        .cta-banner {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 50%, var(--primary-dark) 100%);
            border-radius: 24px;
            padding: 60px 40px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(2, 132, 199, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.1);
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
           FOOTER (BRIGHT WHITE HIGH CONTRAST)
        ------------------------------------------------------------- */
        .landing-footer {
            background-color: var(--navy);
            color: #ffffff !important;
            padding: 80px 0 30px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }

        .footer-desc {
            color: #f1f5f9 !important;
            font-size: 0.92rem;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .footer-title {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 20px;
            position: relative;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
            color: #f1f5f9 !important;
        }

        .footer-links a {
            color: #f1f5f9 !important;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 400;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a:hover {
            color: var(--accent) !important;
            transform: translateX(4px);
        }

        .footer-contact-item {
            color: #f1f5f9 !important;
            font-size: 0.92rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .social-link-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .social-link-btn:hover {
            background: var(--primary);
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            padding-top: 24px;
            margin-top: 50px;
            font-size: 0.9rem;
            color: #f1f5f9 !important;
        }

        .footer-bottom a {
            color: #f1f5f9 !important;
            transition: color 0.2s ease;
        }

        .footer-bottom a:hover {
            color: var(--accent) !important;
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
            background: var(--primary);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.4);
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
            background: var(--primary-dark);
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
            .photo-grid-container {
                grid-template-columns: 1fr;
            }
            .photo-grid-item img {
                height: 200px;
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

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0 text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
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
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- =============================================================
         HERO SECTION [BERANDA] (IMAGE 1: HERO BACKGROUND SISWA VOKASI)
    ============================================================= -->
    <section class="hero-section" id="beranda">
        <div class="container position-relative z-1">
            <div class="row align-items-center g-5">
                <div class="col-lg-7" data-aos="fade-up" data-aos-duration="1000">
                    <div class="hero-badge">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>
                        <span>Platform Penyelarasan Vokasi &amp; DUDI Terpadu</span>
                    </div>
                    <h1 class="hero-title">
                        Sinergi Nyata <span>Pendidikan Vokasi</span> &amp; Dunia Industri
                    </h1>
                    <p class="hero-subtitle">
                        SIMILA mengintegrasikan seluruh ekosistem kemitraan SMK, Politeknik, Guru, Siswa, dan Dunia Usaha &amp; Industri (DUDI) dalam satu platform terstandarisasi 8+i Link and Match.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#fitur" class="btn-hero-primary text-decoration-none">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.9a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"></path>
                                <path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"></path>
                                <path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"></path>
                            </svg>
                            <span>Jelajahi Fitur</span>
                        </a>
                        <a href="{{ route('login') }}" target="_blank" class="btn-hero-outline text-decoration-none">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                <polyline points="10 17 15 12 10 7"></polyline>
                                <line x1="15" y1="12" x2="3" y2="12"></line>
                            </svg>
                            <span>Masuk Portal</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="hero-glass-card">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                <span class="fw-bold text-white fs-6">Ekosistem 8 Pilar Vokasi</span>
                            </div>
                            <span class="hero-mini-badge">Terakreditasi</span>
                        </div>

                        <div class="mb-3 p-3 rounded-3" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.12);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3 bg-primary text-white">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h6 class="text-white mb-0 fw-semibold">Praktik Kerja Lapangan (PKL)</h6>
                                    <small class="text-white-50">E-Logbook, absensi digital &amp; monitoring</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 p-3 rounded-3" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.12);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3 text-white" style="background-color: #0284c7;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                    </svg>
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
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="8" r="7"></circle>
                                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                                    </svg>
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
                        <div class="stats-icon-wrap mx-auto" style="background-color: #e0f2fe; color: #0284c7;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                            </svg>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_siswa'] ?? 1250) }}+</div>
                        <p class="stats-label">Siswa &amp; Talenta Vokasi</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-card text-center">
                        <div class="stats-icon-wrap mx-auto" style="background-color: #f0fdf4; color: #16a34a;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="16" height="20" x="4" y="2" rx="2" ry="2"></rect>
                                <path d="M9 22v-4h6v4M8 6h.01M16 6h.01M12 6h.01M12 10h.01M12 14h.01M16 10h.01M16 14h.01M8 10h.01M8 14h.01"></path>
                            </svg>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_mitra'] ?? 85) }}+</div>
                        <p class="stats-label">Mitra Industri (DUDI)</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-card text-center">
                        <div class="stats-icon-wrap mx-auto" style="background-color: #fefce8; color: #ca8a04;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <path d="m9 14 2 2 4-4"></path>
                            </svg>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_pkl'] ?? 340) }}+</div>
                        <p class="stats-label">Program PKL &amp; Proyek</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="stats-card text-center">
                        <div class="stats-icon-wrap mx-auto" style="background-color: #fef2f2; color: #dc2626;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="7"></circle>
                                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                            </svg>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_sertifikasi'] ?? 48) }}+</div>
                        <p class="stats-label">Skema Sertifikasi LSP</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
         TENTANG SECTION [TENTANG] (4-PHOTO GRID SISWA VOKASI & LAB)
    ============================================================= -->
    <section class="section-padding" id="tentang">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- 4-Image Grid Showcase -->
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="900">
                    <div class="photo-grid-container">
                        <!-- Image 1 -->
                        <div class="photo-grid-item">
                            <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=800&auto=format&fit=crop" alt="Laboratorium Rekayasa &amp; Teknologi" />
                            <div class="photo-badge-label">
                                <span>Laboratorium Rekayasa &amp; IoT</span>
                            </div>
                        </div>
                        <!-- Image 2 -->
                        <div class="photo-grid-item">
                            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=800&auto=format&fit=crop" alt="Diskusi Siswa dan Mentor di Laboratorium" />
                            <div class="photo-badge-label">
                                <span>Kolaborasi Kelas &amp; Praktisi</span>
                            </div>
                        </div>
                        <!-- Image 3 -->
                        <div class="photo-grid-item">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=800&auto=format&fit=crop" alt="Praktek Pemrograman dan Rekayasa" />
                            <div class="photo-badge-label">
                                <span>Praktek Project Berbasis Industri</span>
                            </div>
                        </div>
                        <!-- Image 4 -->
                        <div class="photo-grid-item">
                            <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=800&auto=format&fit=crop" alt="Workshop dan Sertifikasi LSP" />
                            <div class="photo-badge-label">
                                <span>Workshop &amp; Standarisasi BNSP</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="900">
                    <span class="section-tag">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>Tentang SIMILA</span>
                    </span>
                    <h2 class="section-title">
                        Jembatan Digital Transformasi Pendidikan Kejuruan
                    </h2>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        <strong>SIMILA (Sistem Informasi Kemitraan &amp; Penyelarasan)</strong> dirancang untuk mengatasi kesenjangan kompetensi antara lulusan vokasi dengan kebutuhan riil dunia kerja melalui sinergi terstandar 8+i Link and Match.
                    </p>

                    <div class="pilar-item">
                        <div class="pilar-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="4" x2="4" y1="21" y2="14"></line>
                                <line x1="4" x2="4" y1="10" y2="3"></line>
                                <line x1="12" x2="12" y1="21" y2="12"></line>
                                <line x1="12" x2="12" y1="8" y2="3"></line>
                                <line x1="20" x2="20" y1="21" y2="16"></line>
                                <line x1="20" x2="20" y1="12" y2="3"></line>
                                <line x1="1" x2="7" y1="14" y2="14"></line>
                                <line x1="9" x2="15" y1="8" y2="8"></line>
                                <line x1="17" x2="23" y1="16" y2="16"></line>
                            </svg>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Penyelarasan Kurikulum Mendalam</h6>
                            <p class="text-muted small mb-0">Memastikan kompetensi yang diajarkan di kelas selalu sinkron dengan standar teknologi industri terkini.</p>
                        </div>
                    </div>

                    <div class="pilar-item">
                        <div class="pilar-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Penguatan Guru &amp; Praktisi Industri</h6>
                            <p class="text-muted small mb-0">Praktisi industri hadir langsung ke kelas untuk membimbing siswa dan berbagi wawasan praktis dunia kerja.</p>
                        </div>
                    </div>

                    <div class="pilar-item">
                        <div class="pilar-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
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
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
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
                        <div class="advantage-icon" style="background-color: #e0f2fe; color: #0284c7;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.9a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"></path>
                                <path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"></path>
                                <path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"></path>
                            </svg>
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
                        <div class="advantage-icon" style="background-color: #f0fdf4; color: #16a34a;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="9" y="2" width="6" height="6" rx="1"></rect>
                                <rect x="2" y="16" width="6" height="6" rx="1"></rect>
                                <rect x="16" y="16" width="6" height="6" rx="1"></rect>
                                <path d="M5 16v-4h14v4"></path>
                                <path d="M12 8v4"></path>
                            </svg>
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
                        <div class="advantage-icon" style="background-color: #fefce8; color: #ca8a04;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                            </svg>
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
                        <div class="advantage-icon" style="background-color: #fef2f2; color: #dc2626;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="7"></circle>
                                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                            </svg>
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
                        <div class="advantage-icon" style="background-color: #eff6ff; color: #2563eb;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="10" cy="8" r="5"></circle>
                                <path d="M2 21a8 8 0 0 1 13.292-6"></path>
                                <circle cx="19" cy="11" r="3"></circle>
                                <path d="m21 13 3 3"></path>
                            </svg>
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
                        <div class="advantage-icon" style="background-color: #f1f5f9; color: #475569;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" x2="12" y1="20" y2="10"></line>
                                <line x1="18" x2="18" y1="20" y2="4"></line>
                                <line x1="6" x2="6" y1="20" y2="16"></line>
                            </svg>
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
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                        <path d="M3 9h18"></path>
                        <path d="M9 21V9"></path>
                    </svg>
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
                            <div class="feature-icon-badge text-white" style="background-color: #0284c7;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                            </div>
                            <h4 class="feature-title">Praktik Kerja Lapangan</h4>
                        </div>
                        <p class="feature-desc">
                            Manajemen siklus PKL mulai dari pemilihan tempat magang, pembagian kelompok, penugasan guru pembimbing, hingga rekapitulasi nilai akhir.
                        </p>
                        <ul class="feature-list">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>E-Logbook harian siswa</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Validasi pembimbing DUDI &amp; guru</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Laporan evaluasi magang digital</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 2: Kurikulum -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge text-white" style="background-color: #0369a1;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                            </div>
                            <h4 class="feature-title">Kurikulum Bersama</h4>
                        </div>
                        <p class="feature-desc">
                            Ruang pengajuan dan sinkronisasi draft kurikulum kejuruan bersama industri mitra untuk memastikan relevansi keahlian di dunia kerja.
                        </p>
                        <ul class="feature-list">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Pengajuan draft kurikulum online</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Validasi &amp; revisi oleh industri</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Arsip dokumen kurikulum terpadu</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 3: Project Mitra -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge text-white" style="background-color: #10b981;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"></path>
                                    <path d="m10 13 2 2 4-4"></path>
                                </svg>
                            </div>
                            <h4 class="feature-title">Project Based Learning</h4>
                        </div>
                        <p class="feature-desc">
                            Pemberian project riil dari perusahaan kepada siswa kejuruan sebagai sarana pembelajaran praktis berbasis kebutuhan pasar.
                        </p>
                        <ul class="feature-list">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Brief proyek dari perusahaan</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Tracking progres pengerjaan tim</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Upload laporan &amp; penilaian hasil</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 4: Guru Tamu -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge text-dark" style="background-color: #f59e0b;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <h4 class="feature-title">Program Guru Tamu</h4>
                        </div>
                        <p class="feature-desc">
                            Fasilitasi penjadwalan dan pengajuan praktisi industri untuk mengajar dan mentransfer ilmu langsung ke ruang kelas sekolah.
                        </p>
                        <ul class="feature-list">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Pengajuan materi &amp; jadwal praktisi</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Konfirmasi kehadiran pengajar</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Dokumentasi &amp; evaluasi sesi kelas</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 5: Talent Scouting -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge text-white" style="background-color: #ef4444;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="10" cy="8" r="5"></circle>
                                    <path d="M2 21a8 8 0 0 1 13.292-6"></path>
                                    <circle cx="19" cy="11" r="3"></circle>
                                    <path d="m21 13 3 3"></path>
                                </svg>
                            </div>
                            <h4 class="feature-title">Talent Scouting</h4>
                        </div>
                        <p class="feature-desc">
                            Mekanisme pencarian dan penyaluran lulusan berprestasi ke mitra DUDI untuk kebutuhan rekrutmen tenaga kerja siap pakai.
                        </p>
                        <ul class="feature-list">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Profil portofolio kompetensi siswa</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Batch seleksi rekrutmen industri</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Tracking status penerimaan kerja</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 6: MOOC & Sertifikasi -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-header">
                            <div class="feature-icon-badge text-white" style="background-color: #0f172a;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="12" x="3" y="4" rx="2"></rect>
                                    <line x1="2" x2="22" y1="20" y2="20"></line>
                                </svg>
                            </div>
                            <h4 class="feature-title">MOOC &amp; Uji Sertifikasi LSP</h4>
                        </div>
                        <p class="feature-desc">
                            Pusat pelatihan digital mandiri dengan modul multimedia serta pelaksanaan Computer Based Test (CBT) sertifikasi profesi LSP.
                        </p>
                        <ul class="feature-list">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Materi &amp; video kursus interaktif</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Ujian CBT online terenkripsi</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Penerbitan sertifikat kelulusan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============================================================
         KERJASAMA SECTION [KERJASAMA] (IMAGE 4: INDUSTRIAL WORKSHOP BANNER)
    ============================================================= -->
    <section class="section-padding bg-white" id="kerjasama">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <span class="section-tag">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>Kemitraan Industri</span>
                </span>
                <h2 class="section-title">Alur Kerjasama Terpadu</h2>
                <p class="section-desc">
                    Bagaimana sekolah kejuruan dan perusahaan berkolaborasi secara terstruktur di dalam ekosistem digital SIMILA.
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

            <!-- Image 4: Industrial Workshop Training Showcase Banner -->
            <div class="workshop-banner-box" data-aos="fade-up" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=1200&auto=format&fit=crop" alt="Suasana Praktik Siswa Vokasi di Bengkel Industri Modern" />
                <div class="workshop-banner-overlay">
                    <div>
                        <span class="badge bg-primary px-3 py-2 rounded-pill fw-semibold mb-2">Kompetensi Siap Kerja</span>
                        <h4 class="fw-bold mb-1 text-white">Menghubungkan Potensi Generasi Muda dengan Kebutuhan Riil Industri</h4>
                        <p class="text-white-50 mb-0 small">Membangun ekosistem link and match yang berkelanjutan untuk kemajuan vokasi Indonesia.</p>
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
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
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
                            <span class="badge bg-white px-3 py-2 rounded-pill fw-bold mb-3" style="color: var(--primary);">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                    <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
                                    <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                                </svg>
                                <span>Akses Portal</span>
                            </span>
                            <h3 class="text-white fw-bold mb-3 fs-2">
                                Siap Bersinergi Bersama Ekosistem SIMILA?
                            </h3>
                            <p class="text-white-50 mb-4" style="line-height: 1.7;">
                                Akses portal sekarang untuk memulai pengelolaan kemitraan vokasi, evaluasi PKL, dan sertifikasi kompetensi secara praktis dan terpadu.
                            </p>

                            <div class="d-flex flex-column gap-3 mb-4">
                                <div class="d-flex align-items-center gap-3 text-white">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    </svg>
                                    <span class="small">Autentikasi aman terenkripsi multi-role</span>
                                </div>
                                <div class="d-flex align-items-center gap-3 text-white">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"></path>
                                    </svg>
                                    <span class="small">Penyimpanan berkas kurikulum &amp; logbook di cloud</span>
                                </div>
                                <div class="d-flex align-items-center gap-3 text-white">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                    </svg>
                                    <span class="small">Layanan bantuan helpdesk responsif</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('login') }}" target="_blank" class="btn btn-light btn-lg rounded-pill px-4 py-3 fw-bold shadow d-inline-flex align-items-center gap-2" style="color: var(--primary-dark);">
                                <span>Buka Halaman Login</span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 17L17 7M7 7h10v10"></path>
                                </svg>
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
                    <p class="footer-desc">
                        Sistem Informasi Kemitraan &amp; Penyelarasan Vokasi berbasis 8+i Link and Match. Membangun generasi unggul yang kompeten dan siap diserap industri.
                    </p>
                    <div class="d-flex gap-2">
                        <!-- Facebook -->
                        <a href="#" class="social-link-btn" aria-label="Facebook">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="social-link-btn" aria-label="Instagram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                            </svg>
                        </a>
                        <!-- LinkedIn -->
                        <a href="#" class="social-link-btn" aria-label="LinkedIn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect width="4" height="12" x="2" y="9"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                        <!-- Youtube -->
                        <a href="#" class="social-link-btn" aria-label="YouTube">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"></path>
                                <polygon points="10 15 15 12 10 9 10 15"></polygon>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="footer-title">Tautan Cepat</h6>
                    <ul class="footer-links">
                        <li>
                            <a href="#beranda">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tentang">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Tentang Kami</span>
                            </a>
                        </li>
                        <li>
                            <a href="#keunggulan">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Keunggulan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#fitur">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Modul Fitur</span>
                            </a>
                        </li>
                        <li>
                            <a href="#kerjasama">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Kerjasama</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title">Pilar Program 8+i</h6>
                    <ul class="footer-links">
                        <li>
                            <a href="#fitur">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Praktik Kerja Lapangan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#fitur">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Kurikulum Bersama DUDI</span>
                            </a>
                        </li>
                        <li>
                            <a href="#fitur">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Guru Tamu / Praktisi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#fitur">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Sertifikasi Profesi LSP</span>
                            </a>
                        </li>
                        <li>
                            <a href="#fitur">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                <span>Riset &amp; Inovasi Terapan</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title">Hubungi Kami</h6>
                    <ul class="footer-links">
                        <li>
                            <span class="footer-contact-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>Pusat Pengembangan Vokasi &amp; Kemitraan Industri</span>
                            </span>
                        </li>
                        <li class="mt-2">
                            <span class="footer-contact-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                                <span>info@simila.vokasi.id</span>
                            </span>
                        </li>
                        <li class="mt-2">
                            <span class="footer-contact-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
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
                    <a href="#" class="text-decoration-none">Kebijakan Privasi</a>
                    <span>&bull;</span>
                    <a href="#" class="text-decoration-none">Syarat &amp; Ketentuan</a>
                    <span>&bull;</span>
                    <a href="{{ route('login') }}" target="_blank" class="text-decoration-none fw-semibold" style="color: #38bdf8;">Login Portal</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button type="button" class="btn-back-to-top" id="backToTopBtn" aria-label="Kembali ke atas">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="m18 15-6-6-6 6"></path>
        </svg>
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

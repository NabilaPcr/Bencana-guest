<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siaga Desa - Platform Bantuan Bencana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ===== VARIABLES & RESET ===== */
        :root {
            --primary: #56a65a;
            --secondary: #4ECDC4;
            --dark: #2e6d38;
            --light: #F7F7F7;
            --accent: #f39c12;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
            --gray: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f7fbf7;
            color: #2b2b2b;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ===== FIX DROPDOWN ISSUE ===== */
        header, .navbar, .nav-links, .dropdown {
            overflow: visible !important;
        }

        /* ===== NAVBAR IMPROVED WITH LOGO HORIZONTAL ===== */
        header {
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 12px 20px;
        }

        /* ===== LOGO HORIZONTAL IMPROVED ===== */
        .logo-horizontal {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
            padding: 5px 0;
        }

        .logo-horizontal:hover {
            transform: translateY(-2px);
            text-decoration: none;
        }

        .logo-icon-container {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(86, 166, 90, 0.3);
            transition: all 0.3s ease;
        }

        .logo-horizontal:hover .logo-icon-container {
            transform: rotate(-5deg) scale(1.05);
            box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
        }

        .logo-icon-container i {
            font-size: 22px;
            color: white;
        }

        .logo-text-container {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .logo-main {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -0.5px;
        }

        .logo-accent {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
            margin-top: -2px;
        }

        /* ===== NAV LINKS ===== */
        .nav-links {
            display: flex;
            list-style: none;
            gap: 15px;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .nav-links>li {
            position: relative;
        }

        .nav-links a {
            font-weight: 600;
            color: var(--dark);
            transition: all 0.3s;
            padding: 10px 18px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 1rem;
        }

        .nav-links a i:first-child {
            font-size: 16px;
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }

        .nav-links a:hover {
            background: linear-gradient(135deg, var(--primary), #4a9a4e);
            color: white !important;
            box-shadow: 0 4px 12px rgba(86, 166, 90, 0.3);
        }

        /* ===== DROPDOWN MENU - FIXED ===== */
        .dropdown {
            position: relative;
            z-index: 1001;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dropdown-toggle .fa-chevron-down {
            font-size: 0.8rem;
            transition: transform 0.3s ease;
            margin-left: 3px;
        }

        .dropdown:hover .dropdown-toggle .fa-chevron-down {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 220px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            border-radius: 12px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 1002 !important;
            padding: 10px 0;
            margin-top: 8px;
            border: 1px solid rgba(86, 166, 90, 0.1);
            list-style: none;
            display: block !important;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0);
        }

        .dropdown-menu li {
            list-style: none;
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 6px;
            margin: 2px 10px;
            font-size: 0.95rem;
        }

        .dropdown-menu a i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            color: var(--primary);
        }

        .dropdown-menu a:hover {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white !important;
            transform: translateX(5px);
        }

        .dropdown-menu a:hover i {
            color: white;
        }

        /* ===== LOGIN BUTTON ===== */
        .btn-login {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white !important;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(86, 166, 90, 0.3);
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #48904d, #255d2a);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
            color: white !important;
        }

        /* ===== RESPONSIVE NAVBAR ===== */
        @media (max-width: 992px) {
            .nav-links {
                gap: 10px;
            }

            .nav-links a {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }

            .nav-links {
                flex-direction: column;
                gap: 8px;
                width: 100%;
                align-items: stretch;
            }

            .nav-links a {
                justify-content: flex-start;
                padding: 12px 20px;
            }

            .dropdown-menu {
                position: static !important;
                box-shadow: none;
                border: 1px solid rgba(86, 166, 90, 0.2);
                margin: 5px 0 !important;
                background: #f9fff9;
                width: 100%;
                opacity: 1 !important;
                visibility: visible !important;
                transform: none !important;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .dropdown:hover .dropdown-menu {
                max-height: 300px;
                padding: 10px 0;
            }

            .dropdown-menu a {
                margin: 2px 15px;
                padding: 10px 15px 10px 30px;
            }

            .btn-login {
                margin-top: 10px;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .logo-icon-container {
                width: 40px;
                height: 40px;
            }

            .logo-icon-container i {
                font-size: 20px;
            }

            .logo-main {
                font-size: 20px;
            }

            .logo-accent {
                font-size: 16px;
            }

            .navbar {
                padding: 10px 15px;
            }
        }

        /* ===== DASHBOARD STYLES ===== */
        .hero-section {
            background: linear-gradient(135deg, #a8e0b3, #eaf5ea);
            padding: 120px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 2.8rem;
            color: var(--dark);
            margin-bottom: 20px;
            line-height: 1.2;
            font-weight: 700;
        }

        .hero-content p {
            color: #333;
            margin-bottom: 30px;
            font-size: 1.2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.3s;
            display: inline-block;
            font-size: 1.1rem;
            text-decoration: none;
            border: none;
        }

        .btn-primary:hover {
            background-color: #48904d;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
            color: white;
            text-decoration: none;
        }

        .section {
            padding: 80px 0;
        }

        .section h2 {
            text-align: center;
            color: var(--dark);
            font-size: 2.2rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .section p {
            text-align: center;
            color: #444;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto 30px;
            font-size: 1.1rem;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .event-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
        }

        .event-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .event-card h3 {
            padding: 20px 20px 10px;
            color: var(--dark);
            font-size: 1.4rem;
            font-weight: 600;
        }

        .event-card p {
            padding: 0 20px 15px;
            color: #555;
            text-align: left;
            font-size: 1rem;
            flex: 1;
        }

        .event-btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 6px 16px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 0 20px 20px;
            text-align: center;
            width: auto;
            font-size: 0.85rem;
            min-width: 120px;
        }

        .event-btn:hover {
            background: #48904d;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(86, 166, 90, 0.3);
            color: white;
            text-decoration: none;
        }

        .stats-section {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white;
            padding: 60px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .contact-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }

        .contact-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
            width: 250px;
            transition: transform 0.3s;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .contact-card h3 {
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .contact-card p {
            color: #555;
            margin-bottom: 0;
            text-align: center;
        }

        /* ===== FORM STYLES ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            width: 100%;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            margin-bottom: 30px;
            font-weight: 500;
        }

        .back-link:hover {
            color: #48904d;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 6px solid var(--accent);
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            color: var(--dark);
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .form-header p {
            color: #666;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            background: var(--accent);
            color: white;
            padding: 15px 10px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-cancel {
            background: var(--gray);
            color: white;
            padding: 0cm;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex: 0.5;
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-submit-full {
            flex: 1;
        }

        /* ===== LISTING STYLES ===== */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
            gap: 20px;
        }

        .header-text h1 {
            color: var(--dark);
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-text p {
            color: #666;
        }

        .btn-add {
            background: #24af5a;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .btn-add:hover {
            background: #1e8d4a;
            transform: translateY(-2px);
        }

        /* ===== FIXED GRID LAYOUT ===== */
        .warga-grid,
        .kejadian-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            width: 100%;
        }

        .warga-card,
        .kejadian-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid var(--primary);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            height: auto;
            min-height: 0;
            break-inside: avoid;
        }

        .warga-card:hover,
        .kejadian-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .warga-card h3,
        .kejadian-card h3 {
            color: var(--dark);
            font-size: 1.4rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            word-break: break-word;
            hyphens: auto;
            line-height: 1.3;
        }

        .warga-info,
        .kejadian-info {
            flex: 1;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .warga-info p,
        .kejadian-info p {
            margin-bottom: 8px;
            color: #555;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
            hyphens: auto;
        }

        .warga-info strong,
        .kejadian-info strong {
            color: #333;
            min-width: 120px;
        }

        .warga-info i,
        .kejadian-info i {
            color: var(--primary);
            width: 16px;
            text-align: center;
        }

        /* ===== STATUS STYLES ===== */
        .status-korban {
            background: #ffeaea;
            color: var(--danger);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
            display: inline-block;
            max-width: 100%;
            word-break: break-word;
            white-space: normal;
            text-align: center;
            line-height: 1.3;
        }

        .status-pengungsi {
            background: #eaf7ff;
            color: var(--info);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
            display: inline-block;
            max-width: 100%;
            word-break: break-word;
            white-space: normal;
            text-align: center;
            line-height: 1.3;
        }

        .status-relawan {
            background: #f0ffea;
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
            display: inline-block;
            max-width: 100%;
            word-break: break-word;
            white-space: normal;
            text-align: center;
            line-height: 1.3;
        }

        .status-warga_biasa {
            background: #f8f9fa;
            color: var(--gray);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
            display: inline-block;
            max-width: 100%;
            word-break: break-word;
            white-space: normal;
            text-align: center;
            line-height: 1.3;
        }

        .health-sehat {
            color: #27ae60;
        }

        .health-luka_ringan {
            color: var(--warning);
        }

        .health-luka_berat {
            color: var(--danger);
        }

        .health-meninggal {
            color: #7f8c8d;
        }

        /* ===== CARD ACTIONS FIXED ===== */
        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
            flex-wrap: wrap;
        }

        .card-actions a,
        .card-actions button {
            flex: 1;
            min-width: 80px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 12px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.85rem;
            white-space: nowrap;
            text-align: center;
            border: none;
            cursor: pointer;
        }

        .btn-detail {
            background: var(--primary);
            color: white;
        }

        .btn-detail:hover {
            background: #48904d;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: var(--accent);
            color: white;
        }

        .btn-edit:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: var(--danger);
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .delete-form {
            flex: 1;
            margin: 0;
        }

        /* ===== FILTER SECTION ===== */
        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
        }

        .filter-form .form-row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: end;
        }

        .filter-form .form-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #495057;
        }

        .filter-form input,
        .filter-form select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-filter {
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-reset {
            background: var(--gray);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        /* ===== DETAIL STYLES ===== */
        .detail-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 6px solid var(--primary);
        }

        .detail-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .detail-header h1 {
            color: var(--dark);
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .status-aktif {
            background: #ffeaea;
            color: var(--danger);
        }

        .status-selesai {
            background: #eafaf1;
            color: #27ae60;
        }

        .status-dalam-penanganan {
            background: #fef5e7;
            color: var(--warning);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-group {
            margin-bottom: 25px;
        }

        .info-group h3 {
            color: var(--dark);
            font-size: 1.1rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-group h3 i {
            color: var(--primary);
            width: 20px;
        }

        .info-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid var(--primary);
        }

        .keterangan-box {
            background: #fff9e6;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid var(--accent);
            margin-top: 20px;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            color: #999;
            margin-bottom: 10px;
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: var(--dark);
            text-align: center;
            padding: 30px 0;
            color: white;
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1200px) {
            .container {
                max-width: 100%;
                padding: 30px 20px;
            }
        }

        @media (max-width: 992px) {

            .warga-grid,
            .kejadian-grid {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 20px;
            }

            .form-card,
            .detail-card {
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }

            .warga-grid,
            .kejadian-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .warga-card,
            .kejadian-card {
                padding: 20px;
            }

            .card-actions {
                flex-direction: row;
                gap: 8px;
            }

            .card-actions a,
            .card-actions button {
                flex: 1;
                min-width: 70px;
                padding: 8px 10px;
                font-size: 0.8rem;
            }

            .form-card,
            .detail-card {
                padding: 20px;
            }

            .form-header h1,
            .detail-header h1 {
                font-size: 1.8rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .action-buttons {
                flex-direction: column;
            }

            .page-header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .header-text h1 {
                font-size: 1.8rem;
                justify-content: center;
            }

            .btn-add {
                justify-content: center;
            }

            .detail-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .btn {
                justify-content: center;
            }

            .contact-info {
                flex-direction: column;
                align-items: center;
            }

            .filter-form .form-group {
                min-width: 100%;
            }

            .filter-form .form-row {
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 15px 10px;
            }

            .warga-card,
            .kejadian-card {
                padding: 15px;
            }

            .card-actions {
                flex-direction: column;
                gap: 8px;
            }

            .card-actions a,
            .card-actions button {
                width: 100%;
            }

            .warga-info p,
            .kejadian-info p {
                flex-direction: column;
                gap: 5px;
            }

            .warga-info strong,
            .kejadian-info strong {
                min-width: auto;
            }
        }
    </style>
</head>
</html>

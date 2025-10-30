<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaDesa - Platform Bantuan Bencana</title>
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

        /* ===== NAVBAR (COMMON) ===== */
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
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
            padding: 15px 20px;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
        }

        .navbar .logo i {
            font-size: 2rem;
            color: var(--primary);
        }

        .navbar .logo span {
            color: #7ac27b;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            font-weight: 500;
            color: var(--dark);
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn-login {
            background: var(--primary);
            color: white !important;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #48904d;
        }

        /* ===== DASHBOARD STYLES ===== */
        /* Hero Section */
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

        /* Section Styles */
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

        /* Event Grid */
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

        /* Stats Section */
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

        /* Contact Section */
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

        /* ===== FORM STYLES (WARGA & KEJADIAN) ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
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
            padding: 15px 30px;
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
            padding: 15px 30px;
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
            gap: 8px;
            flex: 1;
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-submit-full {
            flex: 2;
        }

        /* ===== LISTING STYLES (WARGA & KEJADIAN INDEX) ===== */
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

        /* Grid Styles */
        .warga-grid,
        .kejadian-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
        }

        .warga-card,
        .kejadian-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid var(--primary);
            transition: transform 0.3s, box-shadow 0.3s;
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
        }

        .warga-info,
        .kejadian-info {
            margin-bottom: 20px;
        }

        .warga-info p,
        .kejadian-info p {
            margin-bottom: 8px;
            color: #555;
            display: flex;
            align-items: flex-start;
            gap: 10px;
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

        /* Status Styles */
        .status-korban {
            background: #ffeaea;
            color: var(--danger);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-pengungsi {
            background: #eaf7ff;
            color: var(--info);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-relawan {
            background: #f0ffea;
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-warga_normal {
            background: #f8f9fa;
            color: var(--gray);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        /* Health Status */
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

        /* Card Actions */
        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .card-actions a,
        .card-actions button {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 15px;
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
            width: 200px;
            /* atur lebar tombol */
            height: 50px;
            /* atur tinggi tombol */
            font-size: 14px;
            /* atur ukuran teks */
            padding: 10px 20px;
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

        /* Empty State */
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

        /* ===== DETAIL STYLES (SHOW) ===== */
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

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: #48904d;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--gray);
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        /* ===== FOOTER (COMMON) ===== */
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

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }

            .hero-content h1 {
                font-size: 2.2rem;
            }

            .section h2 {
                font-size: 1.8rem;
            }

            .event-grid,
            .warga-grid,
            .kejadian-grid {
                grid-template-columns: 1fr;
            }

            .form-card,
            .detail-card {
                padding: 25px;
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
            }

            .btn-add {
                justify-content: center;
            }

            .card-actions {
                flex-direction: column;
                gap: 8px;
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
        }
    </style>

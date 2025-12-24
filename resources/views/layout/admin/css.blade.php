<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Siaga Desa- Platform Bantuan Bencana</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* ===== RESET & FONT ===== */
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
        padding-bottom: 20px;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* ===== NAVBAR IMPROVED ===== */
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
        background: linear-gradient(135deg, #56a65a, #2e6d38);
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
        color: #2e6d38;
        letter-spacing: -0.5px;
    }

    .logo-accent {
        font-size: 18px;
        font-weight: 600;
        color: #56a65a;
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
        color: #2e6d38;
        transition: all 0.3s;
        padding: 10px 18px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .nav-links a i:first-child {
        font-size: 16px;
        width: 20px;
        text-align: center;
        margin-right: 8px;
    }

    .nav-links a:hover {
        background: linear-gradient(135deg, #56a65a, #4a9a4e);
        color: white !important;
        box-shadow: 0 4px 12px rgba(86, 166, 90, 0.3);
    }

    /* ===== DROPDOWN MENU ===== */
    .dropdown-toggle {
        position: relative;
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
        z-index: 1000;
        padding: 10px 0;
        margin-top: 8px;
        border: 1px solid rgba(86, 166, 90, 0.1);
        list-style: none;
    }

    .dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
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
        color: #2e6d38;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 6px;
        margin: 2px 10px;
    }

    .dropdown-menu a i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
        color: #56a65a;
    }

    .dropdown-menu a:hover {
        background: linear-gradient(135deg, #56a65a, #2e6d38);
        color: white !important;
        transform: translateX(5px);
    }

    .dropdown-menu a:hover i {
        color: white;
    }

    /* ===== LOGIN BUTTON ===== */
    .btn-login {
        background: linear-gradient(135deg, #56a65a, #2e6d38);
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
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #48904d, #255d2a);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
        color: white !important;
    }

    /* ===== RESPONSIVE ===== */
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
            position: static;
            box-shadow: none;
            border: 1px solid rgba(86, 166, 90, 0.2);
            margin: 5px 0 !important;
            background: #f9fff9;
            width: 100%;
            opacity: 1;
            visibility: visible;
            transform: none;
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
    }

    /* ===== LOGIN BUTTON IMPROVED ===== */
    .btn-login {
        background: linear-gradient(135deg, #56a65a, #2e6d38);
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
        margin-left: 10px;
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #48904d, #255d2a);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
        color: white !important;
    }

    /* ===== MAIN CONTENT ===== */
    .container {
        max-width: 1200px;
        margin: 40px auto 20px;
        padding: 0 20px;
    }

    .container-form {
        max-width: 600px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 30px;
        gap: 20px;
        padding: 0 5px;
    }

    .header-text h1 {
        color: #2e6d38;
        font-size: 2.2rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header-text h1 i {
        font-size: 1.8rem;
    }

    .header-text p {
        color: #666;
        font-size: 1rem;
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
        font-size: 0.95rem;
        height: fit-content;
    }

    .btn-add:hover {
        background: #1e8d4a;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(36, 175, 90, 0.3);
    }

    /* ===== BACK LINK ===== */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #56a65a;
        margin-bottom: 25px;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .back-link:hover {
        color: #48904d;
    }

    /* ===== FORM STYLES ===== */
    .form-card {
        background: white;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border-left: 6px solid #f39c12;
    }

    .form-card-create {
        border-left: 6px solid #24af5a;
    }

    .form-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .form-header h1 {
        color: #2e6d38;
        font-size: 2rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .form-header p {
        color: #666;
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #2e6d38;
        font-size: 0.95rem;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #56a65a;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .password-note {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 14px;
        margin: 20px 0;
        font-size: 0.9rem;
        color: #6c757d;
        line-height: 1.5;
    }

    .password-note i {
        color: #f39c12;
        margin-right: 8px;
    }

    /* ===== BUTTON STYLES ===== */
    .btn-submit {
        background: #f39c12;
        color: white;
        padding: 14px 28px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit-create {
        background: #24af5a;
    }

    .btn-submit:hover {
        background: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(243, 156, 18, 0.3);
    }

    .btn-submit-create:hover {
        background: #1e8d4a;
        box-shadow: 0 4px 8px rgba(36, 175, 90, 0.3);
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
        padding: 14px 28px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
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
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
    }

    .btn-submit-full {
        flex: 2;
    }

    /* ===== TABLE STYLES ===== */
    .table-container {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        min-width: 800px;
    }

    .users-table th {
        background: #2e6d38;
        color: white;
        padding: 16px 18px;
        text-align: left;
        font-weight: 600;
        border: none;
        font-size: 0.95rem;
        white-space: nowrap;
    }

    /* Atur lebar kolom dengan proporsi yang lebih baik */
    .users-table th:nth-child(1) {
        width: 60px; /* NO - lebih kecil */
        text-align: center;
    }

    .users-table th:nth-child(2) {
        width: 22%; /* NAME */
    }

    .users-table th:nth-child(3) {
        width: 28%; /* EMAIL */
    }

    .users-table th:nth-child(4) {
        width: 15%; /* ROLE - lebih kecil karena badge sudah ringkas */
        text-align: center;
    }

    .users-table th:nth-child(5) {
        width: 22%; /* PASSWORD */
    }

    .users-table th:nth-child(6) {
        width: 180px; /* ACTION - fixed width */
    }

    .users-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
        word-wrap: break-word;
        font-size: 0.92rem;
    }

    .users-table tr:last-child td {
        border-bottom: none;
    }

    .users-table tr:hover {
        background: #f9fff9;
    }

    .users-table td:nth-child(1) {
        text-align: center;
        color: #666;
        font-weight: 500;
    }

    .users-table td:nth-child(4) {
        text-align: center;
        vertical-align: middle;
    }

    .user-name {
        font-weight: 600;
        color: #2e6d38;
        font-size: 0.95rem;
    }

    .user-email {
        color: #666;
        word-wrap: break-word;
        font-size: 0.9rem;
    }

    .password-cell {
        max-width: 250px;
    }

    .password-hash {
        font-family: 'Consolas', 'Monaco', 'Courier New', monospace;
        font-size: 0.8rem;
        color: #888;
        word-break: break-all;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.4;
        padding: 6px 8px;
        background: #f8f9fa;
        border-radius: 6px;
        border: 1px solid #e9ecef;
        max-height: 48px;
    }

    /* ===== ROLE BADGE (TANPA IKON) ===== */
    .role-badge {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        min-width: 120px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid;
    }

    .role-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* Super Admin Role - warna lebih gelap */
    .role-badge-superadmin {
        background-color: #f8c471;
        color: #7d3c1e;
        border-color: #e67e22;
    }

    /* Admin Role - warna lebih gelap */
    .role-badge-admin {
        background-color: #85c1e9;
        color: #154360;
        border-color: #2e86c1;
    }

    /* Mira Role - dari gambar */
    .role-badge-mira {
        background-color: #d7bde2;
        color: #6c3483;
        border-color: #8e44ad;
    }

    /* Warga Role - dari gambar */
    .role-badge-warga {
        background-color: #82e0aa;
        color: #186a3b;
        border-color: #28b463;
    }

    /* Staf Role - warna lebih gelap */
    .role-badge-staf {
        background-color: #aed6f1;
        color: #1b4f72;
        border-color: #3498db;
    }

    /* Relawan Role - warna lebih gelap */
    .role-badge-relawan {
        background-color: #bb8fce;
        color: #4a235a;
        border-color: #9b59b6;
    }

    /* Umum Role - warna lebih gelap */
    .role-badge-umum {
        background-color: #f2f3f4;
        color: #424949;
        border-color: #bdc3c7;
    }

    /* Mitra Role - warna lebih gelap */
    .role-badge-mitra {
        background-color: #f5b7b1;
        color: #78281f;
        border-color: #e74c3c;
    }

    /* Disabled Role - warna lebih gelap */
    .role-badge-disabled {
        background-color: #b2babb;
        color: #212f3d;
        border-color: #7f8c8d;
        opacity: 0.8;
    }

    /* Role Display in Table */
    .role-cell {
        text-align: center;
        vertical-align: middle;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    /* Role Filter Dropdown */
    .role-filter {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .role-filter-btn {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        border: 2px solid transparent;
        background: white;
        color: #495057;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .role-filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .role-filter-btn.active {
        font-weight: 600;
    }

    .role-filter-btn[data-role="superadmin"] {
        border-color: #e67e22;
        color: #7d3c1e;
    }

    .role-filter-btn[data-role="admin"] {
        border-color: #2e86c1;
        color: #154360;
    }

    .role-filter-btn[data-role="mira"] {
        border-color: #8e44ad;
        color: #6c3483;
    }

    .role-filter-btn[data-role="warga"] {
        border-color: #28b463;
        color: #186a3b;
    }

    .role-filter-btn[data-role="staf"] {
        border-color: #3498db;
        color: #1b4f72;
    }

    .role-filter-btn[data-role="relawan"] {
        border-color: #9b59b6;
        color: #4a235a;
    }

    .role-filter-btn[data-role="umum"] {
        border-color: #bdc3c7;
        color: #424949;
    }

    .role-filter-btn[data-role="mitra"] {
        border-color: #e74c3c;
        color: #78281f;
    }

    .role-count {
        font-size: 0.75rem;
        background: #f1f2f6;
        padding: 2px 8px;
        border-radius: 10px;
        margin-left: 4px;
    }

    /* Role Selector in Forms */
    .role-selector {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 12px;
        margin: 15px 0;
    }

    .role-option {
        position: relative;
        cursor: pointer;
    }

    .role-option input[type="radio"] {
        display: none;
    }

    .role-option label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px 15px;
        border-radius: 12px;
        background: white;
        border: 2px solid #e0e0e0;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        min-height: 100px;
    }

    .role-option label:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .role-option input[type="radio"]:checked + label {
        border-width: 3px;
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .role-option input[type="radio"]:checked + label .role-icon {
        transform: scale(1.1);
    }

    .role-option[data-role="superadmin"] input[type="radio"]:checked + label {
        border-color: #e67e22;
        background: linear-gradient(135deg, #fff5e6 0%, #ffeaa7 30%);
    }

    .role-option[data-role="admin"] input[type="radio"]:checked + label {
        border-color: #2e86c1;
        background: linear-gradient(135deg, #e8f4ff 0%, #d0e7ff 30%);
    }

    .role-option[data-role="mira"] input[type="radio"]:checked + label {
        border-color: #8e44ad;
        background: linear-gradient(135deg, #f4ecf7 0%, #e8d4f1 30%);
    }

    .role-option[data-role="warga"] input[type="radio"]:checked + label {
        border-color: #28b463;
        background: linear-gradient(135deg, #e8fff8 0%, #d0fff0 30%);
    }

    .role-option[data-role="staf"] input[type="radio"]:checked + label {
        border-color: #3498db;
        background: linear-gradient(135deg, #e8f4ff 0%, #d0e7ff 30%);
    }

    .role-option[data-role="relawan"] input[type="radio"]:checked + label {
        border-color: #9b59b6;
        background: linear-gradient(135deg, #f0eeff 0%, #e6e3ff 30%);
    }

    .role-option[data-role="umum"] input[type="radio"]:checked + label {
        border-color: #bdc3c7;
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f2f6 30%);
    }

    .role-option[data-role="mitra"] input[type="radio"]:checked + label {
        border-color: #e74c3c;
        background: linear-gradient(135deg, #fdedec 0%, #fadbd8 30%);
    }

    .role-icon {
        font-size: 2rem;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .role-name {
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 0.95rem;
    }

    .role-description {
        font-size: 0.8rem;
        color: #666;
        line-height: 1.3;
    }

    /* ===== ACTION BUTTONS ===== */
    .action-buttons-table {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
        justify-content: center;
    }

    .btn-action {
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        white-space: nowrap;
        min-width: 80px;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-edit {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        color: white;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #e67e22, #d35400);
    }

    .btn-delete {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #c0392b, #a93226);
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
        font-size: 1.5rem;
    }

    /* ===== FOOTER INFO ===== */
    .table-footer {
        margin-top: 25px;
        padding: 18px 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .data-info {
        font-size: 0.9rem;
        color: #495057;
    }

    .data-info strong {
        color: #2e6d38;
    }

    .system-info {
        font-size: 0.85rem;
        color: #6c757d;
        font-style: italic;
        margin-top: 5px;
    }

    .system-info i {
        color: #56a65a;
        margin-right: 6px;
    }

    /* ===== PAGINATION ===== */
    .pagination-simple {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .btn-prev,
    .btn-next {
        padding: 8px 16px;
        background: #2e6d38;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
    }

    .btn-prev:hover,
    .btn-next:hover {
        background: #48904d;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(46, 125, 56, 0.3);
    }

    /* ===== FOOTER ===== */
    footer {
        background-color: #2e6d38;
        text-align: center;
        padding: 30px 0;
        color: white;
        margin-top: 60px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .container {
            max-width: 95%;
        }
    }

    @media (max-width: 992px) {
        .users-table th,
        .users-table td {
            padding: 14px 16px;
        }

        .role-badge {
            min-width: 100px;
            padding: 6px 12px;
            font-size: 0.75rem;
        }

        .btn-action {
            padding: 6px 12px;
            min-width: 70px;
            font-size: 0.8rem;
        }

        .users-table {
            min-width: 1000px;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
            margin: 30px auto 15px;
        }

        .page-header {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
            margin-bottom: 25px;
        }

        .header-text h1 {
            font-size: 1.8rem;
        }

        .header-text h1 i {
            font-size: 1.6rem;
        }

        .btn-add {
            justify-content: center;
            width: 100%;
        }

        .table-container {
            padding: 20px;
            border-radius: 12px;
        }

        .users-table {
            min-width: 900px;
        }

        .users-table th {
            padding: 14px 16px;
            font-size: 0.9rem;
        }

        .users-table td {
            padding: 14px 16px;
            font-size: 0.88rem;
        }

        .action-buttons-table {
            flex-direction: column;
            gap: 6px;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
            padding: 8px 12px;
            min-width: auto;
        }

        .form-card {
            padding: 25px;
        }

        .form-header h1 {
            font-size: 1.8rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .action-buttons {
            flex-direction: column;
        }

        .table-footer {
            flex-direction: column;
            text-align: center;
            gap: 12px;
            padding: 15px;
        }

        /* Role Responsive */
        .role-badge {
            min-width: 100px;
            padding: 6px 12px;
            font-size: 0.75rem;
        }

        .role-selector {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .role-option label {
            padding: 15px 10px;
            min-height: 80px;
        }

        .role-icon {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .role-name {
            font-size: 0.85rem;
        }

        .role-description {
            font-size: 0.7rem;
        }

        /* Navbar responsive */
        .nav-links {
            flex-direction: column;
            gap: 5px;
            width: 100%;
            align-items: stretch;
        }

        .nav-links a {
            margin: 2px 0;
            border-radius: 8px;
            justify-content: flex-start;
        }

        .btn-login {
            margin: 10px 0 0 0;
            width: 100%;
            justify-content: center;
        }

        .dropdown-menu {
            position: static;
            box-shadow: none;
            border: 1px solid rgba(0, 0, 0, 0.1);
            margin: 5px 0 !important;
            background: #f8f9fa;
            width: 100%;
            opacity: 1;
            visibility: visible;
            transform: none;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .dropdown:hover .dropdown-menu {
            max-height: 200px;
            padding: 10px 0;
        }

        .dropdown-menu a {
            margin: 2px 5px;
            padding: 10px 15px 10px 35px;
        }
    }

    @media (max-width: 576px) {
        .navbar {
            flex-direction: column;
            gap: 15px;
            padding: 15px;
        }

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

        .nav-links {
            gap: 10px;
        }

        .users-table {
            min-width: 900px;
        }

        .header-text h1 {
            font-size: 1.6rem;
        }

        .header-text p {
            font-size: 0.9rem;
        }

        .btn-add {
            font-size: 0.9rem;
            padding: 10px 20px;
        }

        .role-badge {
            min-width: 85px;
            padding: 4px 10px;
            font-size: 0.7rem;
        }

        .password-hash {
            font-size: 0.7rem;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding: 0 10px;
        }

        .page-header {
            margin-bottom: 20px;
        }

        .header-text h1 {
            font-size: 1.5rem;
            gap: 8px;
        }

        .header-text h1 i {
            font-size: 1.4rem;
        }

        .table-container {
            padding: 15px;
        }

        .form-card {
            padding: 20px;
        }

        .form-header h1 {
            font-size: 1.6rem;
        }

        /* Role Responsive */
        .role-badge {
            min-width: 90px;
            padding: 5px 10px;
            font-size: 0.7rem;
        }

        .role-selector {
            grid-template-columns: 1fr;
        }

        .role-filter {
            justify-content: center;
        }

        .role-filter-btn {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }
</style>

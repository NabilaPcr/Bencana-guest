<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Siaga Desa- Platform Bantuan Bencana</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --primary: #56a65a;
        --secondary: #4ECDC4;
        --dark: #2e6d38;
        --light: #F7F7F7;
    }

    body {
        font-family: 'Quicksand', sans-serif;
        background-color: #ffffff;
        color: #2b2b2b;
        line-height: 1.6;
    }

    /* ===== LOGO HORIZONTAL ===== */
    .logo-horizontal {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: inherit;
        gap: 10px;
        font-size: 30px;
        font-weight: 700;
        color: var(--dark) !important;
        transition: transform 0.3s ease;
    }

    .logo-horizontal:hover {
        transform: translateY(-2px);
        text-decoration: none;
    }

    .logo-icon {
        font-size: 32px;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo-text {
        font-weight: 700;
        font-size: 30px;
        line-height: 1;
    }

    .logo-main {
        color: var(--dark);
    }

    .logo-accent {
        color: var(--primary);
    }

    /* Navbar */
    .navbar {
        padding: 15px 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        background: white;
    }

    .navbar-brand {
        font-size: 30px;
        font-weight: 700;
        color: var(--dark) !important;
    }

    .navbar-nav .nav-link {
        font-weight: 600;
        padding: 10px 15px !important;
        margin: 0 5px;
        border-radius: 5px;
        transition: all 0.3s;
        color: var(--dark);
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        background: var(--primary);
        color: white !important;
    }

    .btn-login {
        background: var(--primary);
        color: white !important;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .btn-login:hover {
        background: #48904d;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(86, 166, 90, 0.3);
    }

    /* ===== DROPDOWN MENU ===== */
    .navbar-nav .dropdown {
        position: relative;
    }

    .navbar-nav .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
        color: var(--dark);
        transition: all 0.3s;
        cursor: pointer;
        padding: 10px 15px !important;
        margin: 0 5px;
        border-radius: 5px;
        text-decoration: none;
    }

    .navbar-nav .dropdown-toggle:hover,
    .navbar-nav .dropdown:hover .dropdown-toggle {
        background: var(--primary);
        color: white !important;
    }

    .navbar-nav .dropdown-toggle .fa-chevron-down {
        font-size: 0.8rem;
        transition: transform 0.3s ease;
        margin-left: 3px;
    }

    .navbar-nav .dropdown:hover .dropdown-toggle .fa-chevron-down {
        transform: rotate(180deg);
    }

    .navbar-nav .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        min-width: 200px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 1000;
        padding: 8px 0;
        margin-top: 5px;
        border: none;
    }

    .navbar-nav .dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .navbar-nav .dropdown-menu li {
        list-style: none;
    }

    .navbar-nav .dropdown-menu a {
        display: block;
        padding: 10px 20px;
        text-decoration: none;
        color: var(--dark);
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 0;
    }

    .navbar-nav .dropdown-menu a:hover {
        background-color: var(--primary);
        color: white !important;
        padding-left: 25px;
    }

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

    /* Warga Section */
    .btn-lg {
        padding: 15px 30px;
        font-size: 1.1rem;
    }

    /* Kontak Section */
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

    /* Footer */
    .footer {
        background: var(--dark);
        color: white;
        padding: 60px 0 0;
    }

    .footer h2 {
        font-size: 20px;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer h2::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background: var(--primary);
    }

    .footer a {
        color: #ddd;
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .footer a:hover {
        color: var(--primary);
        padding-left: 5px;
        text-decoration: none;
    }

    .copyright {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 20px 0;
        margin-top: 40px;
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

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.2rem;
        }

        .section h2 {
            font-size: 1.8rem;
        }

        .event-grid {
            grid-template-columns: 1fr;
        }

        .contact-info {
            flex-direction: column;
            align-items: center;
        }

        /* Logo responsive */
        .logo-horizontal {
            font-size: 24px;
            gap: 8px;
        }

        .logo-icon {
            font-size: 26px;
        }

        .logo-text {
            font-size: 24px;
        }

        /* Dropdown responsive */
        .navbar-nav .dropdown-menu {
            position: static;
            box-shadow: none;
            border-radius: 0;
            border-left: 3px solid var(--primary);
            opacity: 1;
            visibility: visible;
            transform: none;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .navbar-nav .dropdown:hover .dropdown-menu {
            max-height: 200px;
            padding: 8px 0;
        }

        .navbar-nav .dropdown-menu a {
            padding: 10px 15px 10px 30px;
            background: #f7f7f7;
        }

        .navbar-nav .dropdown-menu a:hover {
            padding-left: 35px;
        }
    }

    @media (max-width: 576px) {
        .logo-horizontal {
            font-size: 20px;
        }

        .logo-icon {
            font-size: 22px;
        }

        .logo-text {
            font-size: 20px;
        }
    }

    /* Floating WhatsApp Button */
    .whatsapp-float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 25px;
        right: 25px;
        background-color: #25D366;
        color: #fff;
        border-radius: 50%;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .whatsapp-float i {
        margin-top: 15px;
    }

    .whatsapp-float:hover {
        background-color: #1ebe57;
        transform: scale(1.1);
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

/* ===== NAVBAR IMPROVEMENTS ===== */
.navbar {
    padding: 12px 0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    background: white !important;
    position: sticky;
    top: 0;
    z-index: 1030;
}

.navbar-nav {
    gap: 5px;
}

.navbar-nav .nav-link {
    font-weight: 600;
    padding: 10px 18px !important;
    margin: 0 3px;
    border-radius: 10px;
    transition: all 0.3s;
    color: var(--dark);
    display: flex;
    align-items: center;
    position: relative;
}

.navbar-nav .nav-link i {
    font-size: 16px;
    width: 20px;
    text-align: center;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
    background: linear-gradient(135deg, var(--primary), #4a9a4e);
    color: white !important;
    box-shadow: 0 4px 12px rgba(86, 166, 90, 0.3);
}

.navbar-nav .nav-link:hover::after,
.navbar-nav .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 6px;
    height: 6px;
    background: var(--primary);
    border-radius: 50%;
}

/* ===== DROPDOWN MENU IMPROVED ===== */
.nav-item.dropdown .dropdown-toggle {
    position: relative;
}

.nav-item.dropdown .dropdown-toggle::after {
    display: none;
}

.dropdown-menu {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    padding: 10px 0;
    margin-top: 8px !important;
    border: 1px solid rgba(86, 166, 90, 0.1);
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item {
    padding: 12px 20px;
    font-weight: 500;
    color: var(--dark);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    border-radius: 6px;
    margin: 2px 10px;
    width: auto;
}

.dropdown-item i {
    width: 20px;
    text-align: center;
    margin-right: 10px;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, var(--primary), var(--dark));
    color: white !important;
    transform: translateX(5px);
}

.dropdown-divider {
    margin: 8px 20px;
    border-color: rgba(86, 166, 90, 0.2);
}

/* ===== LOGIN BUTTON IMPROVED ===== */
.btn-login {
    background: linear-gradient(135deg, var(--primary), var(--dark));
    color: white !important;
    border-radius: 12px;
    transition: all 0.3s;
    padding: 10px 24px !important;
    margin-left: 10px;
    box-shadow: 0 4px 10px rgba(86, 166, 90, 0.3);
    border: none;
}

.btn-login:hover {
    background: linear-gradient(135deg, #48904d, #255d2a);
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
}

.btn-login i {
    margin-right: 8px;
}

/* ===== RESPONSIVE IMPROVEMENTS ===== */
@media (max-width: 992px) {
    .navbar-nav {
        gap: 0;
    }

    .navbar-nav .nav-link {
        margin: 2px 0;
        border-radius: 8px;
    }

    .btn-login {
        margin: 10px 0 0 0;
        width: 100%;
        justify-content: center;
    }

    .dropdown-menu {
        box-shadow: none;
        border: 1px solid rgba(0, 0, 0, 0.1);
        margin: 5px 0 !important;
        background: #f8f9fa;
    }

    .dropdown-item {
        margin: 2px 5px;
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
        padding: 8px 0;
    }

}
</style>

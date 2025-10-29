    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ===== NAVBAR ===== */
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 15px 20px;
            position: relative;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2e6d38;
            transition: transform 0.3s ease;
        }

        .navbar .logo:hover {
            transform: scale(1.05);
        }

        .navbar .logo i {
            font-size: 2rem;
            color: #56a65a;
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
            color: #2e6d38;
            transition: 0.3s;
            position: relative;
            padding: 5px 0;
        }

        .nav-links a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #56a65a;
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #56a65a;
        }

        .nav-links a:hover:after {
            width: 100%;
        }

        .btn-login {
            background: #56a65a;
            color: white !important;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: #48904d;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(86, 166, 90, 0.3);
        }

        .btn-login:after {
            display: none;
        }

        .btn-login i {
            font-size: 1.1rem;
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: #2e6d38;
            transition: 0.3s;
            border-radius: 2px;
        }

        /* Active menu item */
        .nav-links a.active {
            color: #56a65a;
            font-weight: 600;
        }

        .nav-links a.active:after {
            width: 100%;
        }

        /* ===== HERO ===== */
        .hero {
            background: linear-gradient(135deg, #a8e0b3, #eaf5ea);
            text-align: center;
            padding: 120px 20px;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 2.8rem;
            color: #2e6d38;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero p {
            color: #333;
            margin-bottom: 30px;
            font-size: 1.2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-primary {
            background-color: #56a65a;
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.3s;
            display: inline-block;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(86, 166, 90, 0.3);
        }

        .btn-primary:hover {
            background-color: #48904d;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
        }

        /* ===== SECTIONS ===== */
        section {
            padding: 80px 20px;
            max-width: 1100px;
            margin: auto;
        }

        section h2 {
            text-align: center;
            color: #2e6d38;
            font-size: 2.2rem;
            margin-bottom: 20px;
        }

        section p {
            text-align: center;
            color: #444;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        /* ===== KEGIATAN ===== */
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
            color: #2e6d38;
            font-size: 1.4rem;
        }

        .event-card p {
            padding: 0 20px 20px;
            color: #555;
            text-align: left;
            font-size: 1rem;
        }
        /* ===== TOMBOL EVENT CARD ===== */
.event-btn {
    display: inline-block;
    background: #56a65a;
    color: white;
    padding: 6px 16px; /* Lebar dikurangi */
    border-radius: 6px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: 10px;
    text-align: center;
    width: auto;
    font-size: 0.85rem;
    min-width: 120px; /* Atur lebar minimum */
}

.event-btn:hover {
    background: #48904d;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(86, 166, 90, 0.3);
}
/* Update event card untuk accommodate tombol */
.event-card {
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}

.event-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 20px rgba(0,0,0,0.12);
}

.event-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.event-card h3 {
    padding: 20px 20px 10px;
    color: #2e6d38;
    font-size: 1.4rem;
}

.event-card p {
    padding: 0 20px 15px;
    color: #555;
    text-align: left;
    font-size: 1rem;
    flex: 1; /* Agar tombol tetap di bawah */
}

.event-card .event-btn {
    margin: 0 20px 20px;
}

        /* ===== FOOTER ===== */
        footer {
            background-color: #2e6d38;
            text-align: center;
            padding: 30px 0;
            color: white;
            margin-top: 40px;
            font-size: 1rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }

            .nav-links {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 80%;
                height: calc(100vh - 70px);
                background-color: white;
                flex-direction: column;
                justify-content: flex-start;
                padding-top: 40px;
                gap: 25px;
                transition: left 0.4s ease;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            }

            .nav-links.active {
                left: 0;
            }

            .navbar {
                padding: 12px 20px;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            section h2 {
                font-size: 1.8rem;
            }

            .event-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animation for menu toggle */
        .menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }
</style>

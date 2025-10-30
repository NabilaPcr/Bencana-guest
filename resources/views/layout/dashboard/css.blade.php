 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>BinaDesa - Platform Bantuan Bencana</title>
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
     }

     /* Floating WhatsApp Button */
     .whatsapp-float {
         position: fixed;
         width: 60px;
         height: 60px;
         bottom: 40px;
         right: 40px;
         background-color: #25D366;
         color: #FFF;
         border-radius: 50px;
         text-align: center;
         font-size: 30px;
         box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
         z-index: 100;
         display: flex;
         align-items: center;
         justify-content: center;
         transition: all 0.3s ease;
         animation: pulse 2s infinite;
     }

     .whatsapp-float:hover {
         background-color: #128C7E;
         transform: scale(1.1);
         box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
     }

     @keyframes pulse {
         0% {
             box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
         }

         70% {
             box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
         }

         100% {
             box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
         }
     }
 </style>

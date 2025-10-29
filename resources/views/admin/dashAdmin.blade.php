<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Dashboard</title>

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #FF6B6B;
            --secondary: #4ECDC4;
            --dark: #292B2C;
            --light: #F7F7F7;
            --success: #28a745;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f8f9fa;
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: var(--dark);
            color: white;
            transition: all 0.3s;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .main-content {
            margin-left: 250px;
            flex: 1;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
        }

        .sidebar-menu {
            padding: 0;
            list-style: none;
        }

        .sidebar-menu li {
            position: relative;
        }

        .sidebar-menu a {
            padding: 12px 20px;
            display: block;
            color: #ddd;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 3px solid var(--primary);
        }

        .sidebar-menu a i {
            margin-right: 10px;
        }

        .top-navbar {
            background: white;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .content-area {
            padding: 20px;
        }

        .dashboard-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            padding: 15px 20px;
            background: var(--dark);
            color: white;
            border-bottom: 0;
        }

        .card-body {
            padding: 20px;
        }

        /* Charity Template Styles */
        .btn-custom {
            background: var(--primary);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background: #e55c5c;
            color: white;
            transform: translateY(-2px);
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header p {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .section-header h2 {
            font-weight: 700;
            color: var(--dark);
        }

        .carousel-item {
            position: relative;
            height: 500px;
        }

        .carousel-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .carousel-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 2;
            width: 80%;
        }

        .carousel-text h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
        }

        .carousel-text p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .service-item, .causes-item, .team-item, .blog-item, .event-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            margin-bottom: 30px;
        }

        .service-item:hover, .causes-item:hover, .team-item:hover, .blog-item:hover, .event-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-icon i {
            font-size: 30px;
            color: white;
        }

        .facts {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://via.placeholder.com/1920x600');
            background-size: cover;
            background-attachment: fixed;
            padding: 100px 0;
            color: white;
            text-align: center;
        }

        .facts-item i {
            font-size: 50px;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .facts-text h3 {
            font-size: 40px;
            font-weight: 700;
        }

        .donate, .volunteer {
            background-size: cover;
            background-attachment: fixed;
            padding: 100px 0;
            color: white;
        }

        .donate {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://via.placeholder.com/1920x600');
        }

        .volunteer {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://via.placeholder.com/1920x600');
        }

        .testimonial-item {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin: 15px;
        }

        .testimonial-profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .testimonial-profile img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

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

        .copyright {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 20px 0;
            margin-top: 40px;
        }

        /* Dashboard Stats */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            margin-bottom: 20px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 24px;
            color: white;
        }

        .stat-number {
            font-size: 30px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 14px;
        }

        /* Toggle for mobile */
        #sidebarToggle {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.active {
                margin-left: 250px;
            }

            #sidebarToggle {
                display: block;
            }

            .carousel-text h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>Charity Dashboard</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="#"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li><a href="#"><i class="fas fa-hand-holding-heart"></i> Causes</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i> Events</a></li>
                <li><a href="#"><i class="fas fa-blog"></i> Blog</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Our Team</a></li>
                <li><a href="#"><i class="fas fa-donate"></i> Donations</a></li>
                <li><a href="#"><i class="fas fa-user-plus"></i> Volunteers</a></li>
                <li><a href="#"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <div class="top-navbar d-flex justify-content-between align-items-center">
                <button id="sidebarToggle" class="btn btn-primary">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Admin User
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Dashboard Stats -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-donate"></i>
                            </div>
                            <div class="stat-number">$24,580</div>
                            <div class="stat-label">Total Donations</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <div class="stat-number">$50,000</div>
                            <div class="stat-label">Fundraising Goal</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number">248</div>
                            <div class="stat-label">Active Volunteers</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stat-number">12</div>
                            <div class="stat-label">Upcoming Events</div>
                        </div>
                    </div>
                </div>

                <!-- Charity Template Content -->

                <!-- Carousel Start -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h4 class="mb-0">Our Mission</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="carousel">
                            <div class="carousel-item">
                                <div class="carousel-img" style="background-image: url('https://via.placeholder.com/1920x800');"></div>
                                <div class="carousel-text">
                                    <h1>Let's be kind for children</h1>
                                    <p>Lorem ipsum dolor sit amet elit. Phasellus ut mollis mauris. Vivamus egestas eleifend dui ac consequat at lectus in malesuada</p>
                                    <div class="carousel-btn">
                                        <a class="btn btn-custom" href="">Donate Now</a>
                                        <a class="btn btn-custom" href="">Watch Video</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel End -->

                <!-- About Start -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h4 class="mb-0">About Our Organization</h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="about-img" style="height: 400px; background: url('https://via.placeholder.com/600x400') center/cover;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="section-header">
                                    <p>Learn About Us</p>
                                    <h2>Worldwide non-profit charity organization</h2>
                                </div>
                                <div class="about-tab">
                                    <ul class="nav nav-pills nav-justified">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#tab-content-1">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#tab-content-2">Mission</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#tab-content-3">Vision</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-4">
                                        <div id="tab-content-1" class="container tab-pane active">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae pellentesque turpis. Donec in hendrerit dui, vel blandit massa. Ut vestibulum suscipit cursus. Cras quis porta nulla, ut placerat risus.
                                        </div>
                                        <div id="tab-content-2" class="container tab-pane fade">
                                            Sed tincidunt, magna ut vehicula volutpat, turpis diam condimentum justo, posuere congue turpis massa in mi. Proin ornare at massa at fermentum. Nunc aliquet sed nisi iaculis ornare.
                                        </div>
                                        <div id="tab-content-3" class="container tab-pane fade">
                                            Aliquam dolor odio, mollis sed feugiat sit amet, feugiat ut sapien. Nunc eu dignissim lorem. Suspendisse at hendrerit enim. Interdum et malesuada fames ac ante ipsum primis in faucibus.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About End -->

                <!-- Service Start -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h4 class="mb-0">What We Do</h4>
                    </div>
                    <div class="card-body">
                        <div class="section-header text-center">
                            <p>What We Do?</p>
                            <h2>We believe that we can save more lifes with you</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="service-item">
                                    <div class="service-icon">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                    <div class="service-text text-center p-4">
                                        <h3>Healthy Food</h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="service-item">
                                    <div class="service-icon">
                                        <i class="fas fa-tint"></i>
                                    </div>
                                    <div class="service-text text-center p-4">
                                        <h3>Pure Water</h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="service-item">
                                    <div class="service-icon">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>
                                    <div class="service-text text-center p-4">
                                        <h3>Health Care</h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service End -->

                <!-- Causes Start -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h4 class="mb-0">Popular Causes</h4>
                    </div>
                    <div class="card-body">
                        <div class="section-header text-center">
                            <p>Popular Causes</p>
                            <h2>Let's know about charity causes around the world</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="causes-item">
                                    <div class="causes-img" style="height: 200px; background: url('https://via.placeholder.com/400x300') center/cover;"></div>
                                    <div class="causes-progress p-3">
                                        <div class="progress mb-2">
                                            <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                <span>85%</span>
                                            </div>
                                        </div>
                                        <div class="progress-text d-flex justify-content-between">
                                            <p><strong>Raised:</strong> $100000</p>
                                            <p><strong>Goal:</strong> $50000</p>
                                        </div>
                                    </div>
                                    <div class="causes-text p-3">
                                        <h3>Lorem ipsum dolor sit</h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasell nec pretium mi. Curabit facilis ornare velit non vulputa</p>
                                    </div>
                                    <div class="causes-btn p-3 text-center">
                                        <a class="btn btn-custom">Learn More</a>
                                        <a class="btn btn-custom">Donate Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="causes-item">
                                    <div class="causes-img" style="height: 200px; background: url('https://via.placeholder.com/400x300') center/cover;"></div>
                                    <div class="causes-progress p-3">
                                        <div class="progress mb-2">
                                            <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                <span>65%</span>
                                            </div>
                                        </div>
                                        <div class="progress-text d-flex justify-content-between">
                                            <p><strong>Raised:</strong> $65000</p>
                                            <p><strong>Goal:</strong> $100000</p>
                                        </div>
                                    </div>
                                    <div class="causes-text p-3">
                                        <h3>Lorem ipsum dolor sit</h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasell nec pretium mi. Curabit facilis ornare velit non vulputa</p>
                                    </div>
                                    <div class="causes-btn p-3 text-center">
                                        <a class="btn btn-custom">Learn More</a>
                                        <a class="btn btn-custom">Donate Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="causes-item">
                                    <div class="causes-img" style="height: 200px; background: url('https://via.placeholder.com/400x300') center/cover;"></div>
                                    <div class="causes-progress p-3">
                                        <div class="progress mb-2">
                                            <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
                                                <span>45%</span>
                                            </div>
                                        </div>
                                        <div class="progress-text d-flex justify-content-between">
                                            <p><strong>Raised:</strong> $45000</p>
                                            <p><strong>Goal:</strong> $100000</p>
                                        </div>
                                    </div>
                                    <div class="causes-text p-3">
                                        <h3>Lorem ipsum dolor sit</h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasell nec pretium mi. Curabit facilis ornare velit non vulputa</p>
                                    </div>
                                    <div class="causes-btn p-3 text-center">
                                        <a class="btn btn-custom">Learn More</a>
                                        <a class="btn btn-custom">Donate Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Causes End -->

                <!-- Footer Start -->
                <div class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="footer-contact">
                                    <h2>Our Head Office</h2>
                                    <p><i class="fa fa-map-marker-alt"></i>123 Street, New York, USA</p>
                                    <p><i class="fa fa-phone-alt"></i>+012 345 67890</p>
                                    <p><i class="fa fa-envelope"></i>info@example.com</p>
                                    <div class="footer-social">
                                        <a class="btn btn-custom" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-custom" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-custom" href=""><i class="fab fa-youtube"></i></a>
                                        <a class="btn btn-custom" href=""><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="footer-link">
                                    <h2>Popular Links</h2>
                                    <a href="">About Us</a>
                                    <a href="">Contact Us</a>
                                    <a href="">Popular Causes</a>
                                    <a href="">Upcoming Events</a>
                                    <a href="">Latest Blog</a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="footer-link">
                                    <h2>Useful Links</h2>
                                    <a href="">Terms of use</a>
                                    <a href="">Privacy policy</a>
                                    <a href="">Cookies</a>
                                    <a href="">Help</a>
                                    <a href="">FQAs</a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="footer-newsletter">
                                    <h2>Newsletter</h2>
                                    <form>
                                        <input class="form-control" placeholder="Email goes here">
                                        <button class="btn btn-custom mt-2">Submit</button>
                                        <label class="mt-2">Don't worry, we don't spam!</label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container copyright">
                        <div class="row">
                            <div class="col-md-6">
                                <p>&copy; <a href="#">Charity Dashboard</a>, All Right Reserved.</p>
                            </div>
                            <div class="col-md-6">
                                <p>Designed By Charity Organization</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer End -->
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.main-content').classList.toggle('active');
        });

        // Initialize tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        // Tab functionality
        $(document).ready(function(){
            $(".nav-pills a").click(function(){
                $(this).tab('show');
            });
        });
    </script>
</body>
</html>

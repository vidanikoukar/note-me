<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Note Me...</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            font-family: 'Helvetica', sans-serif;
            color: #2c3e50;
            overflow-x: hidden;
        }
        .content {
            flex: 1 0 auto;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .header.scrolled {
            backdrop-filter: blur(10px);
            background: rgba(102, 126, 234, 0.95);
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }
        .logo {
            color: white;
            font-size: 2rem;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: transform 0.3s ease;
        }
        .logo:hover {
            transform: scale(1.05);
        }
        .logo i {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px;
            border-radius: 50%;
        }
        .nav-menu ul {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .nav-menu li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 10px 15px;
            border-radius: 8px;
            position: relative;
        }
        .nav-menu li a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        .nav-menu li a.active {
            background: rgba(255, 255, 255, 0.25);
        }
        .auth-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .auth-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
        }
        .user-menu {
            position: relative;
            display: inline-block;
        }
        .user-menu-toggle {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 10px 15px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .user-menu-toggle:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
        }
        .user-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 200px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 10px 0;
            margin-top: 10px;
            display: none;
            z-index: 1001;
        }
        .user-dropdown.show {
            display: block;
        }
        .user-dropdown a {
            display: block;
            padding: 12px 20px;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.3s ease;
            border-bottom: 1px solid #ecf0f1;
        }
        .user-dropdown a:hover {
            background: #f8f9fa;
            padding-right: 30px;
        }
        .user-dropdown a:last-child {
            border-bottom: none;
            color: #e74c3c;
        }
        .user-dropdown a:last-child:hover {
            background: #ffebee;
        }
        .mobile-menu-toggle {
            display: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            background: none;
            border: none;
        }
        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        .mobile-menu.active {
            display: block;
        }
        .mobile-menu-content {
            padding: 20px;
        }
        .mobile-menu-content a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        .mobile-menu-content a:hover {
            padding-right: 10px;
            background: rgba(255, 255, 255, 0.1);
        }
        .alert {
            padding: 15px 20px;
            margin: 20px auto;
            max-width: 1200px;
            border-radius: 8px;
            position: relative;
        }
        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        .alert-close {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: inherit;
        }
        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            flex-shrink: 0;
            padding: 60px 0 40px;
        }
        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
            text-align: right;
        }
        .footer-section h4 {
            color: #ecf0f1;
            font-size: 1.3rem;
            margin-bottom: 25px;
            position: relative;
        }
        .footer-section h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(45deg, #3498db, #2980b9);
            border-radius: 2px;
        }
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        .footer-logo i {
            font-size: 2.5rem;
            color: #3498db;
            background: rgba(52, 152, 219, 0.1);
            padding: 15px;
            border-radius: 50%;
        }
        .footer-logo h3 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ecf0f1;
        }
        .company-description {
            color: #bdc3c7;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        .social-links {
            display: flex;
            gap: 15px;
        }
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .social-link.telegram { background: #0088cc; }
        .social-link.instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
        .social-link.linkedin { background: #0077b5; }
        .social-link.twitter { background: #1da1f2; }
        .social-link.github { background: #333; }
        .footer-section ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .footer-section ul li {
            margin-bottom: 12px;
        }
        .footer-section ul li a {
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-section ul li a:hover {
            color: #3498db;
            padding-right: 10px;
        }
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
        }
        .contact-item i {
            font-size: 1.2rem;
            color: #3498db;
            background: rgba(52, 152, 219, 0.1);
            padding: 10px;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .contact-item div p {
            font-weight: bold;
            color: #ecf0f1;
            margin-bottom: 5px;
        }
        .contact-item div span,
        .contact-item div a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .contact-item div a:hover {
            color: #3498db;
        }
        .footer-bottom {
            background: rgba(0, 0, 0, 0.3);
            padding: 25px 0;
            margin-top: 40px;
            text-align: center;
        }
        .footer-bottom p {
            color: #bdc3c7;
            margin: 0;
        }
        @media (max-width: 1024px) {
            .footer .container {
                grid-template-columns: 1fr 1fr;
                gap: 30px;
            }
            .nav-menu ul {
                gap: 20px;
            }
        }
        @media (max-width: 768px) {
            .footer .container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .footer-section h4::after {
                right: 50%;
                transform: translateX(50%);
            }
            .nav-menu {
                display: none;
            }
            .mobile-menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <header class="header" id="header">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-sticky-note"></i>
                <span>Note Me...</span>
            </a>
            <nav class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">خانه</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">شعر</a></li>
                    <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">دلنوشته</a></li>
                    <li><a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'active' : '' }}">کتاب</a></li>
                    <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">فیلم</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">هنرمندان</a></li>
                    
                    @auth
                        <li class="user-menu">
                            <span class="user-menu-toggle" onclick="toggleUserMenu()">
                                <i class="fas fa-user"></i>
                                {{ Auth::user()->first_name }}
                                <i class="fas fa-chevron-down"></i>
                            </span>
                            <div class="user-dropdown" id="userDropdown">
                                <a href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    داشبورد
                                </a>
                                <a href="{{ route('profile') }}">
                                    <i class="fas fa-user-edit"></i>
                                    پروفایل
                                </a>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    خروج
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="auth-btn">ورود</a></li>
                    @endauth
                </ul>
            </nav>
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu-content">
                <a href="{{ route('home') }}">خانه</a>
                <a href="{{ route('about') }}">شعر</a>
                <a href="{{ route('services') }}">دلنوشته</a>
                <a href="{{ route('portfolio') }}">کتاب</a>
                <a href="{{ route('blog') }}">فیلم</a>
                <a href="{{ route('contact') }}">هنرمندان</a>
                
                @auth
                    <a href="{{ route('dashboard') }}">داشبورد</a>
                    <a href="{{ route('profile') }}">پروفایل</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">خروج</a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mobile-auth">ورود</a>
                @endauth
            </div>
        </div>
    </header>

    <div class="content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
                <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-section company-info">
                <div class="footer-logo">
                    <i class="fas fa-code"></i>
                    <h3>Note Me...</h3>
                </div>
                <p class="company-description">
                    ما در حوزه هنر و ادبیات دیجیتال فعالیت می‌کنیم. هدف ما ارائه محتوای باکیفیت و الهام‌بخش است.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link telegram"><i class="fab fa-telegram"></i></a>
                    <a href="#" class="social-link instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="footer-section quick-links">
                <h4>لینک‌های سریع</h4>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-angle-left"></i> خانه</a></li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-angle-left"></i> درباره ما</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-angle-left"></i> خدمات</a></li>
                    <li><a href="{{ route('portfolio') }}"><i class="fas fa-angle-left"></i> نمونه کارها</a></li>
                </ul>
            </div>
            <div class="footer-section services">
                <h4>محتوای ما</h4>
                <ul>
                    <li><a href="#"><i class="fas fa-angle-left"></i> شعر</a></li>
                    <li><a href="#"><i class="fas fa-angle-left"></i> دلنوشته</a></li>
                    <li><a href="#"><i class="fas fa-angle-left"></i> کتاب</a></li>
                    <li><a href="#"><i class="fas fa-angle-left"></i> فیلم</a></li>
                </ul>
            </div>
            <div class="footer-section contact-info">
                <h4>تماس با ما</h4>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <p>آدرس:</p>
                        <span>تهران، خیابان هنر</span>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <p>ایمیل:</p>
                        <a href="mailto:info@noteme.com">info@noteme.com</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} Note Me... تمامی حقوق محفوظ است.</p>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        document.getElementById('mobileMenuToggle').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            const icon = this.querySelector('i');
            mobileMenu.classList.toggle('active');
            if (mobileMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        function toggleUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // بستن منو کاربر با کلیک در جای دیگر
        document.addEventListener('click', function(event) {
            const userMenu = document.querySelector('.user-menu');
            const dropdown = document.getElementById('userDropdown');
            
            if (userMenu && !userMenu.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
    </script>
</body>
</html>

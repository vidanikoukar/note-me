<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تماس با ما - شعرگرام</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #4972bd, #445cad);
            font-family: 'Helvetica', sans-serif;
            color: #2c3e50;
            overflow-x: hidden;
            direction: rtl;
            text-align: right;
        }
        .content {
            flex: 1 0 auto;
        }
        .header {
            background: linear-gradient(135deg, #3b97c2, #1d518d);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .header.scrolled {
            backdrop-filter: blur(12px);
            background: rgba(37, 87, 134, 0.9);
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
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.3s ease, color 0.3s ease;
            white-space: nowrap;
            margin-right: 30px;
        }
        .logo:hover {
            transform: scale(1.1);
            color: #0f4596;
        }
        .logo i {
            background: rgba(153, 8, 182, 0.25);
            padding: 10px;
            border-radius: 50%;
            transition: transform 0.5s ease;
        }
        .logo:hover i {
            transform: rotate(360deg);
        }
        .nav-menu ul {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
            margin: 0;
            padding: 0;
            justify-content: flex-end;
        }
        .nav-menu li a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 10px 15px;
            border-radius: 8px;
            position: relative;
        }
        .nav-menu li a:hover {
            background: rgba(128, 41, 150, 0.2);
            transform: translateY(-2px);
            color: #174292;
        }
        .nav-menu li a.active {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }
        .mobile-menu-toggle {
            display: none;
            color: #ffffff;
            font-size: 1.5rem;
            cursor: pointer;
            background: none;
            border: none;
        }
        
        /* صفحه تماس با ما */
        .contact-page {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 60px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .page-title {
            font-size: 3rem;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .page-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }
        
        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 50px;
        }
        
        .contact-form-section, .contact-info-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .contact-form-section:hover, .contact-info-section:hover {
            transform: translateY(-5px);
        }
        
        .section-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 2px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }
        
        .form-input, .form-textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #667eea;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(102, 126, 234, 0.1);
        }
        
        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #ffffff;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .contact-info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .contact-info-item:hover {
            background: #e9ecef;
            transform: translateX(-5px);
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.3rem;
        }
        
        .contact-details h4 {
            font-size: 1.2rem;
            color: #2c3e50;
            margin: 0 0 5px 0;
        }
        
        .contact-details p {
            color: #6c757d;
            margin: 0;
            font-size: 1rem;
        }
        
        .social-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 15px;
            color: #ffffff;
            font-size: 1.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            transform: translateY(-5px) scale(1.1);
        }
        
        .social-link.telegram {
            background: linear-gradient(135deg, #0088cc, #006bb3);
        }
        
        .social-link.instagram {
            background: linear-gradient(135deg, #e4405f, #833ab4, #f56040);
        }
        
        .social-link.email {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #2959a1, #1b4872);
            color: #ffffff;
            flex-shrink: 0;
            padding: 60px 0 40px;
        }
        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 40px;
            text-align: right;
        }
        .footer-section h4 {
            color: #ffffff;
            font-size: 1.3rem;
            margin-bottom: 25px;
            position: relative;
            text-align: right;
        }
        .footer-section h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(45deg, #e040fb, #7b1fa2);
            border-radius: 2px;
        }
        .footer-section ul {
            list-style: none;
            margin: 0;
            padding: 0;
            text-align: right;
        }
        .footer-section ul li {
            margin-bottom: 12px;
        }
        .footer-section ul li a {
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: flex-start;
        }
        .footer-section ul li a:hover {
            color: #f3e8ff;
            padding-left: 10px;
        }
        .footer-logo-section {
            text-align: right;
        }
        .footer-logo-section h3 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 15px;
        }
        .footer-logo-section p {
            color: #ffffff;
            line-height: 1.8;
            margin: 0;
            font-size: 1.1rem;
            font-style: italic;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .contact-container {
                gap: 30px;
            }
            .footer .container {
                grid-template-columns: 1fr 1fr;
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .contact-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .page-title {
                font-size: 2.2rem;
            }
            
            .page-subtitle {
                font-size: 1.1rem;
            }
            
            .contact-form-section, .contact-info-section, .social-section {
                padding: 30px 20px;
            }
            
            .nav-menu {
                display: none;
            }
            .mobile-menu-toggle {
                display: block;
            }
            
            .footer .container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .footer-section h4::after {
                left: 50%;
                transform: translateX(-50%);
            }
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
    </style>
</head>
<body>
    <header class="header" id="header">
        <div class="nav-container">
            <a href="/" class="logo">
                <i class="fas fa-sticky-note"></i>
                <span>شعرگرام</span>
            </a>
            <nav class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li><a href="/poems">شعر</a></li>
                    <li><a href="/notes">دلنوشته</a></li>
                    <li><a href="/books">کتاب</a></li>
                    <li><a href="/movies">فیلم</a></li>
                    <li><a href="/contact" class="active">تماس با ما</a></li>
                </ul>
            </nav>
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <div class="content">
        <div class="contact-page">
            <div class="page-header">
                <h1 class="page-title">تماس با ما</h1>
                <p class="page-subtitle">ما همیشه آماده شنیدن نظرات، پیشنهادات و انتقادات شما هستیم</p>
            </div>

            <div class="contact-container">
                <div class="contact-form-section">
                    <h2 class="section-title">پیام خود را ارسال کنید</h2>
                    <form id="contactForm">
                        <div class="form-group">
                            <label class="form-label" for="name">نام و نام خانوادگی</label>
                            <input type="text" id="name" name="name" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="email">ایمیل</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="subject">موضوع پیام</label>
                            <input type="text" id="subject" name="subject" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="message">متن پیام</label>
                            <textarea id="message" name="message" class="form-textarea" required placeholder="پیام خود را اینجا بنویسید..."></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane" style="margin-left: 10px;"></i>
                            ارسال پیام
                        </button>
                    </form>
                </div>

                <div class="contact-info-section">
                    <h2 class="section-title">اطلاعات تماس</h2>
                    
                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h4>ایمیل</h4>
                            <p>info@sheergram.ir</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fab fa-telegram"></i>
                        </div>
                        <div class="contact-details">
                            <h4>تلگرام</h4>
                            <p>@sheergram_support</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <div class="contact-details">
                            <h4>اینستاگرام</h4>
                            <p>@sheergram.ir</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h4>ساعات پاسخگویی</h4>
                            <p>شنبه تا پنج‌شنبه، ۹ تا ۱۸</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="social-section">
                <h2 class="section-title">ما را دنبال کنید</h2>
                <p style="color: #6c757d; font-size: 1.1rem; margin-bottom: 0;">در شبکه‌های اجتماعی ما را دنبال کنید تا از آخرین اخبار و محتواها با خبر شوید</p>
                
                <div class="social-links">
                    <a href="#" class="social-link telegram" title="تلگرام">
                        <i class="fab fa-telegram"></i>
                    </a>
                    <a href="#" class="social-link instagram" title="اینستاگرام">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="mailto:info@sheergram.ir" class="social-link email" title="ایمیل">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-section footer-logo-section">
                <h3>شعرگرام</h3>
            </div>
            <div class="footer-section about-us">
                <h4>درباره ما</h4>
                <ul>
                    <li><a href="/about"><i class="fas fa-angle-right"></i> اینجا کجاست</a></li>         
                    <li><a href="/who-am-i"><i class="fas fa-angle-right"></i> من کیم</a></li>        
                    <li><a href="/guide"><i class="fas fa-angle-right"></i> راهنما</a></li>                
                </ul>
            </div>
            <div class="footer-section content">
                <h4>محتوای ما</h4>
                <ul>
                    <li><a href="/poems"><i class="fas fa-angle-right"></i> شعر</a></li>
                    <li><a href="/notes"><i class="fas fa-angle-right"></i> دلنوشته</a></li>
                    <li><a href="/books"><i class="fas fa-angle-right"></i> کتاب</a></li>
                    <li><a href="/movies"><i class="fas fa-angle-right"></i> فیلم</a></li>
                </ul>
            </div>
            <div class="footer-section contact-info">
                <h4>راه‌های ارتباطی</h4>
                <ul>
                    <li><a href="/contact"><i class="fas fa-angle-right"></i> تماس با ما</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        // اسکرول هدر
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // منوی موبایل
        document.getElementById('mobileMenuToggle').addEventListener('click', function() {
            // اینجا کد منوی موبایل اضافه شود
        });

        // فرم تماس
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // گرفتن مقادیر فرم
            const formData = new FormData(this);
            const name = formData.get('name');
            const email = formData.get('email');
            const subject = formData.get('subject');
            const message = formData.get('message');
            
            // نمایش پیام موفقیت
            alert('پیام شما با موفقیت ارسال شد! ما در اسرع وقت با شما تماس خواهیم گرفت.');
            
            // پاک کردن فرم
            this.reset();
        });

        // انیمیشن ورود عناصر
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeIn 0.6s ease-out';
                }
            });
        }, observerOptions);

        // مشاهده عناصر برای انیمیشن
        document.querySelectorAll('.contact-form-section, .contact-info-section, .social-section').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
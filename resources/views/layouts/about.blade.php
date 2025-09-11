@extends('layouts.app')

@section('title', 'اینجا کجاست؟')

@section('content')
<style>
    .about-hero {
        background: linear-gradient(135deg, rgba(142, 45, 226, 0.9), rgba(116, 29, 141, 0.9)), url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="grad"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="300" r="100" fill="url(%23grad)"/><circle cx="800" cy="200" r="150" fill="url(%23grad)"/><circle cx="400" cy="700" r="120" fill="url(%23grad)"/></svg>');
        padding: 120px 0;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 70%, rgba(224, 64, 251, 0.3), transparent 50%),
                    radial-gradient(circle at 70% 30%, rgba(156, 39, 176, 0.3), transparent 50%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(1deg); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        animation: slideInDown 1s ease-out;
    }

    .hero-subtitle {
        font-size: 1.4rem;
        margin-bottom: 30px;
        opacity: 0.9;
        line-height: 1.8;
        animation: slideInUp 1s ease-out 0.3s both;
    }

    .hero-quote {
        font-size: 1.6rem;
        font-style: italic;
        margin-top: 40px;
        padding: 20px;
        border-right: 4px solid rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        animation: fadeIn 1s ease-out 0.6s both;
    }

    .about-sections {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 20px;
    }

    .section-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 50px;
        margin-bottom: 40px;
        box-shadow: 0 15px 35px rgba(142, 45, 226, 0.1);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .section-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(142, 45, 226, 0.2);
    }

    .section-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #e040fb, #ab47bc, #7b1fa2);
    }

    .section-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 30px;
        background: linear-gradient(135deg, #e040fb, #ab47bc);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 10px 25px rgba(224, 64, 251, 0.3);
    }

    .section-title {
        font-size: 2.2rem;
        color: #4a148c;
        text-align: center;
        margin-bottom: 25px;
        font-weight: bold;
    }

    .section-text {
        font-size: 1.2rem;
        line-height: 2;
        color: #2c3e50;
        text-align: justify;
        margin-bottom: 20px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 60px;
    }

    .feature-card {
        background: linear-gradient(135deg, rgba(224, 64, 251, 0.1), rgba(171, 71, 188, 0.1));
        border: 2px solid rgba(224, 64, 251, 0.2);
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-card:hover {
        transform: scale(1.05);
        border-color: rgba(224, 64, 251, 0.5);
        box-shadow: 0 15px 30px rgba(224, 64, 251, 0.2);
    }

    .feature-card::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(224, 64, 251, 0.1), transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .feature-card:hover::after {
        opacity: 1;
    }

    .feature-icon {
        font-size: 3rem;
        color: #e040fb;
        margin-bottom: 20px;
        display: block;
    }

    .feature-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: #4a148c;
        margin-bottom: 15px;
    }

    .feature-desc {
        color: #666;
        line-height: 1.6;
        font-size: 1rem;
    }

    .cta-section {
        background: linear-gradient(135deg, #590a69 0%, #764ba2 100%);
        padding: 80px 20px;
        text-align: center;
        color: white;
        margin-top: 60px;
    }

    .cta-title {
        font-size: 2.5rem;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .cta-text {
        font-size: 1.3rem;
        margin-bottom: 40px;
        opacity: 0.9;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.8;
    }

    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .cta-btn {
        padding: 15px 35px;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        color: white;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .cta-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.6);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .stats-section {
        background: #f8f9fa;
        padding: 60px 20px;
        text-align: center;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .stat-item {
        background: white;
        padding: 30px 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-5px);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: bold;
        color: #e040fb;
        margin-bottom: 10px;
    }

    .stat-label {
        color: #666;
        font-size: 1.1rem;
    }

    @keyframes slideInDown {
        from { opacity: 0; transform: translateY(-50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
        }
        
        .hero-quote {
            font-size: 1.3rem;
        }
        
        .section-card {
            padding: 30px 20px;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .section-text {
            font-size: 1.1rem;
        }
        
        .cta-title {
            font-size: 2rem;
        }
        
        .cta-text {
            font-size: 1.1rem;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
    }
</style>

<div class="about-hero">
    <div class="hero-content">
        <h1 class="hero-title">💜 اینجا کجاست؟ 💜</h1>
        <p class="hero-subtitle">
            جایی که کلمات به احساسات جان می‌بخشند و قلب‌ها در آغوش شعر و عاطفه می‌طپند
        </p>
        <div class="hero-quote">
            "مینویسم ...
            <br>
             چون! 
             <br>
             من عاشق شدم..."
        </div>
    </div>
</div>

<div class="about-sections">
    <div class="section-card">
        <div class="section-icon">
            <i class="fas fa-heart"></i>
        </div>
        <h2 class="section-title">Note Me چیست؟</h2>
        <p class="section-text">
            Note Me خانه‌ای است برای همه کسانی که دل پر از عشق و احساس دارند. اینجا محلی است که شما می‌توانید 
            عمیق‌ترین احساسات، زیباترین شعرها، دل‌انگیزترین دلنوشته‌ها و تجربیات خود از کتاب‌ها و فیلم‌هایی که 
            دل‌تان را لرزانده، با دیگران در میان بگذارید.
        </p>
        <p class="section-text">
            ما معتقدیم که هر انسان داستانی دارد برای گفتن، احساسی دارد برای بیان کردن، و عشقی دارد برای به اشتراک گذاشتن. 
            Note Me پلی است میان قلب‌های عاشق و روح‌های آزاد که در جستجوی همدلی و درک متقابل هستند.
        </p>
    </div>

    <div class="section-card">
        <div class="section-icon">
            <i class="fas fa-feather-alt"></i>
        </div>
        <h2 class="section-title">چرا Note Me؟</h2>
        <p class="section-text">
            در دنیای پرشتاب امروز، گاهی نیاز داریم مکانی داشته باشیم که در آن بتوانیم احساسات خود را آزادانه بیان کنیم. 
            Note Me همان مکان است - فضایی امن و صمیمی که در آن:
        </p>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-scroll feature-icon"></i>
                <h3 class="feature-title">شعرهای دل‌انگیز</h3>
                <p class="feature-desc">
                    غزل‌های عاشقانه، شعرهای اجتماعی، و سروده‌های دل که از اعماق جان سرچشمه می‌گیرند
                </p>
            </div>
            <div class="feature-card">
                <i class="fas fa-pen-fancy feature-icon"></i>
                <h3 class="feature-title">دلنوشته‌های احساسی</h3>
                <p class="feature-desc">
                    خاطرات شیرین، تجربیات تلخ، و لحظاتی که قلب را به لرزه درمی‌آورند
                </p>
            </div>
            <div class="feature-card">
                <i class="fas fa-book-open feature-icon"></i>
                <h3 class="feature-title">نقد کتاب‌ها</h3>
                <p class="feature-desc">
                    بررسی و نقد کتاب‌هایی که روح شما را نوازش کرده و افق‌های تازه‌ای به رویتان گشوده‌اند
                </p>
            </div>
            
        
        </div>
    </div>

    <div class="section-card">
        <div class="section-icon">
            <i class="fas fa-users"></i>
        </div>
        <h2 class="section-title">جامعه‌ای از دل‌ها</h2>
        <p class="section-text">
            Note Me تنها یک وب‌سایت نیست، بلکه خانواده‌ای است از افرادی که عاشق زیبایی، هنر، و احساسات انسانی هستند. 
            اینجا می‌توانید با دیگرانی که مثل شما عاشق کلمات و معانی هستند، ارتباط برقرار کنید.
        </p>
        <p class="section-text">
            هر پست، هر شعر، هر دلنوشته که در اینجا منتشر می‌شود، بخشی از روح و قلب کسی است که آن را نوشته. 
            ما این اعتماد و صمیمیت را قدر می‌دانیم و تمام تلاش خود را می‌کنیم تا فضایی امن و محترمانه برای همه فراهم کنیم.
        </p>
    </div>
</div>

<div class="stats-section">
    <h2 style="color: #4a148c; margin-bottom: 50px; font-size: 2.5rem;">Note Me در یک نگاه</h2>
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-number">∞</div>
            <div class="stat-label">احساسات بی‌پایان</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">❤️</div>
            <div class="stat-label">عشق خالص</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">🌟</div>
            <div class="stat-label">الهام بخشی</div>
        </div>
        
        <div class="stat-item">
            <div class="stat-number">📚</div>
            <div class="stat-label">کتاب و فیلم</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">🌌</div>
            <div class="stat-label">دنیای موازی</div>
        </div>
    </div>
</div>

<div class="cta-section">
    <h2 class="cta-title">آماده‌اید که بخشی از این خانواده باشید؟</h2>
    <p class="cta-text">
        اگر دلی پر از عشق دارید، اگر کلماتی دارید که می‌خواهند آزاد شوند، 
        اگر احساساتی دارید که منتظر بیان هستند، Note Me جای شماست.
    </p>
    <div class="cta-buttons">
        @auth
            <a href="{{ route('dashboard') }}" class="cta-btn">
                <i class="fas fa-tachometer-alt"></i> داشبورد من
            </a>
        @else
            <a href="{{ route('register') }}" class="cta-btn">
                <i class="fas fa-user-plus"></i> عضویت در خانواده
            </a>
            <a href="{{ route('login') }}" class="cta-btn">
                <i class="fas fa-sign-in-alt"></i> ورود به خانه
            </a>
        @endauth
        <a href="{{ route('home') }}" class="cta-btn">
            <i class="fas fa-home"></i> بازگشت به خانه
        </a>
    </div>
</div>

<script>
    // افزودن انیمیشن هنگام اسکرول
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.section-card, .feature-card, .stat-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
</script>

@endsection
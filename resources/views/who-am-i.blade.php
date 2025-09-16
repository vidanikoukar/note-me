@extends('layouts.app')

@section('title', 'من کیم')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Vazir:wght@400;700&display=swap');
    
    body {
        font-family: 'Vazir', sans-serif;
    }
    
    .heart-profile {
        position: relative;
        overflow: hidden;
        animation: pulse 2s infinite;
    }
    
    .heart-profile::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,182,193,0.3) 0%, transparent 70%);
        animation: glow 3s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    @keyframes glow {
        0% { opacity: 0.3; }
        50% { opacity: 0.6; }
        100% { opacity: 0.3; }
    }
    
    .intro-text {
        position: relative;
        animation: fadeInUp 1s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .quote-container {
        position: relative;
        padding: 20px;
        background: rgba(255,255,255,0.15);
        border-radius: 20px;
        animation: float 4s ease-in-out infinite;
    }
    
    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0); }
    }
    
    .contact-btn:hover {
        background: #ff6f91 !important;
        color: white !important;
        transform: scale(1.1) !important;
    }
</style>

<div style="min-height: 100vh; padding: 100px 20px; background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%); position: relative; overflow: hidden;">
    <!-- المان‌های تزئینی -->
    <div style="position: absolute; top: 20px; left: 20px; font-size: 2rem; opacity: 0.3;">🌸</div>
    <div style="position: absolute; bottom: 20px; right: 20px; font-size: 2rem; opacity: 0.3;">✨</div>

    <div style="max-width: 800px; margin: 0 auto; text-align: center; color: white;">
        <!-- تصویر پروفایل -->
        <div class="heart-profile" style="width: 220px; height: 220px; border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; background: rgba(255,255,255,0.3); margin: 0 auto 40px; display: flex; align-items: center; justify-content: center; border: 4px solid rgba(255,255,255,0.4); box-shadow: 0 0 30px rgba(255,182,193,0.5);">
            <i class="fas fa-user" style="font-size: 90px; color: rgba(255,255,255,0.9);"></i>
        </div>

        <!-- عنوان -->
        <h1 style="font-size: 3.5rem; margin-bottom: 30px; font-weight: bold; text-shadow: 0 4px 10px rgba(0,0,0,0.2); animation: fadeInUp 1s ease-out;">
            سلام، من نویسنده‌ی Note Me هستم 🌟
        </h1>
        
        <!-- معرفی -->
        <div class="intro-text" style="background: rgba(255,255,255,0.15); padding: 50px; border-radius: 30px; margin-bottom: 40px; backdrop-filter: blur(12px); border: 2px solid rgba(255,255,255,0.3);">
            <p style="font-size: 1.4rem; line-height: 2.2; margin-bottom: 20px;">
                از کودکی عاشق کلمات بودم... 📝
            </p>
            <p style="font-size: 1.4rem; line-height: 2.2; margin-bottom: 20px;">
                هر کلمه برایم دنیایی از معنا داشت و هنوز هم داره! 💖
            </p>
            <p style="font-size: 1.4rem; line-height: 2.2; margin-bottom: 20px;">
                نوشتن برایم مثل نفس کشیدنه... 🌬️
            </p>
            <p style="font-size: 1.4rem; line-height: 2.2;">
                و Note Me جاییه که احساساتمو با دنیا قسمت می‌کنم! 🌍
            </p>
        </div>

        <!-- نقل قول -->
        <div class="quote-container">
            <i class="fas fa-quote-right" style="font-size: 2.5rem; margin-bottom: 20px; color: rgba(255,255,255,0.8);"></i>
            <p style="font-style: italic; font-size: 1.6rem; margin-bottom: 20px; text-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                "مینویسم چون عاشق شدم... و عشق کلماتی می‌خواد که بتونه اونو بگنجونه" 💌
            </p>
        </div>

        <!-- دکمه تماس -->
        <a href="{{ route('contact') }}" class="contact-btn" style="background: #ffe6e6; color: #ff6f91; padding: 18px 50px; border-radius: 50px; text-decoration: none; font-weight: bold; font-size: 1.2rem; display: inline-flex; align-items: center; gap: 12px; transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <i class="fas fa-heart" style="color: #ff6f91;"></i>
            بیایید باهم دوست بشیم! 😊
        </a>
    </div>
</div>
@endsection
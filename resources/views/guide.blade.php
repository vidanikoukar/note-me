@extends('layouts.app')

@section('title', 'راهنمای استفاده - Note Me')

@section('content')
<div class="guide-page">
    <div class="guide-hero">
        <div class="hero-backdrop"></div>
        <div class="hero-content">
            <div class="container">
                <nav class="breadcrumb-nav">
                    <a href="{{ route('home') }}" class="breadcrumb-link">
                        <i class="fas fa-home"></i>
                        خانه
                    </a>
                    <span class="breadcrumb-separator">/</span>
                    <span class="breadcrumb-current">راهنما</span>
                </nav>
                <div class="hero-text">
                    <h1 class="hero-title">
                        <i class="fas fa-book-open"></i>
                        راهنمای استفاده از Note Me
                    </h1>
                    <p class="hero-subtitle">همه چیزهایی که برای استفاده بهینه از سایت نیاز دارید</p>
                </div>
            </div>
        </div>
    </div>

    <div class="guide-content">
        <div class="container">
            <div class="guide-grid">
                <div class="guide-main">
                    <!-- شروع کار -->
                    <section class="guide-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                            <h2>شروع کار</h2>
                        </div>
                        <div class="section-content">
                            <div class="guide-card">
                                <h3><i class="fas fa-user-plus"></i> ثبت نام و ورود</h3>
                                <p>برای استفاده از امکانات کامل سایت، ابتدا باید حساب کاربری ایجاد کنید:</p>
                                <ul>
                                    <li>روی دکمه "ثبت نام" کلیک کنید</li>
                                    <li>اطلاعات مورد نیاز را کامل کنید</li>
                                    <li>ایمیل خود را تأیید کنید</li>
                                    <li>وارد حساب کاربری خود شوید</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- مدیریت پست‌ها -->
                    <section class="guide-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <h2>مدیریت پست‌ها</h2>
                        </div>
                        <div class="section-content">
                            <div class="guide-card">
                                <h3><i class="fas fa-plus"></i> ایجاد پست جدید</h3>
                                <p>برای ایجاد پست جدید:</p>
                                <ul>
                                    <li>به صفحه "پست‌ها" بروید</li>
                                    <li>روی دکمه "پست جدید" کلیک کنید</li>
                                    <li>عنوان و محتوای پست را وارد کنید</li>
                                    <li>در صورت نیاز، تصویر شاخص اضافه کنید</li>
                                    <li>روی "انتشار" کلیک کنید</li>
                                </ul>
                            </div>

                            <div class="guide-card">
                                <h3><i class="fas fa-pencil-alt"></i> ویرایش پست</h3>
                                <p>برای ویرایش پست‌های خود:</p>
                                <ul>
                                    <li>به صفحه پست مورد نظر بروید</li>
                                    <li>روی دکمه "ویرایش پست" کلیک کنید</li>
                                    <li>تغییرات لازم را اعمال کنید</li>
                                    <li>روی "بروزرسانی" کلیک کنید</li>
                                </ul>
                                <div class="note-box">
                                    <i class="fas fa-info-circle"></i>
                                    <span>تنها می‌توانید پست‌های خودتان را ویرایش کنید.</span>
                                </div>
                            </div>

                            <div class="guide-card">
                                <h3><i class="fas fa-trash"></i> حذف پست</h3>
                                <p>برای حذف پست:</p>
                                <ul>
                                    <li>به صفحه پست مورد نظر بروید</li>
                                    <li>روی دکمه "حذف پست" کلیک کنید</li>
                                    <li>حذف را تأیید کنید</li>
                                </ul>
                                <div class="warning-box">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>حذف پست قابل بازگشت نیست!</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- ذخیره و مدیریت محتوا -->
                    <section class="guide-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-bookmark"></i>
                            </div>
                            <h2>ذخیره و مدیریت محتوا</h2>
                        </div>
                        <div class="section-content">
                            <div class="guide-card">
                                <h3><i class="fas fa-heart"></i> ذخیره کردن پست‌ها</h3>
                                <p>برای ذخیره پست‌های مورد علاقه:</p>
                                <ul>
                                    <li>به صفحه پست مورد نظر بروید</li>
                                    <li>روی دکمه "ذخیره" کلیک کنید</li>
                                    <li>پست در بخش "پست‌های ذخیره شده" شما قرار می‌گیرد</li>
                                </ul>
                            </div>

                            <div class="guide-card">
                                <h3><i class="fas fa-list"></i> مشاهده پست‌های ذخیره شده</h3>
                                <p>برای دسترسی به پست‌های ذخیره شده:</p>
                                <ul>
                                    <li>به پروفایل خود بروید</li>
                                    <li>بر روی "پست‌های ذخیره شده" کلیک کنید</li>
                                    <li>لیست کامل پست‌های ذخیره شده را مشاهده کنید</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- پروفایل کاربری -->
                    <section class="guide-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-user-cog"></i>
                            </div>
                            <h2>مدیریت پروفایل</h2>
                        </div>
                        <div class="section-content">
                            <div class="guide-card">
                                <h3><i class="fas fa-image"></i> تغییر آواتار</h3>
                                <p>برای تغییر تصویر پروفایل:</p>
                                <ul>
                                    <li>به تنظیمات پروفایل بروید</li>
                                    <li>روی "تغییر آواتار" کلیک کنید</li>
                                    <li>تصویر جدید را انتخاب کنید</li>
                                    <li>تغییرات را ذخیره کنید</li>
                                </ul>
                            </div>

                            <div class="guide-card">
                                <h3><i class="fas fa-key"></i> تغییر رمز عبور</h3>
                                <p>برای تغییر رمز عبور:</p>
                                <ul>
                                    <li>به تنظیمات حساب کاربری بروید</li>
                                    <li>رمز عبور فعلی را وارد کنید</li>
                                    <li>رمز عبور جدید را دو بار وارد کنید</li>
                                    <li>تغییرات را ذخیره کنید</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- اشتراک‌گذاری -->
                    <section class="guide-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <h2>اشتراک‌گذاری محتوا</h2>
                        </div>
                        <div class="section-content">
                            <div class="guide-card">
                                <h3><i class="fas fa-share"></i> اشتراک‌گذاری در شبکه‌های اجتماعی</h3>
                                <p>برای اشتراک‌گذاری پست‌ها:</p>
                                <ul>
                                    <li>به صفحه پست مورد نظر بروید</li>
                                    <li>از بخش اشتراک‌گذاری سمت راست استفاده کنید</li>
                                    <li>پلتفرم مورد نظر (تلگرام، توییتر، لینکدین) را انتخاب کنید</li>
                                    <li>پست به صورت خودکار به اشتراک گذاشته می‌شود</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- نکات مهم -->
                    <section class="guide-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h2>نکات مهم</h2>
                        </div>
                        <div class="section-content">
                            <div class="guide-card">
                                <div class="tips-grid">
                                    <div class="tip-item">
                                        <div class="tip-icon success">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="tip-content">
                                            <h4>کیفیت محتوا</h4>
                                            <p>همیشه سعی کنید محتوای با کیفیت و مفید منتشر کنید</p>
                                        </div>
                                    </div>

                                    <div class="tip-item">
                                        <div class="tip-icon info">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="tip-content">
                                            <h4>عنوان‌های جذاب</h4>
                                            <p>عنوان‌هایی انتخاب کنید که توجه خواننده را جلب کند</p>
                                        </div>
                                    </div>

                                    <div class="tip-item">
                                        <div class="tip-icon warning">
                                            <i class="fas fa-exclamation"></i>
                                        </div>
                                        <div class="tip-content">
                                            <h4>احترام به حقوق</h4>
                                            <p>از انتشار محتوای کپی شده یا نقض کننده حق نشر خودداری کنید</p>
                                        </div>
                                    </div>

                                    <div class="tip-item">
                                        <div class="tip-icon danger">
                                            <i class="fas fa-ban"></i>
                                        </div>
                                        <div class="tip-content">
                                            <h4>محتوای نامناسب</h4>
                                            <p>از انتشار محتوای توهین‌آمیز یا نامناسب خودداری کنید</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Sidebar -->
                <aside class="guide-sidebar">
                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <h3><i class="fas fa-question-circle"></i> سوالات متداول</h3>
                        </div>
                        <div class="widget-content">
                            <div class="faq-list">
                                <div class="faq-item">
                                    <h4>چگونه رمز عبور را بازیابی کنم؟</h4>
                                    <p>از لینک "فراموشی رمز عبور" در صفحه ورود استفاده کنید.</p>
                                </div>
                                <div class="faq-item">
                                    <h4>آیا می‌توانم پست حذف شده را بازگردانم؟</h4>
                                    <p>خیر، حذف پست قابل بازگشت نیست. لطفاً با احتیاط عمل کنید.</p>
                                </div>
                                <div class="faq-item">
                                    <h4>حداکثر حجم فایل آپلود چقدر است؟</h4>
                                    <p>حداکثر حجم هر فایل 5 مگابایت است.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <h3><i class="fas fa-headset"></i> پشتیبانی</h3>
                        </div>
                        <div class="widget-content">
                            <div class="support-info">
                                <p>در صورت نیاز به کمک، با ما تماس بگیرید:</p>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>support@noteme.com</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>021-12345678</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fab fa-telegram"></i>
                                    <span>@noteme_support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.guide-page {
    background: #f8fafc;
    min-height: calc(100vh - 80px);
    direction: rtl;
}

/* Hero Section */
.guide-hero {
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0 60px;
    overflow: hidden;
}

.hero-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 40px;
}

.breadcrumb-link {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 5px 8px;
    border-radius: 5px;
}

.breadcrumb-link:hover {
    color: white;
    background: rgba(255, 255, 255, 0.1);
    text-decoration: none;
}

.breadcrumb-separator {
    color: rgba(255, 255, 255, 0.6);
    margin: 0 5px;
}

.breadcrumb-current {
    color: white;
    font-weight: 500;
}

.hero-text {
    text-align: center;
    color: white;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.hero-title i {
    font-size: 2.5rem;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 0;
}

/* Guide Content */
.guide-content {
    padding: 60px 0;
}

.guide-grid {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 40px;
    align-items: start;
}

.guide-main {
    display: flex;
    flex-direction: column;
    gap: 40px;
}

.guide-section {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.section-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 30px 40px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.section-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.section-header h2 {
    color: white;
    font-size: 1.8rem;
    font-weight: 600;
    margin: 0;
}

.section-content {
    padding: 40px;
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.guide-card {
    background: #f8fafc;
    border-radius: 15px;
    padding: 30px;
    border: 1px solid #e2e8f0;
}

.guide-card h3 {
    color: #2d3748;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.guide-card h3 i {
    color: #667eea;
    font-size: 1.2rem;
}

.guide-card p {
    color: #4a5568;
    line-height: 1.6;
    margin-bottom: 15px;
}

.guide-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.guide-card li {
    color: #4a5568;
    padding: 8px 0;
    position: relative;
    padding-right: 25px;
}

.guide-card li::before {
    content: "✓";
    position: absolute;
    right: 0;
    color: #48bb78;
    font-weight: bold;
}

.note-box, .warning-box {
    margin-top: 20px;
    padding: 15px 20px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
}

.note-box {
    background: #ebf8ff;
    color: #2b6cb0;
    border: 1px solid #bee3f8;
}

.warning-box {
    background: #fffaf0;
    color: #c05621;
    border: 1px solid #fbd38d;
}

.tips-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
}

.tip-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.tip-icon.success { background: #48bb78; }
.tip-icon.info { background: #4299e1; }
.tip-icon.warning { background: #ed8936; }
.tip-icon.danger { background: #f56565; }

.tip-content h4 {
    color: #2d3748;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 8px;
}

.tip-content p {
    color: #4a5568;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

/* Sidebar */
.guide-sidebar {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.sidebar-widget {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.widget-header {
    padding: 20px 25px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.widget-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.widget-content {
    padding: 25px;
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    padding-bottom: 20px;
    border-bottom: 1px solid #e2e8f0;
}

.faq-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.faq-item h4 {
    color: #2d3748;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.faq-item p {
    color: #4a5568;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

.support-info {
    text-align: center;
}

.support-info p {
    color: #4a5568;
    margin-bottom: 20px;
    line-height: 1.6;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 0;
    color: #2d3748;
    font-size: 0.9rem;
}

.contact-item i {
    color: #667eea;
    width: 20px;
}

/* Responsive */
@media (max-width: 1024px) {
    .guide-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .guide-sidebar {
        order: -1;
    }
}

@media (max-width: 768px) {
    .guide-hero {
        padding: 60px 0 40px;
    }
    
    .hero-title {
        font-size: 2.2rem;
        flex-direction: column;
        gap: 10px;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .guide-content {
        padding: 40px 0;
    }
    
    .container {
        padding: 0 15px;
    }
    
    .section-header,
    .section-content,
    .widget-content {
        padding: 25px 20px;
    }
    
    .guide-card {
        padding: 20px;
    }
    
    .tips-grid {
        gap: 15px;
    }
    
    .tip-item {
        padding: 15px;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .section-header {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .tip-item {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
}
</style>
@endsection
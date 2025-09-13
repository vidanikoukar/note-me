@extends('layouts.app')

@section('title', 'خانه - Note Me')

@section('content')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* فونت و تنظیمات پایه */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.home-page {
    font-family: 'Tahoma', 'Vazir', sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
    overflow-x: hidden;
}

/* بخش هیرو */
.hero-section {
    background: linear-gradient(135deg, #682985 0%, #764ba2 100%);
    color: white;
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 25px;
    text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    animation: fadeInDown 1s ease;
    background: linear-gradient(45deg, #ffffff, #e3f2fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.5rem;
    font-weight: 300;
    margin-bottom: 40px;
    opacity: 0.95;
    animation: fadeInUp 1s ease 0.2s both;
    line-height: 1.6;
}

.hero-btn {
    background: linear-gradient(45deg, #fffeff, #f5f5f5);
    color: #667eea;
    font-weight: 700;
    padding: 18px 40px;
    border-radius: 50px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 15px;
    transition: all 0.4s ease;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    border: 2px solid transparent;
    font-size: 1.1rem;
}

.hero-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border-color: rgba(255, 255, 255, 0.8);
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

/* بخش‌های محتوا */
.content-section {
    padding: 80px 0;
}

.section-header {
    text-align: right; /* انتقال به راست */
    margin-bottom: 50px;
}

.section-title {
    font-size: 2.2rem; /* کوچیکتر کردن عنوان */
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    right: 0; /* خط زیر عنوان به راست */
    width: 60px; /* خط کوتاه‌تر برای تمیزی */
    height: 4px;
    background: linear-gradient(135deg, #e040fb, #7b1fa2); /* تم بنفش */
    border-radius: 2px;
}

.section-subtitle {
    font-size: 1rem; /* کوچیکتر کردن توضیحات */
    color: #6c757d;
    margin-top: 15px;
    font-weight: 300;
    text-align: right; /* انتقال به راست */
}

/* کارت‌های محتوا */
.content-card {
    background: white;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 400px; /* کمی کوتاه‌تر برای تمیزی */
    position: relative;
    cursor: pointer;
    border: 2px solid transparent;
}

.content-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    border-color: rgba(142, 45, 226, 0.2); /* بنفش ملایم */
}

.card-image {
    height: 180px; /* کمی کوتاه‌تر */
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-image i {
    font-size: 2.5rem; /* کوچیکتر کردن آیکون */
    color: white;
    opacity: 0.9;
    transition: all 0.3s ease;
}

.content-card:hover .card-image i {
    transform: scale(1.1);
}

.card-content {
    padding: 25px; /* کمی تمیزتر */
    height: 220px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-text {
    font-size: 1rem;
    color: #6c757d;
    line-height: 1.7;
    flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.9rem;
    color: #95a5a6;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #ecf0f1;
}

.card-meta .author {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
}

.card-meta .stats {
    display: flex;
    align-items: center;
    gap: 15px;
}

.card-meta .stats span {
    display: flex;
    align-items: center;
    gap: 5px;
}

/* تگ دسته‌بندی */
.category-tag {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.9);
    color: #2c3e50;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    z-index: 2;
}

/* رنگ‌بندی متفاوت برای هر بخش */
.recent-posts .card-image {
    background: linear-gradient(135deg, #7c7a7c, #ffffff);
}

.notes-section .card-image {
    background: linear-gradient(135deg, #858286, #ffffff);
}

.books-section .card-image {
    background: linear-gradient(135deg, #a39ea5, #ffffff);
}

.poems-section .card-image {
    background: linear-gradient(135deg, #908892, #ffffff);
}

/* دکمه مشاهده همه */
.view-all-btn {
    background: linear-gradient(135deg, #552575, #764ba2);
    color: white;
    border: none;
    padding: 12px 30px; /* کمی کوچیکتر */
    border-radius: 25px; /* گوشه‌های نرم‌تر */
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    margin-top: 30px;
    font-size: 1rem; /* فونت کوچیکتر */
}

.view-all-btn:hover {
    background: linear-gradient(135deg, #764ba2, #7b47a5);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(142, 45, 226, 0.4); /* سایه بنفش */
}

/* آمار سایت */
.stats-section {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    padding: 60px 0;
    border-top: 1px solid #e9ecef;
    border-bottom: 1px solid #e9ecef;
}

.stat-card {
    text-align: center;
    padding: 30px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.stat-card.clickable {
    cursor: pointer;
}

.stat-number {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 15px;
}

.stat-label {
    font-size: 1.1rem;
    color: #6c757d;
    font-weight: 600;
}

/* حالت خالی */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: #6c757d;
    background: white;
    border-radius: 25px;
    margin: 20px 0;
}

.empty-state i {
    font-size: 5rem;
    margin-bottom: 30px;
    opacity: 0.3;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.empty-state h4 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #2c3e50;
}

.empty-state p {
    font-size: 1.1rem;
    opacity: 0.8;
}

/* انیمیشن‌ها */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* ریسپانسیو */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.8rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .section-title {
        font-size: 1.8rem; /* کوچیکتر در موبایل */
    }
    
    .section-subtitle {
        font-size: 0.9rem;
    }
    
    .content-section {
        padding: 60px 0;
    }
    
    .hero-section {
        padding: 100px 0 60px;
    }
    
    .card-content {
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .content-card {
        height: auto;
        min-height: 360px; /* کمی کوتاه‌تر */
    }
    
    .card-image {
        height: 140px; /* کوتاه‌تر برای موبایل */
    }
    
    .section-title {
        font-size: 1.6rem;
    }
    
    .hero-title {
        font-size: 2.2rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
}
</style>

<div class="home-page">
    <!-- بخش هیرو -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">... I write
                    <hr>
 ... Because I fell in love</h1>
                @auth
                    <a href="{{ route('posts.create') }}" class="hero-btn">
                        <i class="bi bi-pencil-square"></i>
                        شروع به نوشتن
                    </a>
                @else
                    <a href="{{ route('register') }}" class="hero-btn">
                        <i class="bi bi-person-plus"></i>
                        عضو شوید
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- آمار سایت -->
    @if(isset($stats))
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <!-- کل مطالب -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('posts.all_public') }}" class="text-decoration-none">
                        <div class="stat-card clickable">
                            <div class="stat-number">
                                @if($stats['total_posts'] > 0)
                                    {{ number_format($stats['total_posts']) }}
                                @else
                                    &nbsp;
                                @endif
                            </div>
                            <div class="stat-label">همه ی مطالب</div>
                        </div>
                    </a>
                </div>
                <!-- کتاب‌ها -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('books.index') }}" class="text-decoration-none">
                        <div class="stat-card clickable">
                            <div class="stat-number">
                                @if($stats['total_books'] > 0)
                                    {{ number_format($stats['total_books']) }}
                                @else
                                    &nbsp;
                                @endif
                            </div>
                            <div class="stat-label">کتاب‌ها</div>
                        </div>
                    </a>
                </div>
                <!-- حرف حق -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('words_of_wisdom.index') }}" class="text-decoration-none">
                        <div class="stat-card clickable">
                            <div class="stat-number">
                                @if($stats['total_words_of_wisdom'] > 0)
                                    {{ number_format($stats['total_words_of_wisdom']) }}
                                @else
                                    &nbsp;
                                @endif
                            </div>
                            <div class="stat-label">حرف حق</div>
                        </div>
                    </a>
                </div>
                <!-- انگیزشی -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('motivational.index') }}" class="text-decoration-none">
                        <div class="stat-card clickable">
                            <div class="stat-number">
                                @if($stats['total_motivational'] > 0)
                                    {{ number_format($stats['total_motivational']) }}
                                @else
                                    &nbsp;
                                @endif
                            </div>
                            <div class="stat-label">انگیزشی</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- بخش اخیراً اضافه شده‌ها -->
    <section class="content-section recent-posts">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">جدیدترین آثار</h2>
                <p class="section-subtitle">اخیراً اضافه شده از تمام دسته‌بندی‌ها</p>
            </div>
            
            @if(isset($recentPosts) && $recentPosts->count() > 0)
                <div class="row">
                    @foreach($recentPosts as $post)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="content-card" onclick="location.href='{{ route('posts.show', $post->slug ?: $post->id) }}'">
                                <div class="card-image">
                                    @php
                                        $categoryName = $post->category->name ?? '';
                                        $postTitle = $post->title ?? '';
                                        $postContent = $post->content ?? '';
                                        
                                        // تشخیص نوع پست
                                        $isNote = (
                                            str_contains($categoryName, 'دلنوشته') || 
                                            str_contains($categoryName, 'احساس') ||
                                            str_contains($categoryName, 'عشق') ||
                                            str_contains($postTitle, 'دلنوشته') ||
                                            str_contains($postTitle, 'احساس') ||
                                            str_contains($postTitle, 'عشق')
                                        );
                                        
                                        $isBook = (
                                            str_contains($categoryName, 'کتاب') ||
                                            str_contains($categoryName, 'داستان') ||
                                            str_contains($categoryName, 'رمان') ||
                                            str_contains($postTitle, 'کتاب') ||
                                            str_contains($postTitle, 'داستان') ||
                                            str_contains($postTitle, 'رمان')
                                        );
                                        
                                        $isPoem = (
                                            str_contains($categoryName, 'شعر') ||
                                            str_contains($categoryName, 'غزل') ||
                                            str_contains($categoryName, 'قطعه') ||
                                            str_contains($postTitle, 'شعر') ||
                                            str_contains($postTitle, 'غزل') ||
                                            str_contains($postTitle, 'قطعه')
                                        );
                                    @endphp
                                    
                                    @if($isNote)
                                        <i class="bi bi-heart-fill"></i>
                                    @elseif($isBook)
                                        <i class="bi bi-book-fill"></i>
                                    @elseif($isPoem)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-file-earmark-text-fill"></i>
                                    @endif
                                </div>
                                <div class="category-tag">
                                    @if($isNote)
                                        دلنوشته
                                    @elseif($isBook)
                                        کتاب
                                    @elseif($isPoem)
                                        شعر
                                    @else
                                        {{ $post->category->name ?? 'مطلب' }}
                                    @endif
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">{{ $post->title }}</h3>
                                    <p class="card-text">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}</p>
                                    <div class="card-meta">
                                        <div class="author">
                                            <i class="bi bi-person-fill"></i>
                                            <span>{{ $post->user->name ?? 'نویسنده ناشناس' }}</span>
                                        </div>
                                        <div class="stats">
                                            <span><i class="bi bi-eye-fill"></i> {{ $post->views_count ?? 0 }}</span>
                                            <span><i class="bi bi-heart-fill"></i> {{ $post->likes_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="{{ route('posts.index') }}" class="view-all-btn">
                        مشاهده همه مطالب
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>هنوز مطلبی منتشر نشده است</h4>
                    <p>اولین کسی باشید که مطلبی می‌نویسد!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- بخش دسته‌بندی دلنوشته -->
    <section class="content-section notes-section" style="background: white;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">دلنوشته‌ها</h2>
            </div>
            
            @if(isset($recentNotes) && $recentNotes->count() > 0)
                <div class="row">
                    @foreach($recentNotes as $note)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="content-card" onclick="location.href='{{ route('posts.show', $note->slug ?: $note->id) }}'">
                                <div class="card-image">
                                    <i class="bi bi-heart-fill"></i>
                                </div>
                                <div class="category-tag">دلنوشته</div>
                                <div class="card-content">
                                    <h3 class="card-title">{{ $note->title }}</h3>
                                    <p class="card-text">{{ $note->excerpt ?? Str::limit(strip_tags($note->content), 120) }}</p>
                                    <div class="card-meta">
                                        <div class="author">
                                            <i class="bi bi-person-fill"></i>
                                            <span>{{ $note->user->name ?? 'نویسنده ناشناس' }}</span>
                                        </div>
                                        <div class="stats">
                                            <span><i class="bi bi-eye-fill"></i> {{ $note->views_count ?? 0 }}</span>
                                            <span><i class="bi bi-heart-fill"></i> {{ $note->likes_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="{{ route('posts.index') }}?search=دلنوشته" class="view-all-btn">
                        همه دلنوشته‌ها
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-heart"></i>
                    <h4>هنوز دلنوشته‌ای منتشر نشده است</h4>
                    <p>اولین دلنوشته خود را بنویسید!</p>
                    @auth
                        <a href="{{ route('posts.create') }}" class="view-all-btn" style="margin-top: 20px;">
                            <i class="bi bi-pencil-square"></i>
                            شروع نوشتن
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </section>

    <!-- بخش دسته‌بندی کتاب -->
    <section class="content-section books-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">کتاب‌ها</h2>
            </div>
            
            @if(isset($recentBooks) && $recentBooks->count() > 0)
                <div class="row">
                    @foreach($recentBooks as $book)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="content-card" onclick="location.href='{{ route('posts.show', $book->slug ?: $book->id) }}'">
                                <div class="card-image">
                                    <i class="bi bi-book-fill"></i>
                                </div>
                                <div class="category-tag">کتاب</div>
                                <div class="card-content">
                                    <h3 class="card-title">{{ $book->title }}</h3>
                                    <p class="card-text">{{ $book->excerpt ?? Str::limit(strip_tags($book->content), 120) }}</p>
                                    <div class="card-meta">
                                        <div class="author">
                                            <i class="bi bi-person-fill"></i>
                                            <span>{{ $book->user->name ?? 'نویسنده ناشناس' }}</span>
                                        </div>
                                        <div class="stats">
                                            <span><i class="bi bi-eye-fill"></i> {{ $book->views_count ?? 0 }}</span>
                                            <span><i class="bi bi-heart-fill"></i> {{ $book->likes_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="{{ route('posts.index') }}?search=کتاب" class="view-all-btn">
                        همه کتاب‌ها
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-book"></i>
                    <h4>هنوز کتابی منتشر نشده است</h4>
                    <p>اولین کتاب خود را منتشر کنید!</p>
                    @auth
                        <a href="{{ route('posts.create') }}" class="view-all-btn" style="margin-top: 20px;">
                            <i class="bi bi-pencil-square"></i>
                            شروع نوشتن
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </section>

    <!-- بخش شعرها (اختیاری) -->
    @if(isset($recentPoems) && $recentPoems->count() > 0)
    <section class="content-section poems-section" style="background: white;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">شعرها</h2>
            </div>
            
            <div class="row">
                @foreach($recentPoems as $poem)
                    <div class="col-lg-3 col-md-6 mb-4">
                            <div class="content-card" onclick="location.href='{{ route('posts.show', $poem->slug ?: $poem->id) }}'">
                            <div class="card-image">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="category-tag">شعر</div>
                            <div class="card-content">
                                <h3 class="card-title">{{ $poem->title }}</h3>
                                <p class="card-text">{{ $poem->excerpt ?? Str::limit(strip_tags($poem->content), 120) }}</p>
                                <div class="card-meta">
                                    <div class="author">
                                        <i class="bi bi-person-fill"></i>
                                        <span>{{ $poem->user->name ?? 'شاعر ناشناس' }}</span>
                                    </div>
                                    <div class="stats">
                                        <span><i class="bi bi-eye-fill"></i> {{ $poem->views_count ?? 0 }}</span>
                                        <span><i class="bi bi-heart-fill"></i> {{ $poem->likes_count ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('posts.index') }}?search=شعر" class="view-all-btn">
                    همه شعرها
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>
    </section>
    @endif
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// انیمیشن ورود کارت‌ها هنگام اسکرول
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// اعمال انیمیشن به تمام کارت‌ها
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.content-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px)';
        card.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });

    // انیمیشن آمار
    const animateStats = () => {
        document.querySelectorAll('.stat-number').forEach(stat => {
            const finalNumber = parseInt(stat.textContent.replace(/,/g, ''));
            let currentNumber = 0;
            const increment = finalNumber / 50;
            
            const counter = setInterval(() => {
                currentNumber += increment;
                if (currentNumber >= finalNumber) {
                    stat.textContent = finalNumber.toLocaleString('fa-IR');
                    clearInterval(counter);
                } else {
                    stat.textContent = Math.floor(currentNumber).toLocaleString('fa-IR');
                }
            }, 30);
        });
    };

    // شروع انیمیشن آمار هنگام ورود به نمایشگر
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateStats();
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // اضافه کردن افکت hover به کارت‌ها
    document.querySelectorAll('.content-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.background = 'linear-gradient(135deg, #ffffff, #f8f9fa)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.background = 'white';
        });
    });
});

// اضافه کردن افکت کلیک روی کارت‌ها
document.addEventListener('click', function(e) {
    if (e.target.closest('.content-card')) {
        const card = e.target.closest('.content-card');
        card.style.transform = 'scale(0.98)';
        setTimeout(() => {
            card.style.transform = '';
        }, 150);
    }
});

// اضافه کردن افکت smooth scroll برای لینک‌ها
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>

@endsection
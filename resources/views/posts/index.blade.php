@extends('layouts.app')

@section('title', 'شعر و متن‌ها')

@section('content')
<div class="poetry-page">
    <div class="page-hero">
        <div class="hero-content">
            <h1 class="hero-title">شعر و متن‌های زیبا</h1>
            <p class="hero-subtitle">مجموعه‌ای از بهترین آثار هنری و ادبی</p>
            <div class="hero-decoration">
                <i class="fas fa-feather-alt"></i>
            </div>
        </div>
    </div>
    
    @if (session('success'))
        <div class="custom-alert custom-alert-success" id="successAlert">
            <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-text">{{ session('success') }}</div>
            <button type="button" class="alert-dismiss" onclick="hideAlert()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
    
    <div class="posts-container">
        <div class="posts-grid">
            @forelse ($posts as $post)
                <article class="poetry-card" data-aos="fade-up">
                    <div class="card-gradient"></div>
                    <div class="card-content">
                        <div class="card-header">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <div class="card-decoration">
                                <i class="fas fa-quote-right"></i>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <p class="card-excerpt">
                                {{ Str::limit($post->content, 150) }}
                            </p>
                        </div>
                        
                        <div class="card-meta">
                            <div class="meta-row">
                                <div class="meta-item">
                                    <i class="fas fa-user-circle"></i>
                                    <span>{{ $post->user->nickname ?? $post->user->name ?? 'ناشناس' }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $post->created_at->format('Y/m/d') }}</span>
                                </div>
                            </div>
                            <div class="meta-row">
                                <div class="card-stats">
                                    <div class="stat">
                                        <i class="fas fa-eye"></i>
                                        <span>{{ $post->views_count ?? 0 }}</span>
                                    </div>
                                    <div class="stat">
                                        <i class="fas fa-heart"></i>
                                        <span>{{ $post->likes_count ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-actions">
                            <a href="{{ route('posts.show', $post->id) }}" class="read-btn">
                                <span>ادامه مطلب</span>
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-content">
                    <div class="empty-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="empty-title">هنوز پستی منتشر نشده</h3>
                    <p class="empty-text">اولین نفری باشید که نوشته خود را با دنیا به اشتراک می‌گذارد</p>
                </div>
            @endforelse
        </div>
        
        @auth
            <div class="create-section">
                <div class="create-content">
                    <div class="create-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h3 class="create-title">نوشته‌ای دارید؟</h3>
                    <p class="create-text">آیا داستان، شعر یا دلنوشته‌ای دارید که می‌خواهید با دیگران به اشتراک بگذارید؟</p>
                    <a href="{{ route('posts.create') }}" class="create-btn">
                        <i class="fas fa-plus"></i>
                        <span>افزودن نوشته جدید</span>
                    </a>
                </div>
            </div>
        @else
            <div class="create-section">
                <div class="create-content">
                    <div class="create-icon">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <h3 class="create-title">عضویت داشته باشید</h3>
                    <p class="create-text">برای اشتراک‌گذاری نوشته‌های خود، ابتدا وارد حساب کاربری شوید</p>
                    <a href="{{ route('login') }}" class="create-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>ورود به حساب کاربری</span>
                    </a>
                </div>
            </div>
        @endauth
        
        @if(method_exists($posts, 'links'))
            <div class="pagination-section">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>

<style>
/* Reset و Base Styles */
.poetry-page {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    --shadow-light: 0 8px 25px rgba(102, 126, 234, 0.15);
    --shadow-medium: 0 15px 35px rgba(102, 126, 234, 0.2);
    --shadow-heavy: 0 25px 50px rgba(102, 126, 234, 0.3);
    --border-radius: 20px;
    --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    
    min-height: calc(100vh - 160px);
    padding: 0;
    margin: 0;
    position: relative;
    overflow: hidden;
}

/* Hero Section */
.page-hero {
    background: var(--primary-gradient);
    padding: 80px 0 100px;
    position: relative;
    margin: 0;
    overflow: hidden;
}

.page-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.hero-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    text-align: center;
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    color: white;
    margin: 0 0 20px 0;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: fadeInUp 1s ease;
}

.hero-subtitle {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0 0 30px 0;
    font-weight: 300;
    animation: fadeInUp 1s ease 0.2s both;
}

.hero-decoration {
    display: inline-block;
    animation: float 3s ease-in-out infinite;
}

.hero-decoration i {
    font-size: 2rem;
    color: rgba(255, 255, 255, 0.7);
}

/* Alert Styles */
.custom-alert {
    max-width: 1200px;
    margin: -50px auto 40px;
    padding: 20px 25px;
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative;
    z-index: 10;
    backdrop-filter: blur(10px);
    animation: slideInDown 0.6s ease;
}

.custom-alert-success {
    background: rgba(212, 237, 218, 0.95);
    border: 1px solid rgba(195, 230, 203, 0.8);
    color: #155724;
    box-shadow: var(--shadow-light);
}

.alert-icon i {
    font-size: 1.3rem;
}

.alert-text {
    flex: 1;
    font-weight: 500;
}

.alert-dismiss {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.alert-dismiss:hover {
    background: rgba(0, 0, 0, 0.1);
    transform: rotate(90deg);
}

/* Posts Container */
.posts-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px 60px;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 35px;
    margin-bottom: 80px;
}

/* Poetry Card */
.poetry-card {
    background: white;
    border-radius: var(--border-radius);
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-light);
    transition: var(--transition);
    cursor: pointer;
    border: 1px solid rgba(102, 126, 234, 0.1);
}

.poetry-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
    transform: scaleX(0);
    transition: var(--transition);
}

.poetry-card:hover::before {
    transform: scaleX(1);
}

.poetry-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-heavy);
}

.card-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    background: var(--secondary-gradient);
    opacity: 0;
    transition: var(--transition);
}

.poetry-card:hover .card-gradient {
    opacity: 1;
}

.card-content {
    padding: 30px;
    position: relative;
    z-index: 2;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.card-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    line-height: 1.4;
    transition: var(--transition);
    flex: 1;
}

.poetry-card:hover .card-title {
    color: #667eea;
}

.card-decoration {
    margin-left: 15px;
    opacity: 0.3;
    transition: var(--transition);
}

.poetry-card:hover .card-decoration {
    opacity: 0.6;
    transform: scale(1.1);
}

.card-decoration i {
    font-size: 1.2rem;
    color: #667eea;
}

.card-body {
    margin-bottom: 25px;
}

.card-excerpt {
    color: #6c757d;
    line-height: 1.7;
    margin: 0;
    font-size: 0.95rem;
}

.card-meta {
    margin-bottom: 25px;
    padding: 20px 0;
    border-top: 1px solid #f1f3f4;
    border-bottom: 1px solid #f1f3f4;
}

.meta-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.meta-row:not(:last-child) {
    margin-bottom: 12px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #6c757d;
}

.meta-item i {
    color: #667eea;
    width: 16px;
    text-align: center;
}

.card-stats {
    display: flex;
    gap: 20px;
}

.stat {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    color: #6c757d;
}

.stat i {
    color: #667eea;
}

.card-actions {
    text-align: center;
}

.read-btn {
    background: var(--primary-gradient);
    color: white;
    padding: 14px 28px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.read-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
    color: white;
    text-decoration: none;
}

/* Create Section */
.create-section {
    background: white;
    border-radius: var(--border-radius);
    padding: 50px;
    text-align: center;
    box-shadow: var(--shadow-light);
    border: 2px dashed rgba(102, 126, 234, 0.3);
    position: relative;
    overflow: hidden;
}

.create-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--secondary-gradient);
    opacity: 0.5;
}

.create-content {
    position: relative;
    z-index: 2;
}

.create-icon {
    margin-bottom: 20px;
}

.create-icon i {
    font-size: 3rem;
    color: #667eea;
    opacity: 0.8;
}

.create-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 15px 0;
}

.create-text {
    color: #6c757d;
    font-size: 1.1rem;
    margin: 0 0 30px 0;
    line-height: 1.6;
}

.create-btn {
    background: var(--primary-gradient);
    color: white;
    padding: 16px 32px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: var(--transition);
    box-shadow: var(--shadow-medium);
}

.create-btn:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-heavy);
    color: white;
    text-decoration: none;
}

/* Empty State */
.empty-content {
    grid-column: 1 / -1;
    text-align: center;
    padding: 100px 20px;
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
}

.empty-icon i {
    font-size: 5rem;
    color: #dee2e6;
    margin-bottom: 25px;
}

.empty-title {
    font-size: 1.8rem;
    color: #495057;
    margin: 0 0 15px 0;
    font-weight: 600;
}

.empty-text {
    font-size: 1.1rem;
    color: #6c757d;
    margin: 0;
    line-height: 1.6;
}

/* Pagination */
.pagination-section {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .posts-grid {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 25px;
    }
    
    .create-section {
        padding: 40px 30px;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .posts-container {
        padding: 0 15px 40px;
    }
    
    .posts-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .card-content {
        padding: 25px 20px;
    }
    
    .create-section {
        padding: 30px 20px;
    }
    
    .custom-alert {
        margin: -40px 15px 30px;
        padding: 15px 20px;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .page-hero {
        padding: 60px 0 80px;
    }
    
    .card-header {
        flex-direction: column;
        align-items: stretch;
        gap: 15px;
    }
    
    .card-decoration {
        margin: 0;
        text-align: center;
    }
    
    .meta-row {
        flex-direction: column;
        gap: 10px;
        align-items: stretch;
    }
    
    .card-stats {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide success alert after 5 seconds
    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = '0';
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 300);
        }, 5000);
    }
    
    // Card click functionality
    const poetryCards = document.querySelectorAll('.poetry-card');
    poetryCards.forEach(card => {
        card.addEventListener('click', function(e) {
            if (!e.target.closest('.read-btn')) {
                const readBtn = this.querySelector('.read-btn');
                if (readBtn) {
                    readBtn.click();
                }
            }
        });
    });
    
    // Smooth scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Animate cards on scroll
    poetryCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px)';
        card.style.transition = `opacity 0.8s ease ${index * 0.1}s, transform 0.8s ease ${index * 0.1}s`;
        observer.observe(card);
    });
});

function hideAlert() {
    const alert = document.getElementById('successAlert');
    if (alert) {
        alert.style.opacity = '0';
        setTimeout(() => {
            alert.style.display = 'none';
        }, 300);
    }
}
</script>
@endsection
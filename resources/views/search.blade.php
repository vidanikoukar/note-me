@extends('layouts.app')

@section('title', 'نتایج جستجو برای: ' . ($query ?? '') . ' - Note Me')

@section('content')
<div class="category-page">
    <div class="page-hero">
        <div class="hero-background"></div>
        <div class="hero-content">
            <div class="hero-glass-card">
                <h1 class="hero-title">
                    <span class="title-text">نتایج جستجو برای: "{{ $query ?? '' }}"</span>
                    <div class="title-underline"></div>
                </h1>
            </div>
        </div>
    </div>

    <div class="posts-container">
        <div class="posts-grid">
            @forelse ($results as $post)
                <article class="poetry-card" data-aos="fade-up">
                    <div class="card-background"></div>
                    <div class="card-content">
                        <div class="card-header">
                            <h2 class="card-title">{{ $post->title }}</h2>
                        </div>

                        <div class="card-body">
                            <p class="card-excerpt">
                                {{ \Str::limit(strip_tags($post->content), 150) }}
                            </p>
                        </div>

                        <div class="card-meta">
                            <div class="meta-row">
                                <div class="author-info">
                                    <div class="author-avatar">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                    <div class="author-details">
                                        <span class="author-name">{{ $post->user->nickname ?? $post->user->name ?? 'ناشناس' }}</span>
                                        <span class="publish-date">{{ $post->created_at->format('Y/m/d') }}</span>
                                    </div>
                                </div>
                                @if ($post->category)
                                    <div class="category-tag {{ Str::slug($post->category->name) }}-tag">
                                        <i class="bi bi-tag-fill"></i>
                                        {{ $post->category->name }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-stats">
                                <div class="stat">
                                    <i class="bi bi-eye-fill"></i>
                                    <span>{{ $post->views_count ?? 0 }}</span>
                                </div>
                                <div class="stat">
                                    <i class="bi bi-heart-fill"></i>
                                    <span>{{ $post->likes_count ?? 0 }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('posts.show', $post->slug ?? $post->id) }}" class="action-btn primary">
                                <span>ادامه مطلب</span>
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-content">
                    <div class="empty-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3 class="empty-title">نتیجه‌ای یافت نشد</h3>
                    <p class="empty-text">برای عبارت "{{ $query ?? '' }}" هیچ پستی پیدا نشد. لطفا با عبارت دیگری امتحان کنید.</p>
                </div>
            @endforelse
        </div>

        @if(method_exists($results, 'links'))
        <div class="pagination-section">
            {{ $results->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
@endsection
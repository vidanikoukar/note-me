@extends('layouts.app')

@section('title', 'پست‌های ذخیره شده')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 40px; direction: rtl;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-bookmark-heart-fill"></i> پست‌های ذخیره شده</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">بازگشت به داشبورد</a>
    </div>
    
    <p>در این صفحه می‌توانید تمام پست‌هایی که برای مطالعه در آینده ذخیره کرده‌اید را مشاهده کنید.</p>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($posts->isEmpty())
        <div class="alert alert-info text-center mt-4 p-5">
            <i class="bi bi-bookmark-x" style="font-size: 3rem;"></i>
            <h4 class="alert-heading mt-3">شما هنوز هیچ پستی را ذخیره نکرده‌اید.</h4>
            <p>برای ذخیره کردن، از دکمه بوکمارک <i class="bi bi-bookmark"></i> در کنار پست‌ها استفاده کنید.</p>
            <hr>
            <a href="{{ route('posts.all_public') }}" class="btn btn-primary">مشاهده همه پست‌ها</a>
        </div>
    @else
        <div class="posts-grid">
            @foreach ($posts as $post)
                @include('posts._card', ['post' => $post])
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection

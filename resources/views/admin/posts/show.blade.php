{{-- resources/views/admin/posts/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'مشاهده پست - ' . $post->title)

@section('content')
<div class="flex min-h-screen bg-gray-100 dir-rtl">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800">پنل ادمین</h2>
        </div>
        <nav class="mt-4">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600">
                        داشبورد
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600">
                        مدیریت کاربران
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 bg-blue-100 text-blue-600">
                        مدیریت پست‌ها
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.create') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600">
                        ایجاد پست جدید
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Page Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">مشاهده پست</h1>
                <nav class="text-sm text-gray-600">
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline">داشبورد</a> / 
                    <a href="{{ route('admin.posts.index') }}" class="hover:underline">مدیریت پست‌ها</a> / 
                    <span>مشاهده پست</span>
                </nav>
            </div>
            <div class="flex space-x-2 space-x-reverse">
                <a href="{{ route('admin.posts.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    بازگشت به لیست
                </a>
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    ویرایش پست
                </a>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Post Information Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Post Meta Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">اطلاعات پست</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm text-gray-600">شناسه پست:</span>
                        <span class="block text-gray-800 font-medium">#{{ $post->id }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">وضعیت انتشار:</span>
                        @if($post->published)
                            <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">منتشر شده</span>
                        @else
                            <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm">پیش‌نویس</span>
                        @endif
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">دسته‌بندی:</span>
                        <span class="block text-gray-800 font-medium">
                            {{ $post->category ?? 'بدون دسته‌بندی' }}
                        </span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">وضعیت:</span>
                        <span class="block text-gray-800 font-medium">{{ $post->status ?? 'فعال' }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">تعداد بازدید:</span>
                        <span class="block text-gray-800 font-medium">{{ number_format($post->views_count ?? 0) }}</span>
                    </div>
                    @if($post->slug)
                    <div>
                        <span class="text-sm text-gray-600">نامک (Slug):</span>
                        <span class="block text-gray-800 font-medium text-xs">{{ $post->slug }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Author Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">اطلاعات نویسنده</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm text-gray-600">نام نویسنده:</span>
                        <span class="block text-gray-800 font-medium">{{ $post->user->name }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">ایمیل:</span>
                        <span class="block text-gray-800 font-medium">{{ $post->user->email }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">نقش:</span>
                        <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm">
                            {{ $post->user->role ?? 'نویسنده' }}
                        </span>
                    </div>
                    @if($post->user->created_at)
                    <div>
                        <span class="text-sm text-gray-600">عضویت از:</span>
                        <span class="block text-gray-800 font-medium text-xs">
                            {{ \Morilog\Jalali\Jalalian::forge($post->user->created_at)->format('Y/m/d') }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Date Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">اطلاعات زمانی</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm text-gray-600">تاریخ ایجاد:</span>
                        <span class="block text-gray-800 font-medium">
                            {{ \Morilog\Jalali\Jalalian::forge($post->created_at)->format('Y/m/d - H:i') }}
                        </span>
                    </div>
                    @if($post->published_at)
                    <div>
                        <span class="text-sm text-gray-600">تاریخ انتشار:</span>
                        <span class="block text-gray-800 font-medium">
                            {{ \Morilog\Jalali\Jalalian::forge($post->published_at)->format('Y/m/d - H:i') }}
                        </span>
                    </div>
                    @endif
                    <div>
                        <span class="text-sm text-gray-600">آخرین ویرایش:</span>
                        <span class="block text-gray-800 font-medium">
                            {{ \Morilog\Jalali\Jalalian::forge($post->updated_at)->format('Y/m/d - H:i') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Post Content -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="border-b pb-4 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $post->title }}</h2>
                <div class="flex items-center space-x-4 space-x-reverse text-sm text-gray-600">
                    <span>نویسنده: {{ $post->user->name }}</span>
                    <span>•</span>
                    @if($post->published_at)
                        <span>منتشر شده در: {{ \Morilog\Jalali\Jalalian::forge($post->published_at)->format('Y/m/d') }}</span>
                    @else
                        <span>هنوز منتشر نشده</span>
                    @endif
                    @if(isset($post->reading_time))
                        <span>•</span>
                        <span>زمان مطالعه: {{ $post->reading_time }} دقیقه</span>
                    @endif
                </div>
            </div>

            <!-- Featured Image -->
            @if($post->featured_image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded-lg">
                <p class="text-sm text-gray-600 mt-2">تصویر شاخص: {{ $post->title }}</p>
            </div>
            @endif

            <!-- Post Summary -->
            @if($post->excerpt)
            <div class="mb-6 p-4 bg-blue-50 rounded-lg border-r-4 border-blue-500">
                <h3 class="font-bold text-gray-800 mb-2">خلاصه پست:</h3>
                <p class="text-gray-700">{{ $post->excerpt }}</p>
            </div>
            @endif

            <!-- Full Post Content -->
            <div class="prose prose-lg max-w-none">
                <h3 class="text-xl font-bold text-gray-800 mb-4">محتوای کامل پست</h3>
                <div class="text-gray-700 leading-relaxed">
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        <!-- Tags and Meta -->
        @if($post->meta_description || $post->meta_keywords)
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">متادیتا</h3>
            <div class="space-y-4">
                @if($post->slug)
                <div>
                    <span class="text-sm font-medium text-gray-600">URL پست:</span>
                    <span class="block text-blue-600 text-sm">/posts/{{ $post->slug }}</span>
                </div>
                @endif
                @if($post->word_count)
                <div>
                    <span class="text-sm font-medium text-gray-600">تعداد کلمات:</span>
                    <span class="block text-gray-800">{{ number_format($post->word_count) }} کلمه</span>
                </div>
                @endif
                @if($post->reading_time)
                <div>
                    <span class="text-sm font-medium text-gray-600">زمان مطالعه:</span>
                    <span class="block text-gray-800">{{ $post->reading_time }} دقیقه</span>
                </div>
                @endif
                @if($post->meta_title)
                <div>
                    <span class="text-sm font-medium text-gray-600">عنوان متا:</span>
                    <p class="text-gray-800 mt-1">{{ $post->meta_title }}</p>
                </div>
                @endif
                @if($post->meta_description)
                <div>
                    <span class="text-sm font-medium text-gray-600">توضیحات متا:</span>
                    <p class="text-gray-800 mt-1">{{ $post->meta_description }}</p>
                </div>
                @endif
                @if($post->meta_keywords)
                <div>
                    <span class="text-sm font-medium text-gray-600">کلمات کلیدی:</span>
                    <p class="text-gray-800 mt-1">{{ $post->meta_keywords }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Comments Section - Only if you have comments table -->
        {{-- 
        @if($post->comments->count() > 0)
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">آخرین نظرات ({{ min($post->comments->count(), 3) }} نظر اخیر)</h3>
            <div class="space-y-4">
                @foreach($post->comments->take(3) as $comment)
                <div class="border-b pb-4 {{ !$loop->last ? 'border-gray-200' : '' }}">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2 space-x-reverse">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                {{ mb_substr($comment->user->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-gray-800">{{ $comment->user->name }}</span>
                            @if($comment->status === 'approved')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">تایید شده</span>
                            @elseif($comment->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">در انتظار تایید</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">رد شده</span>
                            @endif
                        </div>
                        <span class="text-sm text-gray-600">
                            {{ \Morilog\Jalali\Jalalian::forge($comment->created_at)->format('Y/m/d - H:i') }}
                        </span>
                    </div>
                    <p class="text-gray-700 text-sm">{{ $comment->content }}</p>
                </div>
                @endforeach
            </div>
            @if($post->comments->count() > 3)
            <div class="mt-4">
                <a href="{{ route('admin.comments.index', ['post_id' => $post->id]) }}" class="text-blue-600 hover:underline text-sm">
                    مشاهده تمام نظرات ({{ $post->comments->count() }} نظر)
                </a>
            </div>
            @endif
        </div>
        @endif
        --}}

        <!-- Analytics -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">آمار و تحلیل</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">{{ number_format($post->views_count ?? 0) }}</div>
                    <div class="text-sm text-gray-600">بازدید کل</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">0</div>
                    <div class="text-sm text-gray-600">تعداد نظرات</div>
                </div>
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-600">{{ number_format($post->likes_count ?? 0) }}</div>
                    <div class="text-sm text-gray-600">لایک</div>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600">0</div>
                    <div class="text-sm text-gray-600">اشتراک‌گذاری</div>
                </div>
            </div>
        </div>

        <!-- Post SEO Info -->
        @if($post->meta_title || $post->meta_description || $post->meta_keywords)
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">اطلاعات SEO</h3>
            <div class="space-y-4">
                @if($post->meta_title)
                <div>
                    <span class="text-sm font-medium text-gray-600">عنوان متا:</span>
                    <p class="text-gray-800 mt-1">{{ $post->meta_title }}</p>
                </div>
                @endif
                @if($post->meta_description)
                <div>
                    <span class="text-sm font-medium text-gray-600">توضیحات متا:</span>
                    <p class="text-gray-800 mt-1">{{ $post->meta_description }}</p>
                </div>
                @endif
                @if($post->meta_keywords)
                <div>
                    <span class="text-sm font-medium text-gray-600">کلمات کلیدی:</span>
                    <p class="text-gray-800 mt-1">{{ $post->meta_keywords }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">عملیات</h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    ویرایش پست
                </a>
                <a href="{{ route('admin.posts.preview', $post->id) }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                    پیش‌نمایش
                </a>
                
                @if($post->published)
                    <form action="{{ route('admin.posts.unpublish', $post->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" onclick="return confirm('آیا می‌خواهید این پست را از انتشار خارج کنید؟')" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                            لغو انتشار
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.posts.publish', $post->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" onclick="return confirm('آیا می‌خواهید این پست را منتشر کنید؟')" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            انتشار پست
                        </button>
                    </form>
                @endif

                @if($post->slug)
                    <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                        مشاهده در سایت
                    </a>
                @endif
                
                <button onclick="duplicatePost({{ $post->id }})" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    کپی پست
                </button>
                
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('آیا مطمئن هستید که می‌خواهید این پست را حذف کنید؟ این عمل قابل بازگشت نیست.')" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                        حذف پست
                    </button>
                </form>
            </div>
        </div>

        <!-- Additional Post Stats -->
        @if($post->created_at->diffInDays() <= 30)
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">آمار ماه اخیر</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-xl font-bold text-gray-600">{{ number_format($post->daily_views ?? 0) }}</div>
                    <div class="text-sm text-gray-600">بازدید روزانه میانگین</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-xl font-bold text-gray-600">{{ $post->comments->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                    <div class="text-sm text-gray-600">نظرات هفته اخیر</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-xl font-bold text-gray-600">
                        {{ number_format(($post->views_count ?? 0) / max($post->created_at->diffInDays() ?: 1, 1)) }}
                    </div>
                    <div class="text-sm text-gray-600">بازدید روزانه</div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .dir-rtl { 
        direction: rtl; 
        text-align: right; 
    }
    .prose {
        text-align: right;
        direction: rtl;
    }
    .space-x-reverse > :not([hidden]) ~ :not([hidden]) {
        --tw-space-x-reverse: 1;
        margin-right: calc(0.5rem * var(--tw-space-x-reverse));
        margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
    }
</style>

<script>
function duplicatePost(postId) {
    if (confirm('آیا می‌خواهید یک کپی از این پست ایجاد کنید؟')) {
        fetch(`/admin/posts/${postId}/duplicate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('پست با موفقیت کپی شد');
                window.location.href = `/admin/posts/${data.post_id}/edit`;
            } else {
                alert('خطا در کپی کردن پست');
            }
        })
        .catch(error => {
            alert('خطا در کپی کردن پست');
        });
    }
}
</script>
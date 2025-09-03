{{-- resources/views/admin/posts/show.blade.php --}}
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>مشاهده پست - {{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Vazirmatn', 'Tahoma', sans-serif;
        }
        
        body {
            direction: rtl;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .gradient-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        
        .gradient-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .floating-card {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .post-content {
            line-height: 2;
            font-size: 16px;
            color: #374151;
        }
        
        .post-content h1, .post-content h2, .post-content h3 {
            margin: 2rem 0 1rem 0;
            color: #1f2937;
            font-weight: 600;
        }
        
        .post-content h1 { font-size: 1.875rem; }
        .post-content h2 { font-size: 1.5rem; }
        .post-content h3 { font-size: 1.25rem; }
        
        .post-content p {
            margin-bottom: 1.25rem;
            text-align: justify;
        }
        
        .post-content img {
            border-radius: 12px;
            margin: 1.5rem auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .badge {
            padding: 6px 16px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 4px 12px;
        }
        
        .sidebar-link:hover {
            background: #f3f4f6;
            color: #3b82f6;
            transform: translateX(-4px);
        }
        
        .sidebar-link.active {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 2rem 0;
        }
    </style>
</head>
<body>

<div class="flex min-h-screen">
    <!-- Enhanced Sidebar -->
    <div class="w-72 bg-white shadow-2xl">
        <!-- Sidebar Header -->
        <div class="gradient-primary p-6 text-white">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center ml-4">
                    <i class="fas fa-crown text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold">پنل ادمین</h2>
                    <p class="text-sm opacity-75">مدیریت محتوا</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="mt-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="fas fa-chart-pie text-lg ml-3"></i>
                        <span>داشبورد</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="sidebar-link">
                        <i class="fas fa-users text-lg ml-3"></i>
                        <span>مدیریت کاربران</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.index') }}" class="sidebar-link active">
                        <i class="fas fa-newspaper text-lg ml-3"></i>
                        <span>مدیریت پست‌ها</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.create') }}" class="sidebar-link">
                        <i class="fas fa-plus-circle text-lg ml-3"></i>
                        <span>ایجاد پست جدید</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto">
        <!-- Page Header -->
        <div class="bg-white shadow-sm border-b sticky top-0 z-10">
            <div class="px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-eye text-blue-600 ml-3"></i>
                            مشاهده پست
                        </h1>
                        <nav class="text-sm text-gray-500 mt-2 flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">داشبورد</a>
                            <i class="fas fa-angle-left mx-2"></i>
                            <a href="{{ route('admin.posts.index') }}" class="hover:text-blue-600 transition-colors">مدیریت پست‌ها</a>
                            <i class="fas fa-angle-left mx-2"></i>
                            <span class="text-gray-800 font-medium">{{ Str::limit($post->title, 30) }}</span>
                        </nav>
                    </div>
                    <div class="flex space-x-3 space-x-reverse">
                        <a href="{{ route('admin.posts.index') }}" class="btn bg-gray-600 text-white hover:bg-gray-700">
                            <i class="fas fa-arrow-right"></i>
                            بازگشت
                        </a>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn gradient-success text-white">
                            <i class="fas fa-edit"></i>
                            ویرایش
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="bg-green-50 border-r-4 border-green-400 text-green-800 px-6 py-4 rounded-xl mb-6 shadow-sm animate-slide-up">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle ml-3 text-green-600"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Post Overview Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
                <!-- Status Card -->
                <div class="stats-card card-hover" style="--gradient: {{ $post->published ? 'linear-gradient(135deg, #10b981, #059669)' : 'linear-gradient(135deg, #f59e0b, #d97706)' }}">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full {{ $post->published ? 'bg-green-100' : 'bg-yellow-100' }}">
                        <i class="fas {{ $post->published ? 'fa-check-circle text-green-600' : 'fa-clock text-yellow-600' }} text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">وضعیت انتشار</h3>
                    @if($post->published)
                        <span class="badge bg-green-100 text-green-800">
                            <i class="fas fa-check-circle"></i>
                            منتشر شده
                        </span>
                    @else
                        <span class="badge bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock"></i>
                            پیش‌نویس
                        </span>
                    @endif
                </div>

                <!-- Views Card -->
                <div class="stats-card card-hover" style="--gradient: linear-gradient(135deg, #3b82f6, #1d4ed8)">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100">
                        <i class="fas fa-eye text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">بازدیدها</h3>
                    <div class="text-3xl font-bold text-blue-600">{{ number_format($post->views ?? 0) }}</div>
                    <p class="text-sm text-gray-500 mt-1">تعداد بازدید</p>
                </div>

                <!-- Comments Card -->
                <div class="stats-card card-hover" style="--gradient: linear-gradient(135deg, #8b5cf6, #7c3aed)">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-purple-100">
                        <i class="fas fa-comments text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">نظرات</h3>
                    <div class="text-3xl font-bold text-purple-600">0</div>
                    <p class="text-sm text-gray-500 mt-1">تعداد نظرات</p>
                </div>

                <!-- Likes Card -->
                <div class="stats-card card-hover" style="--gradient: linear-gradient(135deg, #ec4899, #db2777)">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-pink-100">
                        <i class="fas fa-heart text-pink-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">پسندیدن‌ها</h3>
                    <div class="text-3xl font-bold text-pink-600">{{ number_format($post->likes_count ?? 0) }}</div>
                    <p class="text-sm text-gray-500 mt-1">تعداد لایک</p>
                </div>
            </div>

            <!-- Main Post Content -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Post Content -->
                <div class="xl:col-span-2">
                    <div class="glass-effect rounded-2xl shadow-xl overflow-hidden animate-slide-up">
                        <!-- Post Header -->
                        <div class="gradient-primary p-8 text-white">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h1 class="text-3xl font-bold mb-4 leading-tight">{{ $post->title }}</h1>
                                    <div class="flex items-center space-x-6 space-x-reverse text-sm">
                                        <span class="flex items-center bg-white bg-opacity-20 px-3 py-1 rounded-full">
                                            <i class="fas fa-user ml-2"></i>
                                            {{ $post->user->name }}
                                        </span>
                                        <span class="flex items-center bg-white bg-opacity-20 px-3 py-1 rounded-full">
                                            <i class="fas fa-calendar ml-2"></i>
                                            {{ $post->created_at->format('Y/m/d') }}
                                        </span>
                                        @if($post->published_at)
                                        <span class="flex items-center bg-white bg-opacity-20 px-3 py-1 rounded-full">
                                            <i class="fas fa-globe ml-2"></i>
                                            {{ $post->published_at->format('Y/m/d') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-left">
                                    <div class="text-4xl font-bold opacity-75">#{{ $post->id }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        @if($post->featured_image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" 
                                 class="w-full h-80 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            <div class="absolute bottom-4 right-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-image ml-1"></i>
                                تصویر شاخص
                            </div>
                        </div>
                        @endif

                        <!-- Post Summary -->
                        @if($post->excerpt)
                        <div class="p-8 bg-gradient-to-l from-blue-50 to-indigo-50 border-r-4 border-blue-500">
                            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-4">
                                <i class="fas fa-quote-right ml-3 text-blue-600"></i>
                                خلاصه پست
                            </h3>
                            <p class="text-gray-700 text-lg leading-relaxed italic">{{ $post->excerpt }}</p>
                        </div>
                        @endif

                        <!-- Full Content -->
                        <div class="p-8">
                            <h3 class="flex items-center text-2xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-file-alt ml-3 text-gray-600"></i>
                                محتوای کامل پست
                            </h3>
                            <div class="section-divider"></div>
                            <div class="post-content">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-6">
                    <!-- Post Details -->
                    <div class="glass-effect rounded-2xl shadow-xl p-6 floating-card">
                        <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-info-circle ml-3 text-blue-600"></i>
                            جزئیات پست
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">شناسه:</span>
                                <span class="font-bold text-gray-800">#{{ $post->id }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">نویسنده:</span>
                                <span class="font-medium text-gray-800">{{ $post->user->name }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">ایجاد:</span>
                                <span class="text-sm text-gray-700">{{ $post->created_at->format('Y/m/d H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">ویرایش:</span>
                                <span class="text-sm text-gray-700">{{ $post->updated_at->format('Y/m/d H:i') }}</span>
                            </div>
                            @if($post->published_at)
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">انتشار:</span>
                                <span class="text-sm text-green-700 font-medium">{{ $post->published_at->format('Y/m/d H:i') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Author Info -->
                    <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover">
                        <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-user-edit ml-3 text-green-600"></i>
                            اطلاعات نویسنده
                        </h3>
                        <div class="text-center mb-4">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-3 text-white text-2xl font-bold shadow-lg">
                                {{ mb_substr($post->user->name, 0, 1) }}
                            </div>
                            <h4 class="font-bold text-gray-800 text-lg">{{ $post->user->name }}</h4>
                            <p class="text-gray-600 text-sm">{{ $post->user->email }}</p>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">نقش:</span>
                                <span class="badge bg-blue-100 text-blue-800">
                                    <i class="fas fa-user-tag"></i>
                                    {{ $post->user->role ?? 'نویسنده' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">عضویت:</span>
                                <span class="text-sm text-gray-700">{{ $post->user->created_at->format('Y/m/d') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Information -->
                    @if($post->meta_title || $post->meta_description || $post->meta_keywords)
                    <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover">
                        <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-search ml-3 text-purple-600"></i>
                            اطلاعات SEO
                        </h3>
                        <div class="space-y-4">
                            @if($post->meta_title)
                            <div>
                                <label class="text-sm font-medium text-gray-600 block mb-2">عنوان متا:</label>
                                <div class="p-3 bg-gray-50 rounded-lg text-sm text-gray-800">{{ $post->meta_title }}</div>
                            </div>
                            @endif
                            @if($post->meta_description)
                            <div>
                                <label class="text-sm font-medium text-gray-600 block mb-2">توضیحات متا:</label>
                                <div class="p-3 bg-gray-50 rounded-lg text-sm text-gray-700 leading-relaxed">{{ $post->meta_description }}</div>
                            </div>
                            @endif
                            @if($post->meta_keywords)
                            <div>
                                <label class="text-sm font-medium text-gray-600 block mb-2">کلمات کلیدی:</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(',', $post->meta_keywords) as $keyword)
                                    <span class="badge bg-purple-100 text-purple-800 text-xs">
                                        <i class="fas fa-tag"></i>
                                        {{ trim($keyword) }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover">
                        <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-cogs ml-3 text-gray-600"></i>
                            عملیات سریع
                        </h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn w-full bg-blue-600 text-white hover:bg-blue-700 justify-center">
                                <i class="fas fa-edit"></i>
                                ویرایش پست
                            </a>
                            
                            <a href="{{ route('admin.posts.preview', $post->id) }}" class="btn w-full bg-purple-600 text-white hover:bg-purple-700 justify-center" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                                پیش‌نمایش
                            </a>

                            @if($post->published)
                                <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="published" value="0">
                                    <button type="submit" onclick="return confirm('آیا می‌خواهید این پست را از انتشار خارج کنید؟')" 
                                            class="btn w-full gradient-warning text-white justify-center">
                                        <i class="fas fa-eye-slash"></i>
                                        لغو انتشار
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="published" value="1">
                                    <input type="hidden" name="title" value="{{ $post->title }}">
                                    <input type="hidden" name="content" value="{{ $post->content }}">
                                    <button type="submit" onclick="return confirm('آیا می‌خواهید این پست را منتشر کنید؟')" 
                                            class="btn w-full gradient-success text-white justify-center">
                                        <i class="fas fa-globe"></i>
                                        انتشار پست
                                    </button>
                                </form>
                            @endif

                            <button onclick="duplicatePost({{ $post->id }})" class="btn w-full bg-indigo-600 text-white hover:bg-indigo-700 justify-center">
                                <i class="fas fa-copy"></i>
                                کپی پست
                            </button>
                            
                            <div class="section-divider"></div>
                            
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('⚠️ هشدار!\n\nآیا مطمئن هستید که می‌خواهید این پست را حذف کنید؟\nاین عمل قابل بازگشت نیست و تمام اطلاعات پست از بین خواهد رفت.\n\nبرای ادامه OK را بزنید.')" 
                                        class="btn w-full gradient-danger text-white justify-center">
                                    <i class="fas fa-trash"></i>
                                    حذف پست
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Stats -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Content Analysis -->
                <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover animate-slide-up">
                    <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-chart-bar ml-3 text-orange-600"></i>
                        تحلیل محتوا
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-orange-50 rounded-xl">
                            <div class="text-2xl font-bold text-orange-600">{{ str_word_count(strip_tags($post->content)) }}</div>
                            <div class="text-sm text-gray-600 mt-1">تعداد کلمات</div>
                        </div>
                        <div class="text-center p-4 bg-teal-50 rounded-xl">
                            <div class="text-2xl font-bold text-teal-600">{{ ceil(str_word_count(strip_tags($post->content)) / 200) }}</div>
                            <div class="text-sm text-gray-600 mt-1">دقیقه مطالعه</div>
                        </div>
                        <div class="text-center p-4 bg-indigo-50 rounded-xl">
                            <div class="text-2xl font-bold text-indigo-600">{{ strlen(strip_tags($post->content)) }}</div>
                            <div class="text-sm text-gray-600 mt-1">تعداد کاراکتر</div>
                        </div>
                        <div class="text-center p-4 bg-pink-50 rounded-xl">
                            <div class="text-2xl font-bold text-pink-600">{{ $post->created_at->diffInDays() }}</div>
                            <div class="text-sm text-gray-600 mt-1">روز از انتشار</div>
                        </div>
                    </div>
                </div>

                <!-- Activity Timeline -->
                <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover animate-slide-up">
                    <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-history ml-3 text-green-600"></i>
                        تاریخچه فعالیت
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center ml-4">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">پست ایجاد شد</p>
                                <p class="text-sm text-gray-600">{{ $post->created_at->format('Y/m/d H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($post->updated_at != $post->created_at)
                        <div class="flex items-center p-4 bg-yellow-50 rounded-xl">
                            <div class="w-10 h-10 bg-yellow-600 rounded-full flex items-center justify-center ml-4">
                                <i class="fas fa-edit text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">آخرین ویرایش</p>
                                <p class="text-sm text-gray-600">{{ $post->updated_at->format('Y/m/d H:i') }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($post->published_at)
                        <div class="flex items-center p-4 bg-green-50 rounded-xl">
                            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center ml-4">
                                <i class="fas fa-globe text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">پست منتشر شد</p>
                                <p class="text-sm text-gray-600">{{ $post->published_at->format('Y/m/d H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Performance Analytics -->
            <div class="mt-8 glass-effect rounded-2xl shadow-xl p-6 animate-slide-up">
                <h3 class="flex items-center text-2xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-analytics ml-3 text-blue-600"></i>
                    آمار عملکرد پست
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Views -->
                    <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg card-hover">
                        <div class="absolute top-4 left-4 opacity-20">
                            <i class="fas fa-eye text-4xl"></i>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-sm font-medium opacity-90 mb-2">مجموع بازدیدها</h4>
                            <div class="text-3xl font-bold">{{ number_format($post->views ?? 0) }}</div>
                            <div class="flex items-center mt-2 text-sm opacity-80">
                                <i class="fas fa-arrow-up ml-1"></i>
                                <span>+12% از هفته قبل</span>
                            </div>
                        </div>
                    </div>

                    <!-- Engagement -->
                    <div class="relative bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-lg card-hover">
                        <div class="absolute top-4 left-4 opacity-20">
                            <i class="fas fa-heart text-4xl"></i>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-sm font-medium opacity-90 mb-2">تعاملات</h4>
                            <div class="text-3xl font-bold">{{ number_format($post->likes_count ?? 0) }}</div>
                            <div class="flex items-center mt-2 text-sm opacity-80">
                                <i class="fas fa-heart ml-1"></i>
                                <span>لایک و واکنش</span>
                            </div>
                        </div>
                    </div>

                    <!-- Comments -->
                    <div class="relative bg-gradient-to-br from-purple-500 to-purple-600 text-white p-6 rounded-2xl shadow-lg card-hover">
                        <div class="absolute top-4 left-4 opacity-20">
                            <i class="fas fa-comments text-4xl"></i>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-sm font-medium opacity-90 mb-2">نظرات</h4>
                            <div class="text-3xl font-bold">0</div>
                            <div class="flex items-center mt-2 text-sm opacity-80">
                                <i class="fas fa-comment ml-1"></i>
                                <span>تعداد نظرات</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shares -->
                    <div class="relative bg-gradient-to-br from-pink-500 to-pink-600 text-white p-6 rounded-2xl shadow-lg card-hover">
                        <div class="absolute top-4 left-4 opacity-20">
                            <i class="fas fa-share text-4xl"></i>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-sm font-medium opacity-90 mb-2">اشتراک‌گذاری</h4>
                            <div class="text-3xl font-bold">{{ number_format($post->shares_count ?? 0) }}</div>
                            <div class="flex items-center mt-2 text-sm opacity-80">
                                <i class="fas fa-share-alt ml-1"></i>
                                <span>بار اشتراک</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            @if($post->slug || $post->category)
            <div class="mt-8 glass-effect rounded-2xl shadow-xl p-6 animate-slide-up">
                <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-info-circle ml-3 text-indigo-600"></i>
                    اطلاعات تکمیلی
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($post->slug)
                    <div class="p-4 bg-indigo-50 rounded-xl">
                        <h4 class="font-medium text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-link ml-2 text-indigo-600"></i>
                            نشانی پست (Slug)
                        </h4>
                        <div class="bg-white p-3 rounded-lg border border-indigo-200">
                            <code class="text-indigo-700 text-sm break-all">{{ $post->slug }}</code>
                        </div>
                        <p class="text-xs text-gray-600 mt-2">
                            <i class="fas fa-globe ml-1"></i>
                            URL: /posts/{{ $post->slug }}
                        </p>
                    </div>
                    @endif
                    
                    @if($post->category)
                    <div class="p-4 bg-emerald-50 rounded-xl">
                        <h4 class="font-medium text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-folder ml-2 text-emerald-600"></i>
                            دسته‌بندی
                        </h4>
                        <span class="badge bg-emerald-100 text-emerald-800 text-lg">
                            <i class="fas fa-tag"></i>
                            {{ $post->category }}
                        </span>
                    </div>
                    @else
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <h4 class="font-medium text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-folder-open ml-2 text-gray-400"></i>
                            دسته‌بندی
                        </h4>
                        <span class="badge bg-gray-100 text-gray-600">
                            <i class="fas fa-minus"></i>
                            بدون دسته‌بندی
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Action Buttons Footer -->
            <div class="mt-8 flex justify-center">
                <div class="glass-effect rounded-2xl shadow-xl p-6 inline-block">
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="{{ route('admin.posts.index') }}" class="btn bg-gray-600 text-white hover:bg-gray-700">
                            <i class="fas fa-list"></i>
                            لیست پست‌ها
                        </a>
                        <a href="{{ route('admin.posts.create') }}" class="btn bg-green-600 text-white hover:bg-green-700">
                            <i class="fas fa-plus"></i>
                            پست جدید
                        </a>
                        @if($post->published && $post->slug)
                        <a href="/posts/{{ $post->slug }}" target="_blank" class="btn bg-blue-600 text-white hover:bg-blue-700">
                            <i class="fas fa-external-link-alt"></i>
                            مشاهده در سایت
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notifications -->
<div id="toast-container" class="fixed top-4 left-4 z-50 space-y-4"></div>

<!-- Scripts -->
<script>
// Toast Notification System
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    const icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle';
    
    toast.className = `${bgColor} text-white px-6 py-4 rounded-xl shadow-lg transform translate-x-full opacity-0 transition-all duration-300 flex items-center`;
    toast.innerHTML = `
        <i class="fas ${icon} ml-3"></i>
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" class="mr-4 hover:bg-white hover:bg-opacity-20 rounded-full p-1">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    document.getElementById('toast-container').appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 5000);
}

// Duplicate Post Function
async function duplicatePost(postId) {
    if (!confirm('آیا می‌خواهید یک کپی از این پست ایجاد کنید؟\nپست جدید به عنوان پیش‌نویس ذخیره خواهد شد.')) {
        return;
    }
    
    try {
        const response = await fetch(`/admin/posts/${postId}/duplicate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showToast('پست با موفقیت کپی شد! در حال انتقال به صفحه ویرایش...', 'success');
            setTimeout(() => {
                window.location.href = `/admin/posts/${data.post_id}/edit`;
            }, 1500);
        } else {
            throw new Error(data.message || 'خطا در کپی کردن پست');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('خطا در کپی کردن پست. لطفاً دوباره تلاش کنید.', 'error');
    }
}

// Enhanced Confirm Dialog
function enhancedConfirm(message, callback) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl p-8 max-w-md mx-4 shadow-2xl transform scale-95 opacity-0 transition-all duration-300">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">تأیید عملیات</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">${message}</p>
                <div class="flex space-x-3 space-x-reverse">
                    <button onclick="this.closest('.fixed').remove()" class="btn bg-gray-500 text-white hover:bg-gray-600 flex-1">
                        <i class="fas fa-times"></i>
                        انصراف
                    </button>
                    <button onclick="confirmAction()" class="btn gradient-danger text-white hover:shadow-lg flex-1">
                        <i class="fas fa-check"></i>
                        تأیید
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Animate in
    setTimeout(() => {
        modal.querySelector('div > div').classList.remove('scale-95', 'opacity-0');
        modal.querySelector('div > div').classList.add('scale-100', 'opacity-100');
    }, 10);
    
    window.confirmAction = () => {
        callback();
        modal.remove();
    };
}

// Add loading states to buttons
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin ml-2"></i>در حال پردازش...';
            }
        });
    });
    
    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';
    
    // Lazy load images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.loading = 'lazy';
        img.style.transition = 'opacity 0.3s ease';
        img.style.opacity = '0';
        img.onload = () => img.style.opacity = '1';
    });
});

// Reading Progress Bar
function updateReadingProgress() {
    const contentElement = document.querySelector('.post-content');
    if (!contentElement) return;
    
    const windowHeight = window.innerHeight;
    const documentHeight = contentElement.offsetHeight;
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const contentTop = contentElement.offsetTop;
    
    const progress = Math.min(100, Math.max(0, ((scrollTop - contentTop + windowHeight) / documentHeight) * 100));
    
    let progressBar = document.getElementById('reading-progress');
    if (!progressBar) {
        progressBar = document.createElement('div');
        progressBar.id = 'reading-progress';
        progressBar.className = 'fixed top-0 right-0 h-1 bg-gradient-to-l from-blue-600 to-purple-600 z-50 transition-all duration-200';
        progressBar.style.width = '0%';
        document.body.appendChild(progressBar);
    }
    
    progressBar.style.width = `${progress}%`;
}

window.addEventListener('scroll', updateReadingProgress);
window.addEventListener('resize', updateReadingProgress);

// Initialize reading progress
document.addEventListener('DOMContentLoaded', updateReadingProgress);
</script>

</body>
</html>
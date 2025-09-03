{{-- resources/views/admin/posts/edit.blade.php --}}
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ویرایش پست - {{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
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
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background: #f9fafb;
            transition: all 0.3s ease;
            font-size: 16px;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
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
        
        .btn:active {
            transform: translateY(0);
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
        
        .file-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background: #f9fafb;
            position: relative;
            overflow: hidden;
        }
        
        .file-upload-area:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }
        
        .file-upload-area.dragover {
            border-color: #3b82f6;
            background: #dbeafe;
            transform: scale(1.02);
        }
        
        .checkbox-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        
        .checkbox-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .slider {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
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
                            <i class="fas fa-edit text-blue-600 ml-3"></i>
                            ویرایش پست
                        </h1>
                        <nav class="text-sm text-gray-500 mt-2 flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">داشبورد</a>
                            <i class="fas fa-angle-left mx-2"></i>
                            <a href="{{ route('admin.posts.index') }}" class="hover:text-blue-600 transition-colors">مدیریت پست‌ها</a>
                            <i class="fas fa-angle-left mx-2"></i>
                            <span class="text-gray-800 font-medium">ویرایش: {{ Str::limit($post->title, 30) }}</span>
                        </nav>
                    </div>
                    <div class="flex space-x-3 space-x-reverse">
                        <a href="{{ route('admin.posts.show', $post->id) }}" class="btn bg-gray-600 text-white hover:bg-gray-700">
                            <i class="fas fa-eye"></i>
                            مشاهده پست
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="btn bg-gray-500 text-white hover:bg-gray-600">
                            <i class="fas fa-arrow-right"></i>
                            بازگشت
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 animate-slide-up">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="bg-green-50 border-r-4 border-green-400 text-green-800 px-6 py-4 rounded-xl mb-6 shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle ml-3 text-green-600"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border-r-4 border-red-400 text-red-800 px-6 py-4 rounded-xl mb-6 shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle ml-3 text-red-600"></i>
                        <span class="font-medium">خطاهای زیر رخ داده است:</span>
                    </div>
                    <ul class="mr-6 mt-2 list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Form -->
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="editPostForm">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                    <!-- Main Form -->
                    <div class="xl:col-span-2 space-y-6">
                        <!-- Basic Information Card -->
                        <div class="glass-effect rounded-2xl shadow-xl p-8 card-hover">
                            <h2 class="flex items-center text-2xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-file-edit ml-3 text-blue-600"></i>
                                اطلاعات اصلی پست
                            </h2>
                            
                            <!-- Title -->
                            <div class="form-group">
                                <label for="title" class="form-label flex items-center">
                                    <i class="fas fa-heading ml-2 text-blue-600"></i>
                                    عنوان پست
                                    <span class="text-red-500 mr-1">*</span>
                                </label>
                                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" 
                                       class="form-input" placeholder="عنوان جذاب و خلاقانه برای پست خود وارد کنید" required>
                                @error('title')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1 flex items-center">
                                    <i class="fas fa-info-circle ml-1"></i>
                                    <span id="title-count">{{ strlen($post->title ?? '') }}</span>/255 کاراکتر
                                </div>
                            </div>

                            <!-- Excerpt -->
                            <div class="form-group">
                                <label for="excerpt" class="form-label flex items-center">
                                    <i class="fas fa-quote-right ml-2 text-green-600"></i>
                                    خلاصه پست
                                </label>
                                <textarea id="excerpt" name="excerpt" class="form-input form-textarea" 
                                          placeholder="خلاصه‌ای کوتاه و جذاب از محتوای پست که در لیست پست‌ها نمایش داده می‌شود">{{ old('excerpt', $post->excerpt) }}</textarea>
                                @error('excerpt')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1 flex items-center">
                                    <i class="fas fa-lightbulb ml-1"></i>
                                    خلاصه کوتاه و جذاب برای بهتر دیده شدن پست
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="form-group">
                                <label for="content" class="form-label flex items-center">
                                    <i class="fas fa-file-alt ml-2 text-purple-600"></i>
                                    محتوای پست
                                    <span class="text-red-500 mr-1">*</span>
                                </label>
                                <textarea id="content" name="content" class="form-input" style="min-height: 400px;" required>{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- SEO Settings Card -->
                        <div class="glass-effect rounded-2xl shadow-xl p-8 card-hover">
                            <h2 class="flex items-center text-2xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-search ml-3 text-indigo-600"></i>
                                تنظیمات SEO
                            </h2>
                            
                            <!-- Meta Title -->
                            <div class="form-group">
                                <label for="meta_title" class="form-label flex items-center">
                                    <i class="fas fa-tag ml-2 text-indigo-600"></i>
                                    عنوان متا (Meta Title)
                                </label>
                                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" 
                                       class="form-input" placeholder="عنوان SEO برای موتورهای جستجو" maxlength="60">
                                @error('meta_title')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1 flex items-center">
                                    <i class="fas fa-info-circle ml-1"></i>
                                    <span id="meta-title-count">{{ strlen($post->meta_title ?? '') }}</span>/60 کاراکتر (بهینه: 50-60)
                                </div>
                            </div>

                            <!-- Meta Description -->
                            <div class="form-group">
                                <label for="meta_description" class="form-label flex items-center">
                                    <i class="fas fa-align-left ml-2 text-indigo-600"></i>
                                    توضیحات متا (Meta Description)
                                </label>
                                <textarea id="meta_description" name="meta_description" class="form-input form-textarea" 
                                          placeholder="توضیحات کوتاه برای نمایش در نتایج جستجو" maxlength="160">{{ old('meta_description', $post->meta_description) }}</textarea>
                                @error('meta_description')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1 flex items-center">
                                    <i class="fas fa-info-circle ml-1"></i>
                                    <span id="meta-desc-count">{{ strlen($post->meta_description ?? '') }}</span>/160 کاراکتر (بهینه: 120-160)
                                </div>
                            </div>

                            <!-- Meta Keywords -->
                            <div class="form-group">
                                <label for="meta_keywords" class="form-label flex items-center">
                                    <i class="fas fa-tags ml-2 text-indigo-600"></i>
                                    کلمات کلیدی (Meta Keywords)
                                </label>
                                <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}" 
                                       class="form-input" placeholder="کلمات کلیدی را با کاما جدا کنید">
                                @error('meta_keywords')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1 flex items-center">
                                    <i class="fas fa-lightbulb ml-1"></i>
                                    مثال: تکنولوژی, برنامه‌نویسی, وب
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Settings -->
                    <div class="space-y-6">
                        <!-- Publish Settings -->
                        <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover">
                            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-cog ml-3 text-green-600"></i>
                                تنظیمات انتشار
                            </h3>
                            
                            <!-- Publish Toggle -->
                            <div class="form-group">
                                <label class="form-label flex items-center">
                                    <i class="fas fa-globe ml-2 text-green-600"></i>
                                    وضعیت انتشار
                                </label>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                    <span class="text-gray-700 font-medium">انتشار پست</span>
                                    <label class="checkbox-switch">
                                        <input type="checkbox" name="published" value="1" {{ old('published', $post->published) ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-info-circle ml-1"></i>
                                    پست منتشر شده برای عموم قابل مشاهده است
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="form-group">
                                <label for="category" class="form-label flex items-center">
                                    <i class="fas fa-folder ml-2 text-yellow-600"></i>
                                    دسته‌بندی
                                </label>
                                <select id="category" name="category" class="form-input">
                                    <option value="">انتخاب دسته‌بندی</option>
                                    <option value="تکنولوژی" {{ old('category', $post->category) == 'تکنولوژی' ? 'selected' : '' }}>تکنولوژی</option>
                                    <option value="برنامه‌نویسی" {{ old('category', $post->category) == 'برنامه‌نویسی' ? 'selected' : '' }}>برنامه‌نویسی</option>
                                    <option value="طراحی وب" {{ old('category', $post->category) == 'طراحی وب' ? 'selected' : '' }}>طراحی وب</option>
                                    <option value="هوش مصنوعی" {{ old('category', $post->category) == 'هوش مصنوعی' ? 'selected' : '' }}>هوش مصنوعی</option>
                                    <option value="موبایل" {{ old('category', $post->category) == 'موبایل' ? 'selected' : '' }}>موبایل</option>
                                    <option value="عمومی" {{ old('category', $post->category) == 'عمومی' ? 'selected' : '' }}>عمومی</option>
                                </select>
                                @error('category')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status" class="form-label flex items-center">
                                    <i class="fas fa-flag ml-2 text-orange-600"></i>
                                    وضعیت پست
                                </label>
                                <select id="status" name="status" class="form-input">
                                    <option value="active" {{ old('status', $post->status) == 'active' ? 'selected' : '' }}>فعال</option>
                                    <option value="inactive" {{ old('status', $post->status) == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                                    <option value="archived" {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>آرشیو شده</option>
                                </select>
                                @error('status')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover">
                            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-image ml-3 text-pink-600"></i>
                                تصویر شاخص
                            </h3>
                            
                            <!-- Current Image Preview -->
                            @if($post->featured_image)
                            <div class="mb-4">
                                <label class="form-label">تصویر فعلی:</label>
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" 
                                         class="w-full h-32 object-cover rounded-xl shadow-md">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">
                                            <i class="fas fa-search-plus ml-2"></i>
                                            کلیک برای مشاهده کامل
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- File Upload -->
                            <div class="form-group">
                                <label for="featured_image" class="form-label">
                                    {{ $post->featured_image ? 'تغییر تصویر شاخص' : 'آپلود تصویر شاخص' }}
                                </label>
                                <div class="file-upload-area" onclick="document.getElementById('featured_image').click()">
                                    <input type="file" id="featured_image" name="featured_image" accept="image/*" class="hidden">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-gray-600 font-medium">کلیک کنید یا فایل را بکشید</p>
                                        <p class="text-sm text-gray-500 mt-2">PNG, JPG, JPEG تا 2MB</p>
                                    </div>
                                    <div class="upload-preview hidden">
                                        <i class="fas fa-image text-4xl text-green-600 mb-3"></i>
                                        <p class="text-green-600 font-medium">تصویر انتخاب شد</p>
                                        <p class="text-sm text-gray-500 mt-2" id="file-name"></p>
                                    </div>
                                </div>
                                @error('featured_image')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Advanced Settings -->
                        <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover">
                            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-sliders-h ml-3 text-orange-600"></i>
                                تنظیمات پیشرفته
                            </h3>
                            
                            <!-- Slug -->
                            <div class="form-group">
                                <label for="slug" class="form-label flex items-center">
                                    <i class="fas fa-link ml-2 text-orange-600"></i>
                                    نشانی URL (Slug)
                                </label>
                                <div class="flex items-center">
                                    <span class="bg-gray-100 px-3 py-3 rounded-r-xl text-gray-600 text-sm">/posts/</span>
                                    <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" 
                                           class="form-input rounded-r-none rounded-l-xl border-r-0" placeholder="url-friendly-slug">
                                </div>
                                @error('slug')
                                    <div class="error-message flex items-center">
                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1 flex items-center">
                                    <i class="fas fa-info-circle ml-1"></i>
                                    فقط حروف انگلیسی، اعداد و خط تیره مجاز است
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <div class="space-y-6">
                        <!-- Post Info -->
                        <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover">
                            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-info-circle ml-3 text-blue-600"></i>
                                اطلاعات پست
                            </h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-600">شناسه:</span>
                                    <span class="font-bold text-blue-600">#{{ $post->id }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-600">نویسنده:</span>
                                    <span class="font-medium text-gray-800">{{ $post->user->name }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-600">ایجاد:</span>
                                    <span class="text-sm text-gray-700">{{ $post->created_at->format('Y/m/d') }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-600">آخرین ویرایش:</span>
                                    <span class="text-sm text-orange-700">{{ $post->updated_at->format('Y/m/d H:i') }}</span>
                                </div>
                                @if($post->published_at)
                                <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-600">انتشار:</span>
                                    <span class="text-sm text-green-700 font-medium">{{ $post->published_at->format('Y/m/d') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover">
                            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-chart-bar ml-3 text-purple-600"></i>
                                آمار سریع
                            </h3>
                            <div class="space-y-4">
                                <div class="text-center p-4 bg-blue-50 rounded-xl">
                                    <div class="text-2xl font-bold text-blue-600">{{ number_format($post->views ?? 0) }}</div>
                                    <div class="text-sm text-gray-600">بازدید</div>
                                </div>
                                <div class="text-center p-4 bg-green-50 rounded-xl">
                                    <div class="text-2xl font-bold text-green-600">{{ str_word_count(strip_tags($post->content)) }}</div>
                                    <div class="text-sm text-gray-600">کلمه</div>
                                </div>
                                <div class="text-center p-4 bg-purple-50 rounded-xl">
                                    <div class="text-2xl font-bold text-purple-600">{{ number_format($post->likes_count ?? 0) }}</div>
                                    <div class="text-sm text-gray-600">لایک</div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="glass-effect rounded-2xl shadow-xl p-6 card-hover">
                            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                                <i class="fas fa-tools ml-3 text-gray-600"></i>
                                عملیات
                            </h3>
                            <div class="space-y-3">
                                <button type="submit" form="editPostForm" class="btn w-full gradient-success text-white justify-center">
                                    <i class="fas fa-save"></i>
                                    ذخیره تغییرات
                                </button>
                                
                                <a href="{{ route('admin.posts.preview', $post->id) }}" class="btn w-full bg-purple-600 text-white hover:bg-purple-700 justify-center" target="_blank">
                                    <i class="fas fa-eye"></i>
                                    پیش‌نمایش
                                </a>
                                
                                <a href="{{ route('admin.posts.show', $post->id) }}" class="btn w-full bg-blue-600 text-white hover:bg-blue-700 justify-center">
                                    <i class="fas fa-info-circle"></i>
                                    مشاهده جزئیات
                                </a>
                                
                                <button type="button" onclick="duplicatePost({{ $post->id }})" class="btn w-full bg-indigo-600 text-white hover:bg-indigo-700 justify-center">
                                    <i class="fas fa-copy"></i>
                                    کپی پست
                                </button>
                            </div>
                        </div>

                        <!-- Danger Zone -->
                        <div class="glass-effect rounded-2xl shadow-xl p-6 border-2 border-red-200">
                            <h3 class="flex items-center text-xl font-bold text-red-700 mb-4">
                                <i class="fas fa-exclamation-triangle ml-3"></i>
                                منطقه خطر
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">عملیات‌های حساس که قابل بازگشت نیستند</p>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn w-full bg-red-600 text-white hover:bg-red-700 justify-center">
                                    <i class="fas fa-trash"></i>
                                    حذف پست
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-8 text-center shadow-2xl">
        <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-600 mx-auto mb-4"></div>
        <p class="text-gray-700 font-medium">در حال ذخیره تغییرات...</p>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed top-4 left-4 z-50 space-y-4"></div>

<script>
// Initialize TinyMCE Editor
document.addEventListener('DOMContentLoaded', function() {
    tinymce.init({
        selector: '#content',
        height: 500,
        directionality: 'rtl',
        language: 'fa',
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_style: `
            body { 
                font-family: 'Vazirmatn', Tahoma, sans-serif; 
                font-size: 16px; 
                direction: rtl; 
                text-align: right;
                line-height: 1.8;
            }
            p { margin-bottom: 1rem; }
            h1, h2, h3, h4, h5, h6 { 
                margin: 1.5rem 0 1rem 0; 
                font-weight: 600; 
                color: #1f2937;
            }
        `,
        setup: function(editor) {
            editor.on('change', function() {
                updateWordCount();
            });
        }
    });
});

// Character Counters
function setupCharacterCounters() {
    const titleInput = document.getElementById('title');
    const metaTitleInput = document.getElementById('meta_title');
    const metaDescInput = document.getElementById('meta_description');
    
    titleInput?.addEventListener('input', function() {
        document.getElementById('title-count').textContent = this.value.length;
    });
    
    metaTitleInput?.addEventListener('input', function() {
        document.getElementById('meta-title-count').textContent = this.value.length;
    });
    
    metaDescInput?.addEventListener('input', function() {
        document.getElementById('meta-desc-count').textContent = this.value.length;
    });
}

// Auto-generate slug from title
function setupSlugGeneration() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    
    titleInput?.addEventListener('input', function() {
        if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            slugInput.value = slug;
            slugInput.dataset.autoGenerated = 'true';
        }
    });
    
    slugInput?.addEventListener('input', function() {
        this.dataset.autoGenerated = 'false';
    });
}

// File Upload Handler
function setupFileUpload() {
    const fileInput = document.getElementById('featured_image');
    const uploadArea = document.querySelector('.file-upload-area');
    const placeholder = document.querySelector('.upload-placeholder');
    const preview = document.querySelector('.upload-preview');
    
    fileInput?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('file-name').textContent = file.name;
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
        } else {
            placeholder.classList.remove('hidden');
            preview.classList.add('hidden');
        }
    });
    
    // Drag and Drop
    uploadArea?.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });
    
    uploadArea?.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });
    
    uploadArea?.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });
}

// Form Validation
function setupFormValidation() {
    const form = document.getElementById('editPostForm');
    const titleInput = document.getElementById('title');
    
    form?.addEventListener('submit', function(e) {
        let hasErrors = false;
        
        // Clear previous errors
        document.querySelectorAll('.error-highlight').forEach(el => {
            el.classList.remove('error-highlight');
        });
        
        // Validate title
        if (!titleInput.value.trim()) {
            titleInput.classList.add('error-highlight', 'border-red-500');
            hasErrors = true;
        }
        
        // Validate TinyMCE content
        const content = tinymce.get('content')?.getContent();
        if (!content || content.trim() === '') {
            showToast('محتوای پست نمی‌تواند خالی باشد', 'error');
            hasErrors = true;
        }
        
        if (hasErrors) {
            e.preventDefault();
            showToast('لطفاً خطاهای فرم را بررسی کنید', 'error');
            return false;
        }
        
        // Show loading
        showLoading();
        return true;
    });
}

// Auto-save functionality
let autoSaveTimer;
function setupAutoSave() {
    const form = document.getElementById('editPostForm');
    const inputs = form?.querySelectorAll('input, textarea, select');
    
    inputs?.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                saveAsDraft();
            }, 30000); // Auto-save after 30 seconds of inactivity
        });
    });
}

// Save as draft
async function saveAsDraft() {
    try {
        const formData = new FormData(document.getElementById('editPostForm'));
        formData.set('published', '0'); // Force as draft
        
        const response = await fetch(`{{ route('admin.posts.update', $post->id) }}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        if (response.ok) {
            showToast('پیش‌نویس ذخیره شد', 'success');
        }
    } catch (error) {
        console.error('Auto-save failed:', error);
    }
}

// Word count update
function updateWordCount() {
    const content = tinymce.get('content')?.getContent({ format: 'text' }) || '';
    const wordCount = content.trim().split(/\s+/).length;
    const readingTime = Math.ceil(wordCount / 200);
    
    // Update display if elements exist
    const wordCountEl = document.getElementById('word-count');
    const readingTimeEl = document.getElementById('reading-time');
    
    if (wordCountEl) wordCountEl.textContent = wordCount;
    if (readingTimeEl) readingTimeEl.textContent = readingTime;
}

// Toast notifications
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
    
    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
    }, 100);
    
    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 5000);
}

// Loading overlay
function showLoading() {
    document.getElementById('loading-overlay').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loading-overlay').classList.add('hidden');
}

// Confirm delete
function confirmDelete() {
    return confirm('⚠️ هشدار!\n\nآیا مطمئن هستید که می‌خواهید این پست را حذف کنید?\nاین عمل قابل بازگشت نیست و تمام اطلاعات پست از بین خواهد رفت.\n\nبرای تأیید حذف OK را بزنید.');
}

// Duplicate post function
async function duplicatePost(postId) {
    if (!confirm('آیا می‌خواهید یک کپی از این پست ایجاد کنید؟\nپست جدید به عنوان پیش‌نویس ذخیره خواهد شد.')) {
        return;
    }
    
    try {
        showLoading();
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
            showToast('پست با موفقیت کپی شد!', 'success');
            setTimeout(() => {
                window.location.href = `/admin/posts/${data.post_id}/edit`;
            }, 1500);
        } else {
            throw new Error(data.message || 'خطا در کپی کردن پست');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('خطا در کپی کردن پست. لطفاً دوباره تلاش کنید.', 'error');
    } finally {
        hideLoading();
    }
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl+S to save
    if (e.ctrlKey && e.key === 's') {
        e.preventDefault();
        document.getElementById('editPostForm').submit();
    }
    
    // Ctrl+P to preview
    if (e.ctrlKey && e.key === 'p') {
        e.preventDefault();
        window.open(`{{ route('admin.posts.preview', $post->id) }}`, '_blank');
    }
});

// Initialize all features
document.addEventListener('DOMContentLoaded', function() {
    setupCharacterCounters();
    setupSlugGeneration();
    setupFileUpload();
    setupFormValidation();
    setupAutoSave();
    
    // Show keyboard shortcuts help
    const helpBtn = document.createElement('div');
    helpBtn.className = 'fixed bottom-4 left-4 bg-gray-800 text-white p-3 rounded-full cursor-pointer hover:bg-gray-700 transition-colors z-40';
    helpBtn.innerHTML = '<i class="fas fa-keyboard"></i>';
    helpBtn.title = 'میانبرهای کیبورد: Ctrl+S (ذخیره), Ctrl+P (پیش‌نمایش)';
    document.body.appendChild(helpBtn);
    
    // Auto-focus on title
    document.getElementById('title')?.focus();
    
    // Hide loading on page load
    hideLoading();
});

// Prevent data loss
window.addEventListener('beforeunload', function(e) {
    const form = document.getElementById('editPostForm');
    const formData = new FormData(form);
    const hasChanges = Array.from(formData.entries()).some(([key, value]) => {
        const originalValue = form.querySelector(`[name="${key}"]`)?.defaultValue || '';
        return value !== originalValue;
    });
    
    if (hasChanges) {
        e.preventDefault();
        e.returnValue = 'تغییرات ذخیره نشده‌ای دارید. آیا مطمئن هستید که می‌خواهید صفحه را ترک کنید؟';
        return e.returnValue;
    }
});

// Form submission handler
document.getElementById('editPostForm')?.addEventListener('submit', function() {
    // Remove beforeunload warning when form is submitted
    window.removeEventListener('beforeunload', arguments.callee);
    showLoading();
});
</script>

</body>
</html>
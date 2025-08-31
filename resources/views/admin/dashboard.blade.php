
<div class="flex min-h-screen bg-gray-100 dir-rtl">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800">پنل ادمین</h2>
        </div>
        <nav class="mt-4">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 {{ Route::is('admin.dashboard') ? 'bg-blue-100 text-blue-600' : '' }}">
                        داشبورد
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 {{ Route::is('admin.users') ? 'bg-blue-100 text-blue-600' : '' }}">
                        مدیریت کاربران
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 {{ Route::is('admin.posts.index') ? 'bg-blue-100 text-blue-600' : '' }}">
                        مدیریت پست‌ها
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.create') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 {{ Route::is('admin.posts.create') ? 'bg-blue-100 text-blue-600' : '' }}">
                        ایجاد پست جدید
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">داشبورد ادمین</h1>
            <p class="text-gray-600">خلاصه‌ای از فعالیت‌های سیستم و مدیریت کاربران و پست‌ها</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-white rounded-lg shadow p-6 flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857 M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="mr-4">
                    <h3 class="text-lg font-semibold text-gray-700">کل کاربران</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['totalUsers'] }}</p>
                </div>
            </div>

            <!-- Total Posts -->
            <div class="bg-white rounded-lg shadow p-6 flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="mr-4">
                    <h3 class="text-lg font-semibold text-gray-700">کل پست‌ها</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['totalPosts'] }}</p>
                </div>
            </div>

            <!-- Users Today -->
            <div class="bg-white rounded-lg shadow p-6 flex items-center">
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="mr-4">
                    <h3 class="text-lg font-semibold text-gray-700">کاربران امروز</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['usersToday'] }}</p>
                </div>
            </div>

            <!-- Posts Today -->
            <div class="bg-white rounded-lg shadow p-6 flex items-center">
                <div class="p-3 bg-red-100 rounded-full">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2V9a2 2 0 00-2-2h-2a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="mr-4">
                    <h3 class="text-lg font-semibold text-gray-700">پست‌های امروز</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['postsToday'] }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Users -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">کاربران اخیر</h2>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-right">نام</th>
                                <th class="px-4 py-2 text-right">ایمیل</th>
                                <th class="px-4 py-2 text-right">نقش</th>
                                <th class="px-4 py-2 text-right">تاریخ ثبت‌نام</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestUsers as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{ $user->role }}</td>
                                <td class="px-4 py-2">{{ $user->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.users') }}" class="mt-4 inline-block text-blue-600 hover:underline">مشاهده همه کاربران</a>
            </div>

            <!-- Recent Posts -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">پست‌های اخیر</h2>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-right">عنوان</th>
                                <th class="px-4 py-2 text-right">نویسنده</th>
                                <th class="px-4 py-2 text-right">تاریخ انتشار</th>
                                <th class="px-4 py-2 text-right">مشاهده</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestPosts as $post)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $post->title }}</td>
                                <td class="px-4 py-2">{{ $post->user->name }}</td>
                                <td class="px-4 py-2">{{ $post->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('admin.posts.show', $post->id) }}" class="text-blue-600 hover:underline">مشاهده</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">مشاهده همه پست‌ها</a>
            </div>
        </div>
    </div>
</div>

<!-- Tailwind CSS CDN for development (replace with local assets in production) -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .dir-rtl { direction: rtl; text-align: right; }
</style>

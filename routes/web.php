<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Middleware\RestrictToAdmins;

// صفحات عمومی
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', fn() => redirect('/'))->name('about');
Route::get('/services', fn() => redirect('/'))->name('services');
Route::get('/portfolio', fn() => redirect('/'))->name('portfolio');
Route::get('/blog', fn() => redirect('/'))->name('blog');
Route::get('/contact', fn() => redirect('/'))->name('contact');

// احراز هویت
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// پنل کاربری
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    // پست‌های کاربری
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// پنل ادمین - استفاده از کلاس مستقیم به جای alias
Route::middleware(['auth', RestrictToAdmins::class])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.update-role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Posts
    Route::resource('posts', AdminPostController::class);
    Route::get('/posts/{post}/preview', [AdminPostController::class, 'preview'])->name('posts.preview');
});

// سایر روت‌ها
Route::post('/newsletter/subscribe', function() {
    return back()->with('success', 'با موفقیت در خبرنامه عضو شدید!');
})->name('newsletter.subscribe');

Route::get('/privacy', fn() => redirect('/'))->name('privacy');
Route::get('/terms', fn() => redirect('/'))->name('terms');
Route::get('/sitemap', fn() => redirect('/'))->name('sitemap');


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Post management routes (اگه قبلاً نداری)
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    
    // Additional post routes
    Route::patch('posts/{post}/publish', [\App\Http\Controllers\Admin\PostController::class, 'publish'])->name('posts.publish');
    Route::patch('posts/{post}/unpublish', [\App\Http\Controllers\Admin\PostController::class, 'unpublish'])->name('posts.unpublish');
    Route::post('posts/{post}/duplicate', [\App\Http\Controllers\Admin\PostController::class, 'duplicate'])->name('posts.duplicate');
    
});
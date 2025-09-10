<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController;

// صفحه اصلی
Route::get('/', [HomeController::class, 'index'])->name('home');

// صفحات عمومی
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

    // پست‌های کاربری (غیر ادمین)
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/published', [PostController::class, 'published'])->name('posts.published');
    Route::get('/posts/views', [PostController::class, 'views'])->name('posts.views');
    Route::get('/posts/likes', [PostController::class, 'likes'])->name('posts.likes');
    Route::get('/posts/all', [PostController::class, 'all'])->name('posts.all');

    // برای سازگاری با view
    Route::get('/articles/create', [PostController::class, 'create'])->name('articles.create');
});

// پنل ادمین
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.update-role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::resource('posts', AdminPostController::class);
    Route::get('/posts/{post}/preview', [AdminPostController::class, 'preview'])->name('posts.preview');
    Route::patch('posts/{post}/publish', [AdminPostController::class, 'publish'])->name('posts.publish');
    Route::patch('posts/{post}/unpublish', [AdminPostController::class, 'unpublish'])->name('posts.unpublish');
    Route::post('posts/{post}/duplicate', [AdminPostController::class, 'duplicate'])->name('posts.duplicate');
    Route::resource('categories', CategoryController::class);
});

// جستجو
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');

// دسته‌بندی‌های خاص
Route::get('/notes', [HomeController::class, 'getNotesByCategory'])->name('notes.index');
Route::get('/books', [HomeController::class, 'getBooksByCategory'])->name('books.index');
Route::get('/poems', [HomeController::class, 'getPoemsByCategory'])->name('poems.index');
Route::get('/movies', [HomeController::class, 'getMoviesByCategory'])->name('movies.index');

// متدهای کمکی HomeController
Route::get('/home/clear-cache', [HomeController::class, 'clearCache'])->name('home.clear-cache');
Route::get('/home/stats', [HomeController::class, 'getStats'])->name('home.stats');
Route::get('/home/quick-search', [HomeController::class, 'quickSearch'])->name('home.quick-search');

// API Routes
Route::prefix('api')->group(function () {
    Route::get('categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::get('posts/category/{category}', [PostController::class, 'getByCategory']);
});

// سایر روت‌ها
Route::post('/newsletter/subscribe', function () {
    return back()->with('success', 'با موفقیت در خبرنامه عضو شدید!');
})->name('newsletter.subscribe');

Route::get('/privacy', fn() => redirect('/'))->name('privacy');
Route::get('/terms', fn() => redirect('/'))->name('terms');
Route::get('/sitemap', fn() => redirect('/'))->name('sitemap');
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // تعداد نوشته‌های منتشر شده
        $published_posts_count = Post::where('user_id', $user->id)
                                    ->where('published', true)
                                    ->count();
        
        // تعداد کل نوشته‌ها
        $posts_count = Post::where('user_id', $user->id)->count();
        
        // مجموع بازدیدها
        $total_views = Post::where('user_id', $user->id)->sum('views_count');
        
        // مجموع لایک‌ها
        $total_likes = Post::where('user_id', $user->id)->sum('likes_count');
        
        // فعالیت‌های اخیر
        $recent_posts = Post::where('user_id', $user->id)
                           ->with('category')
                           ->latest()
                           ->take(5)
                           ->get();

        return view('auth.dashboard', compact(
            'user',
            'published_posts_count',
            'posts_count',
            'total_views',
            'total_likes',
            'recent_posts'
        ));
    }
}
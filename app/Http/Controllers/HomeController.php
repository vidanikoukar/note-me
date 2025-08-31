<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // دریافت آخرین مطالب بلاگ (مثال)
        // $latestPosts = Blog::latest()->take(3)->get();
        
        // دریافت آخرین پروژه‌ها (مثال)
        // $latestProjects = Portfolio::latest()->take(6)->get();
        
        // داده‌های نمونه
        $data = [
            'hero' => [
                'title' => 'وب‌سایت حرفه‌ای با Laravel',
                'subtitle' => 'ما بهترین راه‌حل‌های دیجیتال را برای کسب‌وکار شما ارائه می‌دهیم',
                'features' => [
                    'طراحی مدرن و زیبا',
                    'کاملاً ریسپانسیو',
                    'بهینه‌سازی شده برای سئو',
                    'پشتیبانی ۲۴ ساعته'
                ]
            ],
            'stats' => [
                ['number' => '۵۰۰+', 'label' => 'پروژه موفق', 'icon' => 'fas fa-project-diagram'],
                ['number' => '۱۰۰+', 'label' => 'مشتری راضی', 'icon' => 'fas fa-users'],
                ['number' => '۵+', 'label' => 'سال تجربه', 'icon' => 'fas fa-calendar-alt'],
                ['number' => '۲۴/۷', 'label' => 'پشتیبانی', 'icon' => 'fas fa-headset']
            ],
            'services' => [
                [
                    'icon' => 'fas fa-code',
                    'title' => 'توسعه وب‌سایت',
                    'description' => 'طراحی و توسعه وب‌سایت‌های حرفه‌ای با تکنولوژی‌های مدرن',
                    'features' => ['Laravel', 'React', 'Vue.js', 'Node.js']
                ],
                [
                    'icon' => 'fas fa-mobile-alt',
                    'title' => 'اپلیکیشن موبایل',
                    'description' => 'ساخت اپلیکیشن‌های اندروید و iOS با کیفیت بالا',
                    'features' => ['React Native', 'Flutter', 'Native', 'Hybrid']
                ],
                [
                    'icon' => 'fas fa-search',
                    'title' => 'سئو و بهینه‌سازی',
                    'description' => 'بهینه‌سازی وب‌سایت برای موتورهای جستجو',
                    'features' => ['Technical SEO', 'Content SEO', 'Local SEO', 'Analytics']
                ],
                [
                    'icon' => 'fas fa-paint-brush',
                    'title' => 'طراحی گرافیک',
                    'description' => 'طراحی لوگو، بنر، و محتوای بصری',
                    'features' => ['Logo Design', 'Branding', 'Print Design', 'Digital Art']
                ]
            ],
            'testimonials' => [
                [
                    'name' => 'احمد محمدی',
                    'position' => 'مدیرعامل شرکت تکنولوژی',
                    'avatar' => 'https://via.placeholder.com/100',
                    'rating' => 5,
                    'comment' => 'کیفیت کار بسیار عالی بود. تیم حرفه‌ای و با تجربه. پروژه در زمان مقرر تحویل داده شد.'
                ],
                [
                    'name' => 'مریم احمدی',
                    'position' => 'بازاریاب دیجیتال',
                    'avatar' => 'https://via.placeholder.com/100',
                    'rating' => 5,
                    'comment' => 'طراحی وب‌سایت بسیار زیبا و کاربردی بود. رضایت کامل از همکاری با این تیم دارم.'
                ],
                [
                    'name' => 'رضا حسینی',
                    'position' => 'کسب‌وکار آنلاین',
                    'avatar' => 'https://via.placeholder.com/100',
                    'rating' => 5,
                    'comment' => 'فروشگاه آنلاین من با کمک آنها رشد قابل توجهی داشته است. توصیه می‌کنم.'
                ]
            ],
            // 'latest_posts' => $latestPosts ?? [],
            // 'latest_projects' => $latestProjects ?? []
        ];

        return view('home', compact('data'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Helpers\CategoryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'allPosts']);
    }

    public function allPosts(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_id');

        $posts = Post::with(['user', 'category'])
            ->whereIn('status', ['published', 'active'])
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($categoryFilter, function ($query, $categoryFilter) {
                return $query->where('category_id', $categoryFilter);
            })
            ->latest()
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_id');

        $posts = Post::with(['user', 'category'])
            ->where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($categoryFilter, function ($query, $categoryFilter) {
                return $query->where('category_id', $categoryFilter);
            })
            ->latest()
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function published(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_id');

        $posts = Post::with(['user', 'category'])
            ->where('user_id', Auth::id())
            ->where('published', true)
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($categoryFilter, function ($query, $categoryFilter) {
                return $query->where('category_id', $categoryFilter);
            })
            ->latest()
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function views(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_id');

        $posts = Post::with(['user', 'category'])
            ->where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($categoryFilter, function ($query, $categoryFilter) {
                return $query->where('category_id', $categoryFilter);
            })
            ->orderBy('views_count', 'desc')
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function likes(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_id');

        $posts = Post::with(['user', 'category'])
            ->where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($categoryFilter, function ($query, $categoryFilter) {
                return $query->where('category_id', $categoryFilter);
            })
            ->orderBy('likes_count', 'desc')
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function all(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_id');

        $posts = Post::with(['user', 'category'])
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($categoryFilter, function ($query, $categoryFilter) {
                return $query->where('category_id', $categoryFilter);
            })
            ->latest()
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.all', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = CategoryHelper::getAllWithCount() ?? Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string',
            'slug' => 'nullable|string|unique:posts,slug',
            'featured_image' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ], [
            'title.required' => 'عنوان الزامی است',
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد',
            'content.required' => 'محتوا الزامی است',
            'category_id.required' => 'انتخاب دسته‌بندی الزامی است',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست',
            'slug.unique' => 'اسلاگ وارد شده قبلاً استفاده شده است',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'excerpt' => $request->excerpt,
            'slug' => $request->slug ?? \Str::slug($request->title),
            'published' => true,
            'published_at' => now(),
            'featured_image' => $request->featured_image,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'views_count' => 0,
            'likes_count' => 0,
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('posts.index')->with('success', 'نوشته با موفقیت اضافه شد!');
    }

    public function show($slugOrId)
    {
        $post = Post::with(['user', 'category'])->where('slug', $slugOrId)->first();

        if (!$post) {
            $post = Post::with(['user', 'category'])->findOrFail($slugOrId);
        }

        $post->increment('views_count'); // افزایش تعداد بازدید
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'شما مجاز به ویرایش این پست نیستید.');
        }
        $categories = CategoryHelper::getAllWithCount() ?? Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'شما مجاز به ویرایش این پست نیستید.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string',
            'slug' => 'nullable|string|unique:posts,slug,' . $id,
            'featured_image' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ], [
            'title.required' => 'عنوان الزامی است',
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد',
            'content.required' => 'محتوا الزامی است',
            'category_id.required' => 'انتخاب دسته‌بندی الزامی است',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست',
            'slug.unique' => 'اسلاگ وارد شده قبلاً استفاده شده است',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'excerpt' => $request->excerpt,
            'slug' => $request->slug ?? \Str::slug($request->title),
            'featured_image' => $request->featured_image,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('posts.show', $post->id)->with('success', 'پست با موفقیت ویرایش شد!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'شما مجاز به حذف این پست نیستید.');
        }
        $post->delete();
        Cache::forget('home_page_data');
        return redirect()->route('posts.index')->with('success', 'پست با موفقیت حذف شد!');
    }
}
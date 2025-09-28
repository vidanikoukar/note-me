<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Modules\Category\app\Models\Category;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'allPosts']);
    }

    private function getPostsQuery(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_id');

        return Post::with(['user', 'categories'])
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('categories', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($categoryFilter, function ($query, $categoryFilter) {
                return $query->whereHas('categories', fn($q) => $q->where('id', $categoryFilter));
            });
    }

    public function allPosts(Request $request)
    {
        $posts = $this->getPostsQuery($request)
            ->whereIn('status', ['published', 'active'])
            ->latest()
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function index(Request $request)
    {
        $posts = $this->getPostsQuery($request)
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function published(Request $request)
    {
        $posts = $this->getPostsQuery($request)
            ->where('user_id', Auth::id())
            ->where('published', true)
            ->latest()
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function views(Request $request)
    {
        $posts = $this->getPostsQuery($request)
            ->where('user_id', Auth::id())
            ->orderBy('views_count', 'desc')
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function likes(Request $request)
    {
        $posts = $this->getPostsQuery($request)
            ->where('user_id', Auth::id())
            ->orderBy('likes_count', 'desc')
            ->paginate(9);

        $categories = CategoryHelper::getAllWithCount() ?? Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function all(Request $request)
    {
        $posts = $this->getPostsQuery($request)
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
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ], [
            'title.required' => 'عنوان الزامی است',
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد',
            'content.required' => 'محتوا الزامی است',
            'category_ids.required' => 'انتخاب حداقل یک دسته‌بندی الزامی است',
            'category_ids.array' => 'فرمت دسته‌بندی‌ها نامعتبر است',
            'category_ids.*.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست',
            'featured_image.image' => 'فایل انتخاب شده باید تصویر باشد.',
            'featured_image.mimes' => 'فرمت تصویر معتبر نیست.',
            'featured_image.max' => 'حجم تصویر نباید بیشتر از 2 مگابایت باشد.',
            'slug.unique' => 'اسلاگ وارد شده قبلاً استفاده شده است',
        ]);

        $slug = $this->generateUniqueSlug($request->title, $request->content);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('post_images', 'public');
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'slug' => $slug,
            'published' => true,
            'published_at' => now(),
            'featured_image' => $imagePath,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'views_count' => 0,
            'likes_count' => 0,
        ]);

        $post->categories()->attach($request->category_ids);

        Cache::forget('home_page_data');

        return redirect()->route('posts.index')->with('success', 'نوشته با موفقیت اضافه شد!');
    }

    private function generateUniqueSlug($title, $content)
    {
        if (!empty($title)) {
            $slug = \Str::slug($title);
        } else {
            $slug = \Str::slug(\Str::limit($content, 50, ''), '-') ?: 'post-' . time();
        }

        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        return $slug;
    }

    public function show($slugOrId)
    {
        $post = Post::with(['user', 'categories'])->where('slug', $slugOrId)->first();

        if (!$post) {
            $post = Post::with(['user', 'categories'])->findOrFail($slugOrId);
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
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ], [
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد',
            'content.required' => 'محتوا الزامی است',
            'category_ids.required' => 'انتخاب حداقل یک دسته‌بندی الزامی است',
            'category_ids.array' => 'فرمت دسته‌بندی‌ها نامعتبر است',
            'category_ids.*.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست',
            'featured_image.image' => 'فایل انتخاب شده باید تصویر باشد.',
            'featured_image.mimes' => 'فرمت تصویر معتبر نیست.',
            'featured_image.max' => 'حجم تصویر نباید بیشتر از 2 مگابایت باشد.',
        ]);

        // Generate a new slug only if the title has changed
        $slug = $post->slug;
        if ($request->title !== $post->title) {
            $slug = $this->generateUniqueSlug($request->title, $request->content);
        }

        $data = $request->only(['title', 'content', 'excerpt', 'meta_title', 'meta_description']);
        $data['slug'] = $slug;

        if ($request->hasFile('featured_image')) {
            // Delete old image if it exists
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('post_images', 'public');
        }

        $post->update($data);
        $post->categories()->sync($request->category_ids);

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
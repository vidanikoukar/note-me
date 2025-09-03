<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Helpers\CategoryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // فقط کاربران لاگین‌شده
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_id');

        $posts = Post::with(['user', 'category'])
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
        ], [
            'title.required' => 'عنوان الزامی است',
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد',
            'content.required' => 'محتوا الزامی است',
            'category_id.required' => 'انتخاب دسته‌بندی الزامی است',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'published' => true,
        ]);

        return redirect()->route('posts.index')->with('success', 'نوشته با موفقیت اضافه شد!');
    }

    public function show($id)
    {
        $post = Post::with(['user', 'category'])->findOrFail($id);
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
        ], [
            'title.required' => 'عنوان الزامی است',
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد',
            'content.required' => 'محتوا الزامی است',
            'category_id.required' => 'انتخاب دسته‌بندی الزامی است',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'پست با موفقیت ویرایش شد!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'شما مجاز به حذف این پست نیستید.');
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'پست با موفقیت حذف شد!');
    }
}
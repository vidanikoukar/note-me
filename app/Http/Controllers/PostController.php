<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // فقط کاربران لاگین‌شده
    }

    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(9); // 9 پست در هر صفحه
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ], [
            'title.required' => 'عنوان الزامی است',
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد',
            'content.required' => 'محتوا الزامی است',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'published' => true, // به‌طور پیش‌فرض منتشرشده
        ]);

        return redirect()->route('posts.index')->with('success', 'نوشته با موفقیت اضافه شد!');
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'شما مجاز به ویرایش این پست نیستید.');
        }
        return view('posts.edit', compact('post'));
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
        ], [
            'title.required' => 'عنوان الزامی است',
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد',
            'content.required' => 'محتوا الزامی است',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
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
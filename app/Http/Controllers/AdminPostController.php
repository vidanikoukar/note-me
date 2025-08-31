<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission:manage-content']);
    }

    public function index()
    {
        $posts = Post::with('user')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,png|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        $data = $request->only('title', 'content', 'excerpt', 'meta_title', 'meta_description', 'status');
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($request->title);
        $data['published'] = $request->status === 'published';
        $data['published_at'] = $request->status === 'published' ? now() : null;
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'پست اضافه شد.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,png|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        $data = $request->only('title', 'content', 'excerpt', 'meta_title', 'meta_description', 'status');
        $data['slug'] = Str::slug($request->title);
        $data['published'] = $request->status === 'published';
        $data['published_at'] = $request->status === 'published' ? now() : null;
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'پست ویرایش شد.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'پست حذف شد.');
    }

    public function preview(Post $post)
    {
        $this->middleware('permission:preview-content');
        return view('admin.posts.preview', compact('post'));
    }
}
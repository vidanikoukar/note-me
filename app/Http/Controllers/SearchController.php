<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // فرض می‌کنیم مدل Post برای محتواها وجود دارد

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');
        $results = Post::where('title', 'like', "%$query%")
                       ->orWhere('category', 'like', "%$query%")
                       ->get();
        return view('search', compact('results', 'query'));
    }

    public function suggestions(Request $request)
    {
        $query = $request->query('q');
        $results = Post::where('title', 'like', "%$query%")
                       ->orWhere('category', 'like', "%$query%")
                       ->take(10)
                       ->get()
                       ->map(function ($post) {
                           return [
                               'title' => $post->title,
                               'url' => route('posts.show', $post->slug),
                               'category' => $post->category,
                               'icon' => $this->getCategoryIcon($post->category)
                           ];
                       });
        return response()->json($results);
    }

    private function getCategoryIcon($category)
    {
        return match ($category) {
            'شعر' => 'fa-book-open',
            'دلنوشته' => 'fa-pen-nib',
            'کتاب' => 'fa-book',
            'فیلم' => 'fa-film',
            'هنرمندان' => 'fa-user',
            default => 'fa-search',
        };
    }
}
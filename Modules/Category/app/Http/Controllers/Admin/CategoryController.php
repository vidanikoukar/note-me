<?php

namespace Modules\Category\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Category\app\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('category::admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('category::admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|string|max:255',
            'description' => 'nullable|string|max:500',
        ], [
            'name.required' => 'نام دسته‌بندی الزامی است.',
            'name.unique' => 'این نام دسته‌بندی قبلاً استفاده شده است.',
            'name.max' => 'نام دسته‌بندی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'description.max' => 'توضیحات نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'دسته‌بندی با موفقیت ایجاد شد.');
    }

    public function show(Category $category)
    {
        return view('category::admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('category::admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
        ], [
            'name.required' => 'نام دسته‌بندی الزامی است.',
            'name.unique' => 'این نام دسته‌بندی قبلاً استفاده شده است.',
            'name.max' => 'نام دسته‌بندی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'description.max' => 'توضیحات نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'دسته‌بندی با موفقیت بروزرسانی شد.');
    }

    public function destroy(Category $category)
    {
        // Add a check for associated posts before deletion
        if ($category->posts()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'نمی‌توان دسته‌بندی را حذف کرد زیرا دارای پست‌های مرتبط است.');
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }
}
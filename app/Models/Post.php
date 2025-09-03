<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',        // اضافه کردن user_id
        'category_id',    // برای پشتیبانی از دسته‌بندی‌ها
        'title',
        'content',
        'excerpt',
        'slug',
        'published',
        'published_at',
        'featured_image',
        'meta_title',
        'meta_description',
        'status',
        'views_count',
        'likes_count',
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
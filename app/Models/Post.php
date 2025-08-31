<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // تغییر از 'articles' به 'posts'
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
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
}
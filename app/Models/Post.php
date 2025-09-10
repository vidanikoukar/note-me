<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'published'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(function (string $eventName) {
                $verb = match ($eventName) {
                    'created' => 'ایجاد کرد',
                    'updated' => 'بروزرسانی کرد',
                    'deleted' => 'حذف کرد',
                    default => $eventName,
                };
                return "پست \"{$this->title}\" را {$verb}";
            });
    }

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'category_id',
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
        'views_count' => 'integer',
        'likes_count' => 'integer',
    ];

    protected $attributes = [
        'views_count' => 0,
        'likes_count' => 0,
        'published' => true,
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

    // متد کمکی برای افزایش بازدید
    public function incrementViews()
    {
        $this->increment('views_count');
        return $this;
    }

    // متد کمکی برای افزایش لایک
    public function incrementLikes()
    {
        $this->increment('likes_count');
        return $this;
    }
}
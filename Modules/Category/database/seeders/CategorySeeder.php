<?php

namespace Modules\Category\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Category\app\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'دلنوشته', 'description' => 'احساسات درونی که به کلمات تبدیل شده‌اند'],
            ['name' => 'کتاب', 'description' => 'مجموعه‌ای از بهترین آثار ادبی و داستان‌ها'],
            ['name' => 'شعر', 'description' => 'زیباترین اشعار و غزلیات'],
            ['name' => 'فیلم', 'description' => 'مجموعه‌ای از بهترین آثار سینمایی و ویدیوها'],
            ['name' => 'حرف حق', 'description' => 'مجموعه‌ای از سخنان حکیمانه و پندآموز'],
            ['name' => 'انگیزشی', 'description' => 'مطالبی برای افزایش انگیزه و امید به آینده'],
            ['name' => 'عمومی', 'description' => 'دسته‌بندی پیش‌فرض برای مطالب عمومی'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                [
                    'slug' => Str::slug($category['name']),
                    'description' => $category['description'],
                ]
            );
        }
    }
}
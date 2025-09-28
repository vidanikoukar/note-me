<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\app\Http\Controllers\Admin\CategoryController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::resource('categories', CategoryController::class)->except(['show']);
});
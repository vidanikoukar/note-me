<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\app\Http\Controllers\Api\CategoryController;

Route::get('/categories', [CategoryController::class, 'index']);
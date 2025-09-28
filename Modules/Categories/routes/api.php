<?php

use Illuminate\Support\Facades\Route;
use Modules\Categories\Http\Controllers\CategoriesController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('categories', CategoriesController::class)->names('categories');
});

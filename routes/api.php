<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/loan', [BookController::class, 'store']);
    Route::post('/returns/{load_id}', [BookController::class, 'store']);
});

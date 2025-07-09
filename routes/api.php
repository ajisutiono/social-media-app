<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    // handle register
    Route::post('register', [JWTAuthController::class, 'register']);

    // handle posts
    Route::prefix('post')->group(function (){
        Route::get('/', [PostsController::class, 'index']); // mengambil seluruh data post
        Route::post('/', [PostsController::class, 'store']); // menambah data post
        Route::get('{id}', [PostsController::class, 'show']); // mengambil data post sesuai id
        Route::put('{id}', [PostsController::class, 'update']); // mengubah data post
        Route::delete('{id}', [PostsController::class, 'destroy']); // menghapus data post
    });

    // handle comments
    Route::prefix('comment')->group(function () {
        Route::post('/', [CommentsController::class, 'store']);
        Route::delete('{id}', [CommentsController::class, 'destroy']);
    });

    // handle likes
    Route::prefix('like')->group(function () {
        Route::post('/', [LikesController::class, 'store']);
        Route::delete('{id}', [LikesController::class, 'destroy']);
    });

    // handle messages
    Route::prefix('message')->group(function () {
        Route::post('/', [MessagesController::class, 'store']);
        Route::get('{id}', [MessagesController::class, 'getMessage']);
        Route::get('/getMessages/{user_id}', [MessagesController::class, 'getAllMessages']);
        Route::delete('{id}', [MessagesController::class, 'destroy']);
    });
});
<?php
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('/posts/{post}/comments', [PostController::class, 'addComment'])->name('posts.comments.store');


Route::get('/invoice', function () {
    return view('invoice');
});

Route::post('/invoice', [InvoiceController::class, 'store'])->name('invoice.store');

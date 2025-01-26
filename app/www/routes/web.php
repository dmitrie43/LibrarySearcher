<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('/');
/* Books */
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/random', [BookController::class, 'random'])->name('books.random');
Route::get('/books/{book}', [BookController::class, 'detail'])->name('books.detail');
/* Search */
Route::get('/search', [SearchController::class, 'index'])->name('search');
/* Comments */
Route::get('/comments/books/{book}', [BookController::class, 'reviews'])->name('comments.books.index');
Route::post('/comments/{type}', [CommentController::class, 'setReview'])->name('comments.set_review');

Route::middleware(['auth'])->group(function () {
    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

require __DIR__.'/auth.php';

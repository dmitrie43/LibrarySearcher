<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', [DashboardController::class, 'index'])->name('admin_panel.dashboard');
// users
Route::resource('/users', UserController::class)
    ->except(['show'])
    ->names('admin_panel.users');
// authors
Route::resource('/authors', AuthorController::class)
    ->except(['show'])
    ->names('admin_panel.authors');
// genres
Route::resource('/genres', GenreController::class)
    ->except(['show'])
    ->names('admin_panel.genres');
// publishers
Route::resource('/publishers', PublisherController::class)
    ->except(['show'])
    ->names('admin_panel.publishers');
// books
Route::resource('/books', BookController::class)
    ->except(['show'])
    ->names('admin_panel.books');
// comments
Route::resource('/comments', CommentController::class)
    ->except(['show', 'create', 'store', 'edit', 'update'])
    ->names('admin_panel.comments');
Route::get('/comments/approve/{comment}', [CommentController::class, 'approve'])
    ->name('admin_panel.comments.approve');
Route::get('/comments/disapprove/{comment}', [CommentController::class, 'disapprove'])
    ->name('admin_panel.comments.disapprove');

require __DIR__.'/auth.php';

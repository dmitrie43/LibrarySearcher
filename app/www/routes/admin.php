<?php

use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\GenresController;
use App\Http\Controllers\Admin\PublishersController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AuthorsController;
use App\Http\Controllers\Admin\DashboardController;
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
//users
Route::resource('/users', UsersController::class)
    ->except(['show'])
    ->names('admin_panel.users');
//authors
Route::resource('/authors', AuthorsController::class)
    ->except(['show'])
    ->names('admin_panel.authors');
//genres
Route::resource('/genres', GenresController::class)
    ->except(['show'])
    ->names('admin_panel.genres');
//publishers
Route::resource('/publishers', PublishersController::class)
    ->except(['show'])
    ->names('admin_panel.publishers');
//books
Route::resource('/books', BooksController::class)
    ->except(['show'])
    ->names('admin_panel.books');
//comments
Route::resource('/comments', CommentsController::class)
    ->except(['show', 'create', 'store', 'edit', 'update'])
    ->names('admin_panel.comments');
Route::get('/comments/approve/{id}', [CommentsController::class, 'approve'])
    ->name('admin_panel.comments.approve');
Route::get('/comments/disapprove/{id}', [CommentsController::class, 'disapprove'])
    ->name('admin_panel.comments.disapprove');

require __DIR__.'/auth.php';

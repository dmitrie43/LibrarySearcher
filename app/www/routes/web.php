<?php

use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\GenresController;
use App\Http\Controllers\Admin\PublishersController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AuthorsController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [IndexController::class, 'index'])->name('/');
Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::middleware(['auth'])->group(function () {
    //Профиль
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::middleware(['admin'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin_panel.dashboard');
    //users
    Route::get('/users', [UsersController::class, 'index'])->name('admin_panel.users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('admin_panel.users.create');
    Route::post('/users/store', [UsersController::class, 'store'])->name('admin_panel.users.store');
    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('admin_panel.users.edit');
    Route::put('/users/update/{id}', [UsersController::class, 'update'])->name('admin_panel.users.update');
    Route::delete('/users/destroy/{id}', [UsersController::class, 'destroy'])->name('admin_panel.users.destroy');
    //authors
    Route::get('/authors', [AuthorsController::class, 'index'])->name('admin_panel.authors.index');
    Route::get('/authors/create', [AuthorsController::class, 'create'])->name('admin_panel.authors.create');
    Route::post('/authors/store', [AuthorsController::class, 'store'])->name('admin_panel.authors.store');
    Route::get('/authors/edit/{id}', [AuthorsController::class, 'edit'])->name('admin_panel.authors.edit');
    Route::put('/authors/update/{id}', [AuthorsController::class, 'update'])->name('admin_panel.authors.update');
    Route::delete('/authors/destroy/{id}', [AuthorsController::class, 'destroy'])->name('admin_panel.authors.destroy');
    //genres
    Route::get('/genres', [GenresController::class, 'index'])->name('admin_panel.genres.index');
    Route::get('/genres/create', [GenresController::class, 'create'])->name('admin_panel.genres.create');
    Route::post('/genres/store', [GenresController::class, 'store'])->name('admin_panel.genres.store');
    Route::get('/genres/edit/{id}', [GenresController::class, 'edit'])->name('admin_panel.genres.edit');
    Route::put('/genres/update/{id}', [GenresController::class, 'update'])->name('admin_panel.genres.update');
    Route::delete('/genres/destroy/{id}', [GenresController::class, 'destroy'])->name('admin_panel.genres.destroy');
    //publishers
    Route::get('/publishers', [PublishersController::class, 'index'])->name('admin_panel.publishers.index');
    Route::get('/publishers/create', [PublishersController::class, 'create'])->name('admin_panel.publishers.create');
    Route::post('/publishers/store', [PublishersController::class, 'store'])->name('admin_panel.publishers.store');
    Route::get('/publishers/edit/{id}', [PublishersController::class, 'edit'])->name('admin_panel.publishers.edit');
    Route::put('/publishers/update/{id}', [PublishersController::class, 'update'])->name('admin_panel.publishers.update');
    Route::delete('/publishers/destroy/{id}', [PublishersController::class, 'destroy'])->name('admin_panel.publishers.destroy');
    //books
    Route::get('/books', [BooksController::class, 'index'])->name('admin_panel.books.index');
    Route::get('/books/create', [BooksController::class, 'create'])->name('admin_panel.books.create');
    Route::post('/books/store', [BooksController::class, 'store'])->name('admin_panel.books.store');
    Route::get('/books/edit/{id}', [BooksController::class, 'edit'])->name('admin_panel.books.edit');
    Route::put('/books/update/{id}', [BooksController::class, 'update'])->name('admin_panel.books.update');
    Route::delete('/books/destroy/{id}', [BooksController::class, 'destroy'])->name('admin_panel.books.destroy');
});

require __DIR__.'/auth.php';

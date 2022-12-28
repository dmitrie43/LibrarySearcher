<?php

use App\Http\Controllers\Admin\UsersController;
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

Route::get('/', [IndexController::class, 'index']);

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
});

require __DIR__.'/auth.php';

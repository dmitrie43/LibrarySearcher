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
    Route::get('/users', [UsersController::class, 'index'])->name('admin_panel.users.index');
});

require __DIR__.'/auth.php';

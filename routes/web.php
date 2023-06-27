<?php

use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\GuestHomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [GuestHomeController::class, 'home'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::resource('restaurants', RestaurantController::class)->parameters(['restaurants' => 'restaurant:slug']);

    Route::resource('dishes', DishController::class)->parameters(['dishes' => 'dish:slug']);

    Route::resource('types', TypeController::class);

    Route::resource('orders', OrderController::class)->parameters(['orders' => 'order:id']);

    Route::get('stats', [StatController::class, 'index'])->name('stats');

    Route::get('/401', [HomeController::class, 'notFound'])->name('notFound');
});


require __DIR__ . '/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\IndexControllers;

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


Route::get('/', [AuthController::class, 'index']);
Route::get('/registration', function () {
return view('auth.register');
});

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/favorite',[FavoriteController::class, 'index'])->name('favorite.index');
Route::get('/store_detail',[ShopController::class, 'show']);
Route::Post('/reservation',[ReservationController::class, 'store'])->name('reservation.store');
Route::view('/booking_is_done', 'booking_is_done')->name('booking_is_done');
Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/{favorite}',[FavoriteController::class, 'destroy'])->name('favorites.destroy');
Route::post('/stores',[ShopController::class,'store'])->name('stores.store');
Route::delete('/stores/{store}',[ShopController::class, 'destroy'])->name('stores.destroy');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\IndexControllers;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\StoreDetailController;

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
Route::get('/store_detail/{id}',[StoreController::class, 'show'])->name('store.detail');
Route::Post('/reservation',[ReservationController::class, 'store'])->name('reservation.store');
Route::view('/booking_is_done', 'booking_is_done')->name('booking_is_done');
Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/{favorite}',[FavoriteController::class, 'destroy'])->name('favorites.destroy');
Route::post('/stores',[StoreController::class,'store'])->name('stores.store');
Route::delete('/stores/{store}',[StoreController::class, 'destroy'])->name('stores.destroy');
Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
Route::get('/stores', [ShopController::class, 'index'])->name('shops.index');
Route::get('/areas/{area}', [StoreController::class, 'storesByArea'])->name('stores.by_area');
Route::get('/areas',[AreaController::class, 'index'])->name('areas.index');
Route::get('/',[StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/search', [StoreController::class, 'search'])->name('store.search');
Route::get('/login',[AuthenticatedSessionController::class,'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::get('/store_detail', [StoreDetailController::class, 'index']);
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

Route::get('/', [AuthController::class, 'index']);
Route::get('/registration', function () {
    return view('auth.register');
});
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
Route::post('/toggle-favorite/{storeId}', [FavoriteController::class, 'toggleFavorite'])->middleware('auth');
Route::post('/stores', [StoreController::class, 'store'])->name('stores.store');
Route::delete('/stores/{store}', [StoreController::class, 'destroy'])->name('stores.destroy');
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/areas/{area}', [StoreController::class, 'storesByArea'])->name('stores.by_area');
Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::get('/store_detail/{id}', [StoreDetailController::class, 'show'])->name('store.detail');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

Route::middleware(['web'])->group(function(){
    Route::view('/booking_is_done', 'booking_is_done')->name('booking_is_done');
});
Route::get('/stores/search', [StoreController::class, 'search'])->name('store.search');
Route::middleware(['auth'])->group(function() {
    Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
}); 
Route::delete('/reservations/{id}', 'ReservationController@destroy')->name('reservations.destroy');
Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
Route::get('reservations/{reservation}/edit', 'App\Http\Controllers\ReservationController@edit')->name('reservations.edit');
Route::put('reservations/{reservation}',[ReservationController::class, 'update'])->name('reservations.update');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('reservations/{reservation}/evaluate', [ReservationController::class, 'evaluateForm'])->name('reservations.evaluateForm');
Route::post('reservations/{reservation}/evaluate', [ReservationController::class, 'evaluate'])->name('reservations.evaluate');
Route::get('/evaluation/complete', function (){
    return view('evaluation_complete');
})->name('evaluation_complete');
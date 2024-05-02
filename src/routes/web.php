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
use App\Http\Controllers\Auth\AuthRepresentativeLoginController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Auth\ManagerLoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerDashboardController;


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

Route::post('/reservations/{reservation}/evaluate', [ReservationController::class, 'evaluate'])->name('reservations.evaluate');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::post('/reservation/{reservation}/evaluate', [ReservationController::class, 'evaluate'])->name('reservation.evaluate');
Route::get('/evaluation/complete', function () {
    return view('evaluation_complete');
})->name('evaluation_complete');
Route::get('/representative/login', [AuthRepresentativeLoginController::class, 'showLoginForm'])->name('representative.login');
Route::post('/representative/login', [AuthRepresentativeLoginController::class, 'login']);
Route::middleware(['auth', 'representative'])->group(function(){
    Route::get('/stores/create', [StoreController::class, 'create'])->name('stores.create');
    Route::post('/stores',[StoreController::class, 'store'])->name('stores.store');
    Route::get('/stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
    Route::put('/stores/{store}', [StoreController::class, 'update'])->name('stores.update');
});

Route::middleware(['auth', 'editor'])->group(function () {
    Route::get('/stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
    Route::put('/stores/{store}', [StoreController::class, 'update'])->name('stores.update');
});
Route::get('/edit_main', [EditController::class, 'showEditMain'])->name('edit_main');
Route::get('/stores/create', [StoreController::class, 'create'])->name('store.create');
Route::get('/store/{store}/edit', [StoreController::class, 'edit'])->name('store.edit');
Route::get('/update_complete', function () {
    return view('store.update_complete');
})->name('update.complete');
Route::get('/update_complete', [StoreController::class, 'updateComplete'])->name('update.complete');
Route::post('/store-image', [ImageController::class, 'store']);
Route::get('/store/{storeId}/image-url', [StoreController::class, 'getImageUrl']);
Route::post('/stores', 'StoreController@store')->name('stores.store');
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
Route::get('/upload', [UploadController::class, 'showUploadForm'])->name('upload.form');
Route::get('manager/login', [ManagerLoginController::class, 'showLoginForm'])->name('manager.login');
Route::post('manager/login', [ManagerLoginController::class, 'login']);

Route::prefix('manager')->group(function () {
    // 新規データ作成のルート
    Route::post('/create', [ManagerController::class, 'create'])->name('manager.create');

    // データ変更のルート
    Route::post('/update/{id}', [ManagerController::class, 'update'])->name('manager.update');

    // データ削除のルート
    Route::delete('/delete/{id}', [ManagerController::class, 'delete'])->name('manager.delete');
    Route::get('/managers', [ManagerController::class, 'index'])->name('managers.index');
});
Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
Route::get('/manager/dashboard', [RepresentativeController::class, 'dashboard'])->name('manager.dashboard');
Route::get('/representatives/create', [RepresentativeController::class, 'create'])->name('representatives.create');
Route::post('/representatives', [RepresentativeController::class, 'store'])->name('representatives.store');
Route::get('/representatives', [RepresentativeController::class, 'index'])->name('representatives.index');




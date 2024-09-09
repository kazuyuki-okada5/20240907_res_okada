<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\StoreDetailController;
use App\Http\Controllers\Auth\AuthRepresentativeLoginController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ImageController;
// use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StoreCsvController;

Route::get('/', [StoreController::class, 'index'])->name('index');

// 認証関連
Route::get('/registration', function () {
    return view('auth.register');
});
Route::post('/register', [RegisteredUserController::class, 'store']);
// Route::get('/representative/login', [AuthRepresentativeLoginController::class, 'showLoginForm'])->name('representative.login');
// Route::post('/representative/login', [AuthRepresentativeLoginController::class, 'login']);


// お気に入り関連(済)
Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
Route::post('/toggle-favorite/{storeId}', [FavoriteController::class, 'toggleFavorite'])->middleware('auth');
Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
Route::middleware(['auth'])->group(function() {
    Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
}); 

// 店舗関連
Route::post('/stores', [StoreController::class, 'store'])->name('stores.store');
Route::delete('/stores/{store}', [StoreController::class, 'destroy'])->name('stores.destroy');
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/areas/{area}', [StoreController::class, 'storesByArea'])->name('stores.by_area');
Route::get('/store_detail/{id}', [StoreController::class, 'show'])->name('store.detail');
Route::get('/stores/search', [StoreController::class, 'search'])->name('store.search');
Route::get('/store/{storeId}/image-url', [StoreController::class, 'getImageUrl']);
Route::post('/stores', [StoreController::class, 'store'])->name('stores.store');
Route::middleware(['auth', 'representative'])->group(function () {
    Route::get('/representative/home', [StoreController::class, 'representativeHome'])->name('representative.home');
});
Route::get('/stores/{storeId}/edit', [StoreController::class, 'edit'])->name('stores.edit');
Route::get('/stores/create', [StoreController::class, 'create'])->name('store.create');
Route::get('/store/{store}/edit', [StoreController::class, 'edit'])->name('store.edit');
Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');

// 予約関連
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('reservations/{reservation}/edit', 'App\Http\Controllers\ReservationController@edit')->name('reservations.edit');
Route::put('reservations/{reservation}',[ReservationController::class, 'update'])->name('reservations.update');
Route::get('reservations/{reservation}/evaluate', [ReservationController::class, 'evaluateForm'])->name('reservations.evaluateForm');
Route::post('/reservations/{reservation}/evaluate', [ReservationController::class, 'evaluate'])->name('reservations.evaluate');

Route::get('/evaluation/complete', function () {
    return view('evaluation_complete');
})->name('evaluation_complete');
Route::get('/booking_is_done', function () {
    return view('booking_is_done');
})->name('booking_is_done'); 

// 管理者用ルート
Route::middleware(['auth', 'manager'])->group(function () {
    // このグループ内のすべてのルートにauthとmanagerミドルウェアが適用されます
    Route::get('/manager/home', 'ManagerController@index')->name('manager.home');
});
Route::get('/manager/home', [ManagerController::class, 'index']);

// 管理者用専用ページ
Route::post('/stores/attach-representative', [StoreController::class, 'attachRepresentative'])->name('stores.attachRepresentative');
Route::post('/send-notification', [NotificationController::class, 'sendNotificationToAllUsers'])->name('send.notification');
Route::get('/notice/create', function () {
    return view('manager.notification');
})->name('notice.create');

// 代表者のみがアクセス可能なルート
Route::middleware(['auth', 'representative'])->group(function(){
    Route::get('/stores/create', [StoreController::class, 'create'])->name('stores.create');
    Route::post('/stores',[StoreController::class, 'store'])->name('stores.store');
    Route::get('/stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
    Route::put('/stores/{store}', [StoreController::class, 'update'])->name('stores.update');
});

// 代表者で店舗編集権限がある者のみがアクセス可能なルート
Route::middleware(['auth', 'editor'])->group(function () {
    Route::get('/stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
    Route::put('/stores/{store}', [StoreController::class, 'update'])->name('stores.update');
});

//代表者用ページ
Route::post('/representatives', [RepresentativeController::class, 'store'])->name('representatives.store');
Route::get('/representative/home', [StoreController::class, 'representativeHome'])->name('representative.home');

// ログアウト
Route::post('/store', function () {
    auth()->logout();
    return redirect('/stores');
})->name('logout');

// 画像関連のルート
Route::post('/store-image', [ImageController::class, 'store']);
Route::get('/store/{storeId}/image-url', [StoreController::class, 'getImageUrl']);
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
Route::get('/upload', [UploadController::class, 'showUploadForm'])->name('upload.form');
Route::resource('upload',ImageController::class);
Route::post('/upload-image', [ImageController::class, 'store'])->name('upload.image');
Route::get('/stores/{id}/edit', [ImageController::class, 'edit'])->name('stores.edit');
Route::post('/upload-image', [ImageController::class, 'uploadImage'])->name('upload.image');
Route::post('/update-image/{id}', [ImageController::class, 'updateImage'])->name('update.image');
Route::delete('/delete-image/{id}', [ImageController::class, 'deleteImage'])->name('delete.image');

// その他のルート
Route::get('/home', function () {
})->name('home');
Route::get('/reservations/{reservation}', 'App\Http\Controllers\ReservationController@show')->name('reservations.show');
Route::post('/representatives', [RepresentativeController::class, 'store'])->name('representatives.store');

Route::get('/manager/home', [ManagerController::class, 'home'])->name('manager.home');
Route::get('/edit_main', [EditController::class, 'showEditMain'])->name('edit_main');

Route::get('/update_complete', function () {
    return view('store.update_complete');
})->name('update.complete');

// Pro用追加実装分
// 特定の店舗 ({id}) に関連するレビューの一覧を表示
Route::get('/store/{id}/reviews', [ReviewController::class, 'review_index'])->name('review_list');
Route::get('/store_reviews_list/{id}', [ReviewController::class, 'review_index'])->name('store.reviews_list');
// 特定の店舗 ({store}) に新しいレビューを追加
Route::post('stores/{store}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
//  特定の店舗 ({storeId}) に関連するレビューの一覧を表示
Route::get('/store_reviews/{storeId}', [ReviewController::class, 'reviewPage'])->name('store_reviews.show');
// 特定のレビュー ({id}) の編集フォームを表示
Route::get('reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
// 特定のレビュー ({id}) を更新
Route::put('reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
// 特定のレビュー ({review}) を削除
Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
// CSVファイルから店舗データをインポート
Route::post('/stores/import', [StoreCsvController::class, 'import'])->name('stores.import');
<?php

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Api\ApiMomo;
use App\Http\Controllers\Api\ApiVNPay;
use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test-start', function () {
    return view('Layout.layout');
});

Route::prefix('admin')->middleware('auth', 'CheckAdmin')->group(function () {
    // DANH MỤC SÁCH
    Route::prefix('category')->group(function () {
        Route::get('/', App\Livewire\Category\Index::class)->name('category.index');
        Route::get('/create-category', App\Livewire\Category\Create::class)->name('category.create');
        Route::get('/edit-category/{id}', App\Livewire\Category\Edit::class)->name('category.edit');
        Route::get('/show-category/{id}', App\Livewire\Category\Show::class)->name('category.show');
    });
    //  SÁCH
    Route::prefix('book')->group(function () {
        Route::get('/', App\Livewire\Product\Index::class)->name('product.index');
        Route::get('/create-product', App\Livewire\Product\Create::class)->name('product.create');
        Route::get('/show-product/{id}', App\Livewire\Product\Show::class)->name('product.show');
        Route::get('/edit-product/{id}', App\Livewire\Product\Edit::class)->name('product.edit');
    });
    // DANH MỤC BÀI ĐĂNG
    Route::prefix('category-post')->controller(CategoryPostController::class)->group(function () {
        Route::get('/', 'index')->name('admin.category-post.index');
        Route::post('/', 'index')->name('admin.category-post.search');
        Route::get('show/{id}', 'show')->name('admin.category-post.show');
        Route::get('create', 'create')->name('admin.category-post.create');
        Route::post('store', 'store')->name('admin.category-post.store');
        Route::get('edit/{id}', 'edit')->name('admin.category-post.edit');
        Route::post('update/{id}', 'update')->name('admin.category-post.update');
        Route::get('delete/{id}', 'delete')->name('admin.category-post.delete');
    });
    // BÀI ĐĂNG
    Route::prefix('post')->controller(PostController::class)->group(function () {
        Route::get('/', 'index')->name('admin.post.index');
        Route::get('/show/{id}', 'show')->name('admin.post.show');
        Route::get('/create', 'create')->name('admin.post.create');
        Route::post('/store', 'store')->name('admin.post.store');
        Route::get('/edit/{id}', 'edit')->name('admin.post.edit');
        Route::post('/update/{id}', 'edit')->name('admin.post.update');
    });
    // COUPON
    Route::prefix('coupon')->controller(CouponController::class)->group(function () {
        Route::get('/', 'index')->name('admin.coupon.index');
        Route::get('/show/{id}', 'show')->name('admin.coupon.show');
        Route::get('/create', 'create')->name('admin.coupon.create');
        Route::post('/store', 'store')->name('admin.coupon.store');
        Route::get('/edit/{id}', 'edit')->name('admin.coupon.edit');
        Route::post('/update/{id}', 'update')->name('admin.coupon.update');
        Route::get('/destroy/{id}', 'destroy')->name('admin.coupon.destroy');
    });
    // NGƯỜI DÙNG
    Route::prefix('user')->controller(UsersController::class)->group(function () {
        Route::get('/', 'index')->name('admin.user.index');
        Route::post('/', 'index')->name('admin.user.search');
        Route::get('/delete/{id}', 'delete')->name('admin.user.delete');
        Route::get('/edit/{id}', 'edit')->name('admin.user.edit');
        Route::post('/update/{id}', 'update')->name('admin.user.update');
        Route::get('/show/{id}', 'show')->name('admin.user.show');
    });
});
Route::post('/upload', [BaseController::class, 'upload'])->name('ckeditor.upload');
Route::prefix('auth')->controller(AuthController::class)->middleware('CheckLogin')->group(function () {
    Route::get('/login', 'loginPage')->name('login');
    Route::post('/login-process', 'loginProcess')->name('auth.loginProcess');
    Route::get('/register', 'registerPage')->name('auth.register');
    Route::post('/register-process', 'registerProcess')->name('auth.registerProcess');
    Route::get('/logout', 'logOut')->name('auth.logout');
});
Route::prefix('/')->controller(ClientController::class)->group(function () {
    Route::get('/', 'index')->name('client.home');
});
Route::get('/vnpay-response', [ApiVNPay::class, 'returnCallBack'])->name('response.vnpay');
Route::get('/momo-response', [ApiMomo::class, 'fallBack'])->name('response.momopay');

<?php

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiMomo;
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
Route::get('/coupon', function () {
    return view('Mail.couponGive');
});
Route::prefix('admin')->middleware('CheckAdmin')->group(function () {
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
    // NHÀ CUNG CẤP
    Route::prefix('suppliers')->group(function () {
        Route::get('/', App\Livewire\Suppliers\Index::class)->name('suppliers.index');
        Route::get('/create-suppliers', App\Livewire\Suppliers\Create::class)->name('suppliers.create');
        Route::get('/edit-suppliers/{id}', App\Livewire\Suppliers\Edit::class)->name('suppliers.edit');
    });
    // KHO HÀNG
    Route::prefix('warehouse')->group(function () {
        Route::get('/', App\Livewire\Warehouse\Index::class)->name('warehouse.index');
        Route::get('/show-warehouse/{id}', App\Livewire\Warehouse\Show::class)->name('warehouse.show');
        Route::get('/create-warehouse', App\Livewire\Warehouse\Create::class)->name('warehouse.create');
        Route::get('/edit-warehouse/{id}', App\Livewire\Warehouse\Edit::class)->name('warehouse.edit');
    });
    // NHẬP HÀNG
    Route::prefix('product-movement')->group(function () {
        Route::get('/', App\Livewire\ProductMovement\Index::class)->name('product-movement.index');
        Route::get('/show-product-movement\{id}', App\Livewire\ProductMovement\Show::class)->name('product-movement.show');
        Route::get('/create-product-movement', App\Livewire\ProductMovement\Create::class)->name('product-movement.create');
        Route::get('/edit-product-movement/{id}', App\Livewire\ProductMovement\Edit::class)->name('product-movement.edit');
    });
    // DANH MỤC BÀI ĐĂNG
    Route::prefix('category-post')->group(function () {
        Route::get('/', App\Livewire\CategoryPost\Index::class)->name('category-post.index');
        Route::get('/create-category-post', App\Livewire\CategoryPost\Create::class)->name('category-post.create');
        Route::get('/show-category-post/{id}', App\Livewire\CategoryPost\Show::class)->name('category-post.show');
        Route::get('/edit-category-post/{id}', App\Livewire\CategoryPost\Edit::class)->name('category-post.edit');
    });
    // BÀI ĐĂNG
    Route::prefix('post')->group(function () {
        Route::get('/', App\Livewire\Post\Index::class)->name('post.index');
        Route::get('/create-post', App\Livewire\Post\Create::class)->name('post.create');
        Route::get('/show-post/{id}', App\Livewire\Post\Show::class)->name('post.show');
        Route::get('/edit-post/{id}', App\Livewire\Post\Edit::class)->name('post.edit');
    });
    // COUPON
    Route::prefix('coupon')->group(function () {
        Route::get('/', App\Livewire\Coupon\Index::class)->name('coupon.index');
        Route::get('/give-coupon', App\Livewire\Coupon\GiveCoupon::class)->name('coupon.give');
        Route::get('/create-coupon', App\Livewire\Coupon\Create::class)->name('coupon.create');
        Route::get('/edit-coupon/{id}', App\Livewire\Coupon\Edit::class)->name('coupon.edit');
    });
    // NGƯỜI DÙNG
    Route::prefix('user')->group(function () {
        Route::get('/', App\Livewire\User\Index::class)->name('user.index');
        Route::get('/create-user', App\Livewire\User\Create::class)->name('user.create');
        Route::get('/show-user/{id}', App\Livewire\User\Show::class)->name('user.show');
        Route::get('/edit-user/{id}', App\Livewire\User\Edit::class)->name('user.edit');
    });
    Route::prefix('setting')->group(function () {
        Route::get('/', App\Livewire\Setting\Index::class)->name('setting.index');
        Route::get('/create-setting', App\Livewire\Setting\Create::class)->name('setting.create');
        Route::get('/edit-setting/{id}', App\Livewire\Setting\Edit::class)->name('setting.edit');
    });
    Route::prefix('order')->group(function () {
        Route::get('/', App\Livewire\Order\Index::class)->name('order.index');
        Route::get('/create-order', App\Livewire\Order\Create::class)->name('order.create');
        Route::get('/show-order/{id}', App\Livewire\Order\Show::class)->name('order.show');
    });
    Route::get('/home', App\Livewire\Home\Index::class)->name('home');
});
Route::post('/upload', [BaseController::class, 'upload'])->name('ckeditor.upload');
Route::prefix('auth')->controller(AuthController::class)->middleware('CheckLogin')->group(function () {
    Route::get('/login', 'loginPage')->name('login');
    Route::post('/login-process', 'loginProcess')->name('loginProcess');
    Route::get('/register', 'registerPage')->name('register');
    Route::post('/register-process', 'registerProcess')->name('registerProcess');
    Route::get('/logout', 'logOut')->name('logout');
});
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/momo-response', [ApiMomo::class, 'fallBack'])->name('response.momopay');

Route::get('403-error', function () {
    return view('Error.403');
})->name('error.403');

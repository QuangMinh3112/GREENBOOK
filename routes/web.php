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
    Route::prefix('user')->group(function () {
        Route::get('/', App\Livewire\User\Index::class)->name('user.index');
        Route::get('/create-user', App\Livewire\User\Create::class)->name('user.create');
        Route::get('/show-user/{id}', App\Livewire\User\Show::class)->name('user.show');
        Route::get('/edit-user/{id}', App\Livewire\User\Edit::class)->name('user.edit');
    });
});
Route::post('/upload', [BaseController::class, 'upload'])->name('ckeditor.upload');
Route::prefix('auth')->controller(AuthController::class)->middleware('CheckLogin')->group(function () {
    Route::get('/login', 'loginPage')->name('login');
    Route::post('/login-process', 'loginProcess')->name('loginProcess');
    Route::get('/register', 'registerPage')->name('register');
    Route::post('/register-process', 'registerProcess')->name('registerProcess');
    Route::get('/logout', 'logOut')->name('logout');
});
Route::prefix('/')->controller(ClientController::class)->group(function () {
    Route::get('/', 'index')->name('client.home');
});
Route::get('/momo-response', [ApiMomo::class, 'fallBack'])->name('response.momopay');

Route::get('403-error', function () {
    return view('Error.403');
})->name('error.403');

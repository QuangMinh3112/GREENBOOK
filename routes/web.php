<?php

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiMomo;
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
    Route::prefix('coupon')->group(function () {
        Route::get('/', App\Livewire\Coupon\Index::class)->name('coupon.index');
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
    Route::prefix('ship-fee')->group(function () {
        Route::get('/', App\Livewire\Ship\Index::class)->name('ship-fee.index');
        Route::get('/create-ship-fee', App\Livewire\Ship\Create::class)->name('ship-fee.create');
        Route::get('/edit-ship-fee/{id}', App\Livewire\Ship\Edit::class)->name('ship-fee.edit');
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

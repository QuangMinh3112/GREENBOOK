<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\Api\ApiCartController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiCouponController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiVNPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/test', [ApiBookController::class, 'test']);

Route::prefix('book')->controller(ApiBookController::class)->group(function () {
    Route::get('/', 'index'); //Show tất cả sách
    Route::get('/show/{id}', 'show'); // Show sách theo id
    Route::get('/search/{field}/{name}', 'searchByFiled'); //Tìm kiếm theo trường
    Route::get('/category-search/{id}', 'searchByCategory'); //Tìm kiếm theo category
});
Route::prefix('category')->controller(ApiCategoryController::class)->group(function () {
    Route::get('/', 'index'); //Lấy toàn bộ danh mục sách
    Route::get('/{id}', 'show'); // Lấy 1 danh mục
});
Route::post('/login', [ApiAuthController::class, 'login']); //Đăng nhập
Route::post('/register', [ApiAuthController::class, 'register']); // Đăng ký
Route::middleware("auth:api")->group(function () {
    Route::get('/show-profile', [ApiAuthController::class, 'showProfile']); // Xem profile cá nhân
    Route::get('/logout', [ApiAuthController::class, 'logOut']); // Đăng xuất

    Route::prefix('cart')->controller(ApiCartController::class)->group(function () {
        Route::get('/{user_id}', 'index'); // Xem giỏ hàng
        Route::post('/add-new', 'addToCart'); //Thêm mới vào giỏ hàng
        Route::put('/update/{id}', 'update'); //Cập nhật giỏ hàng
        Route::delete('/destroy/{id_cart}', 'removeCart'); // Xoá sản phẩm khỏi giỏ hàng
        Route::delete('/destroy-all/{user_id}', 'removeAll'); // Xoá toàn bộ sản phẩm khỏi giỏ hàng
        Route::post('/cart-order', 'createOrder'); // Tạo đơn hàng
    });
    Route::prefix('coupon')->controller(ApiCouponController::class)->group(function()
    {
        Route::get('/', 'getFreeCoupon');
    });
    Route::prefix('order')->controller(ApiOrderController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/order-detail/{order_id}', 'orderDetail');
    });
    Route::post('vnpay_payment/{order_id}',  [ApiVNPay::class, 'vnpay_payment'])->name('vnpay_payment'); // Thanh toán online
});

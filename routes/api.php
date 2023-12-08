<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\Api\ApiCartController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiCouponController;
use App\Http\Controllers\Api\ApiMomo;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiVNPay;
use App\Http\Controllers\Api\StripePaymentController;
use App\Http\Middleware\AlwaysAcceptJson;
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


Route::middleware(AlwaysAcceptJson::class)->group(function () {
    Route::prefix('book')->controller(ApiBookController::class)->group(function () {
        //Show tất cả sách
        Route::get('/', 'index');
        // Show sách theo id
        Route::get('/show/{id}', 'show');
        //Tìm kiếm theo trường
        Route::get('/search/{field}/{name}', 'searchByFiled');
        //Tìm kiếm theo category
        Route::get('/search/category/{id}', 'searchByCategory');
    });
    Route::prefix('category')->controller(ApiCategoryController::class)->group(function () {
        //Lấy toàn bộ danh mục sách
        Route::get('/', 'index');
        // Lấy 1 danh mục
        Route::get('/{id}', 'show');
    });
    //Đăng nhập
    Route::post('/login', [ApiAuthController::class, 'login']);
    // Đăng ký
    Route::post('/register', [ApiAuthController::class, 'register']);
    Route::middleware("auth:api")->group(function () {
        // Xem profile cá nhân
        Route::get('/show-profile', [ApiAuthController::class, 'showProfile']);
        // Đăng xuất
        Route::get('/logout', [ApiAuthController::class, 'logOut']);

        Route::prefix('cart')->controller(ApiCartController::class)->group(function () {
            // Xem giỏ hàng
            Route::get('/', 'index');
            //Thêm mới vào giỏ hàng
            Route::post('/add-new/{book_id}', 'addToCart');
            //Cập nhật giỏ hàng
            Route::put('/update/{book_id}', 'update');
            // Xoá sản phẩm khỏi giỏ hàng
            Route::delete('/destroy/{book_id}', 'removeCart');
            // Xoá toàn bộ sản phẩm khỏi giỏ hàng
            Route::delete('/destroy-all/{user_id}', 'removeAll');
            // Tạo đơn hàng từ giỏ hàng
            Route::post('/create-order', 'createOrder');
        });
        // Lất tất cả coupon public
        Route::prefix('coupon')->controller(ApiCouponController::class)->group(function () {
            Route::get('/', 'getFreeCoupon');
        });
        Route::prefix('order')->controller(ApiOrderController::class)->group(function () {
            // Xem đơn hàng
            Route::get('/', 'index');
            //Xem chi tiết đơn hàng
            Route::get('/order-detail/{order_id}', 'orderDetail');
        });
        Route::post('vnpay_payment/{order_id}',  [ApiVNPay::class, 'vnpay_payment'])->name('vnpay_payment'); // Thanh toán VNPAY
        Route::post('stripe/{order_id}', [StripePaymentController::class, 'stripePayment']); // Thanh toán stripe (đang lỗi)
        Route::post('momo_payment/{order_id}',  [ApiMomo::class, 'momo_payment'])->name('momo_payment');
    });
});

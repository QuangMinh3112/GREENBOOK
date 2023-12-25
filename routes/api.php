<?php

use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\Api\ApiCartController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiCategoryPostController;
use App\Http\Controllers\Api\ApiCouponController;
use App\Http\Controllers\Api\ApiFavoriteBookController;
use App\Http\Controllers\Api\ApiMomo;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiVNPay;
use App\Http\Controllers\Api\Auth\ApiEditProfileController;
use App\Http\Controllers\Api\Auth\ApiLoginController;
use App\Http\Controllers\Api\Auth\ApiLogoutController;
use App\Http\Controllers\Api\Auth\ApiRegisterController;
use App\Http\Controllers\Api\Auth\ApiResetPassword;
use App\Http\Controllers\Api\Auth\ApiShowProfileController;
use App\Http\Controllers\Api\Auth\ApiVerificationController;
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

Route::get('/unauthenticated', function () {
    return response()->json(['message' => 'Không thể xác minh'], 403);
});

Route::middleware(AlwaysAcceptJson::class)->group(function () {
    Route::prefix('book')->controller(ApiBookController::class)->group(function () {
        //Show tất cả sách
        Route::get('/', 'index');
        // Show top 10 sách nhiều lượt xem nhất
        Route::get('/top-book', 'topBook');
        // Show sách theo id
        Route::get('/show/{id}', 'show');
        // Show sách có liên quan
        Route::get('/related-book/{book_id}', 'relatedBook');
        //Tìm kiếm theo trường
        Route::get('/search/{field}/{name}', 'searchByFiled');
        // Lọc theo giá
        Route::get('/filter-price', 'filterPrice');
    });
    Route::prefix('category')->controller(ApiCategoryController::class)->group(function () {
        //Lấy toàn bộ danh mục sách theo sơ đồ cây
        Route::get('/', 'index');
        // Show sách theo danh mục
        Route::get('/{id}', 'show');
    });
    Route::prefix('category-post')->controller(ApiCategoryPostController::class)->group(function () {
        // Hiển thị toàn bộ danh mục bài đăng
        Route::get('/', 'index');
        // Hiển thị danh mục theo id
        Route::get('/{id}', 'show');
    });
    Route::prefix('post')->controller(ApiPostController::class)->group(function () {
        // Hiển thị toàn bộ bài đăng
        Route::get('/', 'index');
        // Hiển thị bài đăng theo id
        Route::get('/show/{id}', 'show');
        // Tìm bài đăng theo trường
        Route::get('/search/{field}/{name}', 'searchByFiled');
        // Tìm bài đăng có liên quan
        Route::get('/related-post/{post_id}', 'relatedPost');
        // Top bài đăng xem nhiều nhất
        Route::get('/top-post', 'topPost');
    });
    //Đăng nhập
    Route::post('/login', [ApiLoginController::class, 'login']);
    // Đăng ký
    Route::post('/register', [ApiRegisterController::class, 'register']);
    // Quên mật khẩu
    Route::post('/forgot-password', [ApiResetPassword::class, 'forgotPassword']);
    // Đặt lại mật khẩu
    Route::post('/reset-password', [ApiResetPassword::class, 'resetPassword']);

    Route::middleware(['auth:api'])->group(function () {
        // Xem profile cá nhân
        Route::get('/show-profile', [ApiShowProfileController::class, 'showProfile']);
        // Đăng xuất
        Route::get('/logout', [ApiLogoutController::class, 'logOut']);
        // Gửi mã xác minh tài khoản
        Route::get('/send-otp', [ApiVerificationController::class, 'sendOtpVertify']);
        // Xác minh tài khoản
        Route::post('/vertify-otp', [ApiVerificationController::class, 'otpVertify']);
        // Cập nhật hồ sơ
        Route::post('/update-profile', [ApiEditProfileController::class, 'updateProfile']);
        // GIỎ HÀNG
        Route::prefix('cart')->controller(ApiCartController::class)->group(function () {
            // Xem giỏ hàng
            Route::get('/', 'index');
            //Thêm mới vào giỏ hàng
            Route::post('/add/{book_id}', 'addToCart');
            //Cập nhật giỏ hàng
            Route::put('/update/{book_id}', 'update');
            // Xoá sản phẩm khỏi giỏ hàng
            Route::delete('/remove/{book_id}', 'removeCart');
            // Xoá toàn bộ sản phẩm khỏi giỏ hàng
            Route::delete('/remove-all', 'removeAll');
            // Tạo đơn hàng từ giỏ hàng
            Route::post('/create-order', 'createOrder');
        });
        // SẢN PHẨM YÊU THÍCH
        Route::prefix('favorite-book')->controller(ApiFavoriteBookController::class)->group(function () {
            // Xem sản phẩm yêu thích
            Route::get('/', 'showFavorite');
            // Thêm sản phẩm yêu thích
            Route::post('/add/{book_id}', 'addFavorite');
            // Xoá sản phẩm yêu thích
            Route::delete('/remove/{book_id}', 'removeFavorite');
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
            // Thay đổi thông tin đơn hàng (Nếu là status pending sẽ thay đổi được, shipping shipped completed faild thì không)
            Route::put('/update-order/{order_id}', 'updateOrder');
            // Huỷ đơn hàng (Nếu là status pending sẽ thay đổi được, shipping shipped completed faild thì không)
            Route::put('/cancel-order/{order_id}', 'cancelOrder');
        });
        Route::post('vnpay_payment/{order_id}',  [ApiVNPay::class, 'vnpay_payment'])->name('vnpay_payment'); // Thanh toán VNPAY
        Route::post('momo_payment/{order_id}',  [ApiMomo::class, 'momo_payment'])->name('momo_payment'); // Thanh toán momo
    });
});

<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\Api\ApiCartController;
use App\Http\Controllers\Api\ApiCategoryController;
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
    Route::get('/search/category/{id}', 'searchByCategory'); //Tìm kiếm theo category
});
Route::prefix('category')->controller(ApiCategoryController::class)->group(function () {
    Route::get('/', 'index'); //Lấy toàn bộ danh mục sách
    Route::get('/{id}', 'show'); // Lấy 1 danh mục
});
Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);
Route::middleware("auth:api")->group(function () {
    Route::get('/show-profile', [ApiAuthController::class, 'showProfile']);
    Route::get('/logout', [ApiAuthController::class, 'logOut']);

    Route::prefix('cart')->controller(ApiCartController::class)->group(function () {
        Route::get('/{user_id}', 'index');
        Route::post('/add-new', 'addToCart');
        Route::put('/update/{id}', 'update');
        Route::delete('/destroy/{id_cart}', 'removeCart');
        Route::delete('/destroy-all/{user_id}', 'removeAll');
    });
});

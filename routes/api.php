<?php

use App\Http\Controllers\Api\ApiBookController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('book')->controller(ApiBookController::class)->group(function () {
    Route::get('/', 'index'); //Show tất cả sách
    Route::get('/show/{id}', 'show'); // Show sách theo id
    Route::get('/search/{name}', 'searchByName'); //Tìm sách theo tên
    Route::get('/search/{field}/{name}', 'searchByFiled');
    Route::get('/search/category/{id}', 'searchByCategory'); //Tìm kiếm theo category
    Route::post('/store', 'store'); //Thêm mới sách
    Route::put('/update/{id}', 'update'); //Cập nhật sách
    Route::delete('/destroy/{id}', 'destroy'); //Xoá sách
});
Route::prefix('category')->controller(ApiCategoryController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

<?php

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\PostController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::prefix('admin')->middleware('auth', 'CheckAdmin')->group(function () {
    // DANH MỤC SÁCH
    Route::prefix('category')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('admin.category.index');
        Route::post('/', 'index')->name('admin.category.search');
        Route::get('show/{id}', 'show')->name('admin.category.show');
        Route::get('create', 'create')->name('admin.category.create');
        Route::post('store', 'store')->name('admin.category.store');
        Route::get('edit/{id}', 'edit')->name('admin.category.edit');
        Route::post('update/{id}', 'update')->name('admin.category.update');
        Route::get('delete/{id}', 'delete')->name('admin.category.delete');
    });
    //  SÁCH
    Route::prefix('book')->controller(BookController::class)->group(function () {
        Route::get('/', 'index')->name('admin.book.index');
        Route::post('/', 'index')->name('admin.book.search');
        Route::get('show/{id}', 'show')->name('admin.book.show');
        Route::get('create', 'create')->name('admin.book.create');
        Route::post('store', 'store')->name('admin.book.store');
        Route::get('edit/{id}', 'edit')->name('admin.book.edit');
        Route::post('update/{id}', 'update')->name('admin.book.update');
        Route::get('delete/{id}', 'delete')->name('admin.book.delete');
        Route::get('archive', 'archive')->name('admin.book.archive');
        Route::get('restore/{id}', 'restore')->name('admin.book.restore');
        Route::get('destroy/{id}', 'destroy')->name('admin.book.destroy');
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
        Route::get('/show', 'show')->name('admin.post.show');
        Route::get('/create', 'create')->name('admin.post.create');
        Route::post('/store', 'store')->name('admin.post.store');
        Route::get('/edit/{id}', 'edit')->name('admin.post.edit');
    });
    // NGƯỜI DÙNG
    Route::prefix('user')->controller(UsersController::class)->group(function () {
        Route::get('/', 'index')->name('admin.user.index');
        Route::delete('/delete/{id}', 'delete')->name('admin.user.delete');
        Route::get('/edit/{id}', 'edit')->name('admin.user.edit');
        Route::post('/update/{id}', 'update')->name('admin.user.update');
        Route::get('/show/{id}', 'show')->name('admin.user.show');
    });
});
Route::post('/upload', [BaseController::class, 'upload'])->name('ckeditor.upload');


Route::prefix('auth')->controller(AuthController::class)->middleware('CheckLogin')->group(function () {
    Route::get('/login', 'loginPage')->name('auth.login');
    Route::post('/login-process', 'loginProcess')->name('auth.loginProcess');
    Route::get('/register', 'registerPage')->name('auth.register');
    Route::post('/register-process', 'registerProcess')->name('auth.registerProcess');
    Route::get('/logout', 'logOut')->name('auth.logout');
});

Route::prefix('/')->controller(ClientController::class)->group(function () {
    Route::get('/', 'index')->name('client.home');
});

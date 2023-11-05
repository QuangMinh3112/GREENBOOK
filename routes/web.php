<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/table', function () {
    return view('dataTable');
});
Route::get('/form', function () {
    return view('form');
});
Route::prefix('admin')->group(function () {
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
    Route::prefix('book')->controller(BookController::class)->group(function () {
        Route::get('/', 'index')->name('admin.book.index');
        Route::post('/', 'index')->name('admin.book.search');
        Route::get('show/{id}', 'show')->name('admin.book.show');
        Route::get('create', 'create')->name('admin.book.create');
        Route::post('upload', 'upload')->name('admin.book.upload');
        Route::post('store', 'store')->name('admin.book.store');
        Route::get('edit/{id}', 'edit')->name('admin.book.edit');
        Route::post('update/{id}', 'update')->name('admin.book.update');
        Route::get('delete/{id}', 'delete')->name('admin.book.delete');
        Route::get('archive', 'archive')->name('admin.book.archive');
        Route::get('restore/{id}', 'restore')->name('admin.book.restore');
        Route::get('destrpy/{id}', 'destroy')->name('admin.book.destroy');
    });
    Route::prefix('user')->controller(UsersController::class)->group(function () {
        Route::get('/', 'index')->name('admin.user.index');
        Route::get('/create', 'create')->name('admin.user.create');
        Route::post('/store', 'store')->name('admin.user.store');
        Route::delete('/delete/{id}', 'delete')->name('admin.user.delete');
        Route::get('/edit/{id}', 'edit')->name('admin.user.edit');
        Route::post('/update/{id}', 'update')->name('admin.user.update');
        Route::get('/show/{id}', 'show')->name('admin.user.show');
        Route::get('archive', 'archive')->name('admin.user.archive');
        Route::get('restore/{id}', 'restore')->name('admin.user.restore');
        Route::get('destrpy/{id}', 'destroy')->name('admin.user.destroy');
    });
});


Route::get('/login', [AuthController::class, 'index']);
Route::post('admin/saveLogin', [AuthController::class, 'check'])->name('login.check');

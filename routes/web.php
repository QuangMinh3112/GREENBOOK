<?php

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
        Route::get('archive', 'archive')->name('admin.category.archive');
        Route::get('restore/{id}', 'restore')->name('admin.category.restore');
        Route::get('destrpy/{id}', 'destroy')->name('admin.category.destroy');
    });
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
        Route::get('destrpy/{id}', 'destroy')->name('admin.book.destroy');
    });
});

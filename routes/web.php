<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [GeneralController::class, 'getUserDashboard'])->name('user.dashboard');
Route::get('/item/details/{id}', [GeneralController::class, 'showItemDetail'])->name('item.details');
Route::get('/items/search', [GeneralController::class, 'searchCategory'])->name('items.search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Corrected admin routes group
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'getAdminDashboard'])->name('dashboard');

    Route::get('/categories', [AdminController::class, 'getCategory'])->name('category.list');
    Route::post('/categories/store', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{id}', [AdminController::class, 'editCategory'])->name('category.edit');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('category.update');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

    Route::get('/items', [AdminController::class, 'getItem'])->name('item.list');
    Route::post('/items/store', [AdminController::class, 'storeItem'])->name('items.store');
    Route::get('/items/{id}', [AdminController::class, 'editItem'])->name('item.edit');
    Route::put('/items/{id}', [AdminController::class, 'updateItem'])->name('item.update');
    Route::delete('/items/{id}', [AdminController::class, 'destroyItem'])->name('items.destroy');
});

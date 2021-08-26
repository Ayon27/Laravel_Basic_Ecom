<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('main');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//category routes
Route::get('/category/all', [CategoryController::class, 'index'])->name('allCategories');
Route::post('/category/add', [CategoryController::class, 'create'])->name('addCategory');
Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('editCategory');
Route::post('category/update/{id}', [CategoryController::class, 'update']);
Route::get('category/delete/{id}', [CategoryController::class, 'softDelete']);
Route::get('category/delete_perma/{id}', [CategoryController::class, 'permanentDelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'restoreDeleted']);

//Brand route
Route::get('brand/all', [BrandController::class, 'index'])->name('allBrand');
Route::post('/brand/add', [BrandController::class, 'create'])->name('addBrand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);


//multiple img upld
Route::get('/multi/image', [BrandController::class, 'multiUpIndex'])->name('multiImg');
Route::post('/multi/add', [BrandController::class, 'storeMultipleImage'])->name('storeMultipleImage');

//user email verify
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

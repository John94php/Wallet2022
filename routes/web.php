<?php

use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categories',[App\Http\Controllers\CategoryController::class,'index'])->name('categories.index');
Route::get('/products',[App\Http\Controllers\ProductController::class,'index'])->name('products.index');
Route::get('/bills',[App\Http\Controllers\BillController::class,'index'])->name('bills.index');

Route::get('/getAllCategories',[App\Http\Controllers\CategoryController::class,'getAllCategories'])->name('getAllCategories');
Route::get('/getAllProducts',[App\Http\Controllers\ProductController::class,'getAllProducts'])->name('getAllProducts');
Route::get('/getAllBills',[App\Http\Controllers\BillController::class,'getAllBills'])->name('getAllBills');

Route::get('/categories/add',[App\Http\Controllers\CategoryController::class,'add'])->name('categories.add');
Route::get('/products/add',[App\Http\Controllers\ProductController::class,'add'])->name('products.add');
Route::get('/bills/add',[App\Http\Controllers\BillController::class,'add'])->name('bills.add');

Route::post('saveCategory',[App\Http\Controllers\CategoryController::class,'store'])->name('saveCategory');
Route::post('saveProduct',[App\Http\Controllers\ProductController::class,'store'])->name('saveProduct');
Route::post('saveBill',[App\Http\Controllers\BillController::class,'store'])->name('saveBill');

Route::get('/countProducts',[App\Http\Controllers\ProductController::class,'countProducts'])->name('countProducts');
Route::get('/countCategories',[App\Http\Controllers\CategoryController::class,'countCategories'])->name('countCategories');

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
Route::get('/shopping',[App\Http\Controllers\ShoppingController::class,'index'])->name('shopping.index');
Route::get('/shopcat',[App\Http\Controllers\ShoppingCategoryController::class,'index'])->name('shopcat.index');



Route::get('/getAllCategories',[App\Http\Controllers\CategoryController::class,'getAllCategories'])->name('getAllCategories');
Route::get('/getAllProducts',[App\Http\Controllers\ProductController::class,'getAllProducts'])->name('getAllProducts');
Route::get('/getAllBills',[App\Http\Controllers\BillController::class,'getAllBills'])->name('getAllBills');
Route::get('/getAllShopping',[App\Http\Controllers\ShoppingController::class,'getAllShopping'])->name('getAllShopping');
Route::get('/getAllStatuses',[App\Http\Controllers\StatusController::class,'getAllStatuses'])->name('getAllStatuses');
Route::get('/getAllShopCat',[App\Http\Controllers\ShoppingCategoryController::class,'getAllShopCat'])->name('getAllShopCat');
Route::get('/getStatus/{id}',[App\Http\Controllers\StatusController::class,'getStatus'])->name('getStatus');
Route::get('/getAllBillsAmount',[App\Http\Controllers\BillController::class,'getAllBillsAmount'])->name('getAllBillsAmount');
Route::get('/getAllShoppingAmount',[App\Http\Controllers\ShoppingController::class,'getAllShoppingAmount'])->name('getAllShoppingAmount');



Route::get('/categories/add',[App\Http\Controllers\CategoryController::class,'add'])->name('categories.add');
Route::get('/products/add',[App\Http\Controllers\ProductController::class,'add'])->name('products.add');
Route::get('/bills/add',[App\Http\Controllers\BillController::class,'add'])->name('bills.add');
Route::get('/shopping/add',[App\Http\Controllers\ShoppingController::class,'add'])->name('shopping.add');

Route::post('saveCategory',[App\Http\Controllers\CategoryController::class,'store'])->name('saveCategory');
Route::post('saveProduct',[App\Http\Controllers\ProductController::class,'store'])->name('saveProduct');
Route::post('saveBill',[App\Http\Controllers\BillController::class,'store'])->name('saveBill');
Route::post('saveShopping',[App\Http\Controllers\ShoppingController::class,'store'])->name('saveShopping');

Route::get('/countAllExpenses',[App\Http\Controllers\ExpenseController::class,'countAllExpenses'])->name('countAllExpenses');
Route::get('/countProducts',[App\Http\Controllers\ProductController::class,'countProducts'])->name('countProducts');
Route::get('/countCategories',[App\Http\Controllers\CategoryController::class,'countCategories'])->name('countCategories');
Route::get('/countBills',[App\Http\Controllers\BillController::class,'countBills'])->name('countBills');
Route::get('/countShopping',[App\Http\Controllers\ShoppingController::class,'countShopping'])->name('countShopping');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyCommerceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\SslCommerzPaymentController;
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

Route::get('/',[MyCommerceController::class,'index'])->name('home');
Route::get('/product-category/{id}',[MyCommerceController::class,'category'])->name('product-category');
Route::get('/product-detail/{id}',[MyCommerceController::class,'detail'])->name('product-detail');
Route::post('/add-to-card/{id}',[CartController::class,'index'])->name('add-to-card');
Route::get('/show-cart',[CartController::class,'show'])->name('show-cart');
Route::post('/update-cart-product/{id}',[CartController::class,'update'])->name('update-cart-product');
Route::get('/remove-cart-product/{id}',[CartController::class,'remove'])->name('remove-cart-product');
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
Route::post('/new-cash-order',[CheckoutController::class,'newCashOrder'])->name('new-cash-order');
Route::get('/complete-order',[CheckoutController::class,'completeOrder'])->name('complete-order');

Route::get('/customer-login',[CustomerAuthController::class,'index'])->name('customer.login');
Route::post('/customer-login',[CustomerAuthController::class,'login'])->name('customer.login');
Route::get('/customer-register',[CustomerAuthController::class,'register'])->name('customer.register');
Route::get('/customer-logout',[CustomerAuthController::class,'logout'])->name('customer.logout');
Route::get('/customer-dashboard',[CustomerAuthController::class,'dashboard'])->name('customer.dashboard');
Route::get('/customer-profile',[CustomerAuthController::class,'profile'])->name('customer.profile');
Route::get('/customer-order',[CustomerOrderController::class,'allOrder'])->name('customer.order');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/category/add',[CategoryController::class,'index'])->name('category.add');
    Route::post('/category/new',[CategoryController::class,'create'])->name('category.new');
    Route::get('/category/manage',[CategoryController::class,'store'])->name('category.manage');
    Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/category/delete',[CategoryController::class,'destroy'])->name('category.delete');
    Route::post('/category/update',[CategoryController::class,'updates'])->name('category.update');

    Route::get('/sub-category/add',[SubCategoryController::class,'index'])->name('sub-category.add');
    Route::post('/sub-category/new',[SubCategoryController::class,'create'])->name('sub-category.new');
    Route::get('/sub-category/manage',[SubCategoryController::class,'store'])->name('sub-category.manage');
    Route::get('/sub-category/edit/{id}',[SubCategoryController::class,'edit'])->name('sub-category.edit');
    Route::post('/sub-category/delete',[SubCategoryController::class,'destroy'])->name('sub-category.delete');
    Route::post('/sub-category/update',[SubCategoryController::class,'updates'])->name('sub-category.update');

    Route::get('/brand/add',[BrandController::class,'index'])->name('brand.add');
    Route::post('/brand/new',[BrandController::class,'create'])->name('brand.new');
    Route::get('/brand/manage',[BrandController::class,'store'])->name('brand.manage');
    Route::get('/brand/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
    Route::post('/brand/delete',[BrandController::class,'destroy'])->name('brand.delete');
    Route::post('/brand/update',[BrandController::class,'updates'])->name('brand.update');

    Route::get('/unit/add',[UnitController::class,'index'])->name('unit.add');
    Route::post('/unit/new',[UnitController::class,'create'])->name('unit.new');
    Route::get('/unit/manage',[UnitController::class,'store'])->name('unit.manage');
    Route::get('/unit/edit/{id}',[UnitController::class,'edit'])->name('unit.edit');
    Route::post('/unit/delete',[UnitController::class,'destroy'])->name('unit.delete');
    Route::post('/unit/update',[UnitController::class,'updates'])->name('unit.update');

    Route::get('/product/add',[ProductController::class,'index'])->name('product.add');
    Route::get('/product/get-subcategory-by-category',[ProductController::class,'getSubCategoryByCategory'])->name('product.get-subcategory-by-category');
    Route::post('/product/new',[ProductController::class,'create'])->name('product.new');
    Route::get('/product/manage',[ProductController::class,'store'])->name('product.manage');
    Route::get('/product/detail/{id}',[ProductController::class,'detail'])->name('product.detail');
    Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::get('/product/delete/{id}/', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('/product/update/{id}',[ProductController::class,'update'])->name('product.update');

});

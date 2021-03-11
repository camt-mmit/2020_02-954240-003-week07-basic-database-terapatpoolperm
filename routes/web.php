<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;

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

Route::get('/product', [ProductController::class, 'list'])
->name('product-list');

Route::get('/product/create', [ProductController::class, 'createForm'])
->name('product-create-form');
 
Route::post('/product/create', [ProductController::class, 'create'])
->name('product-create');
    
Route::get('/product/{product}', [ProductController::class, 'show'])
->name('product-view');

Route::get('/product/{product}/shop', [ProductController::class, 'showShop'])
->name('product-view-shop');

Route::get('/product/{product}/shop/add', [ProductController::class, 'addShopForm'])
->name('product-add-shop-form');

Route::post('/product/{product}/shop/add', [ProductController::class, 'addShop'])
->name('product-add-shop');

Route::get('/product/{product}/shop/{shop}/remove', [ProductController::class, 'removeShop'])
->name('product-remove-shop');
 
Route::get('/product/{product}/update', [ProductController::class, 'updateForm'])
->name('product-update-form');
 
Route::post('/product/{product}/update', [ProductController::class, 'update'])
->name('product-update');

Route::get('/product/{product}/delete', [ProductController::class, 'delete'])
->name('product-delete');

Route::get('/shop', [ShopController::class, 'list'])
->name('shop-list');

Route::get('/shop/create', [shopController::class, 'createForm'])
->name('shop-create-form');
 
Route::post('/shop/create', [shopController::class, 'create'])
->name('shop-create');

Route::get('/shop/{shop}', [ShopController::class, 'show'])
->name('shop-view');

Route::get('/shop/{shop}/shop', [shopController::class, 'showShop'])
->name('shop-view-shop');

Route::get('/shop/{shop}/product', [ShopController::class, 'showProduct'])
->name('shop-view-product');

Route::get('/shop/{shop}/product/add', [ShopController::class, 'addProductForm'])
->name('shop-add-product-form');

Route::post('/shop/{shop}/product/add', [ShopController::class, 'addProduct'])
->name('shop-add-product');

Route::get('/shop/{shop}/product/{product}/remove', [ShopController::class, 'removeProduct'])
->name('shop-remove-product');

Route::get('/shop/{shop}/update', [shopController::class, 'updateForm'])
->name('shop-update-form');
 
Route::post('/shop/{shop}/update', [shopController::class, 'update'])
->name('shop-update');

Route::get('/shop/{shop}/delete', [shopController::class, 'delete'])
->name('shop-delete');

Route::get('/category', [categoryController::class, 'list'])
->name('category-list');

Route::get('/category/create', [categoryController::class, 'createForm'])
->name('category-create-form');
 
Route::post('/category/create', [categoryController::class, 'create'])
->name('category-create');
    
Route::get('/category/{category}', [categoryController::class, 'show'])
->name('category-view');

Route::get('/category/{category}/product', [categoryController::class, 'showProduct'])
->name('category-view-product');

Route::get('/category/{category}/product/add', [categoryController::class, 'addProductForm'])
->name('category-add-product-form');

Route::post('/category/{category}/product/add', [categoryController::class, 'addProduct'])
->name('category-add-product');

Route::get('/category/{category}/product/{product}/remove', [categoryController::class, 'removeProduct'])
->name('category-remove-product');
 
Route::get('/category/{category}/update', [categoryController::class, 'updateForm'])
->name('category-update-form');
 
Route::post('/category/{category}/update', [categoryController::class, 'update'])
->name('category-update');

Route::get('/category/{category}/delete', [categoryController::class, 'delete'])
->name('category-delete');

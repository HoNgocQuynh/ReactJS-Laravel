<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public API
Route::get('product-detail/{id}', [ProductController::class, 'detail']);
Route::get('product-for-sale', [HomeController::class, 'productForSale']);
Route::get('clothes-show-home', [HomeController::class, 'clothesShowHome']);
Route::get('categories-at-home', [HomeController::class, 'catAtHome']);
Route::get('electronics-show-home', [HomeController::class, 'electronicsShowHome']);
Route::get('recommended-item', [HomeController::class, 'recommendedItem']);
Route::get('product-by-cat/{id}', [HomeController::class, 'productByCat']);
Route::get('popularCat', [HomeController::class, 'popularCat']);


// cart
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart/{id}', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove/{id}', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');



// Category management API
Route::post('/create-category', [CategoryController::class, 'store']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
Route::post('update-category/{id}', [CategoryController::class, 'update']);
Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);




// Product management API
Route::post('/add-product', [ProductController::class, 'store']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/all-categories', [ProductController::class, 'allCategory']);
Route::get('/all-brands', [ProductController::class, 'allBrand']);
Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
Route::post('/update-product/{id}', [ProductController::class, 'update']);
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);
// Link management API
Route::post('/add-link', [LinkController::class, 'store']);
Route::get('/links', [LinkController::class, 'index']);
Route::get('/edit-link/{id}', [LinkController::class, 'edit']);
Route::post('/update-link/{id}', [LinkController::class, 'update']);
Route::delete('/delete-link/{id}', [LinkController::class, 'destroy']);
// Brand management API

Route::post('/add-brand', [BrandController::class, 'store']);
Route::get('/brands', [BrandController::class, 'index']);
Route::get('/edit-brand/{id}', [BrandController::class, 'edit']);
Route::post('/update-brand/{id}', [BrandController::class, 'update']);
Route::delete('/delete-brand/{id}', [BrandController::class, 'destroy']);


// Auth API routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum','isAPIAdmin'])->group(function () {
    Route::get('/checkingAuthenticated', function () {
        return response()->json(['status'=> 200, 'message'=>'You are'], 200);
    });
   
});
Route::middleware(['auth:sanctum'])->group(function () {
   Route::post('/logout', [AuthController::class, 'logout']); 
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

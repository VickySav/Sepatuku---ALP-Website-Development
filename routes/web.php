<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\ShouldAdminMiddleware;


Route::get("/login", [AuthController::class,"ShowLogin"]);
Route::post("/login",[AuthController::class,"PostLogin"])->name("PostLogin");
Route::get("/logout",[AuthController::class,"PostLogout"])->name("logout");
Route::get("/registration", [AuthController::class,"ShowCreateAcc"]);
Route::post("/registration",[AuthController::class,"PostRegister"])->name("PostRegister");
Route::get("/forgot-passowrd", [AuthController::class,"ShowForgotPass"]);
Route::get('/',[HomeController::class,'ShowHome']);
Route::post('/', [HomeController::class, 'addWishlist'])->name('addWishlist');

Route::get('/product-details', [HomeController::class, 'ShowProductDetails']);
Route::get('/product-details/{id}-{name}', [HomeController::class, 'ShowProductDetails']);
Route::post('/product-details/addCart', [CartController::class, 'addCart'])->name('addCart');

Route::get('/shop', [CategoryController::class,'ShowCategory']);
Route::post('/shop/filter', [CategoryController::class, 'filterCategory'])->name('filterCategory');
Route::post('/shop/clearFilter', [CategoryController::class, 'clearFilter'])->name('clearFilter');
Route::post('/shop/brand', [CategoryController::class, 'filterBrand'])->name('filterBrand');


Route::get('/checkout', [CheckoutController::class,'ShowCheckout']);

Route::get('/cart', [CartController::class,'ShowCart']);
Route::post('/cart/update', [CartController::class,'updateCart'])->name('updateCart');
Route::post('/cart/delete', [CartController::class,'deleteCart'])->name('deleteCart');

// Route::post('/cart', [CartController::class,'deleteCart'])->name('deleteCart');


Route::get('/wishlist', [WishlistController::class,'ShowWishlist']);
Route::post('/wishlist/delete', [WishlistController::class,'deleteWishlist'])->name('deleteWishlist');


Route::get('/contact', [ContactController::class,'ShowContact']);


Route::middleware([ShouldAdminMiddleware::class])->group(function() {
    Route::prefix('/admin')->group(function () {
        Route::get('/transaction', [AdminController::class,'ShowTransaction']);
        Route::get('/manageproduct',  [AdminController::class,'ShowCatalog']);
        Route::post('/manageproduct/add',  [AdminController::class,'AddNewProduct'])->name("AddNewProduct");
        Route::post('/manageproduct/edit',  [AdminController::class,'EditProduct'])->name("EditProduct");
    });
});
// Route::view('/admin/manageproduct','admin-catalog');
//Route::view('/confirm', 'confirmation');
//Route::view('/tracking', 'tracking');



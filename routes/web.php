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


Route::get("/login", [AuthController::class,"ShowLogin"]);
Route::post("/login",[AuthController::class,"PostLogin"])->name("PostLogin");
Route::get("/logout",[AuthController::class,"PostLogout"])->name("logout");
Route::get("/registration", [AuthController::class,"ShowCreateAcc"]);
Route::post("/registration",[AuthController::class,"PostRegister"])->name("PostRegister");
Route::get("/forgot-passowrd", [AuthController::class,"ShowForgotPass"]);
Route::get('/',[HomeController::class,'ShowHome']);

Route::get('/product-details', [HomeController::class, 'ShowProductDetails']);


Route::get('/category', [CategoryController::class,'ShowCategory']);
Route::get('/checkout', [CheckoutController::class,'ShowCheckout']);
Route::get('/cart', [CartController::class,'ShowCart']);
Route::get('/wishlist', [WishlistController::class,'ShowWishlist']);


Route::get('/contact', [ContactController::class,'ShowContact']);

Route::prefix('/admin')->group(function () {
    Route::get('/transaction', [AdminController::class,'ShowTransaction']);
    Route::get('/manageproduct',  [AdminController::class,'ShowCatalog']);
});
// Route::view('/admin/manageproduct','admin-catalog');
//Route::view('/confirm', 'confirmation');
//Route::view('/tracking', 'tracking');



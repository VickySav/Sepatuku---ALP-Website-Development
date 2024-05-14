<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;

// Route::get('/', function () {
//     return view('login');
// });
//Route::view('/login', 'login');

Route::get("/login", [AuthController::class,"ShowLogin"]);
Route::get("/registration", [AuthController::class,"ShowCreateAcc"]);
Route::get("/forgot-passowrd", [AuthController::class,"ShowForgotPass"]);
Route::get('/',[HomeController::class,'ShowHome']);

Route::get('/product-details', [HomeController::class, 'ShowProductDetails']);


Route::get('/category', [CategoryController::class,'ShowCategory']);
Route::get('/checkout', [CheckoutController::class,'ShowCheckout']);
Route::get('/cart', [CartController::class,'ShowCart']);
Route::get('/wishlist', [WishlistController::class,'ShowWishlist']);


Route::get('/contact', [ContactController::class,'ShowContact']);

Route::view('/admin','admin-catalog');
//Route::view('/confirm', 'confirmation');
//Route::view('/tracking', 'tracking');



<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::view('/cart', 'cart');
Route::view('/home', 'home');
Route::view('/category', 'category');
Route::view('/login', 'login');
Route::view('/contact', 'contact');
Route::view('/tracking', 'tracking');
Route::view('/checkout', 'checkout');

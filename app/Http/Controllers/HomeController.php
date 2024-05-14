<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function ShowHome()
    {
        return view("home");
    }
    public function ShowProductDetails()
    {
        return view("product-details");

        // harusnya return view ('/product/{id}-{name})';
    }
}

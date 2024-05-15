<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function ShowTransaction()
    {
        return view('admin-transaction-data');
    }
    public function ShowCatalog()
    {
        return view('admin-catalog');
    }
}

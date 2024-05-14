<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function ShowLogin()
    {
        return view("login");
    }
    public function ShowCreateAcc()
    {
        return view("Registration");
    }
    public function ShowForgotPass()
    {
        return view("forgot-password");
    }
}

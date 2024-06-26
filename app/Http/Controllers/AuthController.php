<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
class AuthController extends Controller
{
    public function ShowLogin(Request $request)
    {
        HomeController::clearFilterSession();

        if(Session::has('ACCOUNT_ID') || isset($_COOKIE['ACCOUNT_ID']))
        {
             return redirect()->back();
        }
        else
        {
            return view("login");
        }

    }
    public function PostLogin(Request $request)
    {
        $user = $request->only("name","password");
        //$DBuser= DB::table('Account')->where('email', '=', $user['email'])->first();
        $DBuser = DB::table('ACCOUNT')
        ->where('email', '=', $user['name'])
        ->orWhere('username', '=', $user['name'])
        ->first();
        $remember = ($request->has('remember')) ? true : false;
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:5'
        ]);

        if($DBuser !== null) {
            if(password_verify($request->password, $DBuser->PASSWORD) )
            {
                if ($remember == true) {
                    Cookie::queue('ACCOUNT_ID', $DBuser->ACCOUNT_ID, 60 * 24 * 7);
                    Cookie::queue('USERNAME', $DBuser->USERNAME, 60 * 24 * 7);
                    Cookie::queue('PASSWORD', $DBuser->PASSWORD, 60 * 24 * 7);
                }
                else{
                    $request->session()->put('ACCOUNT_ID', $DBuser->ACCOUNT_ID );
                    $request->session()->put('USERNAME', $DBuser->USERNAME);
                    $request->session()->put('PASSWORD', $DBuser->PASSWORD );
                }
                //dd($request->cookies->all());
                if($DBuser->ROLES == 'User')
                    return redirect('/')->with('success','Login Succesfull');
                else
                {
                    return redirect('/admin/transaction')->with('success','Login Succesfull');
                }
            }
            else{
                //dd($request->cookies->all());
                return redirect('/login')->with('error','Login Failed! Please Try Again.');
            }
        }
        else{
            return redirect('/login')->with('error','Login Failed! Please Try Again.');
        }

    }
    public function PostLogout(Request $request)
    {
        if (session()->has('ACCOUNT_ID') || Cookie::get('ACCOUNT_ID') != null) {
            session()->pull('ACCOUNT_ID');
            session()->pull('USERNAME');
            session()->pull('PASSWORD');

            Cookie::queue(Cookie::forget('ACCOUNT_ID'));
            Cookie::queue(Cookie::forget('USERNAME'));
            Cookie::queue(Cookie::forget('PASSWORD'));
        }
        return redirect('/')->with('success','Account succesfuly logout');
    }
    public function ShowCreateAcc()
    {
        return view("Registration");
    }
    public function PostRegister(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|max:50',
            'password' => 'required|min:5',
            'email' => 'required|email|max:50',
            'phone' => 'required|min:8|max:15',
            'address' => 'required|max:100',
        ]);
        $checkUsername = DB::table('ACCOUNT')->where('username', '=', $validatedData['username'])->first();
        $checkEmail = DB::table('ACCOUNT')->where('email', '=', $validatedData['email'])->first();

        if($checkUsername == null && $checkEmail == null){
            $insert = DB::table('ACCOUNT')->insert([
                'USERNAME' => $validatedData['username'],
                'PASSWORD' => Hash::make($validatedData['password']),
                'EMAIL' => $validatedData['email'],
                'PHONE_NUMBER' => $validatedData['phone'],
                'ADDRESS' => $validatedData['address'],
            ]);
            $accountId = DB::table('ACCOUNT')
                    ->select('account_id')
                    ->where('username', '=', $validatedData['username'])
                    ->value('account_id');

            $insertCart = DB::table('CART')->insert([
                'ACCOUNT_ID'=> $accountId,
                'NAMA_CART'=> DB::raw('fGenCart("' . $validatedData['username'] . '")'),
            ]);

            $insertCart = DB::table('WISHLIST')->insert([
                'ACCOUNT_ID'=> $accountId,
                'NAMA_WISHLIST'=> DB::raw('fGenWishList("' . $validatedData['username'] . '")'),
            ]);

            if ($insert && $insertCart && $insertCart) {
                return redirect('/login')->with('success', 'Registration successful!');
            } else {
                return redirect('/registration')->with('error', 'Error occurred during registration.');
            }
        }
        else
        {
            if($checkEmail !=null && $checkUsername != null)
            {
                return redirect('/registration')->with('error', 'Username and Email already exist please change');
            }
            else if($checkEmail !=null)
            {
                return redirect('/registration')->with('error', 'Email already exist please change');
            }
            else
            {
                return redirect('/registration')->with('error', 'Username already exist please change');
            }

        }
    }
    public function ShowForgotPass()
    {
        return view("forgot-password");
    }
    public function PostForgotPass(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $DBuser = DB::table('ACCOUNT')
        ->where('email', '=', $request->email)
        ->first();

        $token = Str::random(60);

        if($DBuser == null)
        {
            return redirect('/forgot-password')->with('error','Your email not found');
        }
        else{
            PasswordResetToken::updateOrCreate(
                ['email' => $request->email], // Search criteria
                [
                    'token' => $token,
                    'created_at' => now(),
                ] // Values to update or create
            );
            Mail::to($request->email)->send(new ResetPasswordMail($token));
            return redirect('/login')->with('success','Please check your inbox email adrress for change your password');
        }

    }
    public function ShowValidateForgotPass($token ){
        $DBuser = DB::table('password_reset_tokens')
        ->where('token', '=', $token)
        ->first();

        if($DBuser != null)
            return view('forgot-password-email',compact('token'));
        else
        return redirect('/')->with('error','You don`t have access for that!');
    }
    public function ShowValidateForgotPassPost(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|min:5',
            'token' => 'required|string',
        ]);
        $token = $validatedData['token'];

        $DBuser = DB::table('password_reset_tokens')
        ->where('token', 'LIKE', $token)
        ->value('email');

        if ($DBuser === $validatedData ['email']) {
            $update = DB::table('ACCOUNT')
            ->where('EMAIL', $validatedData['email'])
            ->update([
                'PASSWORD' => Hash::make($validatedData['password']),
            ]);
            DB::table('password_reset_tokens')
            ->where('token', '=', $token)
            ->delete();
            if ($update) {
                return redirect('/')->with('success', 'Password Change successful!');
            } else {
                return redirect('/')->with('error', 'Error occurred during changing password.');
            }
        }
        else{
            return redirect("/validasi-forgot-password/{$token}")->with('error', 'Enter your own email');
        }
    }
}

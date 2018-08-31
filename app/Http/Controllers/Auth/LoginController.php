<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/store';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->middleware('verify_email')->except('logout');
    }

    public function username()
    {
        return 'username';
    }


    public function authenticated()
    {
        //dd(Auth::user());
        /*
        if (Auth::attempt(['username' => Auth::user()->username, 'password' => Auth::user()->password, 'status' => 1])) {
            return redirect()->intended('dashboard');
        }
        */
        
        if (Auth::user()->status == 0) {
            Auth::logout();
        }
        
    }

/*
    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1])) {
            return redirect()->intended('store');
        }
    }
*/
}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Store;
use App\Verify_mail;
use App\Mail\VerifyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:255',
            'store_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'bank_account' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        try {
            DB::beginTransaction();

            $user = new User;
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->status = '0';
            $user->role_id = 2;
            $user->save();

            $profile = new Profile;
            $profile->name = $data['name'];
            /*if ($data['logo'] == NULL) {
                $profile->logo = 'default-logo.png';
            }else {
                $path = $data['logo']->storeAs('', time().'.'.$data['logo']->getClientOriginalExtension(), 'public');
                $profile->logo = $path;
            }*/
            $profile->contact = $data['contact'];
            $profile->address = $data['address'];
            $profile->bank_account = $data['bank_account'];
            $profile->user_id = $user->id;
            $profile->save();

            $store = new Store;
            $store->name =  $data['store_name'];
            $store->logo = 'default-logo.png';
            $store->url = 'url toko';
            $store->user_id = $user->id;
            $store->save();

            $verify = new Verify_mail;
            $verify->user_id = $user->id;
            $verify->token = $user->id.str_random(40).time();
            $verify->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

        Mail::to($user->email)->send(new VerifyEmail($verify->token));

        return $user;

        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);*/
    }
}

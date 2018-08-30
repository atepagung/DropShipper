<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use App\Woocommerce;
use App\Mail\TestingMail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Verify_mail;
use App\User;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    protected $woocommerce;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $wc = new Woocommerce;
        $this->woocommerce = $wc->woocommerce;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function aaa()
    {
        dd($this->woocommerce->get('products'));
    }

    public function send_mail()
    {
        $user = User::find(2);

        Mail::to('agungteja64@gmail.com')->send(new TestingMail($user));
    }

    public function verify_email($token)
    {
        $isValid = Verify_mail::with('user')->where('token', $token)->first();

        if ($isValid->exists) {
            try {
                DB::beginTransaction();

                $user = User::find($isValid->user->id);
                $user->status = '1';
                $user->save();

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return $e->getMessage();
            }
            return "Email berhasil diverifikasi";
        }
        return "Token tidak valid";
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;

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
        //$this->middleware('auth');
        $this->woocommerce = new Client(
            'https://codeandblue.com/main_dropship', 
            'ck_e2a5069fd4d20488637f1f4bd48bef5c1986b693', 
            'cs_e89ef23e2ce5ffbdeed449f3bba1a69ebbbf69ab',
            [
                'wp_api' => true,
                'version' => 'wc/v2',
            ]
        );
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
        dd($this->woocommerce);
    }
}

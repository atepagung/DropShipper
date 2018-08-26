<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function detail()
    {
    	$store = Store::find(Auth::user()->store->id);
    	return view('StoreDetail', ['store' => $store]);
    }
}

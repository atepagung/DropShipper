<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class StoreController extends Controller
{
    public function detail()
    {
    	$store = Store::find(Auth::user()->store->id);
    	return view('StoreDetail', ['store' => $store]);
    }

    public function update(Request $request)
    {
		if ($request->logo == NULL) {
			return redirect()->route('store-detail');
		}
    	try {
    		DB::beginTransaction();

    		$store = Store::find(Auth::user()->store->id);
    		$path = $request->logo->storeAs('', time().'.'.$request->logo->getClientOriginalExtension(), 'public');
            $store->logo = $path;
            $store->save();

    		DB::commit();
    	} catch (Exception $e) {
    		DB::rollBack();
    		return redirect()->route('store-detail');
    	}
    	return redirect()->route('store-detail');
    }
}

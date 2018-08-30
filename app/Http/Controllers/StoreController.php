<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Automattic\WooCommerce\Client;
use App\Vendor;
use App\Order;
use App\Woocommerce;

class StoreController extends Controller
{
	protected $woocommerce;

	public function __construct()
    {
        
        $wc = new Woocommerce;
        $this->woocommerce = $wc->woocommerce;
    }

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

    public function vendor_list()
    {

    	$subscribed_product = Vendor::where('store_id', Auth::user()->store->id)->get(['wc_cat_id'])->toArray();
    	$subscribed_product_id = array();
    	foreach ($subscribed_product as $value) {
    		array_push($subscribed_product_id, $value['wc_cat_id']);
    	}

    	$product_categories = $this->woocommerce->get('products/categories');

    	$subscribed = array();

    	foreach ($product_categories as $key => $value) {
    		if (in_array($value->id, $subscribed_product_id)) {
    			array_push($subscribed, $product_categories[$key]);
    			unset($product_categories[$key]);
    		}
    	}
		
    	return view('products', ['subscribed' => $subscribed, 'unsubscribed' => $product_categories]);
    }

    public function vendor_update(Request $request)
    {
    	try {
    		DB::beginTransaction();

    		Vendor::where('store_id', Auth::user()->store->id)->delete();

    		foreach ($request->category as $category) {
    			$cat = new Vendor;
    			$cat->store_id = Auth::user()->store->id;
    			$cat->wc_cat_id = $category;
    			$cat->save();
    		}

    		DB::commit();
    	} catch (Exception $e) {
    		DB::rollBack();

    		return redirect()->route('products-list');
    	}
    	return redirect()->route('products-list');
    }

    public function order_list()
    {
    	$order_list = Order::where('user_id', Auth::user()->id)->get()->toArray();

    	echo "<pre>";
    	var_dump($order_list);
    	echo "</pre>";
    	die();
    }
}

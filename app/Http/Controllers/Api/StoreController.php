<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;

class StoreController extends Controller
{

	public function addMessageSuccess($output, $message)
	{
	    return [
	        'status' => 'OK',
	        'message' => $message,
	        'result' => $output
	    ];
	}

	public function addMessageFailed($message)
	{
	    return [
	        'status' => 'Fail',
	        'message' => $message
	    ];
	}

    public function detail($id)
    {	
    	//$store = Store::with('user')->get();
    	$store = Store::with('user')->find($id);
    	
    	if ($store == NULL) {
    		$output = $this->addMessageFailed('Store tidak ditemukan');

    		return response()->json($output, 400);
    	}

    	$output = $this->addMessageSuccess($store->toArray(), 'Success');

    	return response()->json($output);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;
use Automattic\WooCommerce\Client;
use App\Order;
use App\Woocommerce;

class OrderController extends Controller
{

	protected $woocommerce;

	public function __construct()
    {
        $wc = new Woocommerce;
        $this->woocommerce = $wc->woocommerce;
    }

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

	public function add(Request $request)
	{
		try {
			$checkOrder = $this->woocommerce->get('orders/'.$request->order_id);
		} catch (Exception $e) {
			$output = $this->addMessageFailed('ID order tidak ditemukan');
			return response()->json($output, 400);
		}
		
		try {
			DB::beginTransaction();

			$order = new Order;
			$order->user_id = $request->user_id;
			$order->order_id = $request->order_id;
			$order->commission_status = '0';

			$order->save();

			DB::commit();

		} catch (Exception $e) {
			DB::rollBack();
			
            $output = $this->addMessageFailed('Order tidak berhasil ditambahkan');

    		return response()->json($output, 400);
		}

		$output = $this->addMessageSuccess($order->toArray(), 'Order berhasil ditambahkan');

		return response()->json($output, 200);
	}
}

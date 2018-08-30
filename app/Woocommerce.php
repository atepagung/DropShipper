<?php 

namespace App;

use Automattic\WooCommerce\Client;
/**
 * 
 */
class Woocommerce 
{
	public $woocommerce;

	function __construct()
	{
		$this->woocommerce = new Client(
			'https://codeandblue.com/main_dropship', 
        	'ck_e2a5069fd4d20488637f1f4bd48bef5c1986b693', 
        	'cs_e89ef23e2ce5ffbdeed449f3bba1a69ebbbf69ab',
        	[
            	'wp_api' => true,
            	'version' => 'wc/v2',
            	'timeout' =>100
        	]
		);
	}
}
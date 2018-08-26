<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/a', 'HomeController@aaa');

Route::get('/store', 'StoreController@detail')->name('store-detail')->middleware('auth');
Route::post('/store', 'StoreController@update')->name('store-update');

Route::get('/profile', 'ProfileController@detail')->name('profile-detail')->middleware('auth');
Route::post('/profile', 'ProfileController@update')->name('profile-update');

use Automattic\WooCommerce\HttpClient\HttpClientException;

Route::get('/wcc', function () {

	$woocommerce = new Client(
	    'https://codeandblue.com/main_dropship/wp-json', 
	    'ck_e2a5069fd4d20488637f1f4bd48bef5c1986b693', 
	    'cs_e89ef23e2ce5ffbdeed449f3bba1a69ebbbf69ab'
	);

    try {
        // Array of response results.
        $results = $woocommerce->get('customers');
        // Example: ['customers' => [[ 'id' => 8, 'created_at' => '2015-05-06T17:43:51Z', 'email' => ...

        // Last request data.
        $lastRequest = $woocommerce->http->getRequest();
        $lastRequest->getUrl(); // Requested URL (string).
        $lastRequest->getMethod(); // Request method (string).
        $lastRequest->getParameters(); // Request parameters (array).
        $lastRequest->getHeaders(); // Request headers (array).
        $lastRequest->getBody(); // Request body (JSON).

        // Last response data.
        $lastResponse = $woocommerce->http->getResponse();
        $lastResponse->getCode(); // Response code (int).
        $lastResponse->getHeaders(); // Response headers (array).
        $lastResponse->getBody(); // Response body (JSON).

    } catch (HttpClientException $e) {
        $e->getMessage(); // Error message.
        $e->getRequest(); // Last request data.
        $e->getResponse(); // Last response data.
        dd($e->getMessage());
    }
    
});


Route::get('/home', 'HomeController@index')->name('home');

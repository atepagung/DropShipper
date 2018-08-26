<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendor_woocom';

    protected $fillable = [
        'wc_cat_id', 'store_id'
    ];

    public function store()
    {
    	return $this->belongsTo('App/Store');
    }
}

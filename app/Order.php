<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order_commission';

    protected $fillable = [
        'user_id', 'order_id', 'commission_status',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

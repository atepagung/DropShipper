<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';

    protected $fillable = [
        'name', 'logo', 'url', 'user_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function vendor()
    {
    	return $this->hasMany(Vendor::class);
    }

}

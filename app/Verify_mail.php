<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verify_mail extends Model
{
    protected $table = 'verify_mail';

    protected $fillable = [
        'user_id', 'token'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

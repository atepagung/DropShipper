<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'path', 'type', 'status'
    ];
}

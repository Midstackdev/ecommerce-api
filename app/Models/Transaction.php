<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    	'total'
    ];

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
}

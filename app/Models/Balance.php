<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;
    
    public function getAmountAttribute()
    {
        $am =  $this->attributes['amount'];
        
        return number_format($am, 2, '.', ',');
    }

    public static function amount()
    {
        $am = auth()->user()->balance->amount;

        return $am ? $am : 0;
    }
}

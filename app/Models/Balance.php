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

    public function deposit(float $vl) : Array
    {
        $this->amount += number_format($vl, 2, '.', ',');

        if ($this->save()) {
           return [
               'success' => true,
               'message' => 'Deposit successful'
           ];
        }

        return [
            'success' => false,
            'message' => 'Deposit failed'
        ];
    }
}

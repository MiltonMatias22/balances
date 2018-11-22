<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
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

        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;

        $this->amount += number_format($vl, 2, '.', ',');
        $dep = $this->save();

        $hist = auth()->user()->historics()->create([
            'type'          => 'I',
            'amount'        => $vl,
            'total_before'  =>$totalBefore,
            'total_after'   => $this->amount,
            'date'          => date('Ymd'),
        ]);

        if ($dep && $hist) {
            
            DB::commit();
           
            return [
                'success' => true,
                'message' => 'Deposit successful'
            ];

        }else {          

            DB::rollback();

            return [
                'success' => false,
                'message' => 'Deposit failed'
            ];

        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Balance extends Model
{
    protected $fillable = ['amount'];

    public $timestamps = false;
    
    public function getAmountAttribute($value)
    {
        return  number_format($value, 2, '.', ',');
    }

    public static function amount()
    {
        $am = auth()->user()->balance;

        return $am ? $am->amount : 0;
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

        if ($dep && $hist->wasRecentlyCreated) {
            
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

    public function withdraw(float $vl) : Array
    {
        
        $am = $this->amount;

        if ($am < $vl || $vl <= 0) {
            return [
                'success' => false,
                'message' => "Current balance: $am  Reported value: $vl"
            ];
        }

        DB::beginTransaction();

        $totalBefore = $am ? $am : 0;

        $this->amount -= number_format($vl, 2, '.', ',');
        
        $dep = $this->save();

        $hist = auth()->user()->historics()->create([
            'type'          => 'O',
            'amount'        => $vl,
            'total_before'  => $totalBefore,
            'total_after'   => $this->amount,
            'date'          => date('Ymd'),
        ]);
        
        if ($dep && $hist->wasRecentlyCreated) {

            DB::commit();
           
            return [
                'success' => true,
                'message' => 'Cash out successful'
            ];

        }else {          

            DB::rollback();

            return [
                'success' => false,
                'message' => 'Cash out failed'
            ];
        }
    }
}

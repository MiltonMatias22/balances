<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

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

    public function confirm(float $vl, int $sender_id) : array
    {
        $am = $this->amount;
        
        if ($am < $vl || $vl <= 0) {
            return [
                'success' => false,
                'message' => "Current balance: $am  Reported value: $vl"
            ];
        }
        
        $sender = User::find($sender_id);
        
        if (!$sender) {
            return [
                'success' => false,
                'message' => "Sender not found!"
            ];
        }

        DB::beginTransaction();

        /********************************************************
         * owner account
         ********************************************************/

        $totalBefore = $am ? $am : 0;
        
        $this->amount -= number_format($vl, 2, '.', ',');
        
        $owner_deposit = $this->save();
        
        $owner_historic = auth()->user()->historics()->create([
            'type'                  => 'T',
            'amount'                => $vl,
            'total_before'          => $totalBefore,
            'total_after'           => $this->amount,
            'user_id_transaction'   => $sender_id,
            'date'                  => date('Ymd'),
        ]);
        
        /********************************************************
         * Transfer to sender account
         ********************************************************/
        
        $sender_ba = $sender->balance()->firstOrCreate([]);
        
        $totalBefore_sender = $sender_ba->amount ? $sender_ba->amount : 0;
        
        $sender_ba->amount += number_format($vl, 2, '.', ',');

        $sender_deposit = $sender_ba->save();

        $sender_historic = $sender->historics()->create([
            'type'                  => 'I',
            'amount'                => $vl,
            'total_before'          => $totalBefore_sender,
            'total_after'           => $sender_ba->amount,
            'user_id_transaction'   => auth()->user()->id,
            'date'                  => date('Ymd'),
        ]);

        if (
            $owner_deposit &&  $owner_historic->wasRecentlyCreated
            &&
            $sender_deposit && $sender_historic->wasRecentlyCreated
            ) {

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

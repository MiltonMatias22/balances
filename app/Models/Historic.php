<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Historic extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'total_before',
        'total_after',
        'user_id_transaction',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userSender()
    {
        return $this->belongsTo(User::class, 'user_id_transaction');
    }

    public function getTypeAttribute($value)
    {        
        $types = [
            'I' => 'Deposit',
            'O' => 'withdraw',
            'T' => 'Transfer'
        ];

        if ($this->user_id_transaction != null && $value == 'I') {
            return 'received';
        }

        return $types[$value];
    }

    public function getAmountAttribute($value)
    {
        return number_format($value, 2, '.', ',');
    }

    public function getTotalBeforeAttribute($value)
    {
        return number_format($value, 2, '.', ',');
    }

    public function getTotalAfterAttribute($value)
    {
        return number_format($value, 2, '.', ',');
    }
    
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y/m/d');
    }
}

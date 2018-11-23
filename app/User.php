<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Balance;
use App\Models\Historic;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    public function historics()
    {
        return $this->hasMany(Historic::class);
    }

    public function getSender($sender)
    {
        $user = $this->where('name','LIKE', "%$sender%")
                ->orWhere('email',$sender)
                ->get()
                ->first();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Name or E-mal not found!'
            ];
        }
        if ($user->id === auth()->user()->id) {
            return [
                'success' => false,
                'message' => 'You can\'t transfer to yourself'
            ];
        }

        return $user;
    }
}

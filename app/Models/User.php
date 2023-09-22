<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, Wallet
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastName',
        'phone',
        'sponsorCode',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function asignProfile()
    {
        return $this->hasOne(AsignProfile::class, 'user_id');
    }

    public function orderPayments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function eWallet()
    {
        return $this->hasOne(EWallet::class, 'user_id');
    }

    public function totalWithdraw()
    {
        $user = Auth::user();

        $created = $user->created_at;
        $now = Carbon::now();

        $difference = $now->diffInDays($created);
        
        if ($difference > 60) {
            return true;
        } else {
            return false;
        }
    }
}

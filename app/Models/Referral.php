<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'child',
        'grandchild',
        'referral_code',
        'profit_referral',
        'status',
    ];
    protected $table = 'referrals';
}

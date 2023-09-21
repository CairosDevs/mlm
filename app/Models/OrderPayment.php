<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'external_payment_id',
        'user_id',
        'amount',
        'paid_amount',
        'paid_at',
        'type',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'paid_at' => 'datetime:d-m-Y',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

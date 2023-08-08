<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'dni',
        'country',
        'placeBirth',
        'birthdate',
        'address',
        'PostalCode',
        'digitalContract',
        'status',
    ];

    protected $table = 'asign_profile';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

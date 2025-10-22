<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'year',
        'month',
        'target_units',
        'target_amount',
    ];

    /**
     * Relasi: Target ini milik siapa.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
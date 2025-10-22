<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'product_id',
        'user_id',
        'quantity',
        'notes',
    ];

    // Definisikan relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Definisikan relasi ke User (siapa yang mencatat/menerima)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'cost',
        'stock_quantity',
    ];

    // Nanti kita akan tambahkan relasi ke SaleOrder di sini
}
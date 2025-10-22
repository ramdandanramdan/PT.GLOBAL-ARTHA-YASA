<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SaleOrder; // Import Model SaleOrder untuk relasi

class Customer extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'category', // Contoh: 'retail', 'wholesale', dll.
    ];

    // ---

    /**
     * Relasi: Mendapatkan semua order penjualan untuk customer ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleOrders()
    {
        // Mengasumsikan SaleOrder memiliki kolom 'customer_id' yang sesuai.
        return $this->hasMany(SaleOrder::class);
    }
}
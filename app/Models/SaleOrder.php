<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Import Models yang digunakan untuk relasi
use App\Models\User;
use App\Models\Customer;
use App\Models\Product;

class SaleOrder extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',       // ID Sales yang membuat order
        'customer_id',   // ID Customer yang membeli
        'order_date',
        'total_amount',
        'status',        // Contoh: 'pending', 'paid', 'shipped'
    ];

    /**
     * Konversi tipe data untuk atribut.
     *
     * Kolom 'order_date' harus diubah menjadi objek Carbon.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'float', // Opsional, untuk memastikan tipe data numerik
    ];

    // --- RELASI BELONGS TO ---

    /**
     * Relasi: Mendapatkan user (sales) yang membuat order penjualan ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Mendapatkan customer yang melakukan order penjualan ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // --- RELASI BELONGS TO MANY ---

    /**
     * Relasi: Mendapatkan semua produk yang termasuk dalam order ini.
     *
     * Ini adalah relasi Many-to-Many menggunakan tabel pivot 'sale_order_product'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_order_product')
            ->withPivot('quantity', 'unit_price', 'subtotal');
    }
}
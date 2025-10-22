<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Pastikan Anda telah mengimpor Model User jika berada di namespace yang berbeda (walaupun biasanya di App\Models juga)
// use App\Models\User; // Jika User berada di App\Models

class Attendance extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'date',
        'status',
        'notes',
    ];

    /**
     * Konversi tipe data untuk atribut.
     *
     * Kami menentukan bahwa kolom 'date' harus diubah menjadi objek Carbon.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
    ];

    // ---

    /**
     * Relasi: Mendapatkan user yang memiliki absensi ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // Diasumsikan Model User berada di namespace App\Models\User
        // Jika tidak, pastikan Anda menggunakan namespace yang benar di bagian atas.
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // HAPUS/KOMENTARI BARIS INI
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Import Models yang direlasikan
use App\Models\Role;
use App\Models\SaleOrder;
use App\Models\Attendance;
use App\Models\Target;
// use App\Models\UserProfile; // Hapus komentar jika Model ini digunakan

// HAPUS 'implements MustVerifyEmail' dari deklarasi kelas
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'is_active',   // Status akun (aktif/nonaktif)
        'total_sales', // Ditambahkan dari migrasi
        'target',      // Ditambahkan dari migrasi
    ];

    /**
     * Atribut yang harus disembunyikan saat serialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'total_sales' => 'integer',
        'target' => 'integer',
        'password' => 'hashed', // Otomatisasi hashing (Laravel 10+)
    ];

    // -------------------------------------------------------------------------
    // RELASI (RELATIONSHIPS)
    // -------------------------------------------------------------------------

    /**
     * Relasi BelongsTo: User memiliki satu Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relasi HasMany: User (sebagai Sales) memiliki banyak SaleOrder.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleOrders()
    {
        return $this->hasMany(SaleOrder::class, 'user_id');
    }

    /**
     * Relasi HasMany: User memiliki banyak data Absensi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Relasi HasMany: User memiliki banyak Target.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function targets()
    {
        return $this->hasMany(Target::class);
    }

    // -------------------------------------------------------------------------
    // HELPER METHODS (Business Logic/Role Checking)
    // -------------------------------------------------------------------------

    /**
     * Cek apakah user memiliki Role tertentu.
     *
     * @param string $roleName Nama role yang akan dicek.
     * @return bool
     */
    public function hasRole(string $roleName): bool
    {
        // Mengecek role dengan mengkonversi ke huruf kecil untuk konsistensi
        return optional($this->role)->name === strtolower($roleName);
    }

    /**
     * Cek apakah user adalah Founder.
     *
     * @return bool
     */
    public function isFounder(): bool
    {
        return $this->hasRole('founder');
    }

    /**
     * Cek apakah user adalah Manager.
     *
     * @return bool
     */
    public function isManager(): bool
    {
        return $this->hasRole('manager');
    }
}
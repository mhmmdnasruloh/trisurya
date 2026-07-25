<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'fullname',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke Customers yang di-create oleh user ini
    public function customers()
    {
        return $this->hasMany(Customer::class, 'created_by', 'id');
    }

    // Relasi ke Quotations yang di-buat oleh user ini (sebagai Sales)
    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'sales_id', 'id');
    }

    // --- Role Helpers ---

    public function isManager()
    {
        return in_array(strtolower($this->role), ['manager', 'owner']);
    }

    public function isAdmin()
    {
        return strtolower($this->role) === 'admin';
    }

    public function isSales()
    {
        return strtolower($this->role) === 'sales';
    }

    public function hasFullAccess()
    {
        return $this->isManager() || $this->isAdmin();
    }
}

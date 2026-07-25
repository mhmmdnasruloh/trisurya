<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model {
    protected $guarded = [];
    public $timestamps = false;

    // Relasi ke User yang create customer ini
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    
    // Relasi ke Quotation (customer punya banyak quotation)
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}

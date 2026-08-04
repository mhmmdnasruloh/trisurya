<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class DeliveryNote extends Model {
    protected $guarded = [];
    public $timestamps = true;

    public function invoice() { return $this->belongsTo(Invoice::class); }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

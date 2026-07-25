<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class DeliveryNote extends Model {
    protected $guarded = [];
    public $timestamps = false;
    public function invoice() { return $this->belongsTo(Invoice::class); }
}

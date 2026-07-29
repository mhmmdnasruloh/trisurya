<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Quotation extends Model {
    protected $guarded = [];
    public $timestamps = false;
    public function items() { return $this->hasMany(QuotationItem::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function sales() { return $this->belongsTo(User::class, 'sales_id'); }
}

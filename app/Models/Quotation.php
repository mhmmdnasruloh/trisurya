<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Quotation extends Model {
    protected $guarded = [];
    public $timestamps = true;

    public function items() { return $this->hasMany(QuotationItem::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function sales() { return $this->belongsTo(User::class, 'sales_id'); }
    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by'); }
    public function statusHistories() { return $this->hasMany(QuotationStatusHistory::class); }
}

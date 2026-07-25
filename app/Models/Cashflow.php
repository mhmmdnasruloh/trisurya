<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cashflow extends Model {
    protected $table = 'cashflow';
    protected $guarded = [];
    public $timestamps = false;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'source_id')->where('source', 'payment');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Invoice extends Model {
    protected $guarded = [];
    public $timestamps = false;

    public function quotation() { return $this->belongsTo(Quotation::class); }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function cashflows()
    {
        return $this->hasMany(Cashflow::class, 'invoice_id');
    }

    /**
     * Calculate outstanding amount
     */
    public function getOutstandingAttribute()
    {
        return $this->total - ($this->paid_amount ?? 0);
    }

    /**
     * Check if invoice is fully paid
     */
    public function isPaid()
    {
        return $this->paid_amount >= $this->total;
    }

    /**
     * Check if invoice is partially paid
     */
    public function isPartiallPaid()
    {
        return $this->paid_amount > 0 && $this->paid_amount < $this->total;
    }

    /**
     * Recalculate status based on payments
     */
    public function recalculateStatus()
    {
        if ($this->status === 'Dibatalkan') {
            return; // Jangan diubah kalau dibatalkan
        }

        if ($this->paid_amount >= $this->total) {
            $this->status = 'Lunas';
        } elseif ($this->paid_amount > 0) {
            $this->status = 'DP';
        } else {
            $this->status = 'Belum Bayar';
        }

        $this->save();
    }
}

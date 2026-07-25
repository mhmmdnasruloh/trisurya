<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Cashflow;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first 3 invoices and create sample payments
        $invoices = Invoice::limit(3)->get();

        foreach ($invoices as $index => $invoice) {
            if ($index === 0) {
                // First invoice: Full payment
                $payment = Payment::create([
                    'invoice_id' => $invoice->id,
                    'amount' => $invoice->total_price,
                    'method' => 'transfer',
                    'paid_at' => now()->subDays(5),
                    'note' => 'Pembayaran penuh - Transfer Bank BCA',
                    'created_by' => 2, // Assuming user with id 2 exists
                ]);

                // Update invoice
                $invoice->update([
                    'paid_amount' => $payment->amount,
                    'status' => 'paid',
                ]);

                // Create cashflow entry
                Cashflow::create([
                    'date' => $payment->paid_at,
                    'type' => 'income',
                    'amount' => $payment->amount,
                    'note' => "Payment untuk Invoice #{$invoice->id} - {$payment->note}",
                    'source' => 'payment',
                    'source_id' => $payment->id,
                    'created_by' => 2,
                    'invoice_id' => $invoice->id,
                ]);
            } elseif ($index === 1) {
                // Second invoice: DP (50%)
                $dpAmount = $invoice->total_price * 0.5;
                $payment = Payment::create([
                    'invoice_id' => $invoice->id,
                    'amount' => $dpAmount,
                    'method' => 'cash',
                    'paid_at' => now()->subDays(3),
                    'note' => 'DP 50% - Pembayaran Tunai',
                    'created_by' => 2,
                ]);

                // Update invoice
                $invoice->update([
                    'paid_amount' => $payment->amount,
                    'status' => 'partially_paid',
                ]);

                // Create cashflow entry
                Cashflow::create([
                    'date' => $payment->paid_at,
                    'type' => 'income',
                    'amount' => $payment->amount,
                    'note' => "Payment untuk Invoice #{$invoice->id} - {$payment->note}",
                    'source' => 'payment',
                    'source_id' => $payment->id,
                    'created_by' => 2,
                    'invoice_id' => $invoice->id,
                ]);
            } else {
                // Third invoice: No payment yet
                $invoice->update([
                    'paid_amount' => 0,
                    'status' => 'issued',
                ]);
            }
        }

        echo "Payment seeder completed!\n";
    }
}

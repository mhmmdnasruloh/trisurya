<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Invoice;
use App\Models\DeliveryNote;
use App\Models\Cashflow;
use App\Models\User;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DummySalesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $tables = ['quotation_items', 'quotations', 'invoices', 'delivery_notes', 'cashflow', 'products', 'customers'];
        foreach ($tables as $t) {
            if (Schema::hasTable($t)) {
                DB::table($t)->truncate();
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $productNames = [
            'Timbangan Platform',
            'Timbangan Lantai (Floor Scale)',
            'Timbangan Meja (Bench Scale)',
            'Timbangan Duduk',
            'Timbangan Gantung (Crane Scale)',
            'Jembatan Timbang (Truck Scale)',
            'Timbangan Pallet',
            'Timbangan Hand Pallet',
            'Checkweigher',
            'Timbangan Conveyor',
            'Belt Scale',
            'Hopper Scale',
            'Silo Scale',
            'Tank Scale',
            'Batching Scale',
            'Bagging Scale',
            'Packing Scale',
            'Counting Scale',
            'Analytical Balance',
            'Laboratory Balance',
            'Waterproof Scale',
            'Explosion Proof Scale',
            'Drum Scale',
            'Livestock Scale',
            'Multihead Weigher',
            'Roller Scale',
            'Axle Scale',
            'Portable Floor Scale',
            'U-Shape Floor Scale',
            'Low Profile Floor Scale',
            'Wheel Weigher',
            'Rail Scale',
            'Forklift Scale',
            'Coil Scale',
            'Barrel Scale',
            'Bag Scale',
            'Filling Scale',
            'Net Weigh Scale',
            'Gross Weigh Scale',
            'Precision Balance',
            'Moisture Analyzer',
            'Jewelry Scale',
            'Postal Scale',
            'Parcel Scale',
            'Hanging Dial Scale',
            'Digital Hanging Scale',
            'Bench Counting Scale',
            'Animal Platform Scale',
            'Washdown Scale',
            'Dynamic Checkweigher',
            'Static Checkweigher',
            'Load Cell Weighing System',
        ];

        $backupProducts = [
            ['code' => 'PK1200', 'name' => 'PK1200', 'price' => 7205000, 'stock' => 0],
            ['code' => 'PK2200', 'name' => 'PK2200', 'price' => 7810000, 'stock' => 0],
            ['code' => 'PK3200', 'name' => 'PK3200', 'price' => 9075000, 'stock' => 0],
            ['code' => 'PK4200', 'name' => 'PK4200', 'price' => 12430000, 'stock' => 0],
            ['code' => 'PK5200', 'name' => 'PK5200', 'price' => 14850000, 'stock' => 0],
            ['code' => 'PK6200', 'name' => 'PK6200', 'price' => 17050000, 'stock' => 0],
            ['code' => 'PH1201', 'name' => 'PH1201', 'price' => 6500000, 'stock' => 0],
            ['code' => 'PH2201', 'name' => 'PH2201', 'price' => 6750000, 'stock' => 0],
            ['code' => 'PH3201', 'name' => 'PH3201', 'price' => 7000000, 'stock' => 0],
            ['code' => 'PH4201', 'name' => 'PH4201', 'price' => 9500000, 'stock' => 0],
            ['code' => 'PH5201', 'name' => 'PH5201', 'price' => 9700000, 'stock' => 0],
            ['code' => 'PH6201', 'name' => 'PH6201', 'price' => 9800000, 'stock' => 0],
            ['code' => 'PH8201', 'name' => 'PH8201', 'price' => 10200000, 'stock' => 0],
            ['code' => 'PH10001', 'name' => 'PH10001', 'price' => 10500000, 'stock' => 0],
            ['code' => 'PH1202', 'name' => 'PH1202', 'price' => 8500000, 'stock' => 0],
            ['code' => 'PH2202', 'name' => 'PH2202', 'price' => 9500000, 'stock' => 0],
            ['code' => 'PH3202', 'name' => 'PH3202', 'price' => 11400000, 'stock' => -5],
            ['code' => 'PH4202', 'name' => 'PH4202', 'price' => 11800000, 'stock' => 0],
            ['code' => 'PH5202', 'name' => 'PH5202', 'price' => 1320000, 'stock' => 0],
            ['code' => 'PH6202', 'name' => 'PH6202', 'price' => 13500000, 'stock' => 0],
            ['code' => 'PH8202', 'name' => 'PH8202', 'price' => 17500000, 'stock' => 0],
            ['code' => 'PH220', 'name' => 'PH220', 'price' => 9700000, 'stock' => 0],
            ['code' => 'PH320', 'name' => 'PH320', 'price' => 10000000, 'stock' => 0],
            ['code' => 'PH520', 'name' => 'PH520', 'price' => 10500000, 'stock' => 0],
            ['code' => 'PR620', 'name' => 'PR620', 'price' => 5500000, 'stock' => 0],
            ['code' => 'PR1200', 'name' => 'PR1200', 'price' => 7500000, 'stock' => 0],
            ['code' => 'PR2200', 'name' => 'PR2200', 'price' => 7500000, 'stock' => 0],
            ['code' => 'PR3200', 'name' => 'PR3200', 'price' => 8100000, 'stock' => 0],
            ['code' => 'PR3002', 'name' => 'PR3002', 'price' => 8100000, 'stock' => 0],
            ['code' => 'BP7W', 'name' => 'BP7W', 'price' => 46707500, 'stock' => 1],
            ['code' => 'BP7W 30KD', 'name' => 'BP7W 30KD', 'price' => 9000000, 'stock' => 1],
            ['code' => 'PW4001', 'name' => 'Custom 1', 'price' => 7500000, 'stock' => 0],
            ['code' => 'AW224E', 'name' => 'AW224E', 'price' => 26500000, 'stock' => 0],
            ['code' => 'BP7W 30KD2', 'name' => 'BP7W KD 2', 'price' => 11000000, 'stock' => 0],
            ['code' => 'BP7W 300K', 'name' => 'BP7W 300K', 'price' => 8250000, 'stock' => 0],
            ['code' => 'BP7W 150K', 'name' => 'BP7W 150K', 'price' => 7000000, 'stock' => 0],
            ['code' => 'BP7W 100K', 'name' => 'BP7W 100K', 'price' => 5830000, 'stock' => 0],
            ['code' => 'BP7W 60K', 'name' => 'BP7W 60K', 'price' => 5830000, 'stock' => 0],
            ['code' => 'BP7W 30K', 'name' => 'BP7W 30K', 'price' => 5830000, 'stock' => 0],
            ['code' => 'BP7W 150KD', 'name' => 'BP7W 150KD', 'price' => 11000000, 'stock' => 0],
            ['code' => 'BP7W 100KD', 'name' => 'BP7W 100KD', 'price' => 9000000, 'stock' => 0],
            ['code' => 'BP7W 60KD1', 'name' => 'BP7W 60KD1', 'price' => 11000000, 'stock' => 0],
            ['code' => 'BP7W 60KD2', 'name' => 'BP7W 60KD2', 'price' => 9000000, 'stock' => 0],
            ['code' => 'BP7C 300K', 'name' => 'BP7C 300K', 'price' => 8750000, 'stock' => 0],
            ['code' => 'BP7C 150K', 'name' => 'BP7C 150K', 'price' => 7500000, 'stock' => 0],
            ['code' => 'BP7C 100K', 'name' => 'BP7C 100K', 'price' => 6330000, 'stock' => 0],
            ['code' => 'BP7C 60K', 'name' => 'BP7C 60K', 'price' => 6330000, 'stock' => 0],
            ['code' => 'BP7C 30K', 'name' => 'BP7C 30K', 'price' => 6330000, 'stock' => 0],
            ['code' => 'BP7C 150KD', 'name' => 'BP7C 150KD', 'price' => 11500000, 'stock' => 0],
            ['code' => 'BP7C 100KD', 'name' => 'BP7C 100KD', 'price' => 9500000, 'stock' => 0],
            ['code' => 'BP7C 60KD', 'name' => 'BP7C 60KD', 'price' => 9500000, 'stock' => 0],
            ['code' => 'BP7C 30KD', 'name' => 'BP7C 30KD', 'price' => 9500000, 'stock' => 0],
        ];

        $uniqueProducts = [];
        foreach ($backupProducts as $definition) {
            $code = trim($definition['code']);
            if (isset($uniqueProducts[$code])) {
                continue;
            }
            $uniqueProducts[$code] = $definition;
        }

        $products = [];
        $productIndex = 0;
        foreach ($uniqueProducts as $definition) {
            $productName = $productNames[$productIndex % count($productNames)];
            $productIndex++;

            $products[] = Product::create([
                'code' => trim($definition['code']),
                'name' => $productName,
                'price' => $definition['price'],
                'stock' => 50,
                'description' => $definition['description'] ?? '',
            ]);
        }

        $companyNames = $this->getCompanyNames();
        shuffle($companyNames);

        $customers = [];
        for ($i = 0; $i < 150; $i++) {
            $companyName = $companyNames[$i];
            $company = $this->cleanCompanyName($companyName);
            $phone = $this->generatePhone();
            $slug = $this->slugify($company);
            $customers[] = Customer::create([
                'name' => $companyName,
                'address' => $faker->address(),
                'phone' => $phone,
                'email' => "info@{$slug}.co.id",
                'pic_name' => $companyName,
                'pic_phone' => $phone,
                'pic_email' => "pic@{$slug}.co.id",
                'created_by' => null,
                'npwp' => $this->randomNpwp(),
            ]);
        }

        $salesUsers = User::where('role', 'Sales')->get();
        if ($salesUsers->isEmpty()) {
            $salesUsers = User::take(5)->get();
        }

        $start = Carbon::create(2025, 5, 1);
        $end = Carbon::now();
        $diffDays = $start->diffInDays($end);
        $targetSales = 220;
        $interval = $diffDays / max(1, $targetSales - 1);

        $quotationSequence = [];
        $invoiceSequence = [];

        for ($n = 0; $n < $targetSales; $n++) {
            $offsetDays = min((int) round($n * $interval), $diffDays);
            $quotationDate = $start->copy()->addDays($offsetDays);
            $dateStr = $quotationDate->toDateString();

            $customer = $faker->randomElement($customers);
            $sales = $faker->randomElement($salesUsers);
            $year = $quotationDate->year;

            if (!isset($quotationSequence[$year])) {
                $quotationSequence[$year] = 0;
            }
            $quotationSequence[$year]++;
            $quoNumber = sprintf('QUO-%d-%04d', $year, $quotationSequence[$year]);

            // Status logic:
            // ~60% Closed (clear, dana masuk semua)
            // ~30% Approved (masih proses, bisa ada piutang)
            // ~10% Open (belum ada invoice)
            $rand = $faker->numberBetween(1, 100);
            if ($rand <= 60) {
                $quotationStatus = 'Closed';
            } elseif ($rand <= 90) {
                $quotationStatus = 'Approved';
            } else {
                $quotationStatus = 'Open';
            }

            $approvedDate = null;
            $closedDate = null;

            if ($quotationStatus === 'Closed') {
                $approvedDate = $quotationDate->copy()->addDays($faker->numberBetween(1, 5))->toDateString();
                $closedDate = $quotationDate->copy()->addDays($faker->numberBetween(10, 30))->toDateString();
            } elseif ($quotationStatus === 'Approved') {
                $approvedDate = $quotationDate->copy()->addDays($faker->numberBetween(1, 7))->toDateString();
            }

            $quotation = Quotation::create([
                'number' => $quoNumber,
                'customer_id' => $customer->id,
                'sales_id' => $sales->id ?? null,
                'date' => $dateStr,
                'approved_date' => $approvedDate,
                'closed_date' => $closedDate,
                'status' => $quotationStatus,
                'total' => 0,
            ]);

            $itemsCount = $faker->numberBetween(1, 3);
            $total = 0;
            $usedProductIds = [];
            for ($j = 0; $j < $itemsCount; $j++) {
                $product = $faker->randomElement($products);
                if (in_array($product->id, $usedProductIds)) {
                    continue;
                }
                $usedProductIds[] = $product->id;

                $qty = $faker->numberBetween(1, 5);
                $price = $product->price;
                $discount = $qty >= 3 ? $faker->numberBetween(5, 15) : 0;

                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'discount' => $discount,
                ]);

                Product::where('id', $product->id)->decrement('stock', $qty);
                $total += ($price * $qty) * (1 - $discount / 100);
            }

            $quotation->update(['total' => round($total)]);

            // Open = no invoice, no delivery
            if ($quotationStatus === 'Open') {
                continue;
            }

            if (!isset($invoiceSequence[$year])) {
                $invoiceSequence[$year] = 0;
            }
            $invoiceSequence[$year]++;
            $invNumber = sprintf('INV-%d-%04d', $year, $invoiceSequence[$year]);

            $invoiceDate = $quotationDate->copy()->addDays($faker->numberBetween(1, 5));
            $dueDate = $invoiceDate->copy()->addDays($faker->numberBetween(7, 15));

            if ($quotationStatus === 'Closed') {
                // Closed = dana sudah masuk semua, invoice Lunas, paid_amount = total
                $invoiceStatus = 'Lunas';
                $paidAmount = round($total);
                $invoiceTotal = round($total);
            } else {
                // Approved = masih proses, bisa Lunas, DP, atau Belum Bayar
                $invoiceRand = $faker->numberBetween(1, 100);
                if ($invoiceRand <= 30) {
                    // 30% of Approved = Lunas (sudah bayar tapi quotation belum di-close)
                    $invoiceStatus = 'Lunas';
                    $invoiceTotal = round($total);
                    $paidAmount = round($total);
                } elseif ($invoiceRand <= 70) {
                    // 40% of Approved = DP (ada piutang)
                    $invoiceStatus = 'DP';
                    $dpPercent = $faker->numberBetween(30, 70);
                    $invoiceTotal = round($total);
                    $paidAmount = round($total * $dpPercent / 100);
                } else {
                    // 30% of Approved = Belum Bayar (piutang penuh)
                    $invoiceStatus = 'Belum Bayar';
                    $invoiceTotal = round($total);
                    $paidAmount = 0;
                }
            }

            $invoice = Invoice::create([
                'number' => $invNumber,
                'quotation_id' => $quotation->id,
                'date' => $invoiceDate->toDateString(),
                'due_date' => $dueDate->toDateString(),
                'status' => $invoiceStatus,
                'payment_terms' => '30 hari',
                'po_number' => 'PO' . strtoupper(substr($this->slugify($customer->name), 0, 5)) . rand(1000, 9999),
                'notes' => 'Tagihan untuk ' . $customer->name,
                'revision' => 0,
                'total' => $invoiceTotal,
                'paid_amount' => $paidAmount,
                'dp_percentage' => $invoiceStatus === 'DP' ? round(($paidAmount / max($invoiceTotal, 1)) * 100) : null,
                'non_vat' => 0,
            ]);

            DeliveryNote::create([
                'number' => sprintf('SJ-%d-%04d', $year, $invoiceSequence[$year]),
                'invoice_id' => $invoice->id,
                'date' => $invoiceDate->copy()->addDays(1)->toDateString(),
                'pic_name' => $customer->pic_name,
                'pic_phone' => $customer->pic_phone,
                'status' => 'Delivered',
                'po_number' => $invoice->po_number,
                'notes' => 'Pengiriman untuk ' . $customer->name,
                'serial_numbers' => null,
                'has_stock_deducted' => 1,
                'shipping_address' => $customer->address,
            ]);

            $customerName = $customer->name;

            // Cashflow entries
            if ($invoiceStatus === 'Lunas') {
                // Full payment income
                Cashflow::create([
                    'tanggal' => $invoiceDate->toDateString(),
                    'jenis' => 'Income',
                    'nominal' => $invoiceTotal,
                    'keterangan' => "Invoice {$invoice->number} dari {$customerName}",
                    'kategori' => 'Penjualan Produk',
                    'sumber_dana' => 'Invoice',
                    'invoice_id' => $invoice->id,
                ]);
            } elseif ($invoiceStatus === 'DP') {
                // DP payment income (partial)
                Cashflow::create([
                    'tanggal' => $invoiceDate->toDateString(),
                    'jenis' => 'Income',
                    'nominal' => $paidAmount,
                    'keterangan' => "DP {$invoice->number} dari {$customerName}",
                    'kategori' => 'DP Invoice',
                    'sumber_dana' => 'DP',
                    'invoice_id' => $invoice->id,
                ]);
            }
            // Belum Bayar = no cashflow income entry
        }

        $this->command->info("Dummy sales data seeded: {$targetSales} quotations from May 2025 to now.");
        $this->command->info("Status distribution: ~60% Closed, ~30% Approved, ~10% Open");
    }

    private function generatePhone(): string
    {
        $prefixes = ['0811', '0812', '0813', '0821', '0822', '0823', '0851', '0852', '0853', '0855', '0856', '0857', '0858', '0814', '0815', '0816'];
        return $prefixes[array_rand($prefixes)] . rand(1000000, 9999999);
    }

    private function cleanCompanyName(string $name): string
    {
        $name = preg_replace('/[^A-Za-z0-9 ]/', '', $name);
        $name = trim(preg_replace('/\s+/', ' ', $name));

        while (preg_match('/^(PT|CV)\.?\s+/i', $name)) {
            $name = preg_replace('/^(PT|CV)\.?\s+/i', '', $name);
            $name = trim($name);
        }

        return $name;
    }

    /**
     * Nama PT & CV fiktif tapi realistis Indonesia (bukan perusahaan terkenal)
     */
    private function getCompanyNames(): array
    {
        return [
            // PT fiktif
            'PT Buana Teknik Perkasa',
            'PT Sinar Pratama Abadi',
            'PT Karya Mandiri Utama',
            'PT Citra Gemilang Indonesia',
            'PT Maju Bersama Sentosa',
            'PT Anugerah Karya Sejahtera',
            'PT Berkah Mandiri Teknik',
            'PT Surya Kencana Perkasa',
            'PT Indah Makmur Sentosa',
            'PT Bangun Cipta Mandiri',
            'PT Harapan Jaya Utama',
            'PT Nusantara Teknik Mandiri',
            'PT Pratama Karya Abadi',
            'PT Cipta Sejahtera Mandiri',
            'PT Bintang Perkasa Utama',
            'PT Gemilang Jaya Teknik',
            'PT Sentosa Makmur Abadi',
            'PT Karya Utama Perkasa',
            'PT Mega Cipta Sentosa',
            'PT Putra Mandiri Teknik',
            'PT Sumber Makmur Jaya',
            'PT Aneka Cipta Mandiri',
            'PT Jaya Sentosa Perkasa',
            'PT Mandiri Karya Utama',
            'PT Perkasa Teknik Abadi',
            'PT Sejahtera Mandiri Utama',
            'PT Cipta Karya Gemilang',
            'PT Nusantara Makmur Jaya',
            'PT Berlian Cipta Mandiri',
            'PT Harapan Teknik Sentosa',
            'PT Abadi Karya Perkasa',
            'PT Surya Mandiri Teknik',
            'PT Pratama Jaya Sentosa',
            'PT Buana Makmur Abadi',
            'PT Inti Karya Mandiri',
            'PT Cipta Perkasa Jaya',
            'PT Mandiri Sejahtera Teknik',
            'PT Gemilang Utama Sentosa',
            'PT Karya Abadi Perkasa',
            'PT Sinar Mandiri Jaya',
            'PT Buana Cipta Sejahtera',
            'PT Pratama Teknik Utama',
            'PT Sentosa Karya Mandiri',
            'PT Mega Jaya Perkasa',
            'PT Putra Cipta Abadi',
            'PT Nusantara Sentosa Teknik',
            'PT Makmur Karya Jaya',
            'PT Harapan Mandiri Utama',
            'PT Berlian Teknik Sentosa',
            'PT Abadi Cipta Mandiri',
            'PT Surya Perkasa Jaya',
            'PT Sumber Karya Utama',
            'PT Inti Mandiri Sentosa',
            'PT Cipta Jaya Perkasa',
            'PT Buana Karya Mandiri',
            'PT Pratama Makmur Jaya',
            'PT Gemilang Teknik Abadi',
            'PT Sentosa Cipta Utama',
            'PT Mandiri Perkasa Jaya',
            'PT Mega Karya Sentosa',
            'PT Putra Teknik Mandiri',
            'PT Nusantara Cipta Abadi',
            'PT Harapan Karya Jaya',
            'PT Berlian Mandiri Perkasa',
            'PT Surya Cipta Sentosa',
            'PT Sumber Teknik Abadi',
            'PT Inti Perkasa Mandiri',
            'PT Karya Cipta Utama',
            'PT Buana Sentosa Jaya',
            'PT Pratama Mandiri Perkasa',
            'PT Sinar Karya Sentosa',
            'PT Abadi Teknik Jaya',
            'PT Mega Mandiri Utama',
            'PT Putra Karya Sentosa',
            'PT Nusantara Perkasa Mandiri',
            'PT Makmur Cipta Utama',
            'PT Harapan Teknik Jaya',
            'PT Berlian Karya Abadi',
            'PT Surya Sentosa Mandiri',
            'PT Sumber Cipta Perkasa',
            'PT Inti Karya Sentosa',
            'PT Cipta Mandiri Jaya',
            'PT Buana Teknik Utama',
            'PT Pratama Perkasa Sentosa',
            'PT Sinar Mandiri Utama',
            'PT Gemilang Karya Jaya',
            'PT Sentosa Teknik Mandiri',
            'PT Mega Cipta Abadi',
            'PT Putra Mandiri Jaya',
            'PT Nusantara Karya Sentosa',
            'PT Makmur Teknik Mandiri',
            'PT Harapan Cipta Perkasa',
            'PT Berlian Sentosa Utama',
            'PT Surya Karya Abadi',
            'PT Sumber Mandiri Sentosa',
            'PT Inti Cipta Jaya',
            'PT Karya Perkasa Sentosa',
            'PT Buana Mandiri Jaya',
            'PT Pratama Cipta Mandiri',
            'PT Sinar Teknik Perkasa',
            // CV fiktif
            'CV Cipta Mandiri',
            'CV Sinar Abadi',
            'CV Mitra Sejahtera',
            'CV Buana Jaya',
            'CV Karya Bersama',
            'CV Cahaya Makmur',
            'CV Mega Sentosa',
            'CV Prima Teknik',
            'CV Multi Solusi',
            'CV Sukses Makmur',
            'CV Tirta Kencana',
            'CV Makmur Sejahtera',
            'CV Bintang Jaya',
            'CV Artha Karya',
            'CV Aneka Niaga',
            'CV Duta Mandiri',
            'CV Serasi Logistics',
            'CV Berlian Utama',
            'CV Putra Prima',
            'CV Mitra Agro',
            'CV Surya Jaya',
            'CV Global Sejahtera',
            'CV Semesta Abadi',
            'CV Tiga Saudara',
            'CV Karya Nusantara',
            'CV Sentosa Prima',
            'CV Asri Jaya',
            'CV Omega Utama',
            'CV Panca Makmur',
            'CV Dua Putra',
            'CV Sumber Rejeki',
            'CV Putra Perkasa',
            'CV Insan Medika',
            'CV Sinar Baru',
            'CV Rasa Mandiri',
            'CV Bumi Kencana',
            'CV Alam Sari',
            'CV Mega Jaya',
            'CV Prima Citra',
            'CV Graha Nusantara',
            'CV Mandala Jaya',
            'CV Polar Logistic',
            'CV Abadi Sentosa',
            'CV Boga Mulia',
            'CV Kencana Berkat',
            'CV Lestari Perkasa',
            'CV Mitra Duta',
            'CV Teknik Abadi',
            'CV Sinar Utama',
            'CV Maju Bersama',
        ];
    }

    private function randomNpwp(): string
    {
        return sprintf('%s.%s.%s.%s',
            substr(str_pad((string) rand(0, 99999999), 8, '0', STR_PAD_LEFT), 0, 8),
            substr(str_pad((string) rand(0, 999), 3, '0', STR_PAD_LEFT), 0, 3),
            substr(str_pad((string) rand(0, 999), 3, '0', STR_PAD_LEFT), 0, 3),
            substr(str_pad((string) rand(0, 9), 1, '0', STR_PAD_LEFT), 0, 1)
        );
    }

    private function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);

        return strtolower($text);
    }

    private function sanitizeCompanyName(string $name): string
    {
        $name = preg_replace('/[^A-Za-z0-9 ]/', '', $name);
        return trim(preg_replace('/\s+/', ' ', $name));
    }
}

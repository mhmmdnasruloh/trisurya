<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Owner/Manager gets full financial dashboard
        if ($user->isManager()) {
            return $this->ownerDashboard($request);
        }

        // Admin/Sales gets limited dashboard
        return $this->adminDashboard($request);
    }

    /**
     * Dashboard untuk Owner/Manager — data keuangan lengkap
     */
    private function ownerDashboard(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));
        $selectedMonth = $request->input('month', 'all');
        $selectedSales = $request->input('sales', 'all');

        $selectedYear = max(2020, min(2030, $selectedYear));

        $salesOptions = DB::table('users')->where('role', 'Sales')->orderBy('fullname')->get();

        // 1. Approved Query
        $queryApproved = DB::table('quotations')
            ->whereYear('approved_date', $selectedYear)
            ->whereNotNull('approved_date')
            ->where('approved_date', '!=', '0000-00-00')
            ->where(function($q) {
                $q->whereRaw("UPPER(TRIM(status)) = 'APPROVED'")
                  ->orWhereRaw("UPPER(TRIM(status)) = 'FULLY INVOICED'");
            });
        
        if ($selectedMonth !== 'all') $queryApproved->whereMonth('approved_date', $selectedMonth);
        if ($selectedSales !== 'all') $queryApproved->where('sales_id', $selectedSales);
        
        $dataApproved = $queryApproved->selectRaw('COUNT(*) as total, COALESCE(SUM(total), 0) as total_value')->first();

        // 2. Closed Query
        $queryClosed = DB::table('quotations')
            ->whereYear('date', $selectedYear)
            ->whereRaw("UPPER(TRIM(status)) = 'CLOSED'");
            
        if ($selectedMonth !== 'all') $queryClosed->whereMonth('date', $selectedMonth);
        if ($selectedSales !== 'all') $queryClosed->where('sales_id', $selectedSales);
        
        $dataClosed = $queryClosed->selectRaw('COUNT(*) as total, COALESCE(SUM(total), 0) as total_value')->first();

        // 3. Open Query
        $queryOpen = DB::table('quotations')
            ->whereYear('date', $selectedYear)
            ->whereRaw("UPPER(TRIM(status)) = 'OPEN'");
            
        if ($selectedMonth !== 'all') $queryOpen->whereMonth('date', $selectedMonth);
        if ($selectedSales !== 'all') $queryOpen->where('sales_id', $selectedSales);
        
        $dataOpen = $queryOpen->selectRaw('COUNT(*) as total, COALESCE(SUM(total), 0) as total_value')->first();

        $totalCount = ($dataApproved->total ?? 0) + ($dataClosed->total ?? 0) + ($dataOpen->total ?? 0);
        $totalValue = ($dataApproved->total_value ?? 0) + ($dataClosed->total_value ?? 0) + ($dataOpen->total_value ?? 0);

        if ($totalValue > 0) {
            $approvedPercentage = round(($dataApproved->total_value / $totalValue) * 100, 2);
            $closedPercentage = round(($dataClosed->total_value / $totalValue) * 100, 2);
            $openPercentage = round(($dataOpen->total_value / $totalValue) * 100, 2);
        } else {
            $approvedPercentage = $closedPercentage = $openPercentage = 0;
        }

        // Grandtotal function equivalent
        $calculateGrandTotal = function ($invoice) {
            $subtotal = 0;
            if (!empty($invoice->quotation_id)) {
                $subtotalRaw = DB::table('quotation_items')
                    ->where('quotation_id', $invoice->quotation_id)
                    ->selectRaw('COALESCE(SUM((price * quantity) * (1 - COALESCE(discount, 0)/100)), 0) AS subtotal')
                    ->first();
                $subtotal = $subtotalRaw->subtotal ?? 0;
            }
            
            $tagihan = (!empty($invoice->total) && $invoice->total < $subtotal && $subtotal > 0) 
               ? $invoice->total 
               : ($subtotal > 0 ? $subtotal : ($invoice->total ?? 0));
            
            return $tagihan;
        };

        // Total Dana Masuk (dari cashflow Income)
        $queryDanaMasuk = DB::table('cashflow')
            ->where('jenis', 'Income')
            ->whereYear('tanggal', $selectedYear);
        if ($selectedMonth !== 'all') $queryDanaMasuk->whereMonth('tanggal', $selectedMonth);
        $totalDanaMasuk = $queryDanaMasuk->sum('nominal');

        // Total Piutang (invoice belum lunas)
        $queryPiutang = DB::table('invoices')
            ->where('status', '!=', 'Lunas')
            ->where('status', '!=', 'Dibatalkan')
            ->whereRaw('total > paid_amount')
            ->whereYear('date', $selectedYear);
        if ($selectedMonth !== 'all') $queryPiutang->whereMonth('date', $selectedMonth);
        $piutangInvoices = $queryPiutang->get();
        
        $totalPiutang = 0;
        foreach ($piutangInvoices as $inv) {
            $totalPiutang += ($inv->total - ($inv->paid_amount ?? 0));
        }

        // Total Keseluruhan Dana
        $totalKeseluruhanDana = $totalDanaMasuk + $totalPiutang;

        // Total Invoice
        $queryTotalInvoice = DB::table('invoices as i')
            ->join('quotations as q', 'i.quotation_id', '=', 'q.id')
            ->whereYear('i.date', $selectedYear)
            ->select('i.*', 'q.sales_id');
            
        if ($selectedMonth !== 'all') $queryTotalInvoice->whereMonth('i.date', $selectedMonth);
        if ($selectedSales !== 'all') $queryTotalInvoice->where('q.sales_id', $selectedSales);
        
        $totalInvoiceVal = 0;
        foreach ($queryTotalInvoice->get() as $inv) {
            $totalInvoiceVal += $calculateGrandTotal($inv);
        }

        // Due Invoice
        $queryDueInvoice = DB::table('invoices as i')
            ->leftJoin('quotations as q', 'i.quotation_id', '=', 'q.id')
            ->leftJoin('customers as c', 'q.customer_id', '=', 'c.id')
            ->leftJoin('users as u', 'q.sales_id', '=', 'u.id')
            ->whereYear('i.date', $selectedYear)
            ->where(function($q) {
                $q->where('i.status', 'LIKE', 'Belum Bayar%')
                  ->orWhere('i.status', 'LIKE', 'Belum%')
                  ->orWhere('i.status', 'LIKE', 'DP%');
            })
            ->whereNotNull('i.due_date')
            ->whereRaw("i.due_date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)")
            ->select(
                'i.*', 
                'c.name as customer_name', 'c.phone as customer_phone', 'c.email as customer_email',
                'q.number as quotation_number',
                'u.username as sales_username', 'u.fullname as sales_fullname',
                DB::raw('DATEDIFF(i.due_date, CURDATE()) as days_until_due')
            );
            
        if ($selectedMonth !== 'all') $queryDueInvoice->whereMonth('i.date', $selectedMonth);
        if ($selectedSales !== 'all') $queryDueInvoice->where('q.sales_id', $selectedSales);
        $queryDueInvoice->orderBy('i.due_date', 'ASC')->orderBy('i.date', 'DESC');

        $totalOverdue = 0; $totalDueSoon = 0; $countOverdue = 0; $countDueSoon = 0;
        $dueCustomers = [];

        foreach ($queryDueInvoice->get() as $inv) {
            $grandTotal = $calculateGrandTotal($inv);
            $daysUntilDue = $inv->days_until_due;

            if ($daysUntilDue < 0) {
                $totalOverdue += $grandTotal;
                $countOverdue++;
                $statusCategory = 'overdue';
                $statusText = 'OVERDUE';
            } else {
                $totalDueSoon += $grandTotal;
                $countDueSoon++;
                $statusCategory = 'due-soon';
                $statusText = 'H-' . ($daysUntilDue + 1);
            }

            $inv->calculated_total = $grandTotal;
            $inv->status_category = $statusCategory;
            $inv->status_text = $statusText;

            $customerId = $inv->customer_name ?? 'Unknown';
            if (!isset($dueCustomers[$customerId])) {
                $dueCustomers[$customerId] = [
                    'name' => $inv->customer_name ?? 'Unknown',
                    'phone' => $inv->customer_phone ?? '',
                    'email' => $inv->customer_email ?? '',
                    'total_overdue' => 0,
                    'total_due_soon' => 0,
                    'count_overdue' => 0,
                    'count_due_soon' => 0,
                    'invoices' => []
                ];
            }

            if ($statusCategory === 'overdue') {
                $dueCustomers[$customerId]['total_overdue'] += $grandTotal;
                $dueCustomers[$customerId]['count_overdue']++;
            } else {
                $dueCustomers[$customerId]['total_due_soon'] += $grandTotal;
                $dueCustomers[$customerId]['count_due_soon']++;
            }
            $dueCustomers[$customerId]['invoices'][] = $inv;
        }

        uasort($dueCustomers, function($a, $b) {
            return ($b['total_overdue'] + $b['total_due_soon']) <=> ($a['total_overdue'] + $a['total_due_soon']);
        });

        $months = [
            '01' => 'Januari','02' => 'Februari','03' => 'Maret',
            '04' => 'April','05' => 'Mei','06' => 'Juni',
            '07' => 'Juli','08' => 'Agustus','09' => 'September',
            '10' => 'Oktober','11' => 'November','12' => 'Desember'
        ];

        return view('dashboard-owner', compact(
            'selectedYear', 'selectedMonth', 'selectedSales',
            'salesOptions', 'dataApproved', 'dataClosed', 'dataOpen', 'totalCount', 'totalValue',
            'approvedPercentage', 'closedPercentage', 'openPercentage', 'totalInvoiceVal',
            'totalOverdue', 'totalDueSoon', 'countOverdue', 'countDueSoon', 'dueCustomers', 'months',
            'totalKeseluruhanDana', 'totalDanaMasuk', 'totalPiutang'
        ));
    }

    /**
     * Dashboard untuk Admin/Sales — tanpa data keuangan sensitif
     */
    private function adminDashboard(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));
        $selectedMonth = $request->input('month', 'all');

        $selectedYear = max(2020, min(2030, $selectedYear));

        // Statistik penawaran (jumlah saja, tanpa nilai rupiah)
        $queryApproved = DB::table('quotations')
            ->whereYear('date', $selectedYear)
            ->where(function($q) {
                $q->whereRaw("UPPER(TRIM(status)) = 'APPROVED'")
                  ->orWhereRaw("UPPER(TRIM(status)) = 'FULLY INVOICED'");
            });
        if ($selectedMonth !== 'all') $queryApproved->whereMonth('date', $selectedMonth);
        $countApproved = $queryApproved->count();

        $queryClosed = DB::table('quotations')
            ->whereYear('date', $selectedYear)
            ->whereRaw("UPPER(TRIM(status)) = 'CLOSED'");
        if ($selectedMonth !== 'all') $queryClosed->whereMonth('date', $selectedMonth);
        $countClosed = $queryClosed->count();

        $queryOpen = DB::table('quotations')
            ->whereYear('date', $selectedYear)
            ->whereRaw("UPPER(TRIM(status)) = 'OPEN'");
        if ($selectedMonth !== 'all') $queryOpen->whereMonth('date', $selectedMonth);
        $countOpen = $queryOpen->count();

        $totalQuotations = $countApproved + $countClosed + $countOpen;

        // Quotation terbaru
        $recentQuotations = DB::table('quotations')
            ->leftJoin('customers', 'quotations.customer_id', '=', 'customers.id')
            ->leftJoin('users', 'quotations.sales_id', '=', 'users.id')
            ->whereYear('quotations.date', $selectedYear)
            ->select('quotations.*', 'customers.name as customer_name', 'users.fullname as sales_name')
            ->orderBy('quotations.id', 'desc')
            ->limit(10)
            ->get();

        // Invoice terbaru
        $recentInvoices = DB::table('invoices')
            ->leftJoin('quotations', 'invoices.quotation_id', '=', 'quotations.id')
            ->leftJoin('customers', 'quotations.customer_id', '=', 'customers.id')
            ->whereYear('invoices.date', $selectedYear)
            ->select('invoices.*', 'customers.name as customer_name', 'quotations.number as quotation_number')
            ->orderBy('invoices.id', 'desc')
            ->limit(10)
            ->get();

        // Recent payments (from cashflow table, source = payment)
        $recentPayments = DB::table('cashflow as c')
            ->leftJoin('invoices as i', 'c.invoice_id', '=', 'i.id')
            ->leftJoin('users as u', 'c.created_by', '=', 'u.id')
            ->where('c.source', 'payment')
            ->select('c.*', 'i.number as invoice_number', 'u.fullname as created_by_name')
            ->orderBy('c.tanggal', 'desc')
            ->limit(10)
            ->get();

        // Total customers
        $totalCustomers = DB::table('customers')->count();

        // Total products
        $totalProducts = DB::table('products')->count();

        $months = [
            '01' => 'Januari','02' => 'Februari','03' => 'Maret',
            '04' => 'April','05' => 'Mei','06' => 'Juni',
            '07' => 'Juli','08' => 'Agustus','09' => 'September',
            '10' => 'Oktober','11' => 'November','12' => 'Desember'
        ];

        return view('dashboard-admin', compact(
            'selectedYear', 'selectedMonth', 'months',
            'countApproved', 'countClosed', 'countOpen', 'totalQuotations',
            'recentQuotations', 'recentInvoices',
            'totalCustomers', 'totalProducts',
            'recentPayments'
        ));
    }
}

<?php
namespace App\Http\Controllers;
use App\Models\Cashflow;
use Illuminate\Http\Request;

class CashflowController extends Controller {
    public function index() {
        // Get filter parameters
        // Default year = tahun berjalan (konsisten dengan dashboard owner)
        $fromDate = request('from_date') ? date('Y-m-d', strtotime(request('from_date'))) : null;
        $toDate   = request('to_date')   ? date('Y-m-d', strtotime(request('to_date')))   : null;
        $month    = request('month');

        // Kalau user belum pernah set filter sama sekali (fresh page), default ke tahun ini
        // Kalau user sengaja kirim year='' (reset), berarti dia mau lihat semua tahun
        $hasAnyFilter = request()->hasAny(['from_date','to_date','month','year','_token']);
        $year = $hasAnyFilter ? request('year') : date('Y');

        // Build query untuk incomes (Dana Masuk)
        $incomesQuery = Cashflow::where('jenis', 'Income');
        if ($fromDate) $incomesQuery->where('tanggal', '>=', $fromDate);
        if ($toDate)   $incomesQuery->where('tanggal', '<=', $toDate);
        if ($month)    $incomesQuery->whereMonth('tanggal', $month);
        if ($year)     $incomesQuery->whereYear('tanggal', $year);

        $incomes = $incomesQuery->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->get();

        // Build query untuk Piutang (Invoice Belum Lunas)
        $piutangQuery = \App\Models\Invoice::with('quotation.customer')
            ->where('status', '!=', 'Lunas')
            ->where('status', '!=', 'Dibatalkan')
            ->whereRaw('total > paid_amount');

        if ($fromDate) $piutangQuery->where('date', '>=', $fromDate);
        if ($toDate)   $piutangQuery->where('date', '<=', $toDate);
        if ($month)    $piutangQuery->whereMonth('date', $month);
        if ($year)     $piutangQuery->whereYear('date', $year);

        $piutangs = $piutangQuery->orderBy('date', 'desc')->get();

        $totalIncome  = $incomes->sum('nominal');
        $totalPiutang = 0;
        foreach ($piutangs as $p) {
            $totalPiutang += $p->outstanding;
        }

        // Total Keseluruhan Dana
        $totalKeseluruhan = $totalIncome + $totalPiutang;

        return view('cashflow.index', compact(
            'incomes', 'piutangs',
            'totalIncome', 'totalPiutang', 'totalKeseluruhan',
            'year', 'month', 'fromDate', 'toDate'
        ));
    }
}


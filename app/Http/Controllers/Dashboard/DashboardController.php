<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PosInvoice;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(){
        $posInvoices = PosInvoice::with('user', 'tax', 'customer')
        ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(total_last) as revenue'))
        ->groupBy('month')
        ->orderBy('month', 'ASC')
        ->get();
    $revenueData = [];
    foreach ($posInvoices as $invoice) {
        $revenueData[] = [
            'month' => $invoice->month,
            'revenue' => $invoice->revenue,
        ];
    }
    return view('dashboard.dashboard', compact('revenueData'));
    }
}

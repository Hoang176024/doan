<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PosInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $daysAgo = $request->input('days_ago');
        $interval = $request->input('interval');

        $startDate = Carbon::now()->subDays($daysAgo);
        $endDate = Carbon::now();

        $query = PosInvoice::selectRaw('SUM(total_last) as total_sales, COUNT(*) as number_of_sales')
            ->when($interval === 'daily', function ($query) {
                return $query->selectRaw('DATE(created_at) as date')
                             ->groupBy('date');
            })
            ->when($interval === 'weekly', function ($query) {
                return $query->selectRaw('YEARWEEK(created_at) as week')
                             ->groupBy('week');
            })
            ->when($interval === 'monthly', function ($query) {
                return $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month')
                             ->groupBy('month');
            })
            ->whereBetween('created_at', [$startDate, $endDate]);

        $chartLabelFormat = match ($interval) {
            'daily' => 'Y-m-d',
            'weekly' => 'Y-\WW',
            'monthly' => 'F Y',
            default => 'Y-m-d',
        };

        $statistics = $query->get();
        $totalSales = $statistics->sum('total_sales');
        $numberOfSales = $statistics->sum('number_of_sales');
        $averageSales = $numberOfSales > 0 ? $totalSales / $numberOfSales : 0;

        $totalSalesFormatted = number_format($totalSales, 2, '.', ',');
        $averageSalesFormatted = number_format($averageSales, 2, '.', ',');

        $chartLabels = [];
        $chartData = [];
    foreach ($statistics as $item) {
        $date = Carbon::parse($item->date);
        switch ($interval) {
            case 'daily':
                // no modification needed for daily interval
                break;
            case 'weekly':
                // add number of week to year
                $date->addWeek()->startOfWeek();
                break;
            case 'monthly':
                // add one month to date
                $date->addMonth()->startOfMonth();
                break;
        }
        $chartLabels[] = $date->format($chartLabelFormat);
        $chartData[] = $item->total_sales;
    }

        $chartData = $statistics->pluck('total_sales');

        return view('dashboard.admin.statistic.index', [
            'totalSales' => $totalSalesFormatted,
            'numberOfSales' => $numberOfSales,
            'averageSales' => $averageSalesFormatted,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'selectedInterval' => $interval,
            'daysAgo' => $daysAgo,
        ]);

    }
}

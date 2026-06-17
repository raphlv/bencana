<?php

namespace App\Http\Controllers;

use App\Models\RainfallData;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDays = RainfallData::count();
        $avgTemp = RainfallData::avg('tavg') ?? 0.0;
        $avgHumid = RainfallData::avg('rh_avg') ?? 0.0;
        $avgRain = RainfallData::avg('rr') ?? 0.0;
        
        $extremeDays = RainfallData::where('class_actual', 1)->count();
        $extremePercentage = $totalDays > 0 ? ($extremeDays / $totalDays) * 100 : 0.0;

        // BMKG 4-class distribution counts
        $tidakHujanCount = RainfallData::where('rr', 0)->count();
        $ringanCount = RainfallData::where('rr', '>', 0)->where('rr', '<', 20)->count();
        $sedangCount = RainfallData::where('rr', '>=', 20)->where('rr', '<', 50)->count();
        $lebatCount = RainfallData::where('rr', '>=', 50)->count();

        // Get monthly rainfall statistics for the trend chart
        $monthlyStats = RainfallData::selectRaw("
                DATE_FORMAT(tanggal, '%Y-%m') as month, 
                AVG(tavg) as avg_temp, 
                AVG(rh_avg) as avg_humid, 
                SUM(rr) as total_rain,
                COUNT(CASE WHEN class_actual = 1 THEN 1 END) as extreme_count
            ")
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->take(12)
            ->get();

        // Scatter plot points (Suhu vs Kelembapan) classified into 4 BMKG categories
        $scatterPoints = RainfallData::whereNotNull('tavg')
            ->whereNotNull('rh_avg')
            ->whereNotNull('rr')
            ->get(['tavg', 'rh_avg', 'rr'])
            ->map(function ($row) {
                if ($row->rr == 0) {
                    $category = 'Tidak Hujan';
                } elseif ($row->rr < 20) {
                    $category = 'Hujan Ringan';
                } elseif ($row->rr < 50) {
                    $category = 'Hujan Sedang';
                } else {
                    $category = 'Hujan Lebat';
                }
                return [
                    'x' => (double)$row->tavg,
                    'y' => (double)$row->rh_avg,
                    'category' => $category
                ];
            });

        return view('dashboard', compact(
            'totalDays', 
            'avgTemp', 
            'avgHumid', 
            'avgRain', 
            'extremeDays', 
            'extremePercentage',
            'monthlyStats',
            'tidakHujanCount',
            'ringanCount',
            'sedangCount',
            'lebatCount',
            'scatterPoints'
        ));
    }
}

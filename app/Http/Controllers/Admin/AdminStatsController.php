<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminStatsController extends Controller
{
    public function index()
    {
        $totalViews = Visit::count();
        $uniqueVisitors = Visit::distinct('ip_address')->count('ip_address');
        $avgTimeSpent = round(Visit::avg('seconds_spent') ?? 0);

        // Last 7 days chart data
        $chartDates = [];
        $chartViews = [];
        $chartUnique = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartDates[] = Carbon::now()->subDays($i)->format('d/m');
            
            $chartViews[] = Visit::whereDate('created_at', $date)->count();
            $chartUnique[] = Visit::whereDate('created_at', $date)->distinct('ip_address')->count('ip_address');
        }

        // Top visited pages
        $topPages = Visit::select('url', DB::raw('count(*) as total_views'), DB::raw('sum(seconds_spent) as total_time'))
            ->groupBy('url')
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        $topPageUrls = $topPages->pluck('url')->map(fn($url) => parse_url($url, PHP_URL_PATH) ?: $url)->toArray();
        $topPageViews = $topPages->pluck('total_views')->toArray();
        $topPageTimes = $topPages->pluck('total_time')->toArray();

        return view('admin.stats.index', compact(
            'totalViews',
            'uniqueVisitors',
            'avgTimeSpent',
            'chartDates',
            'chartViews',
            'chartUnique',
            'topPageUrls',
            'topPageViews',
            'topPageTimes'
        ));
    }
}

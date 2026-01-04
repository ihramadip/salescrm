<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Lead;
use App\Models\Revenue;
use App\Models\SalesTarget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // === KPI Cards Data ===
        $thisMonthStart = Carbon::now()->startOfMonth();
        $thisMonthEnd = Carbon::now()->endOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // Total Revenue KPI
        $revenueThisMonth = Revenue::whereBetween('revenue_date', [$thisMonthStart, $thisMonthEnd])->sum('amount');
        $revenueLastMonth = Revenue::whereBetween('revenue_date', [$lastMonthStart, $lastMonthEnd])->sum('amount');
        $revenueDiff = $revenueLastMonth > 0 ? (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100 : ($revenueThisMonth > 0 ? 100 : 0);

        // New Leads KPI
        $leadsThisMonth = Lead::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count();
        $leadsLastMonth = Lead::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $leadsDiff = $leadsLastMonth > 0 ? (($leadsThisMonth - $leadsLastMonth) / $leadsLastMonth) * 100 : ($leadsThisMonth > 0 ? 100 : 0);

        // Deals Won KPI
        $dealsWonThisMonth = Deal::where('stage', 'won')->whereBetween('updated_at', [$thisMonthStart, $thisMonthEnd])->count();
        $dealsWonLastMonth = Deal::where('stage', 'won')->whereBetween('updated_at', [$lastMonthStart, $lastMonthEnd])->count();
        $dealsWonDiff = $dealsWonLastMonth > 0 ? (($dealsWonThisMonth - $dealsWonLastMonth) / $dealsWonLastMonth) * 100 : ($dealsWonThisMonth > 0 ? 100 : 0);
        
        // Conversion Rate KPI (Deals Won / (Deals Won + Deals Lost))
        $dealsLostThisMonth = Deal::where('stage', 'lost')->whereBetween('updated_at', [$thisMonthStart, $thisMonthEnd])->count();
        $totalClosedDealsThisMonth = $dealsWonThisMonth + $dealsLostThisMonth;
        $conversionRateThisMonth = $totalClosedDealsThisMonth > 0 ? ($dealsWonThisMonth / $totalClosedDealsThisMonth) * 100 : 0;

        $dealsLostLastMonth = Deal::where('stage', 'lost')->whereBetween('updated_at', [$lastMonthStart, $lastMonthEnd])->count();
        $totalClosedDealsLastMonth = $dealsWonLastMonth + $dealsLostLastMonth;
        $conversionRateLastMonth = $totalClosedDealsLastMonth > 0 ? ($dealsWonLastMonth / $totalClosedDealsLastMonth) * 100 : 0;
        $conversionRateDiff = $conversionRateLastMonth > 0 ? (($conversionRateThisMonth - $conversionRateLastMonth) / $conversionRateLastMonth) * 100 : ($conversionRateThisMonth > 0 ? 100 : 0);


        // === Revenue Chart Data (Last 12 Months) ===
        $revenueChartData = Revenue::select(
            DB::raw('SUM(amount) as total'),
            DB::raw("DATE_FORMAT(revenue_date, '%Y-%m') as month")
        )
        ->where('revenue_date', '>=', Carbon::now()->subMonths(11)->startOfMonth())
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        $salesTargetData = SalesTarget::select(
            DB::raw('SUM(target_amount) as total'),
            DB::raw("CONCAT(year, '-', LPAD(month, 2, '0')) as month")
        )
        ->where('year', '>=', Carbon::now()->subMonths(11)->year)
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $chartLabels = [];
        $actualRevenueData = [];
        $targetRevenueData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $chartLabels[] = $date->format('M Y');
            
            $actualRevenueData[] = $revenueChartData->firstWhere('month', $monthKey)->total ?? 0;
            $targetRevenueData[] = $salesTargetData->firstWhere('month', $monthKey)->total ?? 0;
        }


        // === Sales Pipeline Chart Data ===
        $pipelineStages = ['qualification', 'proposal', 'negotiation', 'won', 'lost'];
        $pipelineData = Deal::select('stage', DB::raw('count(*) as total'))
            ->whereIn('stage', $pipelineStages)
            ->groupBy('stage')
            ->get()
            ->pluck('total', 'stage');


        // === Quick Stats ===
        $openDeals = Deal::whereNotIn('stage', ['won', 'lost'])->count();
        $totalClosedDeals = Deal::whereIn('stage', ['won', 'lost'])->count();
        $totalWonDeals = Deal::where('stage', 'won')->count();
        $winRate = $totalClosedDeals > 0 ? ($totalWonDeals / $totalClosedDeals) * 100 : 0;
        $avgDealSize = Deal::where('stage', 'won')->avg('value');

        
        return view('dashboard', compact(
            'revenueThisMonth', 'revenueDiff',
            'leadsThisMonth', 'leadsDiff',
            'dealsWonThisMonth', 'dealsWonDiff',
            'conversionRateThisMonth', 'conversionRateDiff',
            'chartLabels', 'actualRevenueData', 'targetRevenueData',
            'pipelineData', 'pipelineStages',
            'openDeals', 'winRate', 'avgDealSize'
        ));
    }
}
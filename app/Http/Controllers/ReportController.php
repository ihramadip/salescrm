<?php

namespace App\Http\Controllers;

use App\Exports\RevenueReportExport;
use App\Models\Revenue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display the main reports hub.
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Show the revenue report form and results.
     */
    public function revenueReport(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $revenues = null;
        $totalRevenue = 0;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if ($startDate && $endDate) {
            $revenues = Revenue::with('deal')
                ->whereBetween('revenue_date', [$startDate, $endDate])
                ->orderBy('revenue_date', 'desc')
                ->get();
            
            $totalRevenue = $revenues->sum('amount');
        }

        return view('reports.revenue', compact('revenues', 'totalRevenue', 'startDate', 'endDate'));
    }

    /**
     * Handle the Excel export for the revenue report.
     */
    public function exportRevenue(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $fileName = 'revenue_report_' . $request->start_date . '_to_' . $request->end_date . '.xlsx';

        return Excel::download(new RevenueReportExport($request->start_date, $request->end_date), $fileName);
    }
}
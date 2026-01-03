<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $revenues = Revenue::with('deal')->latest()->paginate(10);
        return view('revenues.index', compact('revenues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only show 'won' deals for revenue association
        $deals = Deal::where('stage', 'won')->orderBy('title')->get();
        return view('revenues.create', compact('deals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deal_id' => 'required|exists:deals,id',
            'amount' => 'required|numeric|min:0',
            'revenue_date' => 'required|date',
        ]);

        Revenue::create($request->all());

        return redirect()->route('revenues.index')
            ->with('success', 'Revenue recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Revenue $revenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revenue $revenue)
    {
        // Only show 'won' deals for revenue association
        $deals = Deal::where('stage', 'won')->orderBy('title')->get();
        return view('revenues.edit', compact('revenue', 'deals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Revenue $revenue)
    {
        $request->validate([
            'deal_id' => 'required|exists:deals,id',
            'amount' => 'required|numeric|min:0',
            'revenue_date' => 'required|date',
        ]);

        $revenue->update($request->all());

        return redirect()->route('revenues.index')
            ->with('success', 'Revenue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue)
    {
        $revenue->delete();

        return redirect()->route('revenues.index')
            ->with('success', 'Revenue deleted successfully.');
    }
}

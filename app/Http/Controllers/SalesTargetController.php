<?php

namespace App\Http\Controllers;

use App\Models\SalesTarget;
use App\Models\User;
use Illuminate\Http\Request;

class SalesTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesTargets = SalesTarget::with('user')->latest()->paginate(10);
        return view('sales_targets.index', compact('salesTargets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear + 5); // Current year + 5 years
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = date('F', mktime(0, 0, 0, $i, 10));
        }
        return view('sales_targets.create', compact('users', 'years', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 5),
            'target_amount' => 'required|numeric|min:0',
        ]);

        // Check for duplicate target for the same user, month, and year
        $existingTarget = SalesTarget::where('user_id', $request->user_id)
                                    ->where('month', $request->month)
                                    ->where('year', $request->year)
                                    ->first();

        if ($existingTarget) {
            return back()->withErrors(['month' => 'A sales target already exists for this user, month, and year.'])->withInput();
        }

        SalesTarget::create($request->all());

        return redirect()->route('sales-targets.index')
            ->with('success', 'Sales target created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesTarget $salesTarget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesTarget $salesTarget)
    {
        $users = User::orderBy('name')->get();
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear + 5);
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = date('F', mktime(0, 0, 0, $i, 10));
        }
        return view('sales_targets.edit', compact('salesTarget', 'users', 'years', 'months'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesTarget $salesTarget)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 5),
            'target_amount' => 'required|numeric|min:0',
        ]);

        // Check for duplicate target for the same user, month, and year, excluding the current salesTarget
        $existingTarget = SalesTarget::where('user_id', $request->user_id)
                                    ->where('month', $request->month)
                                    ->where('year', $request->year)
                                    ->where('id', '!=', $salesTarget->id)
                                    ->first();

        if ($existingTarget) {
            return back()->withErrors(['month' => 'A sales target already exists for this user, month, and year.'])->withInput();
        }

        $salesTarget->update($request->all());

        return redirect()->route('sales-targets.index')
            ->with('success', 'Sales target updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesTarget $salesTarget)
    {
        $salesTarget->delete();

        return redirect()->route('sales-targets.index')
            ->with('success', 'Sales target deleted successfully.');
    }
}

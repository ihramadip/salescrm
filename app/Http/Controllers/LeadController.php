<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::with('company', 'assignedTo')->latest()->paginate(10);
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('leads.create', compact('companies', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'assigned_to' => 'required|exists:users,id',
            'status' => 'required|string|in:new,contacted,qualified,unqualified',
            'source' => 'required|string|in:web,referral,partner,other',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::id();

        Lead::create($data);

        return redirect()->route('leads.index')
            ->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        $lead->load(['activities' => function ($query) {
            $query->with('user')->latest();
        }]);

        $companies = Company::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('leads.edit', compact('lead', 'companies', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'assigned_to' => 'required|exists:users,id',
            'status' => 'required|string|in:new,contacted,qualified,unqualified',
            'source' => 'required|string|in:web,referral,partner,other',
        ]);

        $lead->update($request->all());

        return redirect()->route('leads.index')
            ->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('leads.index')
            ->with('success', 'Lead deleted successfully.');
    }
}

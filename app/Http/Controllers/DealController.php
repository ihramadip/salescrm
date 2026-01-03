<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals = Deal::with('company', 'contact', 'assignedTo')->latest()->paginate(10);
        return view('deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        $contacts = Contact::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('deals.create', compact('companies', 'contacts', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'contact_id' => 'required|exists:contacts,id',
            'assigned_to' => 'required|exists:users,id',
            'value' => 'required|numeric|min:0',
            'stage' => 'required|string|in:qualification,proposal,negotiation,won,lost',
            'probability' => 'required|integer|min:0|max:100',
            'expected_close_date' => 'nullable|date',
        ]);

        Deal::create($request->all());

        return redirect()->route('deals.index')
            ->with('success', 'Deal created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        $companies = Company::orderBy('name')->get();
        $contacts = Contact::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('deals.edit', compact('deal', 'companies', 'contacts', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'contact_id' => 'required|exists:contacts,id',
            'assigned_to' => 'required|exists:users,id',
            'value' => 'required|numeric|min:0',
            'stage' => 'required|string|in:qualification,proposal,negotiation,won,lost',
            'probability' => 'required|integer|min:0|max:100',
            'expected_close_date' => 'nullable|date',
        ]);

        $deal->update($request->all());

        return redirect()->route('deals.index')
            ->with('success', 'Deal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();

        return redirect()->route('deals.index')
            ->with('success', 'Deal deleted successfully.');
    }
}

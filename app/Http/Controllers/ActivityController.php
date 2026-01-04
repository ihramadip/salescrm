<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load relationships for efficiency
        $activities = Activity::with('user', 'subject')
            ->latest()
            ->paginate(20);

        return view('activities.index', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
            'subject_id' => 'required|integer',
            'subject_type' => 'required|string|in:App\Models\Lead,App\Models\Contact,App\Models\Deal',
        ]);

        $modelClass = $request->input('subject_type');
        $model = (new $modelClass)->find($request->input('subject_id'));

        if (!$model) {
            return back()->withErrors(['subject_id' => 'The related item could not be found.'])->withInput();
        }

        $model->activities()->create([
            'user_id' => Auth::id(),
            'type' => 'note',
            'description' => $request->description,
        ]);

        return back()->with('success', 'Note added successfully.');
    }
}
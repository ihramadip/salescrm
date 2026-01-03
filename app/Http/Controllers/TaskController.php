<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('assignedTo')->latest()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $leads = Lead::orderBy('name')->get();
        $contacts = Contact::orderBy('name')->get();
        $deals = Deal::orderBy('title')->get();

        $relatedTypes = [
            'App\Models\Lead' => 'Lead',
            'App\Models\Contact' => 'Contact',
            'App\Models\Deal' => 'Deal',
        ];

        return view('tasks.create', compact('users', 'leads', 'contacts', 'deals', 'relatedTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|string|in:low,medium,high',
            'status' => 'required|string|in:open,in_progress,completed',
            'assigned_to' => 'required|exists:users,id',
            'related_type' => 'nullable|string|in:App\Models\Lead,App\Models\Contact,App\Models\Deal',
            'related_id' => 'nullable|integer',
        ]);

        // Validate related_id based on related_type
        if ($request->filled('related_type') && $request->filled('related_id')) {
            $modelClass = $request->input('related_type');
            if (!class_exists($modelClass) || !(new $modelClass)->find($request->input('related_id'))) {
                return back()->withErrors(['related_id' => 'The selected related item is invalid.'])->withInput();
            }
        } elseif ($request->filled('related_type') xor $request->filled('related_id')) {
             return back()->withErrors(['related_id' => 'Both related type and ID must be provided, or neither.'])->withInput();
        }

        Task::create($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users = User::orderBy('name')->get();
        $leads = Lead::orderBy('name')->get();
        $contacts = Contact::orderBy('name')->get();
        $deals = Deal::orderBy('title')->get();

        $relatedTypes = [
            'App\Models\Lead' => 'Lead',
            'App\Models\Contact' => 'Contact',
            'App\Models\Deal' => 'Deal',
        ];

        return view('tasks.edit', compact('task', 'users', 'leads', 'contacts', 'deals', 'relatedTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|string|in:low,medium,high',
            'status' => 'required|string|in:open,in_progress,completed',
            'assigned_to' => 'required|exists:users,id',
            'related_type' => 'nullable|string|in:App\Models\Lead,App\Models\Contact,App\Models\Deal',
            'related_id' => 'nullable|integer',
        ]);

        // Validate related_id based on related_type
        if ($request->filled('related_type') && $request->filled('related_id')) {
            $modelClass = $request->input('related_type');
            if (!class_exists($modelClass) || !(new $modelClass)->find($request->input('related_id'))) {
                return back()->withErrors(['related_id' => 'The selected related item is invalid.'])->withInput();
            }
        } elseif ($request->filled('related_type') xor $request->filled('related_id')) {
             return back()->withErrors(['related_id' => 'Both related type and ID must be provided, or neither.'])->withInput();
        }

        $task->update($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}

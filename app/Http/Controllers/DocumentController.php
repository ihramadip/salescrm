<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Document;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::with('uploadedBy')->latest()->paginate(10);
        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leads = Lead::orderBy('name')->get();
        $contacts = Contact::orderBy('name')->get();
        $deals = Deal::orderBy('title')->get();

        $relatedTypes = [
            'App\Models\Lead' => 'Lead',
            'App\Models\Contact' => 'Contact',
            'App\Models\Deal' => 'Deal',
        ];

        return view('documents.create', compact('leads', 'contacts', 'deals', 'relatedTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // Max 10MB
            'related_type' => 'nullable|string|in:App\Models\Lead,App\Models\Contact,App\Models\Deal',
            'related_id' => 'nullable|integer',
        ]);

        if ($request->filled('related_type') && $request->filled('related_id')) {
            $modelClass = $request->input('related_type');
            if (!class_exists($modelClass) || !(new $modelClass)->find($request->input('related_id'))) {
                return back()->withErrors(['related_id' => 'The selected related item is invalid.'])->withInput();
            }
        } elseif ($request->filled('related_type') xor $request->filled('related_id')) {
             return back()->withErrors(['related_id' => 'Both related type and ID must be provided, or neither.'])->withInput();
        }

        $filePath = $request->file('file')->store('public/documents');
        $fileName = $request->file('file')->getClientOriginalName();

        Document::create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'related_type' => $request->related_type,
            'related_id' => $request->related_id,
            'uploaded_by' => Auth::id(),
            'version' => 1,
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return Storage::download($document->file_path, $document->file_name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        $leads = Lead::orderBy('name')->get();
        $contacts = Contact::orderBy('name')->get();
        $deals = Deal::orderBy('title')->get();

        $relatedTypes = [
            'App\Models\Lead' => 'Lead',
            'App\Models\Contact' => 'Contact',
            'App\Models\Deal' => 'Deal',
        ];

        return view('documents.edit', compact('document', 'leads', 'contacts', 'deals', 'relatedTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'file' => 'nullable|file|max:10240', // Max 10MB
            'related_type' => 'nullable|string|in:App\Models\Lead,App\Models\Contact,App\Models\Deal',
            'related_id' => 'nullable|integer',
        ]);

        if ($request->filled('related_type') && $request->filled('related_id')) {
            $modelClass = $request->input('related_type');
            if (!class_exists($modelClass) || !(new $modelClass)->find($request->input('related_id'))) {
                return back()->withErrors(['related_id' => 'The selected related item is invalid.'])->withInput();
            }
        } elseif ($request->filled('related_type') xor $request->filled('related_id')) {
             return back()->withErrors(['related_id' => 'Both related type and ID must be provided, or neither.'])->withInput();
        }

        // Handle new file upload
        if ($request->hasFile('file')) {
            // Delete old file
            Storage::delete($document->file_path);

            $filePath = $request->file('file')->store('public/documents');
            $fileName = $request->file('file')->getClientOriginalName();

            $document->update([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'version' => $document->version + 1, // Increment version on file update
            ]);
        }
        
        // Update related type/id
        $document->update([
            'related_type' => $request->related_type,
            'related_id' => $request->related_id,
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        Storage::delete($document->file_path);
        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Document deleted successfully.');
    }
}

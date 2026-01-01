<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $entries = JournalEntry::orderBy('created_at', 'desc')->get();
        return view('journal.index', compact('entries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'entry_type' => 'required|in:gratitude,reflection,challenge,achievement,general',
        ]);

        $userId = Auth::id() ?? 1;

        JournalEntry::create([
            'user_id' => $userId,
            'title' => $request->title,
            'content' => $request->content,
            'entry_type' => $request->entry_type,
            'tags' => json_encode(explode(',', $request->tags)), // Simple tag logic
            'is_private' => $request->has('is_private'),
        ]);

        return redirect()->route('journal.index')->with('success', 'Journal entry saved.');
    }
}

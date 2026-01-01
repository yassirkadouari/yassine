<?php

namespace App\Http\Controllers;

use App\Models\MoodTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function index()
    {
        // For now, just getting all. In a real app, filter by Auth::id()
        // Assuming Auth is not fully set up, we might need a dummy user or just get all
        $moods = MoodTracking::orderBy('date', 'desc')->get();
        return view('mood.index', compact('moods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required',
            'date' => 'required|date',
            'energy_level' => 'nullable|integer|min:1|max:10',
            'stress_level' => 'nullable|integer|min:1|max:10',
            'sleep_quality' => 'nullable|integer|min:1|max:10',
        ]);

        // Mock User ID 1 if not logged in
        $userId = Auth::id() ?? 1;

        MoodTracking::create([
            'user_id' => $userId,
            'mood' => $request->mood,
            'date' => $request->date,
            'energy_level' => $request->energy_level,
            'stress_level' => $request->stress_level,
            'sleep_quality' => $request->sleep_quality,
            'notes' => $request->notes,
        ]);

        return redirect()->route('mood.index')->with('success', 'Mood tracked successfully!');
    }
}

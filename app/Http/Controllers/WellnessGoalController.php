<?php

namespace App\Http\Controllers;

use App\Models\WellnessGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WellnessGoalController extends Controller
{
    public function index()
    {
        $goals = WellnessGoal::orderBy('target_date', 'asc')->get();
        return view('goals.index', compact('goals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:physical,emotional,social,professional,spiritual',
            'start_date' => 'required|date',
            'target_date' => 'required|date|after_or_equal:start_date',
        ]);

        $userId = Auth::id() ?? 1;

        WellnessGoal::create([
            'user_id' => $userId,
            'title' => $request->title,
            'description' => $request->description ?? '',
            'category' => $request->category,
            'start_date' => $request->start_date,
            'target_date' => $request->target_date,
            'status' => 'in_progress',
            'progress' => 0
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal set successfully!');
    }

    // Add update progress method later if requested
}

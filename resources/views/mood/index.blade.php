@extends('layouts.app')

@section('content')
<div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1>Mood Tracker</h1>
        <p style="color: var(--text-muted);">Track your emotional journey day by day.</p>
    </div>
    <button onclick="document.getElementById('moodModal').style.display='flex'" class="btn btn-primary">
        <i class="ph ph-plus"></i> New Log
    </button>
</div>

<!-- Stats Overview -->
<div class="grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 40px; gap: 20px;">
    <div class="glass-card" style="text-align: center; padding: 15px;">
        <span style="display: block; font-size: 2rem;">😊</span>
        <span style="color: var(--text-muted); font-size: 0.9rem;">Most Frequent</span>
    </div>
    <div class="glass-card" style="text-align: center; padding: 15px;">
        <span style="display: block; font-size: 2rem; font-weight: 700; color: var(--primary);">7.5</span>
        <span style="color: var(--text-muted); font-size: 0.9rem;">Avg Energy</span>
    </div>
    <div class="glass-card" style="text-align: center; padding: 15px;">
        <span style="display: block; font-size: 2rem; font-weight: 700; color: var(--secondary);">Low</span>
        <span style="color: var(--text-muted); font-size: 0.9rem;">Avg Stress</span>
    </div>
    <div class="glass-card" style="text-align: center; padding: 15px;">
        <span style="display: block; font-size: 2rem; font-weight: 700; color: #10b981;">Good</span>
        <span style="color: var(--text-muted); font-size: 0.9rem;">Sleep Quality</span>
    </div>
</div>

<!-- Filter / Search (Placeholder) -->
<div class="glass-card" style="margin-bottom: 30px; padding: 15px; display: flex; gap: 15px;">
    <input type="text" placeholder="Search notes..." style="max-width: 300px;">
    <input type="date" style="max-width: 200px;">
</div>

<!-- History List -->
<div class="grid">
    @forelse($moods as $mood)
        <div class="glass-card">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <span style="font-weight: 600; color: var(--text-muted);">{{ \Carbon\Carbon::parse($mood->date)->format('M d, Y') }}</span>
                
                @php
                    $emoji = match($mood->mood) {
                        'very_happy' => '🤩',
                        'happy' => '🙂',
                        'neutral' => '😐',
                        'sad' => '🙁',
                        'very_sad' => '😭',
                        'anxious' => '😰',
                        'angry' => '😡',
                        'tired' => '😴',
                        default => '🤔'
                    };
                @endphp
                <span style="font-size: 1.5rem;">{{ $emoji }}</span>
            </div>
            
            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                <span style="background: rgba(99, 102, 241, 0.1); color: var(--primary); padding: 4px 10px; border-radius: 20px; font-size: 0.8rem;">
                    ⚡ Energy: {{ $mood->energy_level }}/10
                </span>
                <span style="background: rgba(236, 72, 153, 0.1); color: var(--secondary); padding: 4px 10px; border-radius: 20px; font-size: 0.8rem;">
                    🧠 Stress: {{ $mood->stress_level }}/10
                </span>
            </div>

            @if($mood->notes)
                <p style="font-size: 0.95rem; line-height: 1.5; color: var(--text-main);">
                    {{ Str::limit($mood->notes, 100) }}
                </p>
            @endif
        </div>
    @empty
        <div class="glass-card" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
            <p style="font-size: 1.2rem; color: var(--text-muted);">No moods logged yet.</p>
            <button onclick="document.getElementById('moodModal').style.display='flex'" class="btn btn-primary" style="margin-top: 15px;">
                Log your first mood
            </button>
        </div>
    @endforelse
</div>

<!-- Modal (Simple CSS implementation) -->
<div id="moodModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100; justify-content: center; align-items: center;">
    <div class="glass-card" style="background: white; width: 500px; max-width: 90%; max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <h2>Log Mood</h2>
            <button onclick="document.getElementById('moodModal').style.display='none'" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        
        <form action="{{ route('mood.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label>How are you feeling?</label>
                <select name="mood" required>
                    <option value="very_happy">🤩 Very Happy</option>
                    <option value="happy">🙂 Happy</option>
                    <option value="neutral">😐 Neutral</option>
                    <option value="sad">🙁 Sad</option>
                    <option value="very_sad">😭 Very Sad</option>
                    <option value="anxious">😰 Anxious</option>
                    <option value="angry">😡 Angry</option>
                    <option value="tired">😴 Tired</option>
                </select>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
                <div class="form-group">
                    <label>Energy (1-10)</label>
                    <input type="number" name="energy_level" min="1" max="10" value="5">
                </div>
                <div class="form-group">
                    <label>Stress (1-10)</label>
                    <input type="number" name="stress_level" min="1" max="10" value="5">
                </div>
                <div class="form-group">
                    <label>Sleep (1-10)</label>
                    <input type="number" name="sleep_quality" min="1" max="10" value="5">
                </div>
            </div>

            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes" rows="4" placeholder="Why do you feel this way?"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Save Log</button>
        </form>
    </div>
</div>
@endsection

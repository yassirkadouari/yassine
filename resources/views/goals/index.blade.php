@extends('layouts.app')

@section('content')
<div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1>Wellness Goals</h1>
        <p style="color: var(--text-muted);">Set targets. Track progress. Grow.</p>
    </div>
    <button onclick="document.getElementById('goalModal').style.display='flex'" class="btn btn-primary">
        <i class="ph ph-flag"></i> New Goal
    </button>
</div>

<div class="grid">
    @forelse($goals as $goal)
        <div class="glass-card">
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted);">{{ $goal->category }}</span>
                <span style="
                    background: {{ $goal->status == 'completed' ? '#d1fae5' : ($goal->status == 'abandoned' ? '#fee2e2' : '#e0e7ff') }}; 
                    color: {{ $goal->status == 'completed' ? '#059669' : ($goal->status == 'abandoned' ? '#dc2626' : '#4f46e5') }}; 
                    padding: 2px 8px; 
                    border-radius: 4px; 
                    font-size: 0.75rem; 
                    font-weight: 600;
                ">
                    {{ ucfirst(str_replace('_', ' ', $goal->status)) }}
                </span>
            </div>
            
            <h3 style="margin-bottom: 10px;">{{ $goal->title }}</h3>
            <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 20px; min-height: 50px;">
                {{ $goal->description }}
            </p>

            <div style="margin-bottom: 15px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.85rem;">
                    <span>Progress</span>
                    <span>{{ $goal->progress }}%</span>
                </div>
                <div style="height: 10px; background: #f3f4f6; border-radius: 5px; overflow: hidden;">
                    <div style="width: {{ $goal->progress }}%; background: var(--primary); height: 100%; transition: width 0.5s ease;"></div>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: var(--text-muted); border-top: 1px solid #f3f4f6; padding-top: 15px;">
                <span>Start: {{ \Carbon\Carbon::parse($goal->start_date)->format('M d') }}</span>
                <span>Target: {{ \Carbon\Carbon::parse($goal->target_date)->format('M d') }}</span>
            </div>
        </div>
    @empty
        <div class="glass-card" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
            <p style="font-size: 1.2rem; color: var(--text-muted);">No active goals. Set one to start your journey.</p>
        </div>
    @endforelse
</div>

<!-- Modal -->
<div id="goalModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100; justify-content: center; align-items: center;">
    <div class="glass-card" style="background: white; width: 600px; max-width: 90%; max-height: 90vh;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <h2>Set New Goal</h2>
            <button onclick="document.getElementById('goalModal').style.display='none'" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        
        <form action="{{ route('goals.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Goal Title</label>
                <input type="text" name="title" placeholder="e.g. Meditate daily for 10 mins" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" required>
                    <option value="physical">Physical Health</option>
                    <option value="emotional">Emotional Well-being</option>
                    <option value="social">Social Connection</option>
                    <option value="professional">Professional Growth</option>
                    <option value="spiritual">Spiritual</option>
                </select>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3" placeholder="Details about your goal..."></textarea>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr;">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label>Target Date</label>
                    <input type="date" name="target_date" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Create Goal</button>
        </form>
    </div>
</div>
@endsection

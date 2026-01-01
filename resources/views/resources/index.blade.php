@extends('layouts.app')

@section('content')
<div style="margin-bottom: 30px;">
    <h1>Resources Library</h1>
    <p style="color: var(--text-muted);">Curated tools to help you thrive.</p>
</div>

<!-- Category Pills (Visual only) -->
<div style="margin-bottom: 30px; display: flex; gap: 10px; flex-wrap: wrap;">
    <span class="badge" style="background: white; padding: 8px 16px; border-radius: 20px; border: 1px solid #e5e7eb; cursor: pointer;">Anxiety</span>
    <span class="badge" style="background: white; padding: 8px 16px; border-radius: 20px; border: 1px solid #e5e7eb; cursor: pointer;">Meditation</span>
    <span class="badge" style="background: white; padding: 8px 16px; border-radius: 20px; border: 1px solid #e5e7eb; cursor: pointer;">Sleep</span>
</div>

<div class="grid">
    @forelse($resources as $resource)
        <div class="glass-card">
            <!-- Type Icon -->
            <div style="margin-bottom: 15px; display: flex; justify-content: space-between;">
                <span style="font-size: 1.5rem;">
                    @if($resource->type == 'video') 📺 
                    @elseif($resource->type == 'article') 📄
                    @elseif($resource->type == 'podcast') 🎧
                    @else 🛠️ @endif
                </span>
                <span style="background: #f3f4f6; padding: 4px 10px; border-radius: 10px; font-size: 0.8rem; color: var(--text-muted);">
                    {{ $resource->duration_minutes }} min
                </span>
            </div>

            <h3 style="margin-bottom: 10px;">{{ $resource->title }}</h3>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 20px;">
                {{ Str::limit($resource->description, 100) }}
            </p>

            <a href="{{ $resource->url }}" target="_blank" class="btn" style="width: 100%; background: var(--primary); color: white; justify-content: center;">
                Open Resource
            </a>
        </div>
    @empty
        <!-- Include some static placeholders if DB is empty -->
        <div class="glass-card">
            <div style="margin-bottom: 15px; display: flex; justify-content: space-between;">
                <span style="font-size: 1.5rem;">🎧</span>
                <span style="background: #f3f4f6; padding: 4px 10px; border-radius: 10px; font-size: 0.8rem; color: var(--text-muted);">10 min</span>
            </div>
            <h3 style="margin-bottom: 10px;">Morning Mindfulness</h3>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 20px;">
                Start your day with intention and calm using this guided meditation.
            </p>
            <a href="#" class="btn" style="width: 100%; background: var(--primary); color: white; justify-content: center;">Listen Now</a>
        </div>

        <div class="glass-card">
            <div style="margin-bottom: 15px; display: flex; justify-content: space-between;">
                <span style="font-size: 1.5rem;">📄</span>
                <span style="background: #f3f4f6; padding: 4px 10px; border-radius: 10px; font-size: 0.8rem; color: var(--text-muted);">5 min read</span>
            </div>
            <h3 style="margin-bottom: 10px;">Understanding Anxiety</h3>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 20px;">
                Key concepts to help you recognize and manage anxious thoughts.
            </p>
            <a href="#" class="btn" style="width: 100%; background: var(--primary); color: white; justify-content: center;">Read Article</a>
        </div>
    @endforelse
</div>
@endsection

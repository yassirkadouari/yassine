@extends('layouts.app')

@section('content')
<div class="grid" style="grid-template-columns: 2fr 1fr; gap: 30px;">
    
    <!-- Left Column -->
    <div style="display: flex; flex-direction: column; gap: 30px;">
        
        <!-- Welcome Hero -->
        <section class="glass-card" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: white;">
            <h1 style="color: white; margin-bottom: 10px;">Welcome back, Yassine</h1>
            <p style="opacity: 0.9; font-size: 1.1rem; max-width: 600px;">
                "Your mental health is a priority. Your happiness is an essential. Your self-care is a necessity."
            </p>
            <div style="margin-top: 25px; display: flex; gap: 15px;">
                <a href="{{ route('mood.index') }}" class="btn" style="background: white; color: var(--primary);">
                    <i class="ph ph-plus-circle"></i> Log Mood
                </a>
                <a href="{{ route('journal.index') }}" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.4);">
                    <i class="ph ph-pencil-simple"></i> Write Journal
                </a>
            </div>
        </section>

            <!-- Chat with Doctor -->
            <section class="glass-card" style="margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                    <div style="background: rgba(16, 185, 129, 0.1); padding: 10px; border-radius: 50%;">
                        <i class="ph ph-stethoscope" style="font-size: 24px; color: #10b981;"></i>
                    </div>
                    <div>
                        <h3 style="margin: 0; font-size: 1.2rem;">Doctor Chat</h3>
                        <p style="margin: 0; font-size: 0.8rem; color: var(--text-muted);">Professional support</p>
                    </div>
                </div>
                <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 15px;">
                    Need advice or someone to talk to? Connect with a specialist now.
                </p>
                <a href="{{ route('chat.index') }}" class="btn" style="width: 100%; background: #10b981; color: white;">
                    Start Conversation
                </a>
            </section>

        <!-- Recent Moods (Placeholder visualization) -->
        <section>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2>Weekly Mood</h2>
                <a href="{{ route('mood.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 500;">View Report -></a>
            </div>
            
            <div class="glass-card">
                <!-- Simple bar chart simulation using HTML/CSS -->
                <div style="display: flex; align-items: flex-end; justify-content: space-between; height: 150px; padding-top: 20px;">
                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                        <div style="text-align: center; width: 100%;">
                            @php $height = rand(30, 90); $color = $height > 60 ? '#10b981' : ($height > 40 ? '#f59e0b' : '#ef4444'); @endphp
                            <div style="height: {{ $height }}%; width: 12px; background: {{ $color }}; margin: 0 auto; border-radius: 10px;"></div>
                            <span style="display: block; margin-top: 10px; font-size: 0.8rem; color: var(--text-muted);">{{ $day }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>

    <!-- Right Column -->
    <div style="display: flex; flex-direction: column; gap: 30px;">
        
        <!-- Quick Stats -->
        <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 15px;">
            <div class="glass-card" style="text-align: center; padding: 20px;">
                <i class="ph ph-fire" style="font-size: 32px; color: #f59e0b; margin-bottom: 10px;"></i>
                <h3 style="margin: 0; font-size: 2rem;">5</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Day Streak</p>
            </div>
            <div class="glass-card" style="text-align: center; padding: 20px;">
                <i class="ph ph-check-circle" style="font-size: 32px; color: #10b981; margin-bottom: 10px;"></i>
                <h3 style="margin: 0; font-size: 2rem;">12</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Goals Met</p>
            </div>
        </div>

        <!-- Recent Journal -->
        <section class="glass-card">
            <h3 style="margin-bottom: 20px;">Recent Thoughts</h3>
            <div style="border-left: 2px solid #e5e7eb; padding-left: 20px; margin-left: 10px;">
                <div style="margin-bottom: 20px;">
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Today, 10:30 AM</p>
                    <p style="font-weight: 500;">Feeling grateful for the little things...</p>
                </div>
                <div>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Yesterday, 8:15 PM</p>
                    <p style="font-weight: 500;">Had a bit of a rough start but...</p>
                </div>
            </div>
            <a href="{{ route('journal.index') }}" class="btn" style="width: 100%; margin-top: 20px; background: rgba(99, 102, 241, 0.1); color: var(--primary);">View All Entries</a>
        </section>

        <!-- Wellness Goals -->
        <section class="glass-card">
            <h3>Active Goals</h3>
            <div style="margin-top: 15px;">
                <div style="margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="font-weight: 500;">Meditation</span>
                        <span style="color: var(--primary);">80%</span>
                    </div>
                    <div style="height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                        <div style="height: 100%; width: 80%; background: var(--primary);"></div>
                    </div>
                </div>
                <div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="font-weight: 500;">Drink Water</span>
                        <span style="color: var(--secondary);">45%</span>
                    </div>
                    <div style="height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                        <div style="height: 100%; width: 45%; background: var(--secondary);"></div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection

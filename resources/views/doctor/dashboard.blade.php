@extends('layouts.app')

@section('content')
<div style="margin-bottom: 30px;">
    <h1>Doctor Dashboard</h1>
    <p style="color: var(--text-muted);">Overview of patient interactions</p>
</div>

<div class="grid" style="grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
    <div class="glass-card" style="padding: 30px;">
        <h3>My Patients</h3>
        <p style="font-size: 2rem; font-weight: 700; color: var(--primary);">24</p>
    </div>
    <div class="glass-card" style="padding: 30px;">
        <h3>Messages</h3>
        <p style="font-size: 2rem; font-weight: 700; color: var(--secondary);">5 New</p>
    </div>
</div>

<div class="glass-card">
    <h3>Quick Actions</h3>
    <div style="display: flex; gap: 15px; margin-top: 20px;">
        <a href="{{ route('doctor.chat') }}" class="btn btn-primary">Go to Chat</a>
    </div>
</div>
@endsection

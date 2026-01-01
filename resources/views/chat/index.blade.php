@extends('layouts.app')

@section('content')
<div class="grid" style="grid-template-columns: 300px 1fr; gap: 30px; height: calc(100vh - 150px);">
    
    <!-- Contacts List -->
    <div class="glass-card" style="padding: 20px; overflow-y: auto;">
        <h3 style="margin-bottom: 20px;">Contacts</h3>
        @foreach($contacts as $contact)
        <a href="{{ route('chat.show', $contact->id) }}" style="display: block; padding: 15px; border-radius: 12px; margin-bottom: 10px; background: rgba(255,255,255,0.5); text-decoration: none; color: var(--text-main); transition: background 0.2s;">
            <div style="font-weight: 600;">{{ $contact->name }}</div>
            <div style="font-size: 0.8rem; color: var(--text-muted);">Click to chat</div>
        </a>
        @endforeach
    </div>

    <!-- Chat Area Placeholder -->
    <div class="glass-card" style="display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
        <p>Select a contact to start chatting</p>
    </div>
</div>
@endsection

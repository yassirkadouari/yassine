@extends('layouts.app')

@section('content')
<div class="grid" style="grid-template-columns: 1fr; height: calc(100vh - 150px);">
    
    <div class="glass-card" style="display: flex; flex-direction: column; padding: 0; overflow: hidden;">
        <!-- Header -->
        <div style="padding: 20px; border-bottom: 1px solid rgba(0,0,0,0.05); background: rgba(255,255,255,0.3); display: flex; justify-content: space-between; align-items: center;">
            <div style="font-weight: 700;">{{ $otherUser->name }}</div>
            <a href="{{ route('chat.index') }}" class="btn" style="padding: 5px 10px; font-size: 0.8rem;">Back</a>
        </div>

        <!-- Messages -->
        <div style="flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 15px;">
            @foreach($messages as $msg)
                <div style="max-width: 70%; padding: 12px 18px; border-radius: 18px; font-size: 0.95rem; line-height: 1.4; 
                    {{ $msg->sender_id == Auth::id() ? 
                        'align-self: flex-end; background: var(--primary); color: white; border-bottom-right-radius: 4px;' : 
                        'align-self: flex-start; background: rgba(255,255,255,0.8); color: var(--text-main); border-bottom-left-radius: 4px;' 
                    }}">
                    {{ $msg->content }}
                    <div style="font-size: 0.7rem; margin-top: 5px; opacity: 0.7; text-align: right;">
                        {{ $msg->created_at->format('H:i') }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Input -->
        <div style="padding: 20px; background: rgba(255,255,255,0.3);">
            <form action="{{ route('chat.store', $otherUser->id) }}" method="POST" style="display: flex; gap: 10px;">
                @csrf
                <input type="text" name="content" placeholder="Type a message..." required autocomplete="off">
                <button type="submit" class="btn btn-primary" style="border-radius: 50%; width: 50px; height: 50px; padding: 0; display: flex; align-items: center; justify-content: center;">
                    <i class="ph ph-paper-plane-right" style="font-size: 1.2rem;"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

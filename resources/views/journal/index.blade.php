@extends('layouts.app')

@section('content')
<div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1>Journal</h1>
        <p style="color: var(--text-muted);">Reflect, write, and clear your mind.</p>
    </div>
    <button onclick="document.getElementById('journalModal').style.display='flex'" class="btn btn-primary">
        <i class="ph ph-pen-nib"></i> New Entry
    </button>
</div>

<!-- Tabs/Filters -->
<div style="margin-bottom: 30px; display: flex; gap: 15px; overflow-x: auto; padding-bottom: 5px;">
    <button class="btn" style="background: white; border: 1px solid #e5e7eb;">All</button>
    <button class="btn" style="background: white; border: 1px solid #e5e7eb;">Gratitude</button>
    <button class="btn" style="background: white; border: 1px solid #e5e7eb;">Reflection</button>
    <button class="btn" style="background: white; border: 1px solid #e5e7eb;">Challenges</button>
</div>

<!-- Entries Grid -->
<div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); align-items: start;">
    @forelse($entries as $entry)
        <div class="glass-card" style="display: flex; flex-direction: column; gap: 15px;">
            <div style="display: flex; justify-content: space-between; align-items: start;">
                <span class="badge" style="
                    background: rgba(99, 102, 241, 0.1); 
                    color: var(--primary); 
                    padding: 4px 12px; 
                    border-radius: 20px; 
                    font-size: 0.8rem; 
                    text-transform: capitalize;
                ">
                    {{ $entry->entry_type }}
                </span>
                <span style="font-size: 0.8rem; color: var(--text-muted);">
                    {{ $entry->created_at->format('M d, H:i') }}
                </span>
            </div>

            <h3 style="font-size: 1.25rem; margin: 0;">{{ $entry->title }}</h3>
            
            <div style="font-family: 'Courier New', Courier, monospace; font-size: 0.95rem; color: #4b5563; line-height: 1.6;">
                {{ Str::limit($entry->content, 200) }}
            </div>

            <div style="margin-top: auto; padding-top: 15px; border-top: 1px solid #f3f4f6; display: flex; gap: 10px;">
                @if($entry->tags)
                    @foreach(json_decode($entry->tags) as $tag)
                        <span style="font-size: 0.8rem; color: var(--text-muted);">#{{ trim($tag) }}</span>
                    @endforeach
                @endif
            </div>
        </div>
    @empty
        <div class="glass-card" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
            <div style="margin-bottom: 20px; font-size: 3rem; color: #d1d5db;">📓</div>
            <p style="font-size: 1.2rem; color: var(--text-muted);">Your journal is empty.</p>
            <p style="margin-bottom: 30px; color: var(--text-muted);">Start writing to clear your mind.</p>
            <button onclick="document.getElementById('journalModal').style.display='flex'" class="btn btn-primary">
                Write first entry
            </button>
        </div>
    @endforelse
</div>

<!-- Modal -->
<div id="journalModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100; justify-content: center; align-items: center;">
    <div class="glass-card" style="background: white; width: 700px; max-width: 90%; max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <h2>New Entry</h2>
            <button onclick="document.getElementById('journalModal').style.display='none'" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        
        <form action="{{ route('journal.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" placeholder="Give your entry a title..." required>
            </div>

            <div class="form-group">
                <label>Type</label>
                <select name="entry_type" required>
                    <option value="general">Daily Journal</option>
                    <option value="gratitude">Gratitude</option>
                    <option value="reflection">Reflection</option>
                    <option value="challenge">Challenge / Issue</option>
                    <option value="achievement">Achievement</option>
                </select>
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" rows="10" placeholder="Write whatever is on your mind..." required style="resize: vertical;"></textarea>
            </div>

            <div class="form-group">
                <label>Tags (comma separated)</label>
                <input type="text" name="tags" placeholder="e.g. work, anxiety, family">
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_private" checked style="width: auto;">
                    <span>Keep Private</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Save Entry</button>
        </form>
    </div>
</div>
@endsection

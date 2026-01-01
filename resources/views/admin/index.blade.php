@extends('layouts.app')

@section('content')
<div style="margin-bottom: 30px;">
    <h1>Admin Panel</h1>
    <p style="color: var(--text-muted);">Manage users and system settings.</p>
</div>

<div class="glass-card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid #f3f4f6;">
                <th style="padding: 15px;">Name</th>
                <th style="padding: 15px;">Email</th>
                <th style="padding: 15px;">Role</th>
                <th style="padding: 15px;">Status</th>
                <th style="padding: 15px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr style="border-bottom: 1px solid #f3f4f6;">
                <td style="padding: 15px; font-weight: 500;">{{ $user->name }}</td>
                <td style="padding: 15px;">{{ $user->email }}</td>
                <td style="padding: 15px;">
                    <span style="
                        padding: 4px 10px; border-radius: 12px; font-size: 0.8rem;
                        background: {{ $user->role === 'admin' ? '#fee2e2' : ($user->role === 'doctor' ? '#e0e7ff' : '#d1fae5') }};
                        color: {{ $user->role === 'admin' ? '#ef4444' : ($user->role === 'doctor' ? '#4f46e5' : '#059669') }};
                    ">{{ ucfirst($user->role) }}</span>
                </td>
                <td style="padding: 15px;">
                    @if($user->is_approved)
                        <span style="color: #059669;">Active</span>
                    @else
                        <span style="color: #ea580c;">Pending</span>
                    @endif
                </td>
                <td style="padding: 15px;">
                    <form action="{{ route('admin.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="padding: 6px 12px; font-size: 0.8rem; background: #fee2e2; color: #ef4444;">Delete</button>
                    </form>
                    @if($user->role === 'doctor')
                    <form action="{{ route('admin.approve', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn" style="padding: 6px 12px; font-size: 0.8rem; background: #f3f4f6; color: var(--text-main);">
                            {{ $user->is_approved ? 'Suspend' : 'Approve' }}
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

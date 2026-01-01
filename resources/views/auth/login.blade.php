@extends('layouts.app')

@section('content')
<div style="max-width: 400px; margin: 40px auto;">
    <div class="glass-card" style="padding: 40px;">
        <h2 style="text-align: center; margin-bottom: 30px;">Welcome Back</h2>
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span style="color: #ef4444; font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Sign In</button>
        </form>

        <div style="margin-top: 20px; text-align: center; font-size: 0.9rem;">
            Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 600;">Sign Up</a>
        </div>
    </div>
</div>
@endsection

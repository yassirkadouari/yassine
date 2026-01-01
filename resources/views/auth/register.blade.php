@extends('layouts.app')

@section('content')
<div style="max-width: 500px; margin: 40px auto;">
    <div class="glass-card" style="padding: 40px;">
        <h2 style="text-align: center; margin-bottom: 30px;">Create Account</h2>
        
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name') <span style="color: #ef4444; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <span style="color: #ef4444; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>I am a...</label>
                <select name="role" required>
                    <option value="student">Student</option>
                    <option value="doctor">Doctor / Specialist</option>
                </select>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                    @error('password') <span style="color: #ef4444; font-size: 0.8rem;">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Sign Up</button>
        </form>

        <div style="margin-top: 20px; text-align: center; font-size: 0.9rem;">
            Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600;">Sign In</a>
        </div>
    </div>
</div>
@endsection

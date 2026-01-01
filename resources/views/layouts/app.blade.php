<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Mental Health Tracker') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Styles -->
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --bg-body: #f3f4f6;
            --surface: rgba(255, 255, 255, 0.7);
            --surface-hover: rgba(255, 255, 255, 0.9);
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border: rgba(255, 255, 255, 0.5);
            --shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            --glass-border: 1px solid rgba(255, 255, 255, 0.18);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%);
            color: var(--text-main);
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Glassmorphism Utilities */
        .glass {
            background: var(--surface);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 24px;
            border: var(--glass-border);
            box-shadow: var(--shadow);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            padding: 24px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            margin-bottom: 40px;
            margin-top: 20px;
        }

        .logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-main);
            font-weight: 500;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-muted);
        }

        input, textarea, select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: rgba(255, 255, 255, 0.9);
            font-family: inherit;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Grid Layouts */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        /* Typography */
        h1, h2, h3 {
            color: var(--text-main);
            margin-bottom: 1rem;
        }
        
        h1 { font-size: 2.5rem; line-height: 1.2; }
        h2 { font-size: 1.8rem; }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(10px);
        }

        @keyframes fadeIn {
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>
<body>
    <div class="container">
        <nav class="glass">
            <a href="{{ url('/') }}" class="logo">
                <i class="ph ph-brain" style="font-size: 32px;"></i>
                <span>MindTrack</span>
            </a>
            <div class="nav-links">
                @auth
                    @if(Auth::user()->role === 'student')
                        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                            <i class="ph ph-house"></i> Dashboard
                        </a>
                        <a href="{{ route('mood.index') }}" class="nav-link {{ request()->routeIs('mood.*') ? 'active' : '' }}">
                            <i class="ph ph-smiley"></i> Mood
                        </a>
                        <a href="{{ route('journal.index') }}" class="nav-link {{ request()->routeIs('journal.*') ? 'active' : '' }}">
                            <i class="ph ph-notebook"></i> Journal
                        </a>
                        <a href="{{ route('goals.index') }}" class="nav-link {{ request()->routeIs('goals.*') ? 'active' : '' }}">
                            <i class="ph ph-target"></i> Goals
                        </a>
                        <a href="{{ route('resources.index') }}" class="nav-link {{ request()->routeIs('resources.*') ? 'active' : '' }}">
                            <i class="ph ph-book-open"></i> Resources
                        </a>
                        <a href="{{ route('chat.index') }}" class="nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">
                            <i class="ph ph-chats"></i> Chat with Doctor
                        </a>
                    @elseif(Auth::user()->role === 'doctor')
                        <a href="{{ route('doctor.dashboard') }}" class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                            <i class="ph ph-house"></i> Dashboard
                        </a>
                        <a href="{{ route('doctor.chat') }}" class="nav-link {{ request()->routeIs('doctor.chat') ? 'active' : '' }}">
                            <i class="ph ph-chats"></i> Student Chat
                        </a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="ph ph-shield-check"></i> Admin Panel
                        </a>
                    @endif
                @endauth
            </div>
            <!-- Authenticated User Menu -->
            @auth
            <div style="display: flex; gap: 20px; align-items: center;">
                <div class="user-menu" style="display: flex; align-items: center; gap: 10px;">
                    <div style="text-align: right;">
                        <span style="display: block; font-weight: 600; font-size: 0.9rem;">{{ Auth::user()->name }}</span>
                        <span style="display: block; font-size: 0.8rem; color: var(--text-muted); text-transform: capitalize;">{{ Auth::user()->role }}</span>
                    </div>
                    <div style="background: var(--primary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn" style="padding: 8px 16px; font-size: 0.9rem; background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                        <i class="ph ph-sign-out"></i>
                    </button>
                </form>
            </div>
            @endauth

            <!-- Guest Menu -->
            @guest
            <div class="nav-links">
                <a href="{{ route('login') }}" class="btn" style="background: transparent; color: var(--text-main);">Log In</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
            </div>
            @endguest
        </nav>

        <main class="fade-in">
            @yield('content')
        </main>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') | PearlMind</title>
    <link rel="icon" href="{{ asset('images/PearlMind-logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --blue: #2F68EF; --navy: #1A3E9A; --ink: #121826; --muted: #5c6578; --line: #e6eaf2; --bg: #f4f7fb; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Inter, sans-serif; color: var(--ink); background: var(--bg); }
        a { color: var(--navy); text-decoration: none; }
        .shell { display: flex; min-height: 100vh; }
        .side { width: 240px; background: #0e1726; color: #fff; padding: 24px 16px; flex-shrink: 0; }
        .side img { height: 42px; width: auto; border-radius: 8px; background: #fff; }
        .side nav { display: flex; flex-direction: column; gap: 6px; margin-top: 28px; }
        .side a { color: #d7deea; padding: 10px 12px; border-radius: 10px; }
        .side a.active, .side a:hover { background: rgba(47,104,239,.25); color: #fff; }
        .main { flex: 1; padding: 28px; }
        .top { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 22px; }
        h1 { margin: 0; font-size: 26px; }
        .cards { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; margin-bottom: 22px; }
        .card, .panel { background: #fff; border: 1px solid var(--line); border-radius: 16px; padding: 18px; }
        .card span { display: block; color: var(--muted); font-size: 13px; }
        .card strong { font-size: 28px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px 10px; border-bottom: 1px solid var(--line); vertical-align: top; }
        th { font-size: 12px; letter-spacing: .04em; text-transform: uppercase; color: var(--muted); }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 999px; font-size: 12px; background: #e8eefc; color: var(--navy); }
        .badge.new { background: #2F68EF; color: #fff; }
        .btn { display: inline-flex; align-items: center; border: 0; background: var(--blue); color: #fff; border-radius: 10px; padding: 10px 14px; cursor: pointer; font: inherit; }
        .btn.ghost { background: transparent; color: #d7deea; padding: 10px 12px; }
        .login { min-height: 100vh; display: grid; place-items: center; padding: 24px; }
        .login form { width: min(420px, 100%); background: #fff; border-radius: 18px; padding: 28px; border: 1px solid var(--line); }
        label { display: block; margin: 14px 0 6px; font-size: 14px; }
        input, textarea, select { width: 100%; border: 1px solid var(--line); border-radius: 10px; padding: 12px; font: inherit; background: #fff; }
        textarea { min-height: 90px; }
        .row-actions { display: flex; gap: 8px; align-items: center; }
        .btn.light { background: #e8eefc; color: var(--navy); }
        .btn.danger { background: #b42318; }
        .note { background: #e8eefc; color: var(--navy); padding: 10px 12px; border-radius: 10px; margin-bottom: 14px; }
        .check { display: flex; align-items: center; gap: 8px; margin-top: 14px; }
        .check input { width: auto; }
        .error { color: #b42318; font-size: 14px; }
        .work { display: flex; gap: 14px; align-items: center; }
        .work img { width: 120px; height: 72px; object-fit: cover; border-radius: 8px; background: #eef2f8; }
        .pager { margin-top: 16px; }
        @media (max-width: 800px) {
            .shell { display: block; }
            .side { width: 100%; }
            .cards { grid-template-columns: 1fr; }
            .work { align-items: flex-start; }
        }
    </style>
</head>
<body>
@auth
<div class="shell">
    <aside class="side">
        <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('images/PearlMind-logo.jpeg') }}" alt="PearlMind"></a>
        <nav>
            <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Dashboard</a>
            <a href="{{ route('admin.inquiries') }}" @class(['active' => request()->routeIs('admin.inquiries*')])>Contact messages</a>
            <a href="{{ route('admin.team.index') }}" @class(['active' => request()->routeIs('admin.team.*')])>Team</a>
            <a href="{{ route('admin.portfolio') }}" @class(['active' => request()->routeIs('admin.portfolio*')])>Portfolio</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn ghost" type="submit">Log out</button>
            </form>
        </nav>
    </aside>
    <main class="main">
        @if (session('status'))
            <p class="note">{{ session('status') }}</p>
        @endif
        @yield('content')
    </main>
</div>
@else
    @yield('content')
@endauth
</body>
</html>

@extends('admin.layout')

@section('title', 'Log in')

@section('content')
<div class="login">
    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf
        <img src="{{ asset('images/PearlMind-logo.jpeg') }}" alt="PearlMind" style="height:52px;border-radius:8px">
        <h1 style="margin:16px 0 6px">Admin</h1>
        <p style="margin:0;color:#5c6578">Team, portfolio, and contact messages.</p>
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
        @error('email')<p class="error">{{ $message }}</p>@enderror
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>
        <label style="display:flex;align-items:center;gap:8px">
            <input type="checkbox" name="remember" value="1" style="width:auto"> Remember me
        </label>
        <button class="btn" type="submit" style="margin-top:8px">Log in</button>
    </form>
</div>
@endsection

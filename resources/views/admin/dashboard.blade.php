@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="top"><h1>Dashboard</h1></div>
<div class="cards">
    <div class="card"><span>Contact messages</span><strong>{{ $inquiryCount }}</strong></div>
    <div class="card"><span>Unread</span><strong>{{ $unreadCount }}</strong></div>
    <div class="card"><span>Portfolio sites</span><strong>{{ $portfolioCount }}</strong></div>
    <div class="card"><span>Team members</span><strong>{{ $teamCount }}</strong></div>
</div>
<div class="panel">
    <h2 style="margin-top:0">Latest messages</h2>
    @if ($recent->isEmpty())
        <p>No contact messages yet.</p>
    @else
        <table>
            <thead><tr><th>Name</th><th>Service</th><th>When</th></tr></thead>
            <tbody>
            @foreach ($recent as $inquiry)
                <tr>
                    <td><a href="{{ route('admin.inquiries.show', $inquiry) }}">{{ $inquiry->name }}</a></td>
                    <td>{{ $inquiry->service }}</td>
                    <td>{{ $inquiry->created_at->format('d M Y, H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

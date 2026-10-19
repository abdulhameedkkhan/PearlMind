@extends('admin.layout')

@section('title', 'Contact messages')

@section('content')
<div class="top"><h1>Contact messages</h1></div>
<div class="panel">
    @if ($inquiries->isEmpty())
        <p>No one has submitted the contact form yet.</p>
    @else
        <table>
            <thead>
                <tr><th>Status</th><th>Name</th><th>Email</th><th>Phone</th><th>Service</th><th>Received</th></tr>
            </thead>
            <tbody>
            @foreach ($inquiries as $inquiry)
                <tr>
                    <td><span class="badge {{ $inquiry->isRead() ? '' : 'new' }}">{{ $inquiry->isRead() ? 'Read' : 'New' }}</span></td>
                    <td><a href="{{ route('admin.inquiries.show', $inquiry) }}">{{ $inquiry->name }}</a></td>
                    <td>{{ $inquiry->email }}</td>
                    <td>{{ $inquiry->phone }}</td>
                    <td>{{ $inquiry->service }}</td>
                    <td>{{ $inquiry->created_at->format('d M Y, H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pager">{{ $inquiries->links() }}</div>
    @endif
</div>
@endsection

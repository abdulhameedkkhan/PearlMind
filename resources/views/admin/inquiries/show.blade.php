@extends('admin.layout')

@section('title', $inquiry->name)

@section('content')
<div class="top">
    <h1>{{ $inquiry->name }}</h1>
    <a href="{{ route('admin.inquiries') }}">Back to messages</a>
</div>
<div class="panel">
    <p><strong>Email:</strong> <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></p>
    <p><strong>Phone:</strong> <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a></p>
    <p><strong>Service:</strong> {{ $inquiry->service }}</p>
    <p><strong>Received:</strong> {{ $inquiry->created_at->format('d M Y, H:i') }}</p>
    <h2>Message</h2>
    <p style="white-space:pre-wrap">{{ $inquiry->message }}</p>
</div>
@endsection

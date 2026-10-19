@extends('admin.layout')

@section('title', 'Portfolio')

@section('content')
<div class="top">
    <h1>Portfolio</h1>
    <a class="btn" href="{{ route('admin.portfolio.create') }}">Add website</a>
</div>
<div class="panel">
    @if ($projects->isEmpty())
        <p>No portfolio items yet.</p>
    @else
        <table>
            <thead><tr><th>Site</th><th>Category</th><th>Order</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>
                        <div class="work">
                            <img src="{{ $project->image }}" alt="">
                            <div>
                                <strong>{{ $project->title }}</strong><br>
                                <a href="{{ $project->url }}" target="_blank" rel="noopener">{{ $project->domain() }}</a>
                            </div>
                        </div>
                    </td>
                    <td>{{ $project->category }}</td>
                    <td>{{ $project->sort_order }}</td>
                    <td><span class="badge">{{ $project->is_active ? 'Shown' : 'Hidden' }}</span></td>
                    <td>
                        <div class="row-actions">
                            <a class="btn light" href="{{ route('admin.portfolio.edit', $project) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.portfolio.destroy', $project) }}" onsubmit="return confirm('Remove this website?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

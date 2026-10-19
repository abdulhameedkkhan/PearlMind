@extends('admin.layout')

@section('title', 'Team')

@section('content')
<div class="top">
    <h1>Team members</h1>
    <a class="btn" href="{{ route('admin.team.create') }}">Add member</a>
</div>
<div class="panel">
    @if ($members->isEmpty())
        <p>No team members yet.</p>
    @else
        <table>
            <thead><tr><th>Photo</th><th>Name</th><th>Role</th><th>Order</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach ($members as $member)
                <tr>
                    <td><img src="{{ $member->photo }}" alt="" style="width:64px;height:64px;object-fit:cover;border-radius:8px"></td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->role }}</td>
                    <td>{{ $member->sort_order }}</td>
                    <td><span class="badge">{{ $member->is_active ? 'Shown' : 'Hidden' }}</span></td>
                    <td>
                        <div class="row-actions">
                            <a class="btn light" href="{{ route('admin.team.edit', $member) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Remove this team member?')">
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

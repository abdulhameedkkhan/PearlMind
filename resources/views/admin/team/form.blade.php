@extends('admin.layout')

@section('title', $member->exists ? 'Edit member' : 'Add member')

@section('content')
<div class="top">
    <h1>{{ $member->exists ? 'Edit member' : 'Add member' }}</h1>
    <a href="{{ route('admin.team.index') }}">Back</a>
</div>
<div class="panel" style="max-width:640px">
    <form method="POST" action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($member->exists) @method('PUT') @endif
        <label for="name">Name</label>
        <input id="name" name="name" value="{{ old('name', $member->name) }}" required>
        @error('name')<p class="error">{{ $message }}</p>@enderror
        <label for="role">Role</label>
        <input id="role" name="role" value="{{ old('role', $member->role) }}" required placeholder="Founder, Designer, Developer">
        @error('role')<p class="error">{{ $message }}</p>@enderror
        <label for="sort_order">Order</label>
        <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $member->sort_order) }}">
        <label for="photo">Photo {{ $member->exists ? '(leave empty to keep current)' : '' }}</label>
        @if ($member->photo)
            <img src="{{ $member->photo }}" alt="" style="width:96px;height:96px;object-fit:cover;border-radius:10px;margin-bottom:8px">
        @endif
        <input id="photo" name="photo" type="file" accept="image/*" {{ $member->exists ? '' : 'required' }}>
        @error('photo')<p class="error">{{ $message }}</p>@enderror
        <label class="check"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $member->is_active))> Show on the website</label>
        <button class="btn" type="submit" style="margin-top:16px">Save</button>
    </form>
</div>
@endsection

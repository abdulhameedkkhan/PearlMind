@extends('admin.layout')

@section('title', $project->exists ? 'Edit website' : 'Add website')

@section('content')
<div class="top">
    <h1>{{ $project->exists ? 'Edit website' : 'Add website' }}</h1>
    <a href="{{ route('admin.portfolio') }}">Back</a>
</div>
<div class="panel" style="max-width:640px">
    <form method="POST" action="{{ $project->exists ? route('admin.portfolio.update', $project) : route('admin.portfolio.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($project->exists) @method('PUT') @endif
        <label for="title">Name</label>
        <input id="title" name="title" value="{{ old('title', $project->title) }}" required>
        @error('title')<p class="error">{{ $message }}</p>@enderror
        <label for="url">Website URL</label>
        <input id="url" name="url" value="{{ old('url', $project->url) }}" required placeholder="https://example.com">
        @error('url')<p class="error">{{ $message }}</p>@enderror
        <label for="category">Category</label>
        <input id="category" name="category" value="{{ old('category', $project->category) }}" required placeholder="Website, E-commerce, Beauty">
        @error('category')<p class="error">{{ $message }}</p>@enderror
        <label for="sort_order">Order</label>
        <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $project->sort_order) }}">
        <label for="image">Screenshot {{ $project->exists ? '(leave empty to keep current)' : '' }}</label>
        @if ($project->image)
            <img src="{{ $project->image }}" alt="" style="width:180px;height:110px;object-fit:cover;border-radius:10px;margin-bottom:8px">
        @endif
        <input id="image" name="image" type="file" accept="image/*" {{ $project->exists ? '' : 'required' }}>
        @error('image')<p class="error">{{ $message }}</p>@enderror
        <label class="check"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $project->is_active))> Show on the website</label>
        <button class="btn" type="submit" style="margin-top:16px">Save</button>
    </form>
</div>
@endsection

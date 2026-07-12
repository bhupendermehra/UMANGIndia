@extends('admin.layouts.app')

@section('title', 'Edit: ' . $category->name)

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Category</h1>
    <a href="{{ route('admin.categories.index') }}" class="text-sm text-primary-600 hover:underline">← Back to Categories</a>
</div>

<form method="POST" action="{{ route('admin.categories.update', $category) }}" class="max-w-2xl">
    @csrf
    @method('PUT')
    @include('admin.categories._form', ['submitText' => 'Update Category'])
</form>
@endsection

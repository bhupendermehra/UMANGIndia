@extends('admin.layouts.app')

@section('title', 'Edit: ' . $state->name)

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit State/UT</h1>
    <a href="{{ route('admin.states.index') }}" class="text-sm text-primary-600 hover:underline">← Back to States</a>
</div>

<form method="POST" action="{{ route('admin.states.update', $state) }}" class="max-w-2xl">
    @csrf
    @method('PUT')
    @include('admin.states._form', ['submitText' => 'Update State'])
</form>
@endsection

@extends('admin.layouts.app')

@section('title', 'Add State')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Add New State/UT</h1>
    <a href="{{ route('admin.states.index') }}" class="text-sm text-primary-600 hover:underline">← Back to States</a>
</div>

<form method="POST" action="{{ route('admin.states.store') }}" class="max-w-2xl">
    @csrf
    @include('admin.states._form', ['submitText' => 'Create State'])
</form>
@endsection

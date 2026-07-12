@extends('admin.layouts.app')

@section('title', 'Add New Scheme')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Add New Scheme</h1>
        <a href="{{ route('admin.schemes.index') }}" class="text-sm text-primary-600 hover:underline">← Back to Schemes</a>
    </div>
</div>

<form method="POST" action="{{ route('admin.schemes.store') }}">
    @csrf
    @include('admin.schemes._form', ['submitText' => 'Create Scheme'])
</form>
@endsection

@extends('layouts.app')

@section('title', $category->name . ' Schemes - UmangIndia')
@section('description', $category->description ?? 'Browse all ' . $category->name . ' related government schemes.')

@section('content')
<nav class="text-sm mb-6">
    <ol class="flex items-center gap-2 text-slate-500 flex-wrap">
        <li><a href="{{ route('home') }}" class="hover:text-[#0B4EA2] transition">Home</a></li>
        <li>›</li>
        <li class="text-slate-800 font-medium">{{ $category->name }}</li>
    </ol>
</nav>

<section class="surface-card p-6 md:p-8 mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
        <div class="w-16 h-16 bg-[#eef4fb] rounded-2xl flex items-center justify-center text-3xl">{{ $category->icon }}</div>
        <div>
            <h1 class="text-2xl md:text-3xl font-bold section-title">{{ $category->name }}</h1>
            <p class="text-slate-600 mt-1">{{ $category->description }}</p>
            <p class="text-sm muted mt-1">{{ $category->schemes_count }} schemes available</p>
        </div>
    </div>
</section>

@if($schemes->count())
<div class="space-y-4">
    @foreach($schemes as $scheme)
    <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover block p-5 group focus-ring">
        <div class="flex items-center gap-2 mb-2 flex-wrap">
            @if($scheme->status === 'active')
            <span class="bg-green-50 text-green-600 text-xs px-2.5 py-1 rounded-full font-medium">Active</span>
            @elseif($scheme->status === 'upcoming')
            <span class="bg-yellow-50 text-yellow-600 text-xs px-2.5 py-1 rounded-full font-medium">Upcoming</span>
            @else
            <span class="bg-red-50 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">Closed</span>
            @endif
            @if($scheme->state)
            <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded-full">{{ $scheme->state->name }}</span>
            @endif
        </div>
        <h3 class="font-bold text-lg text-slate-800 group-hover:text-[#0B4EA2] transition">{{ $scheme->title }}</h3>
        <p class="text-sm muted mt-1 line-clamp-2">{{ $scheme->short_description }}</p>
    </a>
    @endforeach
</div>
<div class="mt-6">{{ $schemes->links() }}</div>
@else
<div class="surface-card p-12 text-center">
    <p class="text-slate-500 text-lg">No schemes found in this category.</p>
    <a href="{{ route('schemes.index') }}" class="mt-3 inline-block text-[#0B4EA2] hover:underline">View all schemes →</a>
</div>
@endif
@endsection

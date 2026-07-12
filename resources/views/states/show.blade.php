@extends('layouts.app')

@section('title', $state->name . ' Schemes - UmangIndia')
@section('description', 'Browse all government schemes available in ' . $state->name . '.')

@section('content')
<nav class="text-sm mb-6">
    <ol class="flex items-center gap-2 text-slate-500 flex-wrap">
        <li><a href="{{ route('home') }}" class="hover:text-[#0B4EA2] transition">Home</a></li>
        <li>›</li>
        <li class="text-slate-800 font-medium">{{ $state->name }}</li>
    </ol>
</nav>

<section class="surface-card p-6 md:p-8 mb-8">
    <h1 class="text-2xl md:text-3xl font-bold section-title">{{ $state->name }}</h1>
    <p class="text-slate-600 mt-1">{{ $state->schemes_count }} government schemes available</p>
</section>

@if($schemes->count())
<div class="space-y-4">
    @foreach($schemes as $scheme)
    <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover block p-5 group focus-ring">
        <div class="flex items-center gap-2 mb-2 flex-wrap">
            <span class="bg-[#eef4fb] text-[#0B4EA2] text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name }}</span>
            @if($scheme->status === 'active')
            <span class="bg-green-50 text-green-600 text-xs px-2.5 py-1 rounded-full font-medium">Active</span>
            @elseif($scheme->status === 'upcoming')
            <span class="bg-yellow-50 text-yellow-600 text-xs px-2.5 py-1 rounded-full font-medium">Upcoming</span>
            @else
            <span class="bg-red-50 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">Closed</span>
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
    <p class="text-slate-500 text-lg">No schemes found for this state.</p>
    <a href="{{ route('schemes.index') }}" class="mt-3 inline-block text-[#0B4EA2] hover:underline">View all schemes →</a>
</div>
@endif
@endsection

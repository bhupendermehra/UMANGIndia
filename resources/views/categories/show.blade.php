@extends('layouts.app')

@section('title', $category->meta_title ?: $category->name . ' Schemes - UmangIndia')
@section('description', $category->meta_description ?: 'Browse all ' . $category->name . ' related government schemes.')

@php
    // Build state slug lookup map for badges
    $stateSlugs = [];
    if ($stateBreakdown->count()) {
        $stateSlugs = \App\Models\State::whereIn('name', $stateBreakdown->keys())->pluck('slug', 'name')->toArray();
    }
@endphp

@push('head')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {"@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ route('home') }}"},
        {"@@type": "ListItem", "position": 2, "name": "Categories", "item": "{{ route('schemes.index') }}"},
        {"@@type": "ListItem", "position": 3, "name": "{{ $category->name }}", "item": "{{ route('categories.show', $category) }}"}
    ]
}
</script>
@endpush

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden mb-10 rounded-2xl bg-gradient-to-br from-slate-900 via-indigo-900 to-blue-900 text-white">
    <!-- Decorative pattern overlay -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="cat-grid" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1.5" fill="white" opacity="0.6"/>
                    <path d="M0 20 L40 20 M20 0 L20 40" stroke="white" stroke-width="0.3" opacity="0.15"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#cat-grid)"/>
            <!-- Decorative orbital rings -->
            <circle cx="200" cy="300" r="180" fill="none" stroke="white" stroke-width="0.8" opacity="0.1"/>
            <circle cx="600" cy="200" r="220" fill="none" stroke="white" stroke-width="0.8" opacity="0.08"/>
            <circle cx="400" cy="400" r="260" fill="none" stroke="white" stroke-width="0.5" opacity="0.06"/>
        </svg>
    </div>
    <!-- Gradient overlay edges -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900/60 via-transparent to-blue-900/60 pointer-events-none"></div>

    <div class="relative z-10 p-6 md:p-10 lg:p-12">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-5">
            <ol class="flex items-center gap-2 text-blue-200/80 flex-wrap">
                <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                <li><span class="mx-1">›</span></li>
                <li><a href="{{ route('schemes.index') }}" class="hover:text-white transition">Categories</a></li>
                <li><span class="mx-1">›</span></li>
                <li class="text-white font-medium">{{ $category->name }}</li>
            </ol>
        </nav>

        <!-- Category Icon + Name + Description -->
        <div class="flex flex-wrap items-start gap-5 mb-5">
            @if($category->icon)
            <div class="w-16 h-16 bg-white/15 backdrop-blur-sm rounded-2xl flex items-center justify-center text-4xl border border-white/20 shrink-0">
                {{ $category->icon }}
            </div>
            @endif
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">{{ $category->name }}</h1>
                @if($category->description)
                <p class="text-blue-200/90 mt-2 max-w-2xl text-base md:text-lg">{{ $category->description }}</p>
                @endif
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="flex flex-wrap gap-4 md:gap-6 mt-5">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl px-5 py-3 border border-white/10">
                <p class="text-2xl md:text-3xl font-bold text-white">{{ $totalActive }}</p>
                <p class="text-xs text-blue-200/80 mt-0.5">Active Schemes</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-xl px-5 py-3 border border-white/10">
                <p class="text-2xl md:text-3xl font-bold text-white">{{ number_format($totalViews + $totalActive) }}+</p>
                <p class="text-xs text-blue-200/80 mt-0.5">Total Views</p>
            </div>
            @if($category->schemes_count)
            <div class="bg-white/10 backdrop-blur-sm rounded-xl px-5 py-3 border border-white/10">
                <p class="text-2xl md:text-3xl font-bold text-white">{{ $category->schemes_count }}</p>
                <p class="text-xs text-blue-200/80 mt-0.5">Total Entries</p>
            </div>
            @endif
        </div>
    </div>
</section>

@if($schemes->count() || $featuredSchemes->count())
    <!-- Featured Schemes Section -->
    @if($featuredSchemes->count())
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            Featured Schemes
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($featuredSchemes as $scheme)
            <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover block p-5 rounded-xl border border-slate-200 group focus-ring">
                <div class="flex items-center gap-2 mb-3 flex-wrap">
                    @if($scheme->state)
                    <span class="bg-slate-100 text-slate-600 text-xs px-2.5 py-1 rounded-full">{{ $scheme->state->name }}</span>
                    @endif
                    <span class="bg-amber-50 text-amber-600 text-xs px-2.5 py-1 rounded-full font-medium flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Featured
                    </span>
                    @if($scheme->status === 'active')
                    <span class="bg-green-50 text-green-600 text-xs px-2.5 py-1 rounded-full font-medium">Active</span>
                    @elseif($scheme->status === 'upcoming')
                    <span class="bg-yellow-50 text-yellow-600 text-xs px-2.5 py-1 rounded-full font-medium">Upcoming</span>
                    @else
                    <span class="bg-red-50 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">Closed</span>
                    @endif
                </div>
                <h3 class="font-bold text-lg text-slate-800 group-hover:text-blue-600 transition">{{ $scheme->title }}</h3>
                <p class="text-sm text-slate-600 mt-1.5 line-clamp-2">{{ $scheme->short_description }}</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- State Breakdown Section -->
    @if($stateBreakdown->count())
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Schemes by State</h2>
        <div class="flex flex-wrap gap-3">
            @foreach($stateBreakdown as $stateName => $count)
            @php $stateSlug = $stateSlugs[$stateName] ?? null; @endphp
            <a href="{{ $stateSlug ? route('states.show', $stateSlug) : '#' }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-50 text-primary-700 hover:bg-primary-100 hover:text-primary-800 transition text-sm font-medium border border-primary-100 shadow-sm">
                <span>{{ $stateName }}</span>
                <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 rounded-full bg-primary-600 text-white text-xs font-bold">{{ $count }}</span>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Latest Added Section -->
    @if($latestSchemes->count())
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Latest Added
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($latestSchemes as $scheme)
            <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover block p-4 rounded-xl border border-slate-200 group focus-ring">
                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    @if($scheme->state)
                    <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded-full">{{ $scheme->state->name }}</span>
                    @endif
                    @if($scheme->status === 'active')
                    <span class="bg-green-50 text-green-600 text-xs px-2 py-1 rounded-full font-medium">Active</span>
                    @elseif($scheme->status === 'upcoming')
                    <span class="bg-yellow-50 text-yellow-600 text-xs px-2 py-1 rounded-full font-medium">Upcoming</span>
                    @else
                    <span class="bg-red-50 text-red-600 text-xs px-2 py-1 rounded-full font-medium">Closed</span>
                    @endif
                </div>
                <h3 class="font-semibold text-slate-800 group-hover:text-blue-600 transition text-sm leading-snug">{{ $scheme->title }}</h3>
                <p class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $scheme->short_description }}</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- All Schemes Section -->
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4">All {{ $category->name }} Schemes</h2>
        <div class="space-y-4">
            @foreach($schemes as $scheme)
            <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover block p-5 rounded-xl border border-slate-200 group focus-ring">
                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    @if($scheme->state)
                    <span class="bg-slate-100 text-slate-600 text-xs px-2.5 py-1 rounded-full">{{ $scheme->state->name }}</span>
                    @endif
                    @if($scheme->status === 'active')
                    <span class="bg-green-50 text-green-600 text-xs px-2.5 py-1 rounded-full font-medium">Active</span>
                    @elseif($scheme->status === 'upcoming')
                    <span class="bg-yellow-50 text-yellow-600 text-xs px-2.5 py-1 rounded-full font-medium">Upcoming</span>
                    @else
                    <span class="bg-red-50 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">Closed</span>
                    @endif
                </div>
                <h3 class="font-bold text-lg text-slate-800 group-hover:text-blue-600 transition">{{ $scheme->title }}</h3>
                <p class="text-sm text-slate-600 mt-1.5 line-clamp-2">{{ $scheme->short_description }}</p>
                <div class="mt-3 text-blue-600 text-sm font-medium group-hover:underline inline-flex items-center gap-1">
                    View Details
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </a>
            @endforeach
        </div>
        @if(method_exists($schemes, 'links'))
        <div class="mt-6">{{ $schemes->links() }}</div>
        @endif
    </section>
@else
    <!-- Empty State -->
    <div class="surface-card rounded-xl border border-slate-200 p-12 text-center">
        <div class="max-w-md mx-auto">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <h3 class="text-lg font-bold text-slate-800 mb-2">No schemes found in {{ $category->name }}.</h3>
            <p class="text-slate-500 mb-6">Check back soon for updates.</p>
            <a href="{{ route('schemes.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-xl transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Browse All Yojana
            </a>
        </div>
    </div>
@endif
@endsection
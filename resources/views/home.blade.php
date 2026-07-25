@extends('layouts.app')

@section('title', 'UmangIndia - सरकारी योजनाएं | Government Schemes Portal')
@section('description', '259+ सरकारी योजनाओं की जानकारी। पात्रता, लाभ और आवेदन प्रक्रिया की जानकारी। PM किसान, आयुष्मान भारत, मगनेगा और अधिक।')

@section('schema')
<?php
$siteSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => 'UmangIndia',
    'url' => url('/'),
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => url('/search') . '?q={search_term_string}',
        'query-input' => 'required name=search_term_string',
    ],
];
?>
<script type="application/ld+json">{!! json_encode($siteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 rounded-2xl mb-10">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
            <path d="M200 0L400 200L200 400L0 200Z" fill="none" stroke="white" stroke-width="0.5"/>
            <circle cx="200" cy="200" r="150" fill="none" stroke="white" stroke-width="0.3"/>
            <circle cx="200" cy="200" r="100" fill="none" stroke="white" stroke-width="0.2"/>
        </svg>
    </div>
    <div class="relative z-10 px-6 py-12 sm:px-8 sm:py-16 md:px-16 md:py-20">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 mb-6">
                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                <span class="text-sm text-blue-100">{{ $totalSchemes }}+ Schemes Listed</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">
                Find the Right<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Government Scheme</span><br>
                for You
            </h1>
            <p class="text-lg text-blue-100/80 mb-8 max-w-xl">
                Check eligibility, benefits, and application process for PM Kisan, Ayushman Bharat, MGNREGA and {{ $totalSchemes }}+ schemes. An independent information portal — not affiliated with any government body.
            </p>
            <form action="{{ route('search') }}" method="GET" class="flex flex-col sm:flex-row gap-3 max-w-xl">
                <div class="flex-1 relative">
                    <input type="text" name="q" placeholder="Search schemes..." class="w-full px-5 py-4 rounded-xl bg-white text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-amber-400 shadow-xl">
                    <svg class="absolute right-4 top-4 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <button type="submit" class="px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold rounded-xl shadow-xl transition-all duration-200 hover:scale-105 sm:w-auto">
                    Search
                </button>
            </form>
            <div class="flex flex-wrap gap-6 mt-8">
                <div class="flex items-center gap-2 text-blue-100/70">
                    <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                    <span class="text-sm">Verified Information</span>
                </div>
                <div class="flex items-center gap-2 text-blue-100/70">
                    <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                    <span class="text-sm">100% Free</span>
                </div>
                <div class="flex items-center gap-2 text-blue-100/70">
                    <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                    <span class="text-sm">Hindi & English</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-10">
    <div class="flex items-end justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold section-title">Browse by Category</h2>
            <p class="muted mt-1">Find schemes by your area of interest</p>
        </div>
    </div>
    @php
    function categoryIcon($name) {
        $lower = strtolower($name);
        if (str_contains($lower, 'education') || str_contains($lower, 'shiksha')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>';
        }
        if (str_contains($lower, 'health') || str_contains($lower, 'swasthya')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>';
        }
        if (str_contains($lower, 'agriculture') || str_contains($lower, 'kisan') || str_contains($lower, 'krishi')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>';
        }
        if (str_contains($lower, 'housing') || str_contains($lower, 'awas') || str_contains($lower, 'aawas')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>';
        }
        if (str_contains($lower, 'employment') || str_contains($lower, 'rozgar') || str_contains($lower, 'rojgar')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"/></svg>';
        }
        if (str_contains($lower, 'social') || str_contains($lower, 'samajik')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>';
        }
        if (str_contains($lower, 'women') || str_contains($lower, 'mahila') || str_contains($lower, 'female')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33"/></svg>';
        }
        if (str_contains($lower, 'financial') || str_contains($lower, 'bank') || str_contains($lower, 'finance')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v9.5m-8.25 2.5v.5m4.5-10.5H6.75a.75.75 0 0 1-.75-.75v-1.5a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-.75.75Zm-9 10.5h.008v.008H12.75v-.008Z"/></svg>';
        }
        if (str_contains($lower, 'digital') || str_contains($lower, 'tech') || str_contains($lower, ' it ')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"/></svg>';
        }
        if (str_contains($lower, 'infrastructure') || str_contains($lower, 'vikas') || str_contains($lower, 'development')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/></svg>';
        }
        if (str_contains($lower, 'environment') || str_contains($lower, 'paryavaran') || str_contains($lower, 'forest') || str_contains($lower, 'climate')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/></svg>';
        }
        if (str_contains($lower, 'senior') || str_contains($lower, 'vriddh') || str_contains($lower, 'elderly') || str_contains($lower, 'old age')) {
            return '<svg class="w-10 h-10 mx-auto mb-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>';
        }
        return '<svg class="w-10 h-10 mx-auto mb-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>';
    }
    @endphp
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-6 gap-4">
        @foreach($categories as $category)
        <a href="{{ route('categories.show', $category) }}" class="surface-card card-hover p-5 text-center group focus-ring">
            {!! categoryIcon($category->name) !!}
            <h3 class="font-semibold text-sm text-slate-800 group-hover:text-blue-600 transition">{{ $category->name }}</h3>
            <p class="text-xs muted mt-1">{{ $category->schemes_count }} schemes</p>
        </a>
        @endforeach
    </div>
</section>

@if($featuredSchemes->count())
<section class="mb-10">
    <div class="flex items-end justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold section-title">Featured Schemes</h2>
            <p class="muted mt-1">Most popular government schemes</p>
        </div>
        <a href="{{ route('schemes.index') }}" class="text-blue-600 text-sm font-medium hover:underline hidden sm:inline-flex items-center gap-1">View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
    </div>
    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($featuredSchemes as $scheme)
        <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover overflow-hidden group focus-ring">
            <div class="h-1 bg-gradient-to-r from-blue-600 to-blue-400"></div>
            <div class="p-5">
                <div class="flex items-center gap-2 mb-3 flex-wrap">
                    <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name }}</span>
                    @if($scheme->application_deadline)
                    <span class="bg-red-50 text-red-600 text-xs px-2 py-1 rounded-full font-medium">Deadline: {{ $scheme->application_deadline->format('d M Y') }}</span>
                    @endif
                </div>
                <h3 class="font-bold text-lg mb-2 text-slate-800 group-hover:text-blue-600 transition line-clamp-2">{{ $scheme->title }}</h3>
                <p class="text-sm muted line-clamp-3 leading-relaxed">{{ $scheme->short_description }}</p>
            </div>
            <div class="px-5 py-3 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
                <span class="text-xs muted">{{ number_format($scheme->views) }} views</span>
                <span class="text-blue-600 text-sm font-medium flex items-center gap-1">View Details <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></span>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif

<section class="mb-10">
    <div class="flex items-end justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold section-title">Latest Schemes</h2>
            <p class="muted mt-1">Recently updated government schemes</p>
        </div>
        <a href="{{ route('schemes.latest') }}" class="text-blue-600 text-sm font-medium hover:underline hidden sm:inline-flex items-center gap-1">View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
    </div>
    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($latestSchemes as $scheme)
        <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover overflow-hidden group focus-ring">
            <div class="h-1 bg-gradient-to-r from-blue-600 to-blue-400"></div>
            <div class="p-5">
                <div class="flex items-center gap-2 mb-3 flex-wrap">
                    <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name }}</span>
                    @if($scheme->status === 'active')
                    <span class="bg-green-50 text-green-600 text-xs px-2 py-1 rounded-full font-medium">Active</span>
                    @elseif($scheme->status === 'upcoming')
                    <span class="bg-yellow-50 text-yellow-600 text-xs px-2 py-1 rounded-full font-medium">Upcoming</span>
                    @else
                    <span class="bg-red-50 text-red-600 text-xs px-2 py-1 rounded-full font-medium">Closed</span>
                    @endif
                </div>
                <h3 class="font-bold text-lg mb-2 text-slate-800 group-hover:text-blue-600 transition line-clamp-2">{{ $scheme->title }}</h3>
                <p class="text-sm muted line-clamp-3 leading-relaxed">{{ $scheme->short_description }}</p>
            </div>
            <div class="px-5 py-3 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
                <span class="text-xs muted">{{ $scheme->published_at?->diffForHumans() }}</span>
                <span class="text-blue-600 text-sm font-medium flex items-center gap-1">View Details <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></span>
            </div>
        </a>
        @endforeach
    </div>
</section>

@if(\App\Models\Setting::get('adsense_enabled') && \App\Models\Setting::get('adsense_inarticle_slot'))
<div class="my-8 text-center">
    <ins class="adsbygoogle" style="display:block" data-ad-client="{{ \App\Models\Setting::get('adsense_publisher_id') }}" data-ad-slot="{{ \App\Models\Setting::get('adsense_inarticle_slot') }}" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
@endif

<section class="surface-card p-6 md:p-8 mb-6">
    <x-newsletter-signup />
</section>

<section class="bg-white rounded-xl p-6 md:p-8 shadow-sm border border-slate-200 mt-10" id="trust-section">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-900">Why Use UmangIndia</h2>
        <p class="text-slate-500 mt-2">An independent information portal for Indian government schemes</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center">
        <div><div class="text-3xl font-bold text-blue-600">{{ number_format(\App\Models\Scheme::active()->count()) }}+</div><div class="text-sm text-slate-500 mt-1">Schemes Listed</div></div>
        <div><div class="text-3xl font-bold text-blue-600">{{ \App\Models\State::count() }}</div><div class="text-sm text-slate-500 mt-1">States Covered</div></div>
        <div><div class="text-3xl font-bold text-blue-600">{{ \App\Models\Category::count() }}</div><div class="text-sm text-slate-500 mt-1">Categories</div></div>
    </div>
</section>

@push('scripts')
<script>
(function() {
    const section = document.getElementById('trust-section');
    if (!section) return;
    const counters = section.querySelectorAll('[data-count]');
    let animated = false;
    
    function animateCounters() {
        if (animated) return;
        animated = true;
        counters.forEach(el => {
            const target = parseFloat(el.dataset.count);
            const suffix = el.dataset.suffix || '';
            const isDecimal = el.dataset.decimal === 'true';
            const duration = 1500;
            const start = performance.now();
            
            function update(now) {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = eased * target;
                el.textContent = (isDecimal ? current.toFixed(1) : Math.floor(current)) + suffix;
                if (progress < 1) requestAnimationFrame(update);
            }
            requestAnimationFrame(update);
        });
    }
    
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => { if (entry.isIntersecting) animateCounters(); });
    }, { threshold: 0.3 });
    observer.observe(section);
})();
</script>
@endpush

<section class="surface-card p-6 md:p-8">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-2xl md:text-3xl font-bold section-title mb-4">About UmangIndia</h2>
        <div class="text-slate-600 leading-relaxed space-y-3">
            <p>UmangIndia is an independent information portal providing details about Indian government schemes (Sarkari Yojana). We compile and organize information about eligibility criteria, benefits, application process, and required documents for central and state government welfare schemes.</p>
            <p>Our goal is to help Indian citizens find and understand government welfare schemes. From PM Kisan and Ayushman Bharat to MGNREGA and Sukanya Samriddhi Yojana, we cover schemes across multiple categories.</p>
        </div>
        <div class="mt-6 p-4 rounded-2xl border border-amber-200 bg-amber-50">
            <p class="text-sm text-slate-600"><strong class="text-saffron-500">Disclaimer:</strong> This is an informational portal. For official information and applications, please visit the respective government websites. We do not represent any government body.</p>
        </div>
    </div>
</section>
@endsection

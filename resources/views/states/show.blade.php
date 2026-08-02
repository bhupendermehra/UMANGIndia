@extends('layouts.app')

@section('title', $state->meta_title ?: $state->name . ' government schemes list 2026 - UmangIndia')
@section('description', $state->meta_description ?: 'Find ' . $totalActive . ' government schemes available in ' . $state->name . '. Explore state and central sarkari yojana with eligibility, benefits, and application process on UmangIndia.')

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {"@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ route('home') }}"},
        {"@@type": "ListItem", "position": 2, "name": "States", "item": "{{ route('schemes.index') }}"},
        {"@@type": "ListItem", "position": 3, "name": "{{ $state->name }}", "item": "{{ route('states.show', $state) }}"}
    ]
}
</script>
@endpush

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "ItemList",
    "itemListElement": [
        @foreach($featuredSchemes as $i => $scheme)
        {"@@type": "ListItem", "position": {{ $i + 1 }}, "name": "{{ $scheme->title }}", "url": "{{ route('schemes.show', $scheme) }}"}{{ $loop->last ? '' : ',' }}
        @endforeach
    ]
}
</script>
@endpush

@php
    // Known Union Territories of India
    $unionTerritories = [
        'Andaman and Nicobar Islands', 'Chandigarh',
        'Dadra and Nagar Haveli and Daman and Diu',
        'Delhi', 'National Capital Territory of Delhi',
        'Jammu and Kashmir', 'Ladakh', 'Lakshadweep', 'Puducherry',
    ];
    $isUt = in_array($state->name, $unionTerritories) || in_array($state->name_hi ?? '', $unionTerritories);
    $stateType = $isUt ? 'Union Territory' : 'State';
    // Build category slug lookup map for badges
    $catSlugs = [];
    if ($categoryBreakdown->count()) {
        $catSlugs = \App\Models\Category::whereIn('name', $categoryBreakdown->keys())->pluck('slug', 'name')->toArray();
    }
@endphp

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden mb-10 rounded-2xl bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 text-white">
    <!-- Decorative India map SVG pattern -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="map-grid" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1.5" fill="white" opacity="0.6"/>
                    <path d="M0 20 L40 20 M20 0 L20 40" stroke="white" stroke-width="0.3" opacity="0.15"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#map-grid)"/>
            <!-- Simplified India outline decorative shape -->
            <path d="M380 80 L420 70 L460 85 L490 75 L520 90 L540 80 L560 100 L575 130 L590 120 L600 150 L610 180 L600 200 L620 230 L610 260 L620 290 L600 310 L580 320 L560 340 L540 350 L520 370 L500 380 L480 400 L460 410 L440 420 L420 430 L400 440 L380 435 L360 420 L340 410 L320 400 L300 380 L280 360 L270 340 L260 310 L250 290 L260 260 L250 240 L260 210 L250 180 L260 150 L270 130 L290 110 L310 100 L330 95 L350 85 Z"
                fill="none" stroke="white" stroke-width="1.5" opacity="0.15"/>
        </svg>
    </div>
    <!-- Gradient overlay edges -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900/60 via-transparent to-indigo-900/60 pointer-events-none"></div>

    <div class="relative z-10 p-6 md:p-10 lg:p-12">
        @if($state->featured_image)
        <img src="{{ $state->featured_image ?? asset('images/state-default.jpg') }}" alt="{{ $state->name }} banner" class="w-full h-48 md:h-64 object-cover rounded-xl mb-6" width="1200" height="300">
        @endif
        <!-- Breadcrumb -->
        <nav class="text-sm mb-5">
            <ol class="flex items-center gap-2 text-blue-200/80 flex-wrap">
                <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                <li><span class="mx-1">›</span></li>
                <li><a href="{{ route('schemes.index') }}" class="hover:text-white transition">States</a></li>
                <li><span class="mx-1">›</span></li>
                <li class="text-white font-medium">{{ $state->name }}</li>
            </ol>
        </nav>

        <!-- State Name & Badges -->
        <div class="flex flex-wrap items-center gap-3 mb-4">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">{{ $state->name }}</h1>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm border border-white/20">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4a4 4 0 014-4h.5M9 21V7a4 4 0 014-4h.5M15 21v-8a4 4 0 014-4h.5"/></svg>
                {{ $stateType }}
            </span>
            @if($centralSchemes->count())
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-400/20 text-green-200 backdrop-blur-sm border border-green-400/30">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Central Schemes Available
            </span>
            @endif
        </div>

        @if($state->short_intro)
        <p class="text-blue-100/90 mt-3 max-w-2xl text-base md:text-lg">{{ $state->short_intro }}</p>
        @endif

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
            @if($state->schemes_count)
            <div class="bg-white/10 backdrop-blur-sm rounded-xl px-5 py-3 border border-white/10">
                <p class="text-2xl md:text-3xl font-bold text-white">{{ $state->schemes_count }}</p>
                <p class="text-xs text-blue-200/80 mt-0.5">Total Entries</p>
            </div>
            @endif
        </div>
    </div>
</section>

@if($state->description)
<section class="mb-10">
    <h2 class="text-xl font-bold text-slate-900 mb-4">About {{ $state->name }} Government Schemes</h2>
    <div class="prose max-w-none text-slate-700 leading-relaxed">{!! $state->description !!}</div>
</section>
@endif

@if($schemes->count() || $featuredSchemes->count())
    <!-- Split Section: Featured Schemes + Quick Info -->
    @if($featuredSchemes->count())
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
        <!-- Left: Featured Schemes (2/3) -->
        <div class="lg:col-span-2">
            <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                Featured Schemes
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($featuredSchemes as $scheme)
                <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover block p-5 rounded-xl border border-slate-200 group focus-ring">
                    <div class="flex items-center gap-2 mb-3 flex-wrap">
                        <span class="bg-primary-50 text-primary-600 text-xs font-semibold px-2.5 py-1 rounded-full">
                            {{ $scheme->category->name ?? 'Uncategorized' }}
                        </span>
                        <span class="bg-amber-50 text-amber-600 text-xs px-2.5 py-1 rounded-full font-medium flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            Featured
                        </span>
                    </div>
                    <h3 class="font-bold text-lg text-slate-800 group-hover:text-primary-600 transition">{{ $scheme->title }}</h3>
                    <p class="text-sm text-slate-600 mt-1.5 line-clamp-2">{{ $scheme->short_description }}</p>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Right: Quick Info (1/3) -->
        <div class="surface-card rounded-xl border border-slate-200 p-6">
            <h3 class="font-bold text-slate-900 text-lg mb-3">About {{ $state->name }}</h3>
            <p class="text-sm text-slate-600 leading-relaxed mb-4">
                {{ $state->meta_description ?: 'Explore all government schemes and sarkari yojana available in ' . $state->name . '. Find detailed information about eligibility, benefits, and application process.' }}
            </p>
            @if($centralSchemes->count())
            <div class="flex items-center gap-2 p-3 bg-green-50 rounded-lg mb-4">
                <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-sm font-medium text-green-700">Central schemes are available in this state</span>
            </div>
            @endif
            @if($categoryBreakdown->count())
            <div>
                <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Top Categories</h4>
                <div class="space-y-2">
                    @foreach($categoryBreakdown as $catName => $count)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-700 font-medium">{{ $catName }}</span>
                        <span class="inline-flex items-center justify-center min-w-[1.5rem] h-5 px-1.5 rounded-full bg-primary-50 text-primary-600 text-xs font-bold">{{ $count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Category Breakdown Section -->
    @if($categoryBreakdown->count())
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Top Categories in {{ $state->name }}</h2>
        <div class="flex flex-wrap gap-3">
            @foreach($categoryBreakdown as $catName => $count)
            @php $catSlug = $catSlugs[$catName] ?? null; @endphp
            <a href="{{ $catSlug ? route('categories.show', $catSlug) : '#' }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-50 text-primary-700 hover:bg-primary-100 hover:text-primary-800 transition text-sm font-medium border border-primary-100 shadow-sm">
                <span>{{ $catName }}</span>
                <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 rounded-full bg-primary-600 text-white text-xs font-bold">{{ $count }}</span>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Popular Schemes Section -->
    @if($popularSchemes->count())
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-rose-500" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
            Popular Schemes in {{ $state->name }}
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($popularSchemes as $scheme)
            <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover block p-5 rounded-xl border border-slate-200 group focus-ring">
                <div class="flex items-center gap-2 mb-3 flex-wrap">
                    <span class="bg-primary-50 text-primary-600 text-xs font-semibold px-2.5 py-1 rounded-full">
                        {{ $scheme->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
                <h3 class="font-bold text-lg text-slate-800 group-hover:text-primary-600 transition">{{ $scheme->title }}</h3>
                <p class="text-sm text-slate-600 mt-1.5 line-clamp-2">{{ $scheme->short_description }}</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- All Schemes Section -->
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4">All {{ $state->name }} Schemes</h2>
        <div class="space-y-4">
            @foreach($schemes as $scheme)
            <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover block p-5 rounded-xl border border-slate-200 group focus-ring">
                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    <span class="bg-primary-50 text-primary-600 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name ?? 'Uncategorized' }}</span>
                    <span class="bg-blue-50 text-blue-600 text-xs px-2.5 py-1 rounded-full font-medium">{{ $state->name }}</span>
                    @if($scheme->status === 'active')
                    <span class="bg-green-50 text-green-600 text-xs px-2.5 py-1 rounded-full font-medium">Active</span>
                    @elseif($scheme->status === 'upcoming')
                    <span class="bg-yellow-50 text-yellow-600 text-xs px-2.5 py-1 rounded-full font-medium">Upcoming</span>
                    @else
                    <span class="bg-red-50 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">Closed</span>
                    @endif
                </div>
                <h3 class="font-bold text-lg text-slate-800 group-hover:text-primary-600 transition">{{ $scheme->title }}</h3>
                <p class="text-sm text-slate-600 mt-1.5 line-clamp-2">{{ $scheme->short_description }}</p>
            </a>
            @endforeach
        </div>
        @if(method_exists($schemes, 'links'))
        <div class="mt-6">{{ $schemes->links() }}</div>
        @endif
    </section>

    <!-- Central Schemes Section -->
    @if($centralSchemes->count())
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Central Schemes Available in {{ $state->name }}</h2>
        <div class="space-y-4">
            @foreach($centralSchemes as $scheme)
            <a href="{{ route('schemes.show', $scheme) }}" class="surface-card card-hover block p-5 rounded-xl border border-slate-200 group focus-ring">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2 flex-wrap">
                            <span class="bg-primary-50 text-primary-600 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name ?? 'Uncategorized' }}</span>
                            <span class="bg-indigo-50 text-indigo-600 text-xs px-2.5 py-1 rounded-full font-medium">Central</span>
                        </div>
                        <h3 class="font-bold text-base text-slate-800 group-hover:text-primary-600 transition">{{ $scheme->title }}</h3>
                        <p class="text-sm text-slate-600 mt-1 line-clamp-1">{{ $scheme->short_description }}</p>
                    </div>
                    <div class="shrink-0">
                        <svg class="w-5 h-5 text-slate-300 group-hover:text-primary-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-5 text-center sm:text-left">
            <a href="{{ route('schemes.index') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium transition group">
                View All Schemes
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>
    @endif

@else
    <!-- Empty State -->
    <div class="surface-card rounded-xl border border-slate-200 p-12 text-center">
        <div class="max-w-md mx-auto">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <h2 class="text-lg font-bold text-slate-800 mb-2">No schemes found for {{ $state->name }} yet.</h2>
            <p class="text-slate-500 mb-6">Check back soon or browse central schemes available across India.</p>
            <a href="{{ route('schemes.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-xl transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Browse All Yojana
            </a>
        </div>
    </div>
@endif

    <!-- FAQ Section -->
    @php
        $faqs = [
            [
                'q' => 'How do I apply for government schemes in ' . $state->name . '?',
                'a' => 'You can apply for ' . $state->name . ' government schemes through the official state or central portals listed on each scheme page. Most schemes offer an online application with eligibility checks, document upload, and status tracking.',
            ],
            [
                'q' => 'Are central government schemes also available in ' . $state->name . '?',
                'a' => 'Yes. Central schemes such as PM-KISAN, Ayushman Bharat, and other nationwide yojana are available to residents of ' . $state->name . ' alongside state-specific schemes.',
            ],
            [
                'q' => 'What documents are required to apply for schemes in ' . $state->name . '?',
                'a' => 'Common documents include Aadhaar card, proof of residence in ' . $state->name . ', income certificate, bank account details, and category or caste certificates where applicable. Exact requirements vary by scheme.',
            ],
            [
                'q' => 'Which schemes are most beneficial for farmers in ' . $state->name . '?',
                'a' => $state->name . ' farmers can benefit from central schemes like PM-KISAN and PM Fasal Bima Yojana as well as state agriculture subsidies and loan waivers. Check the Popular Schemes section above for the most-viewed options.',
            ],
            [
                'q' => 'Where can I check my application status for ' . $state->name . ' schemes?',
                'a' => 'Application status can typically be tracked on the relevant scheme portal using your registered mobile number or application reference ID. Each scheme page on UmangIndia links to the official tracking portal.',
            ],
        ];
    @endphp
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Frequently Asked Questions</h2>
        <div>
            @foreach($faqs as $faq)
            <details class="surface-card rounded-xl border border-slate-200 p-4 mb-3">
                <summary class="font-semibold text-slate-800 cursor-pointer">{{ $faq['q'] }}</summary>
                <p class="text-sm text-slate-600 mt-2">{{ $faq['a'] }}</p>
            </details>
            @endforeach
        </div>
    </section>

    <!-- Related States Section -->
    @if($relatedStates->count())
    <section class="mb-10">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Other States & Union Territories</h2>
        <div class="flex flex-wrap gap-3">
            @foreach($relatedStates as $rs)
            <a href="{{ route('states.show', $rs) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200 transition text-sm font-medium">{{ $rs->name }}</a>
            @endforeach
        </div>
    </section>
    @endif
@endsection

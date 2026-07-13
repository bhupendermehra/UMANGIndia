@extends('layouts.app')

@section('title', 'Your Eligibility Results - UmangIndia | Matching Schemes Found')
@section('description', 'View the list of government schemes and sarkari yojana that match your eligibility criteria based on your answers.')

@push('meta')
<meta name="robots" content="noindex, nofollow">
@endpush

@section('content')
<div class="page-enter">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('eligibility.index') }}" class="hover:text-blue-600 transition">Eligibility Checker</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-800 font-medium">Results</span>
    </nav>

    <div class="max-w-4xl mx-auto">
        <!-- Summary Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 px-6 py-6 sm:px-8 sm:py-8 text-white text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 mb-4">
                    @if($schemes->count() > 0)
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @else
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @endif
                </div>

                @if($schemes->count() > 0)
                <h1 class="text-2xl sm:text-3xl font-bold mb-2">
                    {{ $schemes->count() }} Scheme{{ $schemes->count() !== 1 ? 's' : '' }} Found!
                </h1>
                <p class="text-blue-100 text-sm sm:text-base max-w-xl mx-auto">
                    Based on your responses, here are the government schemes you may be eligible for.
                </p>
                @else
                <h1 class="text-2xl sm:text-3xl font-bold mb-2">No Exact Matches Found</h1>
                <p class="text-blue-100 text-sm sm:text-base max-w-xl mx-auto">
                    We couldn't find schemes matching all your criteria. Try broadening your search or browse all available schemes.
                </p>
                @endif
            </div>

            <!-- Filter Summary -->
            @if($schemes->count() > 0)
            <div class="px-6 py-4 sm:px-8 border-b border-slate-100 bg-slate-50">
                <div class="flex flex-wrap gap-2">
                    @if(!empty($data['state']) && \App\Models\State::find($data['state']))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ \App\Models\State::find($data['state'])->name }}
                        </span>
                    @endif
                    @if(!empty($data['category']))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            {{ $data['category'] }}
                        </span>
                    @endif
                    @if(!empty($data['age_group']))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-purple-100 text-purple-700 text-xs font-medium">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                            Age: {{ $data['age_group'] }}
                        </span>
                    @endif
                    @if(!empty($data['income']))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-medium">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Income: {{ str_replace(['0-1lac','1-2.5lac','2.5-5lac','5-10lac','10+lac'], ['Up to ₹1L','₹1-2.5L','₹2.5-5L','₹5-10L','₹10L+'], $data['income']) }}
                        </span>
                    @endif
                    @if(!empty($data['occupation']))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-pink-100 text-pink-700 text-xs font-medium">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ str_replace(['farming','student','private_job','govt_job','business','unemployed','retired'], ['Farmer','Student','Private Job','Govt Job','Business','Unemployed','Retired'], $data['occupation']) }}
                        </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        @if($schemes->count() > 0)
        <!-- Schemes Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
            @foreach($schemes as $scheme)
            <a href="{{ route('schemes.show', $scheme) }}" class="block bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-200 card-hover overflow-hidden">
                <div class="p-5">
                    <!-- Status Badge -->
                    <div class="flex items-center justify-between mb-3">
                        @if($scheme->application_deadline && $scheme->application_deadline->isFuture())
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Active
                            </span>
                        @elseif($scheme->application_deadline && $scheme->application_deadline->isPast())
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-100 text-red-700 text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                Closed
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Active
                            </span>
                        @endif

                        @if($scheme->category)
                            <span class="text-xs text-slate-400">{{ $scheme->category->name }}</span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h2 class="text-base font-semibold text-slate-800 mb-2 line-clamp-2">
                        {{ $scheme->localized('title') ?? $scheme->title }}
                    </h2>

                    <!-- State -->
                    @if($scheme->state)
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-3">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        @if($scheme->state->is_central)
                            <span class="text-blue-600 font-medium">All India</span>
                        @else
                            {{ $scheme->state->name }}
                        @endif
                    </div>
                    @endif

                    <!-- Eligibility Short -->
                    @if($scheme->eligibility)
                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">
                        {{ Str::limit(strip_tags($scheme->localized('eligibility') ?? $scheme->eligibility), 120) }}
                    </p>
                    @endif
                </div>

                <!-- Footer -->
                <div class="px-5 py-3 bg-slate-50 border-t border-slate-100">
                    <span class="text-xs font-medium text-blue-600 inline-flex items-center gap-1">
                        View Details
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <!-- No Results -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden mb-8">
            <div class="px-6 py-10 sm:px-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-700 mb-2">No Exact Matches Found</h2>
                <p class="text-sm text-slate-500 max-w-md mx-auto mb-6">
                    We couldn't find schemes matching your exact criteria. Try browsing all available schemes or adjust your search.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('schemes.index') }}"
                       class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition text-sm inline-flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        Browse All Schemes
                    </a>
                    <a href="{{ route('schemes.latest') }}"
                       class="px-6 py-3 border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-xl transition text-sm inline-flex items-center justify-center gap-2">
                        View Latest Schemes
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="text-center mb-8">
            <a href="{{ route('eligibility.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Check Again
            </a>
        </div>

        <!-- AdSense In-Article -->
        @if(\App\Models\Setting::get('adsense_enabled') && \App\Models\Setting::get('adsense_in_article_slot'))
        <div class="text-center my-6">
            <ins class="adsbygoogle" style="display:block" data-ad-client="{{ \App\Models\Setting::get('adsense_publisher_id') }}"
                 data-ad-slot="{{ \App\Models\Setting::get('adsense_in_article_slot') }}" data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
        </div>
        @endif
    </div>
</div>
@endsection

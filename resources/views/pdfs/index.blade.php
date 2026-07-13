@extends('layouts.app')

@section('title', 'Download Scheme PDFs & Application Forms | UmangIndia')
@section('description', 'Download official scheme notifications, application forms, and PDF documents for Indian government schemes and sarkari yojana.')
@section('keywords', 'scheme pdf download, application form pdf, government scheme notification, yojana pdf, sarkari yojana form, official pdf documents')

@push('meta')
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}">
@endpush

@section('content')
<div class="page-enter">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-slate-800 font-medium">Downloads</span>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-800">Download Scheme PDFs & Application Forms</h1>
                <p class="text-slate-500 mt-1">Official notifications, application forms, and PDF documents for government schemes</p>
            </div>
        </div>
    </div>

    <!-- Note -->
    <div class="mb-8 bg-amber-50 border border-amber-200 text-amber-800 px-5 py-4 rounded-xl flex items-start gap-3">
        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div class="text-sm">
            <strong>Note:</strong> PDFs and application forms are hosted on official government websites. Clicking a download button will take you to the respective department's portal. UmangIndia does not host or modify any official documents.
        </div>
    </div>

    <!-- Schemes Grouped by Category -->
    @forelse($schemes as $categoryName => $categorySchemes)
    <div class="mb-10">
        <h2 class="text-xl font-bold text-slate-800 mb-4 flex items-center gap-2">
            <span class="w-2 h-8 rounded-full bg-blue-600 inline-block"></span>
            {{ $categoryName }}
            <span class="text-sm font-normal text-slate-400">({{ $categorySchemes->count() }} schemes)</span>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($categorySchemes as $scheme)
            <div class="bg-white rounded-xl border border-slate-200 p-5 card-hover flex flex-col">
                <div class="flex-1">
                    <h3 class="text-base font-semibold text-slate-800 mb-3 line-clamp-2">{{ $scheme->title }}</h3>

                    @if($scheme->short_description)
                    <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ Str::limit(strip_tags($scheme->short_description), 100) }}</p>
                    @endif
                </div>

                <div class="mt-auto pt-3 border-t border-slate-100">
                    @if($scheme->official_website)
                    <a href="{{ $scheme->official_website }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl transition active:scale-[0.98]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download PDF
                        <svg class="w-3.5 h-3.5 ml-1 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    @else
                    <span class="inline-flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-slate-100 text-slate-400 text-sm font-medium rounded-xl cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Coming Soon
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="text-center py-16">
        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center">
            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-slate-700 mb-2">No PDFs Available</h3>
        <p class="text-slate-500 max-w-md mx-auto">No downloadable documents are available at the moment. Please check back later as new scheme PDFs are added regularly.</p>
        <a href="{{ route('schemes.index') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            Browse All Schemes
        </a>
    </div>
    @endforelse

    <!-- Bottom Info Section -->
    @if($schemes->isNotEmpty())
    <div class="mt-10 bg-blue-50 rounded-xl p-6 text-center">
        <div class="max-w-2xl mx-auto">
            <h3 class="text-lg font-bold text-slate-800 mb-2">Looking for a specific scheme PDF?</h3>
            <p class="text-sm text-slate-600 mb-4">If you can't find what you're looking for, try browsing our full schemes directory or use the search.</p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('schemes.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    All Schemes
                </a>
                <a href="{{ route('search') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Search Schemes
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

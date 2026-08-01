@extends('layouts.app')

@section('title', 'Articles & Updates - UmangIndia')
@section('description', 'Stay informed with the latest news, in-depth guides, and updates about Indian government schemes — Sarkari Yojana articles, eligibility, benefits, and application processes.')

@php
    $filter = request()->query('filter', 'latest');
    $readingTime = fn($a) => max(1, ceil(str_word_count(strip_tags($a->content)) / 200)) . ' min read';
@endphp

@section('content')
<div class="py-8">
    {{-- Header --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-800 font-medium">Articles</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                    Sarkari Yojana Blog
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">Latest Updates & Articles</h1>
                <p class="mt-2 text-slate-600 max-w-2xl">In-depth guides, scheme explainers, and updates on Indian government yojanas — written in simple language.</p>
            </div>
            <div class="flex items-center gap-1 bg-slate-100 rounded-full p-1 w-max">
                <a href="{{ route('articles.index', ['filter' => 'latest']) }}"
                   class="px-4 py-1.5 text-sm font-medium rounded-full transition {{ $filter !== 'featured' ? 'bg-white text-blue-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Latest</a>
                <a href="{{ route('articles.index', ['filter' => 'featured']) }}"
                   class="px-4 py-1.5 text-sm font-medium rounded-full transition {{ $filter === 'featured' ? 'bg-white text-blue-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Featured</a>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
        @if ($articles->isNotEmpty())
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($articles as $article)
                    <a href="{{ route('articles.show', $article) }}" class="group surface-card card-hover overflow-hidden rounded-2xl border border-slate-200 bg-white flex flex-col focus-ring hover:border-blue-600">
                        <div class="h-1 bg-gradient-to-r from-blue-600 to-blue-400"></div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3 flex-wrap">
                                <span class="text-xs text-slate-500">{{ $article->published_at?->format('M d, Y') ?? 'Recent' }}</span>
                                <span class="text-xs text-slate-400">·</span>
                                <span class="text-xs text-slate-500">{{ $readingTime($article) }}</span>
                                @if ($article->is_featured)
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Featured</span>
                                @endif
                            </div>
                            <h2 class="text-lg font-bold text-slate-800 group-hover:text-blue-600 transition line-clamp-2 mb-2">
                                {{ $article->title }}
                            </h2>
                            @if ($article->excerpt)
                                <p class="text-sm text-slate-600 line-clamp-3 mb-4 flex-1">{{ $article->excerpt }}</p>
                            @endif
                            <span class="inline-flex items-center gap-1.5 text-blue-600 text-sm font-medium mt-auto">
                                Read article
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">
                {{ $articles->withQueryString()->onEachSide(2)->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-slate-50 rounded-2xl border border-slate-200">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <p class="text-slate-600 font-medium">No articles published yet.</p>
                <p class="text-slate-500 text-sm mt-1">Check back soon — we're adding new guides every week.</p>
            </div>
        @endif
            </div>

            <div class="lg:col-span-1">
                <x-article-sidebar :popularArticles="$popularArticles" />
            </div>
        </div>
    </div>
</div>
@endsection

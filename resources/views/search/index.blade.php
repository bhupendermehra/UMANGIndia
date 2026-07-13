@extends('layouts.app')

@section('title', 'Search: ' . ($query ?? '') . ' - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-blue-600">Search Results</h1>

    <form action="{{ route('search') }}" method="GET" class="mb-8">
        <div class="flex gap-2">
            <input type="text" name="q" value="{{ $query }}" placeholder="Search government schemes..." class="flex-1 px-5 py-3 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-blue-700 transition">Search</button>
        </div>
    </form>

    @if($query && $results->count())
    <p class="text-slate-500 text-sm mb-4">{{ $results->total() }} results found for "<strong class="text-slate-900">{{ $query }}</strong>"</p>
    <div class="space-y-4">
        @foreach($results as $scheme)
        <a href="{{ route('schemes.show', $scheme) }}" class="block bg-white rounded-xl p-5 shadow-sm hover:shadow-lg transition-all duration-200 border border-slate-200 hover:border-blue-300 group card-hover">
            <div class="h-1 bg-gradient-to-r from-blue-600 to-blue-400 rounded-t-xl -mt-5 -mx-5 mb-4"></div>
            <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name }}</span>
            <h3 class="font-bold text-lg mt-2 text-slate-900 group-hover:text-blue-600 transition">{{ $scheme->title }}</h3>
            <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ $scheme->short_description }}</p>
        </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $results->links() }}</div>
    @elseif($query)
    <div class="bg-white rounded-xl p-8 md:p-12 text-center shadow-sm border border-slate-200">
        <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <p class="text-slate-900 text-lg font-medium">No results found for "{{ $query }}"</p>
        <p class="text-sm text-slate-500 mt-2">Try different keywords or browse all schemes</p>
        <a href="{{ route('schemes.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition">Browse all schemes →</a>
    </div>
    @else
    <div class="bg-white rounded-xl p-8 md:p-12 text-center shadow-sm border border-slate-200">
        <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <p class="text-slate-500">Type at least 2 characters to search.</p>
    </div>
    @endif
</div>
@endsection

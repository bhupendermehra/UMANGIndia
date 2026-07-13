@extends('layouts.app')

@section('title', 'Latest Government Schemes - UmangIndia')
@section('description', 'Latest updates and newly added government schemes on UmangIndia.')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-blue-600">Latest Government Schemes</h1>
<p class="text-slate-500 text-sm mb-6">Recently added and updated schemes on UmangIndia</p>

@if($schemes->count())
<div class="space-y-4">
    @foreach($schemes as $scheme)
    <a href="{{ route('schemes.show', $scheme) }}" class="block bg-white rounded-xl p-5 shadow-sm hover:shadow-lg transition-all duration-200 border border-slate-200 hover:border-blue-300 group card-hover">
        <div class="h-1 bg-gradient-to-r from-blue-600 to-blue-400 rounded-t-xl -mt-5 -mx-5 mb-4"></div>
        <div class="flex items-center gap-2 mb-2">
            <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name }}</span>
            @if($scheme->status === 'active')
            <span class="bg-emerald-50 text-emerald-600 text-xs px-2.5 py-1 rounded-full font-medium">Active</span>
            @elseif($scheme->status === 'upcoming')
            <span class="bg-amber-50 text-amber-600 text-xs px-2.5 py-1 rounded-full font-medium">Upcoming</span>
            @else
            <span class="bg-red-50 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">Closed</span>
            @endif
        </div>
        <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-600 transition">{{ $scheme->title }}</h3>
        <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ $scheme->short_description }}</p>
        <p class="text-xs text-slate-400 mt-2">Published: {{ $scheme->published_at?->format('d M Y') }}</p>
    </a>
    @endforeach
</div>
<div class="mt-6">{{ $schemes->links() }}</div>
@else
<div class="bg-white rounded-xl p-12 text-center shadow-sm border border-slate-200">
    <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
    <p class="text-slate-500 text-lg">No schemes available yet.</p>
</div>
@endif
@endsection

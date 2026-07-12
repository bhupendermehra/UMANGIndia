@extends('layouts.app')

@section('title', 'Latest Government Schemes - UmangIndia')
@section('description', 'Latest updates and newly added government schemes on UmangIndia.')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-[#0B4EA2]">Latest Government Schemes</h1>
<p class="text-[#888888] text-sm mb-6">Recently added and updated schemes on UmangIndia</p>

@if($schemes->count())
<div class="space-y-4">
    @foreach($schemes as $scheme)
    <a href="{{ route('schemes.show', $scheme) }}" class="block bg-white rounded-xl p-5 shadow-sm hover:shadow-lg transition-all duration-200 border border-[#E5E7EB] hover:border-[#0B4EA2] group card-hover">
        <div class="flex items-center gap-2 mb-2">
            <span class="bg-[#eef4fb] text-[#0B4EA2] text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name }}</span>
            @if($scheme->status === 'active')
            <span class="bg-green-50 text-green-600 text-xs px-2.5 py-1 rounded-full font-medium">Active</span>
            @elseif($scheme->status === 'upcoming')
            <span class="bg-yellow-50 text-yellow-600 text-xs px-2.5 py-1 rounded-full font-medium">Upcoming</span>
            @else
            <span class="bg-red-50 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">Closed</span>
            @endif
        </div>
        <h3 class="font-bold text-lg text-[#333333] group-hover:text-[#0B4EA2] transition">{{ $scheme->title }}</h3>
        <p class="text-sm text-[#666666] mt-1 line-clamp-2">{{ $scheme->short_description }}</p>
        <p class="text-xs text-[#888888] mt-2">Published: {{ $scheme->published_at?->format('d M Y') }}</p>
    </a>
    @endforeach
</div>
<div class="mt-6">{{ $schemes->links() }}</div>
@else
<div class="bg-white rounded-xl p-12 text-center shadow-sm border border-[#E5E7EB]">
    <div class="text-4xl mb-4">📋</div>
    <p class="text-[#888888] text-lg">No schemes available yet.</p>
</div>
@endif
@endsection

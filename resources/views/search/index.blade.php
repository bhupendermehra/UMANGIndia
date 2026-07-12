@extends('layouts.app')

@section('title', 'Search: ' . ($query ?? '') . ' - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-[#0B4EA2]">Search Results</h1>

    <form action="{{ route('search') }}" method="GET" class="mb-8">
        <div class="flex gap-2">
            <input type="text" name="q" value="{{ $query }}" placeholder="Search government schemes..." class="flex-1 px-5 py-3 border border-[#E5E7EB] rounded-xl text-sm bg-[#F5F7FA] focus:ring-2 focus:ring-[#0B4EA2] focus:border-[#0B4EA2]">
            <button type="submit" class="bg-[#0B4EA2] text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-[#083B7A] transition">Search</button>
        </div>
    </form>

    @if($query && $results->count())
    <p class="text-[#888888] text-sm mb-4">{{ $results->total() }} results found for "<strong class="text-[#333333]">{{ $query }}</strong>"</p>
    <div class="space-y-4">
        @foreach($results as $scheme)
        <a href="{{ route('schemes.show', $scheme) }}" class="block bg-white rounded-xl p-5 shadow-sm hover:shadow-lg transition-all duration-200 border border-[#E5E7EB] hover:border-[#0B4EA2] group card-hover">
            <span class="bg-[#eef4fb] text-[#0B4EA2] text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name }}</span>
            <h3 class="font-bold text-lg mt-2 text-[#333333] group-hover:text-[#0B4EA2] transition">{{ $scheme->title }}</h3>
            <p class="text-sm text-[#666666] mt-1 line-clamp-2">{{ $scheme->short_description }}</p>
        </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $results->links() }}</div>
    @elseif($query)
    <div class="bg-white rounded-xl p-12 text-center shadow-sm border border-[#E5E7EB]">
        <div class="text-4xl mb-4">🔍</div>
        <p class="text-[#333333] text-lg font-medium">No results found for "{{ $query }}"</p>
        <p class="text-sm text-[#888888] mt-2">Try different keywords or browse all schemes</p>
        <a href="{{ route('schemes.index') }}" class="mt-4 inline-block bg-[#0B4EA2] text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-[#083B7A] transition">Browse all schemes →</a>
    </div>
    @else
    <div class="bg-white rounded-xl p-12 text-center shadow-sm border border-[#E5E7EB]">
        <div class="text-4xl mb-4">💡</div>
        <p class="text-[#666666]">Type at least 2 characters to search.</p>
    </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title', 'All Government Schemes - UmangIndia')
@section('description', 'Browse all Indian government schemes. Filter by category, state, and status. Find eligibility, benefits and application process.')

@section('content')
<div class="lg:hidden mb-4">
    <button onclick="document.getElementById('filter-panel').classList.toggle('hidden'); this.querySelector('span').textContent = document.getElementById('filter-panel').classList.contains('hidden') ? 'Show Filters' : 'Hide Filters'" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-medium flex items-center justify-between shadow-sm">
        <span>Show Filters</span>
        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </button>
</div>
<div class="grid gap-8 lg:grid-cols-[280px_minmax(0,1fr)]">
    <aside id="filter-panel" class="hidden lg:block lg:sticky lg:top-24 self-start">
        <div class="surface-card p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold section-title">Filters</h3>
                <a href="{{ route('schemes.index') }}" class="text-xs text-blue-600 hover:underline">Clear all</a>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-2 text-slate-700">Category</label>
                    <select onchange="window.location.href=this.value" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm bg-slate-50 focus-ring">
                        <option value="{{ route('schemes.index') }}">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ route('schemes.index', ['category' => $cat->id]) }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->icon }} {{ $cat->name }} ({{ $cat->schemes_count }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-slate-700">State</label>
                    <select onchange="window.location.href=this.value" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm bg-slate-50 focus-ring">
                        <option value="{{ route('schemes.index') }}">All States</option>
                        @foreach($states as $state)
                        <option value="{{ route('schemes.index', ['state' => $state->id]) }}" {{ request('state') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-slate-700">Status</label>
                    <select onchange="window.location.href=this.value" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm bg-slate-50 focus-ring">
                        <option value="{{ route('schemes.index') }}">All</option>
                        <option value="{{ route('schemes.index', ['status' => 'active']) }}" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="{{ route('schemes.index', ['status' => 'upcoming']) }}" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="{{ route('schemes.index', ['status' => 'closed']) }}" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-slate-700">Sort By</label>
                    <select onchange="window.location.href=this.value" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm bg-slate-50 focus-ring">
                        <option value="{{ route('schemes.index') }}">Latest First</option>
                        <option value="{{ route('schemes.index', ['sort' => 'popular']) }}" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Viewed</option>
                        <option value="{{ route('schemes.index', ['sort' => 'deadline']) }}" {{ request('sort') == 'deadline' ? 'selected' : '' }}>Deadline Soon</option>
                    </select>
                </div>
            </div>
        </div>
    </aside>

    <div class="min-w-0">
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold section-title">
                @if(request('category'))
                    {{ \App\Models\Category::find(request('category'))?->name }} Schemes
                @elseif(request('state'))
                    {{ \App\Models\State::find(request('state'))?->name }} Schemes
                @else
                    All Government Schemes
                @endif
            </h1>
            <p class="muted mt-1">Browse and compare schemes with clear filters and mobile-friendly cards.</p>
        </div>

        @if($schemes->count())
            @foreach($schemes as $scheme)
            <a href="{{ route('schemes.show', $scheme) }}" class="block bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-blue-300 mb-4">
                <div class="h-1 bg-gradient-to-r from-blue-600 to-blue-400"></div>
                <div class="p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-medium text-slate-500">{{ $scheme->category->name }}</span>
                        </div>
                        @if($scheme->status === 'active')
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-700 bg-emerald-50 px-2 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                            Active
                        </span>
                        @elseif($scheme->status === 'upcoming')
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-700 bg-amber-50 px-2 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                            Upcoming
                        </span>
                        @elseif($scheme->status === 'closed')
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-red-700 bg-red-50 px-2 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                            Closed
                        </span>
                        @endif
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-600 transition-colors mb-2 line-clamp-2">{{ $scheme->title }}</h3>
                    <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed">{{ $scheme->short_description }}</p>
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-center gap-3 text-xs text-slate-400">
                            <span>{{ $scheme->category->name }}</span>
                            @if($scheme->state)
                            <span>{{ $scheme->state->name }}</span>
                            @endif
                        </div>
                        <span class="text-blue-600 text-sm font-medium flex items-center gap-1">
                            View Details
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach

        <div class="mt-6">
            {{ $schemes->links() }}
        </div>
        @else
        <div class="surface-card p-8 md:p-12 text-center">
            <p class="text-slate-500 text-lg">No schemes found matching your criteria.</p>
            <a href="{{ route('schemes.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">View all schemes →</a>
        </div>
        @endif
    </div>
</div>
@endsection

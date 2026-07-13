@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-500 text-sm">Welcome back, {{ auth()->user()->name }} · {{ now()->format('l, j F Y') }}</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Schemes</p>
                <p class="text-3xl font-bold text-primary-600">{{ $stats['total_schemes'] }}</p>
            </div>
            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Active</p>
                <p class="text-3xl font-bold text-green-600">{{ $stats['active_schemes'] }}</p>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Categories</p>
                <p class="text-3xl font-bold text-primary-600">{{ $stats['total_categories'] }}</p>
            </div>
            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">States/UTs</p>
                <p class="text-3xl font-bold text-primary-600">{{ $stats['total_states'] }}</p>
            </div>
            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Views</p>
                <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_views']) }}</p>
            </div>
            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Subscribers</p>
                <p class="text-3xl font-bold text-primary-600">{{ number_format($totalSubscribers) }}</p>
            </div>
            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
        </div>
    </div>
</div>

<!-- Content Health Alerts -->
@php
    $healthAlerts = [];
    if ($schemesWithMissingData > 0) {
        $healthAlerts[] = ['label' => 'Schemes missing description', 'count' => $schemesWithMissingData, 'route' => route('admin.schemes.index'), 'severity' => 'amber'];
    }
    if ($schemesWithNoHindi > 0) {
        $healthAlerts[] = ['label' => 'Schemes without Hindi title', 'count' => $schemesWithNoHindi, 'route' => route('admin.schemes.index'), 'severity' => 'amber'];
    }
    if ($schemesWithNoDeadline > 0) {
        $healthAlerts[] = ['label' => 'Schemes with no deadline', 'count' => $schemesWithNoDeadline, 'route' => route('admin.schemes.index'), 'severity' => 'red'];
    }
    if ($draftArticles > 0) {
        $healthAlerts[] = ['label' => 'Draft articles not published', 'count' => $draftArticles, 'route' => route('admin.articles.index'), 'severity' => 'amber'];
    }
@endphp

@if(count($healthAlerts))
<div class="mb-8">
    <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Content Health</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
        @foreach($healthAlerts as $alert)
        <a href="{{ $alert['route'] }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg border shadow-sm transition hover:shadow-md
                  @if($alert['severity'] === 'red') bg-red-50 border-red-200 text-red-800 hover:bg-red-100
                  @else bg-amber-50 border-amber-200 text-amber-800 hover:bg-amber-100 @endif">
            <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center
                        @if($alert['severity'] === 'red') bg-red-100 text-red-600
                        @else bg-amber-100 text-amber-600 @endif">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium">{{ $alert['label'] }}</p>
                <p class="text-lg font-bold">{{ $alert['count'] }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

<!-- Middle Section: Recent Schemes + Upcoming Deadlines -->
<div class="grid lg:grid-cols-2 gap-6 mb-8">
    <!-- Recent Schemes -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">Recent Schemes</h2>
            <a href="{{ route('admin.schemes.index') }}" class="text-sm text-primary-600 hover:underline">View All →</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($recentSchemes as $scheme)
            <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $scheme->title }}</p>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="text-xs text-gray-500">{{ $scheme->category?->name ?? 'Uncategorized' }}</span>
                        @if($scheme->state)
                        <span class="text-xs text-gray-400">·</span>
                        <span class="text-xs text-gray-500">{{ $scheme->state->name }}</span>
                        @endif
                        <span class="text-xs text-gray-400">·</span>
                        <span class="text-xs text-gray-400">{{ number_format($scheme->views) }} views</span>
                    </div>
                </div>
                <div class="ml-3 flex-shrink-0 flex items-center gap-2">
                    @php
                        $statusColors = [
                            'active' => 'bg-green-100 text-green-700',
                            'upcoming' => 'bg-yellow-100 text-yellow-700',
                            'closed' => 'bg-red-100 text-red-700',
                        ];
                        $color = $statusColors[$scheme->status] ?? 'bg-gray-100 text-gray-600';
                    @endphp
                    <span class="px-2 py-0.5 text-xs rounded-full font-medium {{ $color }}">{{ ucfirst($scheme->status) }}</span>
                    <span class="text-xs text-gray-400">{{ $scheme->updated_at->diffForHumans() }}</span>
                </div>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-gray-400 text-sm">No schemes yet.</div>
            @endforelse
        </div>
    </div>

    <!-- Upcoming Deadlines -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">Upcoming Deadlines</h2>
            @if($upcomingDeadlines->count())
            <span class="text-xs bg-primary-50 text-primary-600 px-2 py-0.5 rounded-full font-medium">{{ $upcomingDeadlines->count() }} upcoming</span>
            @endif
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($upcomingDeadlines as $scheme)
            @php
                $daysRemaining = now()->diffInDays(\Carbon\Carbon::parse($scheme->application_deadline), false);
                $deadlineLabel = $daysRemaining <= 0 ? 'Today!' : ($daysRemaining === 1 ? '1 day remaining' : $daysRemaining . ' days remaining');
                $isUrgent = $daysRemaining <= 3;
            @endphp
            <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $scheme->title }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">
                        {{ \Carbon\Carbon::parse($scheme->application_deadline)->format('d M Y') }}
                        @if($scheme->category)
                         · {{ $scheme->category->name }}
                        @endif
                    </p>
                </div>
                <div class="ml-3 flex-shrink-0">
                    <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full
                        @if($isUrgent) bg-red-100 text-red-700
                        @elseif($daysRemaining <= 7) bg-amber-100 text-amber-700
                        @else bg-green-100 text-green-700 @endif">
                        {{ $deadlineLabel }}
                    </span>
                </div>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-gray-400 text-sm">No upcoming deadlines.</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Bottom: Trending & Most Viewed + Quick Actions -->
<div class="grid lg:grid-cols-2 gap-6 mb-8">
    <!-- Trending -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">Trending (7 Days)</h2>
            <span class="text-xs bg-primary-50 text-primary-600 px-2 py-0.5 rounded-full font-medium">{{ $trendingSchemes->count() }} trending</span>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($trendingSchemes as $scheme)
            <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $scheme->title }}</p>
                    <p class="text-xs text-gray-500">{{ $scheme->category?->name ?? 'Uncategorized' }}</p>
                </div>
                <span class="ml-3 text-sm font-semibold text-primary-600">{{ number_format($scheme->views) }} views</span>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-gray-400 text-sm">No trending schemes.</div>
            @endforelse
        </div>
    </div>

    <!-- Most Viewed -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">Most Viewed (All Time)</h2>
            <span class="text-xs text-gray-500">Top 5</span>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($topViewed as $scheme)
            <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $scheme->title }}</p>
                    <p class="text-xs text-gray-500">{{ $scheme->category?->name ?? 'Uncategorized' }}</p>
                </div>
                <span class="ml-3 text-sm font-semibold text-gray-600">{{ number_format($scheme->views) }} views</span>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-gray-400 text-sm">No data yet.</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
    <h2 class="font-semibold text-gray-800 mb-4">Quick Actions</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.schemes.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Add Scheme
        </a>
        <a href="{{ route('admin.categories.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 bg-white text-primary-600 text-sm font-medium rounded-lg border border-primary-200 hover:bg-primary-50 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            Add Category
        </a>
        <a href="{{ route('admin.settings.index') }}"
           class="inline-flex items-center gap-2 px-5 py-3 bg-white text-primary-600 text-sm font-medium rounded-lg border border-primary-200 hover:bg-primary-50 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            View Settings
        </a>
        <a href="{{ route('home') }}" target="_blank"
           class="inline-flex items-center gap-2 px-5 py-3 bg-white text-primary-600 text-sm font-medium rounded-lg border border-primary-200 hover:bg-primary-50 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            View Site
        </a>
    </div>
</div>
@endsection

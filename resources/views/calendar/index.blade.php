@php
    $months = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $dayNames = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $today = \Carbon\Carbon::today();
    $totalSchemes = $upcomingDeadlines->count() + collect($schemesInMonth)->flatten(1)->count();
@endphp

@extends('layouts.app')

@section('title', 'Scheme Deadline Calendar ' . $year . ' | UmangIndia')
@section('description', 'View all government scheme application deadlines in a visual calendar format. Check upcoming Sarkari Yojana deadlines month by month on UmangIndia.')
@section('keywords', 'scheme deadlines, yojana calendar, application deadlines, government schemes dates, sarkari yojana last date')

@push('schema')
<?php
$schemaItems = [];
foreach ($upcomingDeadlines as $i => $scheme) {
    $schemaItems[] = [
        '@type' => 'ListItem',
        'position' => $i + 1,
        'item' => [
            '@type' => 'WebPage',
            'name' => $scheme->title,
            'url' => route('schemes.show', $scheme),
        ],
    ];
}
$calendarSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => 'Scheme Deadline Calendar ' . $year,
    'description' => 'Calendar of government scheme application deadlines',
    'itemListElement' => $schemaItems,
];
?>
<script type="application/ld+json">{!! json_encode($calendarSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@push('styles')
<style>
    .cal-day:hover { background-color: #f8fafc; }
    .cal-day.has-deadline { background: linear-gradient(180deg, #f0f9ff 0%, #ffffff 100%); }
    .cal-day.today { box-shadow: inset 0 0 0 2px #2563eb; font-weight: 600; }
    .cal-day.other-month { opacity: 0.4; }
    .deadline-badge { transition: transform 0.15s ease, box-shadow 0.15s ease; cursor: default; }
    .deadline-badge:hover { transform: translateY(-1px); box-shadow: 0 2px 6px rgba(0,0,0,0.15); }
</style>
@endpush

@section('content')
<div class="page-enter">
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-sm text-slate-500" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
            <li><svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
            <li class="text-slate-800 font-medium" aria-current="page">Deadline Calendar</li>
        </ol>
    </nav>

    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-2xl p-6 md:p-8 mb-8 text-white shadow-xl">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold mb-2">📅 Scheme Deadline Calendar {{ $year }}</h1>
                <p class="text-blue-100 text-sm md:text-base">Track application deadlines for all government schemes and sarkari yojana in a visual calendar view.</p>
                <p class="text-blue-200/70 text-xs mt-1">{{ $totalSchemes }} scheme{{ $totalSchemes !== 1 ? 's' : '' }} with deadlines tracked</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('schemes.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white/20 hover:bg-white/30 backdrop-blur rounded-lg text-sm font-medium transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    All Schemes
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Calendar -->
        <div class="flex-1 min-w-0">
            <!-- Month Navigation -->
            <div class="flex items-center justify-between mb-6 bg-white rounded-xl border border-slate-200 p-3 shadow-sm">
                <a href="{{ route('calendar.index', ['month' => $prevMonth->month, 'year' => $prevMonth->year]) }}"
                   class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-slate-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    <span class="hidden sm:inline">{{ $months[$prevMonth->month] }}</span>
                </a>

                <div class="text-center">
                    <h2 class="text-lg md:text-xl font-bold text-slate-800">{{ $months[$month] }} {{ $year }}</h2>
                    <p class="text-xs text-slate-400">{{ count(collect($schemesInMonth)->flatten(1)) }} deadline{{ count(collect($schemesInMonth)->flatten(1)) !== 1 ? 's' : '' }} this month</p>
                </div>

                <a href="{{ route('calendar.index', ['month' => $nextMonth->month, 'year' => $nextMonth->year]) }}"
                   class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-slate-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                    <span class="hidden sm:inline">{{ $months[$nextMonth->month] }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Calendar Grid -->
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                <!-- Day headers -->
                <div class="grid grid-cols-7 bg-slate-50 border-b border-slate-200">
                    @foreach($dayNames as $day)
                    <div class="py-2.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">{{ $day }}</div>
                    @endforeach
                </div>

                <!-- Week rows -->
                @forelse($weeks as $week)
                <div class="grid grid-cols-7 border-b border-slate-100 last:border-b-0">
                    @foreach($week as $day)
                        @php
                            $dateKey = $day->format('Y-m-d');
                            $isCurrentMonth = $day->month === $month;
                            $isToday = $day->isSameDay($today);
                            $daySchemes = $schemesInMonth->get($dateKey, collect());
                        @endphp
                        <div class="cal-day min-h-[90px] md:min-h-[110px] p-1.5 md:p-2 border-r border-slate-100 last:border-r-0 {{ $isCurrentMonth ? '' : 'other-month' }} {{ $isToday ? 'today' : '' }} {{ $daySchemes->count() ? 'has-deadline' : '' }}">
                            <div class="text-xs md:text-sm font-medium {{ $isToday ? 'text-blue-600' : ($isCurrentMonth ? 'text-slate-700' : 'text-slate-400') }} mb-1">
                                {{ $day->format('j') }}
                            </div>
                            @if($daySchemes->count())
                                <div class="space-y-0.5">
                                    @foreach($daySchemes as $scheme)
                                        @php
                                            $catColor = $categoryColors[$scheme->category_id % count($categoryColors)] ?? '#6B7280';
                                            $bgColor = $catColor . '18';
                                        @endphp
                                        <a href="{{ route('schemes.show', $scheme) }}"
                                           class="deadline-badge block text-[10px] md:text-xs leading-tight px-1.5 py-0.5 rounded truncate font-medium text-white"
                                           style="background-color: {{ $catColor }};"
                                           title="{{ $scheme->title }}">
                                            {{ $scheme->title }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                @empty
                <div class="p-12 text-center">
                    <p class="text-slate-500">No calendar data available.</p>
                </div>
                @endforelse
            </div>

            <!-- Category Legend -->
            @if(count($schemesInMonth))
            <div class="mt-4 flex flex-wrap items-center gap-3 text-xs text-slate-500">
                <span class="font-medium">Legend:</span>
                @php $seenCats = []; @endphp
                @foreach(collect($schemesInMonth)->flatten(1)->unique('category_id') as $scheme)
                    @if(!in_array($scheme->category_id, $seenCats))
                        @php
                            $seenCats[] = $scheme->category_id;
                            $catColor = $categoryColors[$scheme->category_id % count($categoryColors)] ?? '#6B7280';
                        @endphp
                        <span class="inline-flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $catColor }};"></span>
                            {{ $scheme->category->name ?? 'Uncategorized' }}
                        </span>
                    @endif
                @endforeach
            </div>
            @endif

            <!-- No deadlines message -->
            @php
                $allSchemesCount = count(collect($schemesInMonth)->flatten(1)) + $upcomingDeadlines->count();
            @endphp
            @if($allSchemesCount === 0)
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-8 text-center mt-6">
                <div class="text-4xl mb-3">📭</div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">No Deadline Schemes Found</h3>
                <p class="text-slate-600 mb-4 max-w-md mx-auto">There are currently no schemes with published deadlines. Check the full schemes list to explore available yojana.</p>
                <a href="{{ route('schemes.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    Browse All Schemes
                </a>
            </div>
            @endif
        </div>

        <!-- Upcoming Deadlines Sidebar -->
        <div class="w-full lg:w-80 shrink-0">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm sticky top-24">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-t-xl px-5 py-4">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Upcoming Deadlines
                    </h3>
                </div>

                <div class="p-4">
                    @if($upcomingDeadlines->count())
                        <ul class="space-y-3">
                            @foreach($upcomingDeadlines as $scheme)
                                @php
                                    $catColor = $categoryColors[$scheme->category_id % count($categoryColors)] ?? '#6B7280';
                                    $daysLeft = now()->startOfDay()->diffInDays($scheme->application_deadline, false);
                                    $isPast = $daysLeft < 0;
                                    $isUrgent = $daysLeft >= 0 && $daysLeft <= 7;
                                @endphp
                                <li class="group">
                                    <a href="{{ route('schemes.show', $scheme) }}" class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-slate-50 transition">
                                        <span class="w-2 h-2 rounded-full mt-1.5 shrink-0" style="background-color: {{ $catColor }};"></span>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-medium text-slate-800 truncate group-hover:text-blue-600 transition">{{ $scheme->title }}</p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="text-xs text-slate-400">{{ $scheme->application_deadline->format('M d, Y') }}</span>
                                                @if($isPast)
                                                    <span class="text-xs text-red-500 font-medium">Expired</span>
                                                @elseif($isUrgent)
                                                    <span class="text-xs text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded font-medium">{{ $daysLeft }} day{{ $daysLeft !== 1 ? 's' : '' }} left</span>
                                                @else
                                                    <span class="text-xs text-slate-400">{{ $daysLeft }} days left</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-4 pt-3 border-t border-slate-100">
                            <a href="{{ route('schemes.index') }}" class="flex items-center justify-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition">
                                View all schemes
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-slate-400 text-sm mb-3">No upcoming deadlines at the moment.</p>
                            <a href="{{ route('schemes.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Browse all schemes →</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats Card -->
            <div class="mt-4 bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
                <h4 class="text-sm font-semibold text-slate-600 uppercase tracking-wider mb-3">Quick Stats</h4>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-blue-50 rounded-lg p-3 text-center">
                        <p class="text-2xl font-bold text-blue-600">{{ count(collect($schemesInMonth)->flatten(1)) }}</p>
                        <p class="text-xs text-slate-500">This Month</p>
                    </div>
                    <div class="bg-emerald-50 rounded-lg p-3 text-center">
                        <p class="text-2xl font-bold text-emerald-600">{{ $upcomingDeadlines->count() }}</p>
                        <p class="text-xs text-slate-500">Upcoming</p>
                    </div>
                </div>
            </div>

            <!-- Jump to Month -->
            <div class="mt-4 bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
                <h4 class="text-sm font-semibold text-slate-600 uppercase tracking-wider mb-3">Jump to Month</h4>
                <div class="grid grid-cols-3 gap-1.5">
                    @foreach(range(1, 12) as $m)
                        <a href="{{ route('calendar.index', ['month' => $m, 'year' => $year]) }}"
                           class="text-center py-1.5 text-xs rounded-md transition font-medium
                                  {{ $m === $month ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                            {{ substr($months[$m], 0, 3) }}
                        </a>
                    @endforeach
                </div>
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('calendar.index', ['year' => $year - 1]) }}"
                       class="flex-1 text-center py-1.5 text-xs rounded-md border border-slate-200 text-slate-600 hover:bg-slate-50 transition font-medium">
                        {{ $year - 1 }}
                    </a>
                    <a href="{{ route('calendar.index') }}"
                       class="flex-1 text-center py-1.5 text-xs rounded-md border border-slate-200 text-slate-600 hover:bg-slate-50 transition font-medium">
                        Current
                    </a>
                    <a href="{{ route('calendar.index', ['year' => $year + 1]) }}"
                       class="flex-1 text-center py-1.5 text-xs rounded-md border border-slate-200 text-slate-600 hover:bg-slate-50 transition font-medium">
                        {{ $year + 1 }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

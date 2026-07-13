@extends('layouts.app')

@section('title', 'Scheme Comparison Results | UmangIndia')
@section('description', 'Side-by-side comparison of Indian government schemes. Compare eligibility, benefits, application process, and required documents.')
@section('keywords', 'scheme comparison, compare yojana, side by side comparison, government scheme details')

@push('meta')
<meta name="robots" content="noindex, follow">
<link rel="canonical" href="{{ url()->current() }}">
@endpush

@push('styles')
<style>
@media print {
    body { background: white !important; }
    .no-print { display: none !important; }
    .print-only { display: block !important; }
    main { max-width: 100% !important; padding: 0 !important; }
    .comparison-table { break-inside: avoid; }
    .scheme-header-card { break-inside: avoid; }
    footer { display: none !important; }
}
.print-only { display: none; }
</style>
@endpush

@section('content')
<div class="page-enter">
    <!-- Header -->
    <div class="mb-6 no-print">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-800">Comparison Results</h1>
                    <p class="text-slate-500 mt-1">Side-by-side overview of selected schemes</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('compare.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 text-slate-700 font-medium rounded-xl hover:bg-slate-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                    </svg>
                    Compare Another
                </a>
                <button onclick="window.print()"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print
                </button>
            </div>
        </div>
    </div>

    <!-- Desktop: Side-by-Side Table -->
    <div class="hidden md:block comparison-table">
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="w-48 bg-slate-50 border-r border-b border-slate-200 px-4 py-3"></th>
                        @foreach($schemes as $index => $scheme)
                        <th class="border-b border-slate-200 {{ !$loop->last ? 'border-r' : '' }} p-0 align-top">
                            <div class="scheme-header-card p-5 {{ $index === 0 ? 'bg-gradient-to-br from-blue-50/80 to-white' : ($index === 1 ? 'bg-gradient-to-br from-amber-50/80 to-white' : 'bg-gradient-to-br from-emerald-50/80 to-white') }}">
                                @if($scheme->category)
                                <span class="inline-block text-xs font-medium {{ $index === 0 ? 'text-blue-600 bg-blue-100' : ($index === 1 ? 'text-amber-600 bg-amber-100' : 'text-emerald-600 bg-emerald-100') }} px-2.5 py-1 rounded-full mb-2">
                                    {{ $scheme->category->name }}
                                </span>
                                @endif
                                <h3 class="text-base font-bold text-slate-800 leading-tight">{{ $scheme->title }}</h3>
                                @if($scheme->status === 'active')
                                <span class="inline-flex items-center gap-1 mt-2 text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Active
                                </span>
                                @endif
                            </div>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                    $rows = [
                        'Scheme Name' => fn($s) => $s->title,
                        'Category' => fn($s) => $s->category?->name ?? '<span class="text-slate-400">—</span>',
                        'Status' => fn($s) => $s->status === 'active'
                            ? '<span class="inline-flex items-center gap-1 text-emerald-600 font-medium"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Active</span>'
                            : '<span class="inline-flex items-center gap-1 text-slate-500"><span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>Inactive</span>',
                        'Eligibility' => fn($s) => $s->eligibility ? nl2br(e(Str::limit(strip_tags($s->eligibility), 300))) : '<span class="text-slate-400">—</span>',
                        'Benefits' => fn($s) => $s->benefits ? nl2br(e(Str::limit(strip_tags($s->benefits), 300))) : '<span class="text-slate-400">—</span>',
                        'Application Process' => fn($s) => $s->application_process ? nl2br(e(Str::limit(strip_tags($s->application_process), 300))) : '<span class="text-slate-400">—</span>',
                        'Required Documents' => fn($s) => $s->required_documents ? nl2br(e(Str::limit(strip_tags($s->required_documents), 300))) : '<span class="text-slate-400">—</span>',
                        'Deadline' => fn($s) => $s->application_deadline
                            ? '<span class="font-medium">' . $s->application_deadline->format('d M Y') . '</span>'
                            : '<span class="text-slate-400">No deadline</span>',
                        'Website' => fn($s) => $s->official_website
                            ? '<a href="' . e($s->official_website) . '" target="_blank" rel="noopener noreferrer nofollow" class="text-blue-600 hover:text-blue-700 underline break-all">' . e($s->official_website) . '</a>'
                            : '<span class="text-slate-400">—</span>',
                    ];
                    @endphp

                    @foreach($rows as $label => $renderer)
                    <tr class="{{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                        <td class="bg-slate-50 font-semibold text-sm text-slate-700 border-r border-slate-200 px-4 py-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                @php
                                $icons = [
                                    'Scheme Name' => 'document-text',
                                    'Category' => 'folder',
                                    'Status' => 'check-circle',
                                    'Eligibility' => 'user-group',
                                    'Benefits' => 'gift',
                                    'Application Process' => 'clipboard-list',
                                    'Required Documents' => 'document-duplicate',
                                    'Deadline' => 'calendar',
                                    'Website' => 'globe-alt',
                                ];
                                $icon = $icons[$label] ?? 'information-circle';
                                @endphp
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @switch($icon)
                                        @case('document-text')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        @break
                                        @case('folder')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                        @break
                                        @case('check-circle')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @break
                                        @case('user-group')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        @break
                                        @case('gift')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                                        @break
                                        @case('clipboard-list')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                        @break
                                        @case('document-duplicate')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                                        @break
                                        @case('calendar')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        @break
                                        @case('globe-alt')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                        @break
                                        @default
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endswitch
                                </svg>
                                {{ $label }}
                            </div>
                        </td>
                        @foreach($schemes as $scheme)
                        <td class="px-4 py-3.5 text-sm text-slate-600 leading-relaxed {{ !$loop->parent->last ? 'border-r border-slate-100' : '' }}">
                            {!! $renderer($scheme) !!}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile: Card Stack -->
    <div class="md:hidden space-y-6">
        @foreach($schemes as $index => $scheme)
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <!-- Scheme Header -->
            <div class="p-5 {{ $index === 0 ? 'bg-gradient-to-br from-blue-50/80 to-white' : ($index === 1 ? 'bg-gradient-to-br from-amber-50/80 to-white' : 'bg-gradient-to-br from-emerald-50/80 to-white') }}">
                <div class="flex items-center justify-between mb-2">
                    @if($scheme->category)
                    <span class="text-xs font-medium {{ $index === 0 ? 'text-blue-600 bg-blue-100' : ($index === 1 ? 'text-amber-600 bg-amber-100' : 'text-emerald-600 bg-emerald-100') }} px-2.5 py-1 rounded-full">
                        {{ $scheme->category->name }}
                    </span>
                    @endif
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Scheme {{ $loop->iteration }}</span>
                </div>
                <h3 class="text-lg font-bold text-slate-800">{{ $scheme->title }}</h3>
                @if($scheme->status === 'active')
                <span class="inline-flex items-center gap-1 mt-2 text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Active
                </span>
                @endif
            </div>

            <!-- Details -->
            <div class="divide-y divide-slate-100">
                @php
                $mobileRows = [
                    'Category' => fn($s) => $s->category?->name ?? '—',
                    'Status' => fn($s) => $s->status === 'active' ? 'Active' : 'Inactive',
                    'Eligibility' => fn($s) => $s->eligibility ? Str::limit(strip_tags($s->eligibility), 200) : '—',
                    'Benefits' => fn($s) => $s->benefits ? Str::limit(strip_tags($s->benefits), 200) : '—',
                    'Application Process' => fn($s) => $s->application_process ? Str::limit(strip_tags($s->application_process), 200) : '—',
                    'Required Documents' => fn($s) => $s->required_documents ? Str::limit(strip_tags($s->required_documents), 200) : '—',
                    'Deadline' => fn($s) => $s->application_deadline ? $s->application_deadline->format('d M Y') : 'No deadline',
                    'Website' => fn($s) => $s->official_website ? '<a href="' . e($s->official_website) . '" target="_blank" rel="noopener noreferrer nofollow" class="text-blue-600 hover:text-blue-700 underline break-all">' . e($s->official_website) . '</a>' : '—',
                ];
                @endphp
                @foreach($mobileRows as $label => $renderer)
                <div class="px-5 py-3">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">{{ $label }}</span>
                    <span class="text-sm text-slate-700">{!! $renderer($scheme) !!}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <!-- Bottom Actions -->
    <div class="mt-8 text-center no-print">
        <a href="{{ route('compare.index') }}"
           class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
            </svg>
            Compare Another Set of Schemes
        </a>
    </div>
</div>
@endsection

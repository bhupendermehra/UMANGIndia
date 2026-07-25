@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">Overview of your schemes portal</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold text-primary-600">{{ $stats['total_schemes'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Total Schemes</div>
            </div>
            <div class="w-12 h-12 bg-primary-50 rounded-lg flex items-center justify-center text-primary-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
        </div>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold text-green-600">{{ $stats['articles_published'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Published Articles</div>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-green-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg></div>
        </div>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold text-orange-600">{{ $stats['total_categories'] + $stats['total_states'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Categories + States</div>
            </div>
            <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg></div>
        </div>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold text-red-600">{{ $stats['pending_drafts'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Pending SEO Drafts</div>
            </div>
            <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center text-red-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
            <h2 class="font-semibold">Recent Articles</h2>
            <a href="{{ route('admin.articles.index') }}" class="text-primary-600 hover:underline text-sm">View All</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($recent_articles as $article)
            <div class="px-4 py-3 flex items-center justify-between">
                <div>
                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-primary-600 hover:underline text-sm font-medium">{{ Str::limit($article->title, 50) }}</a>
                    <div class="text-xs text-gray-500 mt-0.5">{{ $article->status }} · {{ $article->created_at->format('d M Y') }}</div>
                </div>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $article->status }}</span>
            </div>
            @empty
            <div class="px-4 py-8 text-center text-gray-500 text-sm">No articles yet.</div>
            @endforelse
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
            <h2 class="font-semibold">Pending SEO Drafts</h2>
            <a href="{{ route('admin.seo-drafts.index') }}" class="text-primary-600 hover:underline text-sm">View All</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($pending_seo_drafts as $draft)
            <div class="px-4 py-3">
                <a href="{{ route('admin.seo-drafts.show', $draft) }}" class="text-primary-600 hover:underline text-sm font-medium">{{ Str::limit($draft->title, 60) }}</a>
                <div class="text-xs text-gray-500 mt-0.5">{{ $draft->target_keyword ?? 'No keyword' }}</div>
            </div>
            @empty
            <div class="px-4 py-8 text-center text-gray-500 text-sm">No pending drafts.</div>
            @endforelse
        </div>
    </div>
</div>
<div class="mt-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
            <h2 class="font-semibold">Recent Activity</h2>
            <a href="{{ route('admin.activity-logs.index') }}" class="text-primary-600 hover:underline text-sm">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr><th class="text-left px-4 py-2 font-medium text-gray-600">Time</th><th class="text-left px-4 py-2 font-medium text-gray-600">User</th><th class="text-left px-4 py-2 font-medium text-gray-600">Action</th><th class="text-left px-4 py-2 font-medium text-gray-600">Description</th></tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recent_activity as $log)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-gray-500 whitespace-nowrap">{{ $log->created_at->format('d M H:i') }}</td>
                        <td class="px-4 py-2">{{ $log->user->name ?? 'System' }}</td>
                        <td class="px-4 py-2"><span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $log->action }}</span></td>
                        <td class="px-4 py-2 text-gray-500 max-w-xs truncate">{{ Str::limit($log->description, 60) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No activity yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
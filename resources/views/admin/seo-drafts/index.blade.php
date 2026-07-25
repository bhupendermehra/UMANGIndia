@extends('admin.layouts.app')
@section('title', 'SEO Drafts')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">SEO Drafts</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm text-gray-500">From SEO Agent</span>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="text-2xl font-bold text-blue-600">{{ $stats['pending'] }}</div>
        <div class="text-sm text-gray-500">Pending Review</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="text-2xl font-bold text-green-600">{{ $stats['approved'] }}</div>
        <div class="text-sm text-gray-500">Approved</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</div>
        <div class="text-sm text-gray-500">Rejected</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="text-2xl font-bold text-gray-600">{{ $stats['imported'] }}</div>
        <div class="text-sm text-gray-500">Imported to Articles</div>
    </div>
</div>
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.seo-drafts.index') }}" class="px-3 py-1.5 text-sm rounded {{ !request('status') ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">All</a>
            <a href="{{ route('admin.seo-drafts.index', ['status' => 'pending_review']) }}" class="px-3 py-1.5 text-sm rounded {{ request('status') == 'pending_review' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Pending</a>
            <a href="{{ route('admin.seo-drafts.index', ['status' => 'approved']) }}" class="px-3 py-1.5 text-sm rounded {{ request('status') == 'approved' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Approved</a>
            <a href="{{ route('admin.seo-drafts.index', ['status' => 'rejected']) }}" class="px-3 py-1.5 text-sm rounded {{ request('status') == 'rejected' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Rejected</a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Title</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Keyword</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Status</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Created</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($drafts as $draft)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.seo-drafts.show', $draft) }}" class="text-primary-600 hover:underline font-medium">
                            {{ Str::limit($draft->title, 60) }}
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $draft->target_keyword ?? '—' }}</span>
                    </td>
                    <td class="px-4 py-3">
                        @if($draft->status == 'pending_review')
                            <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Pending</span>
                        @elseif($draft->status == 'approved')
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Approved</span>
                        @elseif($draft->status == 'rejected')
                            <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">Rejected</span>
                        @elseif($draft->status == 'imported')
                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">Imported</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $draft->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.seo-drafts.show', $draft) }}" class="text-primary-600 hover:underline text-sm">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        <p class="text-lg mb-1">No drafts found</p>
                        <p class="text-sm">SEO agent drafts will appear here once generated.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-t border-gray-100">
        {{ $drafts->links() }}
    </div>
</div>
@endsection
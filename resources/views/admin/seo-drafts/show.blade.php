@extends('admin.layouts.app')
@section('title', 'SEO Draft: ' . Str::limit($draft->title, 40))
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.seo-drafts.index') }}" class="text-primary-600 hover:underline text-sm">&larr; Back to Drafts</a>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h1 class="text-2xl font-bold mb-4">{{ $draft->title }}</h1>
            @if($draft->excerpt)
                <p class="text-gray-500 mb-4 italic">{{ $draft->excerpt }}</p>
            @endif
            <div class="prose max-w-none">
                {!! nl2br(e($draft->content)) !!}
            </div>
        </div>
    </div>
    <div class="space-y-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <h3 class="font-semibold mb-3">Details</h3>
            <dl class="space-y-2 text-sm">
                <dt class="text-gray-500">Status</dt>
                <dd>
                    @if($draft->status == 'pending_review')
                        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Pending Review</span>
                    @elseif($draft->status == 'approved')
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Approved</span>
                    @else
                        <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">{{ ucfirst($draft->status) }}</span>
                    @endif
                </dd>
                @if($draft->target_keyword)
                <dt class="text-gray-500">Target Keyword</dt>
                <dd class="font-medium">{{ $draft->target_keyword }}</dd>
                @endif
                @if($draft->source_url)
                <dt class="text-gray-500">Source</dt>
                <dd><a href="{{ $draft->source_url }}" target="_blank" class="text-primary-600 hover:underline text-xs">{{ $draft->source_url }}</a></dd>
                @endif
                <dt class="text-gray-500">Received</dt>
                <dd>{{ $draft->created_at->format('d M Y H:i') }}</dd>
                @if($draft->reviewer)
                <dt class="text-gray-500">Reviewed by</dt>
                <dd>{{ $draft->reviewer->name }}</dd>
                @endif
            </dl>
        </div>
        @if($draft->status == 'pending_review')
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <h3 class="font-semibold mb-3">Actions</h3>
            <form action="{{ route('admin.seo-drafts.approve', $draft) }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <textarea name="review_notes" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="Review notes (optional)..."></textarea>
                </div>
                <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm font-medium">Approve</button>
            </form>
            <form action="{{ route('admin.seo-drafts.reject', $draft) }}" method="POST" class="mt-2">
                @csrf
                <textarea name="review_notes" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm mb-2" placeholder="Rejection reason..."></textarea>
                <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm font-medium">Reject</button>
            </form>
            <form action="{{ route('admin.seo-drafts.publish', $draft) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="w-full bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 text-sm font-medium">Publish as Article</button>
            </form>
        </div>
        @endif
        @if($draft->review_notes)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <h3 class="font-semibold mb-2">Review Notes</h3>
            <p class="text-sm text-gray-600">{{ $draft->review_notes }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
@extends('admin.layouts.app')

@section('title', 'Edit Article')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="text-primary-600 hover:underline text-sm">← Back to Articles</a>
    </div>

    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Article</h1>

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')

        <div class="grid gap-6 sm:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title (English)*</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title (Hindi)</label>
                <input type="text" name="title_hi" value="{{ old('title_hi', $article->title_hi) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt (English)</label>
                <textarea name="excerpt" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt (Hindi)</label>
                <textarea name="excerpt_hi" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('excerpt_hi', $article->excerpt_hi) }}</textarea>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Content (English)*</label>
            <textarea name="content" rows="15" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 font-mono text-sm">{{ old('content', $article->content) }}</textarea>
            @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Content (Hindi)</label>
            <textarea name="content_hi" rows="10"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 font-mono text-sm">{{ old('content_hi', $article->content_hi) }}</textarea>
        </div>

        <div class="grid gap-6 sm:grid-cols-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ $article->status == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Featured</label>
                <select name="is_featured" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="0" {{ !$article->is_featured ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $article->is_featured ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Published At</label>
                <input type="datetime-local" name="published_at"
                       value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Source URL</label>
                <input type="url" name="source_url" value="{{ old('source_url', $article->source_url) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
        </div>

        <div class="flex justify-end gap-3">
            @csrf
            <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded hover:bg-primary-700 font-medium">Update Article</button>
        </div>
    </form>
</div>
@endsection
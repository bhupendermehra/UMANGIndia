@extends('admin.layouts.app')

@section('title', 'Create Article')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="text-primary-600 hover:underline text-sm">← Back to Articles</a>
    </div>

    <h1 class="text-2xl font-bold text-gray-900 mb-6">Create New Article</h1>

    <form action="{{ route('admin.articles.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf

        <div class="grid gap-6 sm:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title (English)*</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title (Hindi)</label>
                <input type="text" name="title_hi" value="{{ old('title_hi') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt (English)</label>
                <textarea name="excerpt" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('excerpt') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt (Hindi)</label>
                <textarea name="excerpt_hi" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('excerpt_hi') }}</textarea>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Content (English)*</label>
            <textarea name="content" rows="15" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 font-mono text-sm">{{ old('content') }}</textarea>
            @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Content (Hindi)</label>
            <textarea name="content_hi" rows="10"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 font-mono text-sm">{{ old('content_hi') }}</textarea>
        </div>

        <div class="grid gap-6 sm:grid-cols-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="draft" selected>Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Featured</label>
                <select name="is_featured" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Published At</label>
                <input type="datetime-local" name="published_at"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Source URL</label>
                <input type="url" name="source_url" value="{{ old('source_url') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded hover:bg-primary-700 font-medium">Create Article</button>
        </div>
    </form>
</div>
@endsection
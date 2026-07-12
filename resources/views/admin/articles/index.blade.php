@extends('admin.layouts.app')

@section('title', 'Manage Articles')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Articles</h1>
        <a href="{{ route('admin.articles.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded hover:bg-primary-700 text-sm font-medium">New Article</a>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($articles->isEmpty())
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No articles found.</td>
                    </tr>
                @else
                    @foreach ($articles as $article)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                @if ($article->title_hi)
                                    <div class="text-xs text-gray-500">{{ $article->title_hi }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $article->status === 'published' ? 'bg-green-100 text-green-800' : ($article->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $article->is_featured ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $article->published_at?->format('M d, Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-primary-600 hover:text-primary-900">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {!! $articles->links() !!}
    </div>
</div>
@endsection
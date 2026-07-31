@extends('layouts.app')

@section('title', 'Articles & Updates - UmangIndia')
@section('meta_description', 'Stay informed with the latest news, in-depth guides, and updates about Indian government schemes — Sarkari Yojana articles, eligibility, benefits, and application processes.')

@section('content')
<div class="py-6">
    <h1 class="text-3xl font-bold text-gray-900">
        Latest Updates & Articles
    </h1>
    <p class="mt-2 text-gray-600">
        Stay informed with the latest news, updates, and in-depth guides about government schemes.
    </p>

    @if ($articles->isNotEmpty())
        <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $article)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            <a href="{{ route('articles.show', $article) }}" class="hover:underline">
                                {{ $article->title }}
                            </a>
                        </h2>
                        @if ($article->excerpt)
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                        @endif
                        <div class="flex items-center text-sm text-gray-500">
                            <span>{{ $article->published_at?->format('M d, Y') ?? 'Recent' }}</span>
                            @if ($article->is_featured)
                                <span class="ml-2 px-2 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs">Featured</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex justify-center">
            {{ $articles->onEachSide(2)->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500">No articles published yet. Check back soon!</p>
        </div>
    @endif
</div>

<div class="max-w-4xl mx-auto px-4 mb-8">
    <x-newsletter-signup />
</div>
@endsection

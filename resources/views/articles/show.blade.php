@extends('layouts.app')

@section('title', $article->title . ' - UmangIndia')
@section('description', Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->content), 160))

@push('meta')
<meta property="og:description" content="{{ Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->content), 160) }}">
<meta property="og:title" content="{{ $article->title }}">
<meta name="twitter:card" content="summary_large_image">
@endpush

@section('content')
<div class="py-6">
    <nav class="mb-6 text-sm text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-primary-600">Home</a>
        <span class="mx-2">›</span>
        <a href="{{ route('articles.index') }}" class="hover:text-primary-600">Articles</a>
        <span class="mx-2">›</span>
        <span class="text-gray-900">{{ $article->title }}</span>
    </nav>

    <article>
        <h1 class="mb-4 text-3xl font-bold text-gray-900">{{ $article->title }}</h1>

        <div class="mb-6 flex items-center text-sm text-gray-500 space-x-4">
            <span>{{ $article->published_at?->format('F d, Y') ?? 'Recent' }}</span>
            @if ($article->is_featured)
                <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs">Featured</span>
            @endif
        </div>

        @if ($article->excerpt)
            <p class="mb-6 text-lg text-gray-600 italic">{{ $article->excerpt }}</p>
        @endif

        <div class="prose prose-lg max-w-none text-gray-800">
            {!! $article->content !!}
        </div>

        @if ($article->content_hi)
            <hr class="my-8">
            <div lang="hi" class="mt-6">
                <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ $article->title_hi ?? 'हिन्दी में' }}</h2>
                <div class="prose prose-lg max-w-none text-gray-800">
                    {!! $article->content_hi !!}
                </div>
            </div>
        @endif
    </article>

    {{-- Social Share --}}
    <div class="mt-8 pt-6 border-t border-gray-200">
        <h3 class="font-semibold text-gray-700 mb-3">Share this article:</h3>
        <div class="flex space-x-3 flex-wrap gap-2">
            <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . route('articles.show', $article)) }}"
               target="_blank"
               onclick="trackShare('article', {{ $article->id }}, 'whatsapp')"
               class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </a>
            <a href="https://wa.me/?text={{ urlencode('नमस्ते! यह लेख पढ़ें: ' . ($article->title_hi ?? $article->title) . ' - ' . route('articles.show', $article)) }}"
               target="_blank"
               onclick="trackShare('article', {{ $article->id }}, 'whatsapp')"
               class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700 text-sm">
                👨‍👩‍👧‍👦 Hindi me bhejein
            </a>
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(route('articles.show', $article)) }}"
               target="_blank"
               onclick="trackShare('article', {{ $article->id }}, 'twitter')"
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-400 text-white rounded hover:bg-blue-500 text-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                Twitter
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article)) }}"
               target="_blank"
               onclick="trackShare('article', {{ $article->id }}, 'facebook')"
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                Facebook
            </a>
        </div>
    </div>

    <div class="mt-8">
        <x-newsletter-signup />
    </div>

    <div class="mt-4">
        <a href="{{ route('articles.index') }}" class="text-primary-600 hover:underline">← Back to Articles</a>
    </div>
</div>

@push('scripts')
<script>
function trackShare(type, id, platform) {
    try {
        navigator.sendBeacon('/share/track', new URLSearchParams({type, id, platform}));
    } catch(e) {}
}
</script>
@endpush
@endsection
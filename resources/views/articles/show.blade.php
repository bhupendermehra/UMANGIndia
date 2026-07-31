@extends('layouts.app')

@php
    $readingTime = max(1, ceil(str_word_count(strip_tags($article->content)) / 200)) . ' min read';
    $fullUrl = route('articles.show', $article);
    $shareText = urlencode($article->title);
    $shareUrl = urlencode($fullUrl);
    $relatedArticles = \App\Models\Article::published()->where('id', '!=', $article->id)->latest('published_at')->take(3)->get();
    $faqs = $article->faqs ?? null;
@endphp

@section('title', $article->title . ' - UmangIndia')
@section('description', Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->content), 160))

@push('meta')
<meta property="og:description" content="{{ Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->content), 160) }}">
<meta property="og:title" content="{{ $article->title }}">
<meta property="og:url" content="{{ $fullUrl }}">
<meta name="twitter:card" content="summary_large_image">
@endpush

@section('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {"@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}"},
        {"@@type": "ListItem", "position": 2, "name": "Articles", "item": "{{ route('articles.index') }}"},
        {"@@type": "ListItem", "position": 3, "name": "{{ $article->title }}", "item": "{{ $fullUrl }}"}
    ]
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Article",
    "headline": "{{ $article->title }}",
    "description": "{{ strip_tags($article->excerpt ?: $article->content) }}",
    "datePublished": "{{ $article->published_at?->toIso8601String() }}",
    "dateModified": "{{ $article->updated_at->toIso8601String() }}",
    "mainEntityOfPage": { "@@type": "WebPage", "@@id": "{{ $fullUrl }}" },
    "author": { "@@type": "Organization", "name": "UmangIndia" },
    "publisher": { "@@type": "Organization", "name": "UmangIndia", "logo": { "@@type": "ImageObject", "url": "{{ asset('images/icon.png') }}" } }
}
</script>
@if($faqs && count($faqs))
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": {!! json_encode(array_map(function($f) {
        return ["@@type" => "Question", "name" => $f['question'], "acceptedAnswer" => ["@@type" => "Answer", "text" => $f['answer']]];
    }, $faqs)) !!}
}
</script>
@endif
@endsection

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

        <div class="mb-6 flex flex-wrap items-center text-sm text-gray-500 gap-x-4 gap-y-1">
            <span>{{ $article->published_at?->format('F d, Y') ?? 'Recent' }}</span>
            <span>{{ $readingTime }}</span>
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

    @if($faqs && count($faqs))
    <div class="mt-10">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
        <div class="space-y-3">
            @foreach($faqs as $faq)
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button onclick="this.parentElement.classList.toggle('active'); this.nextElementSibling.classList.toggle('hidden')" class="w-full flex items-center justify-between px-5 py-4 text-left bg-gray-50 hover:bg-gray-100 transition-colors">
                    <span class="text-sm font-medium text-gray-900 pr-4">{{ $faq['question'] }}</span>
                    <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </button>
                <div class="hidden px-5 py-4 text-sm text-gray-600 leading-relaxed">
                    {{ $faq['answer'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Social Share --}}
    <div class="mt-8 pt-6 border-t border-gray-200">
        <h3 class="font-semibold text-gray-700 mb-3">Share this article:</h3>
        <div class="flex flex-wrap gap-2">
            <a href="https://wa.me/?text={{ $shareText . ' ' . $shareUrl }}"
               target="_blank" rel="noopener"
               onclick="trackShare('article', {{ $article->id }}, 'whatsapp')"
               class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-sm transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </a>
            <a href="https://wa.me/?text={{ urlencode('नमस्ते! यह लेख पढ़ें: ' . ($article->title_hi ?? $article->title) . ' - ' . route('articles.show', $article)) }}"
               target="_blank" rel="noopener"
               onclick="trackShare('article', {{ $article->id }}, 'whatsapp')"
               class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp (Hindi)
            </a>
            <a href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $shareUrl }}"
               target="_blank" rel="noopener"
               onclick="trackShare('article', {{ $article->id }}, 'twitter')"
               class="inline-flex items-center gap-2 px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 text-sm transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                X (Twitter)
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
               target="_blank" rel="noopener"
               onclick="trackShare('article', {{ $article->id }}, 'facebook')"
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                Facebook
            </a>
        </div>
    </div>

    @if($relatedArticles->isNotEmpty())
    <div class="mt-10 pt-6 border-t border-gray-200">
        <h3 class="font-semibold text-gray-700 mb-4">Related Articles</h3>
        <div class="grid gap-4 sm:grid-cols-3">
            @foreach($relatedArticles as $related)
            <a href="{{ route('articles.show', $related) }}" class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <h4 class="text-sm font-semibold text-gray-900 line-clamp-2 mb-1">{{ $related->title }}</h4>
                <p class="text-xs text-gray-500">{{ $related->published_at?->format('M d, Y') ?? 'Recent' }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

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

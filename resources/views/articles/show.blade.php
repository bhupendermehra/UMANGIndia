@extends('layouts.app')

@php
    $readingTime = max(1, ceil(str_word_count(strip_tags($article->content)) / 200)) . ' min read';
    $fullUrl = route('articles.show', $article);
    $shareText = urlencode($article->title);
    $shareUrl = urlencode($fullUrl);
    $relatedArticles = \App\Models\Article::published()->where('id', '!=', $article->id)->latest('published_at')->take(3)->get();
    $faqs = $article->faqs ?? null;
    $prev = \App\Models\Article::published()->where('published_at', '<', $article->published_at ?? now())->latest('published_at')->first();
    $next = \App\Models\Article::published()->where('published_at', '>', $article->published_at ?? now())->oldest('published_at')->first();
@endphp

@section('title', $article->title . ' - UmangIndia')
@section('description', Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->content), 160))

@push('meta')
<meta property="og:description" content="{{ Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->content), 160) }}">
<meta property="og:title" content="{{ $article->title }}">
<meta property="og:url" content="{{ $fullUrl }}">
<meta name="twitter:card" content="summary_large_image">
@if($article->featured_image)
<meta property="og:image" content="{{ asset($article->featured_image) }}">
@endif
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
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('articles.index') }}" class="hover:text-blue-600 transition">Articles</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-800 font-medium line-clamp-1">{{ $article->title }}</span>
        </nav>

        <article>
            {{-- Hero --}}
            <header class="mb-8">
                <div class="flex items-center gap-2 mb-3 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        Sarkari Yojana Guide
                    </span>
                    @if ($article->is_featured)
                        <span class="px-2.5 py-1 bg-blue-600 text-white rounded-full text-xs font-semibold">Featured</span>
                    @endif
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight leading-tight">{{ $article->title }}</h1>
                <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-slate-500">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $article->published_at?->format('F d, Y') ?? 'Recent' }}
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $readingTime }}
                    </span>
                </div>
            </header>

            @if ($article->excerpt)
                <p class="mb-8 text-lg text-slate-600 italic border-l-4 border-blue-200 pl-4">{{ $article->excerpt }}</p>
            @endif

            {{-- TOC (auto-built from h2s) --}}
            <div id="toc-wrap" class="mb-8 bg-slate-50 border border-slate-200 rounded-2xl p-5 hidden">
                <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wide mb-3">In this article</h2>
                <nav id="toc" class="space-y-1.5 text-sm"></nav>
            </div>

            <div class="article-content prose prose-lg max-w-none text-gray-800">
                {!! $article->content !!}
            </div>

            @if ($article->content_hi)
                <hr class="my-8 border-slate-200">
                <div lang="hi" class="mt-6">
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ $article->title_hi ?? 'हिन्दी में' }}</h2>
                    <div class="article-content prose prose-lg max-w-none text-gray-800">
                        {!! $article->content_hi !!}
                    </div>
                </div>
            @endif
        </article>

        {{-- Author box --}}
        <div class="mt-8 flex items-center gap-4 surface-card p-5 rounded-2xl">
            <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-lg shrink-0">U</div>
            <div>
                <p class="text-sm font-bold text-slate-800">UmangIndia Editorial Team</p>
                <p class="text-xs text-slate-500 mt-0.5">Independent research on government schemes. Updated {{ $article->updated_at?->format('M d, Y') ?? 'recently' }}.</p>
            </div>
        </div>

        @if($faqs && count($faqs))
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
            <div class="space-y-3">
                @foreach($faqs as $faq)
                <div class="border border-slate-200 rounded-xl overflow-hidden bg-white">
                    <button onclick="this.parentElement.classList.toggle('active'); this.nextElementSibling.classList.toggle('hidden'); this.querySelector('svg').classList.toggle('rotate-180')" class="w-full flex items-center justify-between px-5 py-4 text-left bg-white hover:bg-slate-50 transition-colors">
                        <span class="text-sm font-semibold text-slate-800 pr-4">{{ $faq['question'] }}</span>
                        <svg class="w-5 h-5 text-slate-400 shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="hidden px-5 py-4 text-sm text-slate-600 leading-relaxed border-t border-slate-100">
                        {{ $faq['answer'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Social Share --}}
        <div class="mt-8 pt-6 border-t border-slate-200">
            <h3 class="font-semibold text-slate-700 mb-3">Share this article:</h3>
            <div class="flex flex-wrap gap-2">
                <a href="https://wa.me/?text={{ $shareText . ' ' . $shareUrl }}"
                   target="_blank" rel="noopener"
                   onclick="trackShare('article', {{ $article->id }}, 'whatsapp')"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-500 text-white rounded-full hover:bg-green-600 text-sm font-medium transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp
                </a>
                <a href="https://wa.me/?text={{ urlencode('नमस्ते! यह लेख पढ़ें: ' . ($article->title_hi ?? $article->title) . ' - ' . route('articles.show', $article)) }}"
                   target="_blank" rel="noopener"
                   onclick="trackShare('article', {{ $article->id }}, 'whatsapp')"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 text-sm font-medium transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp (Hindi)
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $shareUrl }}"
                   target="_blank" rel="noopener"
                   onclick="trackShare('article', {{ $article->id }}, 'twitter')"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-sky-500 text-white rounded-full hover:bg-sky-600 text-sm font-medium transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    X (Twitter)
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                   target="_blank" rel="noopener"
                   onclick="trackShare('article', {{ $article->id }}, 'facebook')"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-full hover:bg-blue-700 text-sm font-medium transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Facebook
                </a>
            </div>
        </div>

        {{-- Prev / Next --}}
        @if($prev || $next)
        <div class="mt-8 grid gap-4 sm:grid-cols-2">
            @if($prev)
            <a href="{{ route('articles.show', $prev) }}" class="group surface-card card-hover rounded-2xl border border-slate-200 bg-white p-5 flex flex-col">
                <span class="text-xs text-slate-500 mb-1 inline-flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Previous</span>
                <span class="text-sm font-semibold text-slate-800 group-hover:text-blue-600 transition line-clamp-2">{{ $prev->title }}</span>
            </a>
            @else <div></div> @endif
            @if($next)
            <a href="{{ route('articles.show', $next) }}" class="group surface-card card-hover rounded-2xl border border-slate-200 bg-white p-5 flex flex-col text-right">
                <span class="text-xs text-slate-500 mb-1 inline-flex items-center gap-1 justify-end">Next <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                <span class="text-sm font-semibold text-slate-800 group-hover:text-blue-600 transition line-clamp-2">{{ $next->title }}</span>
            </a>
            @endif
        </div>
        @endif

        @if($relatedArticles->isNotEmpty())
        <div class="mt-10 pt-6 border-t border-slate-200">
            <h3 class="font-bold text-slate-800 mb-4 text-lg">Related Articles</h3>
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach($relatedArticles as $related)
                <a href="{{ route('articles.show', $related) }}" class="group surface-card card-hover rounded-2xl border border-slate-200 bg-white p-4 flex flex-col">
                    <h4 class="text-sm font-semibold text-slate-800 group-hover:text-blue-600 transition line-clamp-2 mb-1.5">{{ $related->title }}</h4>
                    <p class="text-xs text-slate-500 line-clamp-2 mb-3 flex-1">{{ Str::limit(strip_tags($related->excerpt ?: $related->content), 100) }}</p>
                    <span class="text-xs text-blue-600 font-medium inline-flex items-center gap-1">{{ $related->published_at?->format('M d, Y') ?? 'Recent' }} <svg class="w-3 h-3 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-8">
            <x-newsletter-signup />
        </div>

        <div class="mt-4">
            <a href="{{ route('articles.index') }}" class="text-blue-600 hover:underline inline-flex items-center gap-1 text-sm font-medium"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Back to Articles</a>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto TOC from article h2s
(function(){
    var content = document.querySelector('.article-content');
    var wrap = document.getElementById('toc-wrap');
    if (!content || !wrap) return;
    var h2s = content.querySelectorAll('h2');
    if (h2s.length < 2) return;
    var toc = document.getElementById('toc');
    h2s.forEach(function(h, i){
        if (!h.id) h.id = 'sec-' + i;
        var a = document.createElement('a');
        a.href = '#' + h.id;
        a.className = 'block text-slate-600 hover:text-blue-600 transition py-0.5';
        a.textContent = h.textContent;
        toc.appendChild(a);
    });
    wrap.classList.remove('hidden');
})();

function trackShare(type, id, platform) {
    try {
        navigator.sendBeacon('/share/track', new URLSearchParams({type, id, platform}));
    } catch(e) {}
}
</script>
@endpush
@endsection

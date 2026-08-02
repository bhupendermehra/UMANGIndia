@props(['popularArticles' => collect()])

<aside class="space-y-6">
    {{-- Popular Articles --}}
    @if($popularArticles->isNotEmpty())
    <div class="surface-card rounded-2xl border border-slate-200 bg-white p-5">
        <span class="font-bold text-slate-800 mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            Popular Articles
        </span>
        <div class="space-y-4">
            @foreach($popularArticles as $pop)
            <a href="{{ route('articles.show', $pop) }}" class="group flex gap-3">
                @if($pop->featured_image)
                <img src="{{ asset($pop->featured_image) }}" alt="{{ $pop->title }}" class="w-16 h-12 rounded-lg object-cover shrink-0" loading="lazy">
                @else
                <div class="w-16 h-12 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                @endif
                <div class="min-w-0">
                    <span class="text-sm font-semibold text-slate-800 group-hover:text-blue-600 transition line-clamp-2 leading-snug">{{ $pop->title }}</span>
                    <p class="text-xs text-slate-500 mt-1">{{ $pop->published_at?->format('M d, Y') ?? 'Recent' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Newsletter --}}
    <div class="surface-card rounded-2xl border border-slate-200 bg-gradient-to-br from-blue-50 to-white p-5">
        <span class="font-bold text-slate-800 mb-1">Stay Updated</span>
        <p class="text-xs text-slate-500 mb-3">Get the latest yojana updates in your inbox.</p>
        <x-newsletter-signup />
    </div>
</aside>

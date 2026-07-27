@extends('layouts.app')

@section('title', $scheme->getMetaTitle())
@section('description', $scheme->getMetaDescription())
@section('keywords', $scheme->meta_keywords)

@section('schema')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $scheme->title,
    'description' => $scheme->short_description,
    'url' => url()->current(),
    'author' => [
        '@type' => 'Organization',
        'name' => 'UmangIndia',
        'url' => url('/'),
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'UmangIndia',
        'url' => url('/'),
    ],
    'mainEntityOfPage' => url()->current(),
    'about' => [
        '@type' => 'Thing',
        'name' => $scheme->category->name,
    ],
];
?>
<script type="application/ld+json">{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
<nav class="text-sm mb-6">
    <ol class="flex items-center gap-2 text-slate-500 flex-wrap">
        <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
        <li>›</li>
        <li><a href="{{ route('categories.show', $scheme->category) }}" class="hover:text-blue-600 transition">{{ $scheme->category->name }}</a></li>
        <li>›</li>
        <li class="text-slate-800 font-medium">{{ $scheme->title }}</li>
    </ol>
</nav>

<div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_320px]">
    <article class="min-w-0">
        <section class="surface-card p-6 md:p-8 mb-6">
            <div class="flex items-center gap-2 mb-3 flex-wrap">
                <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $scheme->category->name }}</span>
                @if($scheme->state)
                <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded-full">{{ $scheme->state->name }}</span>
                @endif
                @if($scheme->status === 'active')
                <span class="bg-green-50 text-green-600 text-xs px-2.5 py-1 rounded-full font-medium">Active</span>
                @elseif($scheme->status === 'upcoming')
                <span class="bg-yellow-50 text-yellow-600 text-xs px-2.5 py-1 rounded-full font-medium">Upcoming</span>
                @else
                <span class="bg-red-50 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">Closed</span>
                @endif
            </div>
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-900">{{ $scheme->title }}</h1>
            <p class="mt-4 text-lg leading-relaxed text-slate-600">{{ $scheme->short_description }}</p>

            <div class="mt-5 flex flex-wrap items-center gap-4 text-sm text-slate-500">
                <span>{{ number_format($scheme->views) }} views</span>
                @if($scheme->application_deadline)
                <span class="text-red-600 font-semibold">Deadline: {{ $scheme->application_deadline->format('d M Y') }}</span>
                @endif
                @if($scheme->official_website)
                <a href="{{ $scheme->official_website }}" target="_blank" rel="noopener" class="text-blue-600 font-medium hover:underline">Official website</a>
                @endif
            </div>
        </section>

        <section class="surface-card p-6 md:p-8 mb-6">
            <div class="border-b border-slate-200 mb-6">
                <nav class="flex overflow-x-auto gap-2 pb-2" id="tabs">
                    <button data-tab="overview" class="tab-btn px-4 py-2 text-sm font-medium rounded-full bg-blue-600 text-white">Overview</button>
                    @if($scheme->eligibility)
                    <button data-tab="eligibility" class="tab-btn px-4 py-2 text-sm font-medium rounded-full bg-slate-100 text-slate-600">Eligibility</button>
                    @endif
                    @if($scheme->benefits)
                    <button data-tab="benefits" class="tab-btn px-4 py-2 text-sm font-medium rounded-full bg-slate-100 text-slate-600">Benefits</button>
                    @endif
                    @if($scheme->application_process)
                    <button data-tab="process" class="tab-btn px-4 py-2 text-sm font-medium rounded-full bg-slate-100 text-slate-600">How to Apply</button>
                    @endif
                    @if($scheme->required_documents)
                    <button data-tab="documents" class="tab-btn px-4 py-2 text-sm font-medium rounded-full bg-slate-100 text-slate-600">Documents</button>
                    @endif
                </nav>
            </div>

            <div id="tab-overview" class="tab-panel content-prose prose max-w-none">
                {!! $scheme->content !!}
            </div>

            @if($scheme->eligibility)
            <div id="tab-eligibility" class="tab-panel hidden content-prose prose max-w-none">
                <h2>Eligibility Criteria</h2>
                <p>{!! nl2br(e(str_replace('\n', "\n", $scheme->eligibility))) !!}</p>
            </div>
            @endif

            @if($scheme->benefits)
            <div id="tab-benefits" class="tab-panel hidden content-prose prose max-w-none">
                <h2>Benefits</h2>
                <p>{!! nl2br(e(str_replace('\n', "\n", $scheme->benefits))) !!}</p>
            </div>
            @endif

            @if($scheme->application_process)
            <div id="tab-process" class="tab-panel hidden content-prose prose max-w-none">
                <h2>How to Apply</h2>
                <p>{!! nl2br(e(str_replace('\n', "\n", $scheme->application_process))) !!}</p>
            </div>
            @endif

            @if($scheme->required_documents)
            <div id="tab-documents" class="tab-panel hidden content-prose prose max-w-none">
                <h2>Required Documents</h2>
                <p>{!! nl2br(e(str_replace('\n', "\n", $scheme->required_documents))) !!}</p>
            </div>
            @endif
        </section>

        @if($scheme->updates->count())
        <section class="surface-card p-6 md:p-8 mb-6">
            <h2 class="text-xl font-bold mb-4 section-title">Recent Updates</h2>
            <div class="space-y-4">
                @foreach($scheme->updates as $update)
                <div class="border-l-4 border-[#F58220] pl-4">
                    <p class="text-xs text-slate-500">{{ $update->created_at->format('d M Y') }}</p>
                    <h3 class="font-semibold text-slate-800">{{ $update->title }}</h3>
                    <p class="text-sm text-slate-600">{{ $update->content }}</p>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
            <h3 class="font-semibold text-slate-900 mb-4">Share this scheme</h3>
            <p class="text-xs text-slate-500 mb-4">Share with family & friends</p>
            <div class="flex flex-wrap gap-3">
                <!-- WhatsApp -->
                <a href="https://wa.me/?text={{ urlencode($scheme->title_hi ?? $scheme->title . ' - ' . url()->current()) }}" target="_blank" 
                   onclick="trackShare('scheme', {{ $scheme->id }}, 'whatsapp')"
                   class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    WhatsApp
                </a>
                <!-- Twitter/X -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($scheme->title) }}" target="_blank"
                   onclick="trackShare('scheme', {{ $scheme->id }}, 'twitter')"
                   class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    X (Twitter)
                </a>
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                   onclick="trackShare('scheme', {{ $scheme->id }}, 'facebook')"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Facebook
                </a>
                <!-- Copy Link -->
                <button onclick="navigator.clipboard.writeText(window.location.href);this.innerHTML='Copied!';var self=this;setTimeout(function(){self.innerHTML='<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z\'/></svg> Copy Link';},2000)"
                        class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-lg text-sm font-medium transition-all border border-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Copy Link
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
            <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Frequently Asked Questions
            </h2>
            
            <!-- FAQ Schema -->
            @php
                $faqItems = [];
                if ($scheme->eligibility) {
                    $faqItems[] = [
                        'question' => 'Who is eligible for ' . $scheme->title . '?',
                        'answer' => strip_tags($scheme->eligibility),
                    ];
                }
                if ($scheme->benefits) {
                    $faqItems[] = [
                        'question' => 'What are the benefits of ' . $scheme->title . '?',
                        'answer' => strip_tags($scheme->benefits),
                    ];
                }
                if ($scheme->application_process) {
                    $faqItems[] = [
                        'question' => 'How to apply for ' . $scheme->title . '?',
                        'answer' => strip_tags($scheme->application_process),
                    ];
                }
            @endphp
            @if(count($faqItems) > 0)
            @php
                $faqSchema = [
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => array_map(function ($faq) {
                        return [
                            '@type' => 'Question',
                            'name' => $faq['question'],
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => $faq['answer'],
                            ],
                        ];
                    }, $faqItems),
                ];
            @endphp
            <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
            @endif
            
            <div class="space-y-3" x-data="{open: null}">
                @if($scheme->eligibility)
                <div class="border border-slate-200 rounded-lg overflow-hidden">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between p-4 text-left hover:bg-slate-50 transition">
                        <span class="font-medium text-slate-900">पात्रता / Eligibility</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="hidden p-4 pt-0 text-slate-600 text-sm leading-relaxed faq-content">
                        {!! nl2br(e(str_replace('\n', "\n", $scheme->eligibility))) !!}
                    </div>
                </div>
                @endif
                
                @if($scheme->benefits)
                <div class="border border-slate-200 rounded-lg overflow-hidden">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between p-4 text-left hover:bg-slate-50 transition">
                        <span class="font-medium text-slate-900">लाभ / Benefits</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="hidden p-4 pt-0 text-slate-600 text-sm leading-relaxed faq-content">
                        {!! nl2br(e(str_replace('\n', "\n", $scheme->benefits))) !!}
                    </div>
                </div>
                @endif
                
                @if($scheme->application_process)
                <div class="border border-slate-200 rounded-lg overflow-hidden">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between p-4 text-left hover:bg-slate-50 transition">
                        <span class="font-medium text-slate-900">आवेदन प्रक्रिया / How to Apply</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="hidden p-4 pt-0 text-slate-600 text-sm leading-relaxed faq-content">
                        {!! nl2br(e(str_replace('\n', "\n", $scheme->application_process))) !!}
                    </div>
                </div>
                @endif
                
                @if($scheme->required_documents)
                <div class="border border-slate-200 rounded-lg overflow-hidden">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between p-4 text-left hover:bg-slate-50 transition">
                        <span class="font-medium text-slate-900">आवश्यक दस्तावेज / Required Documents</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="hidden p-4 pt-0 text-slate-600 text-sm leading-relaxed faq-content">
                        {!! nl2br(e(str_replace('\n', "\n", $scheme->required_documents))) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        @push('scripts')
        <script>
        function toggleFaq(btn) {
            const content = btn.nextElementSibling;
            const icon = btn.querySelector('.faq-icon');
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
        </script>
        @endpush

        <section class="surface-card p-6 md:p-8">
            <h3 class="font-semibold mb-3 text-slate-800">📬 Get Updates</h3>
            <x-newsletter-signup />
        </section>
    </article>

    <aside class="space-y-6 lg:sticky lg:top-24 self-start">
        @if(\App\Models\Setting::get('adsense_enabled') && \App\Models\Setting::get('adsense_sidebar_slot'))
        <div class="surface-card p-4 text-center">
            <ins class="adsbygoogle" style="display:block" data-ad-client="{{ \App\Models\Setting::get('adsense_publisher_id') }}" data-ad-slot="{{ \App\Models\Setting::get('adsense_sidebar_slot') }}" data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<script>
// Share tracking
function trackShare(type, id, platform) {
    try {
        navigator.sendBeacon('/share/track', new URLSearchParams({type, id, platform}));
    } catch(e) {}
}
</script>
        </div>
        @endif

        <section class="surface-card p-5">
            <h3 class="font-bold mb-3 section-title">Quick Info</h3>
            <dl class="space-y-3 text-sm">
                <div class="flex justify-between gap-4"><dt class="text-slate-500">Category</dt><dd class="font-medium text-slate-800 text-right">{{ $scheme->category->name }}</dd></div>
                @if($scheme->state)
                <div class="flex justify-between gap-4"><dt class="text-slate-500">State</dt><dd class="font-medium text-slate-800 text-right">{{ $scheme->state->name }}</dd></div>
                @endif
                <div class="flex justify-between gap-4"><dt class="text-slate-500">Status</dt><dd class="font-medium capitalize text-slate-800 text-right">{{ $scheme->status }}</dd></div>
                @if($scheme->application_deadline)
                <div class="flex justify-between gap-4"><dt class="text-slate-500">Deadline</dt><dd class="font-medium text-red-600 text-right">{{ $scheme->application_deadline->format('d M Y') }}</dd></div>
                @endif
                @if($scheme->official_website)
                <div>
                    <dt class="text-slate-500">Official Website</dt>
                    <dd class="mt-1"><a href="{{ $scheme->official_website }}" target="_blank" class="text-blue-600 hover:underline" rel="noopener">Visit Website →</a></dd>
                </div>
                @endif
            </dl>
        </section>

        @if($relatedSchemes->count())
        <section class="surface-card p-5">
            <h3 class="font-bold mb-3 section-title">Related Schemes</h3>
            <div class="space-y-3">
                @foreach($relatedSchemes as $related)
                <a href="{{ route('schemes.show', $related) }}" class="block p-3 rounded-xl hover:bg-[#eef4fb] border border-slate-200 hover:border-blue-600 transition focus-ring">
                    <h4 class="text-sm font-semibold text-slate-800 hover:text-blue-600">{{ $related->title }}</h4>
                    <p class="text-xs muted mt-1 line-clamp-2">{{ $related->short_description }}</p>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </aside>
</div>

@push('scripts')
<script>
document.querySelectorAll('.tab-btn').forEach((button) => {
    button.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach((el) => {
            el.classList.remove('bg-blue-600', 'text-white');
            el.classList.add('bg-slate-100', 'text-slate-600');
        });
        document.querySelectorAll('.tab-panel').forEach((el) => el.classList.add('hidden'));
        const target = document.getElementById('tab-' + button.dataset.tab);
        if (target) target.classList.remove('hidden');
        button.classList.add('bg-blue-600', 'text-white');
        button.classList.remove('bg-slate-100', 'text-slate-600');
    });
});
</script>
@endpush
@endsection

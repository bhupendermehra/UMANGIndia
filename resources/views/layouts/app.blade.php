@php
    $isActive = function($patterns) {
        foreach ((array) $patterns as $p) {
            if (request()->routeIs($p)) return true;
        }
        return false;
    };
    $announcement = \App\Models\Setting::get('announcement_text');
    $manifestExists = file_exists(public_path('build/manifest.json'));
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'hi' ? 'hi' : 'en' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UmangIndia - सरकारी योजनाएं | Government Schemes Portal')</title>
    <meta name="description" content="@yield('description', '259+ सरकारी योजनाओं की जानकारी। पात्रता, लाभ और आवेदन प्रक्रिया की जानकारी। PM किसान, आयुष्मान भारत, मगनेगा और अधिक।')">
    <meta name="keywords" content="@yield('keywords', 'सरकारी योजना, government schemes, pm kisan, ayushman bharat, mgnrega, sarkari yojana')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">

    <meta property="og:title" content="@yield('title', 'UmangIndia - सरकारी योजनाएं | Government Schemes Portal')">
    <meta property="og:description" content="@yield('description', '259+ सरकारी योजनाओं की जानकारी। पात्रता, लाभ और आवेदन प्रक्रिया की जानकारी।')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'UmangIndia - सरकारी योजनाएं | Government Schemes Portal')">
    <meta name="twitter:description" content="@yield('description', '259+ सरकारी योजनाओं की जानकारी। PM किसान, आयुष्मान भारत, मगनेगा।')">
    <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">

    @if(app()->getLocale() === 'hi')
    <link rel="alternate" hreflang="en" href="{{ url('/') }}">
    <link rel="alternate" hreflang="hi" href="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    @else
    <link rel="canonical" href="{{ url()->current() }}">
    @endif
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">

    @if($gsc = \App\Models\Setting::get('google_search_console'))
    <meta name="google-site-verification" content="{{ $gsc }}">
    @endif
    @if($ga4 = \App\Models\Setting::get('google_analytics_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga4 }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $ga4 }}');</script>
    @endif

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "UmangIndia",
        "url": "https://umangindia.com",
        "logo": "https://umangindia.com/images/icon.png",
        "description": "259+ सरकारी योजनाओं की जानकारी। पात्रता, लाभ और आवेदन प्रक्रिया की जानकारी। PM किसान, आयुष्मान भारत, मगनेगा।",
        "contactPoint": {
            "@@type": "ContactPoint",
            "contactType": "customer support",
            "url": "https://umangindia.com/contact"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "WebSite",
        "name": "UmangIndia",
        "url": "https://umangindia.com",
        "potentialAction": {
            "@@type": "SearchAction",
            "target": "https://umangindia.com/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>

    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    @stack('meta')

    @if(\App\Models\Setting::get('adsense_enabled') && \App\Models\Setting::get('adsense_publisher_id'))
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ \App\Models\Setting::get('adsense_publisher_id') }}" crossorigin="anonymous"></script>
    @endif

    @if($manifestExists)
        @vite('resources/css/app.css')
    @else
    <link rel="stylesheet" href="/css/tailwind.min.css">
    @endif

    <style>
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 16px 32px -12px rgba(11,78,162,0.15); }
        .page-enter { animation: fadeInUp 0.3s ease-out; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .skeleton { background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; }
        @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }
        .footer-gradient { background: linear-gradient(180deg, #0f172a 0%, #1e293b 50%, #0f172a 100%); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .nav-dropdown { display: none; position: absolute; }
        .nav-group:hover > .nav-dropdown, .nav-group:focus-within > .nav-dropdown { display: block !important; }
        #mobile-menu { max-height: 0; opacity: 0; overflow: hidden; transition: max-height 0.35s ease, opacity 0.25s ease, padding 0.25s ease; }
        #mobile-menu.open { max-height: 800px; opacity: 1; }
        #mobile-menu-btn.active .hamburger-top { transform: rotate(45deg) translate(5px,5px); }
        #mobile-menu-btn.active .hamburger-middle { opacity: 0; }
        #mobile-menu-btn.active .hamburger-bottom { transform: rotate(-45deg) translate(5px,-5px); }
        .hamburger-line { transition: all 0.3s ease; }
        #mobile-categories.collapsed { display: none; }
        .article-content h2 { font-size: 1.75rem; font-weight: 600; margin-top: 2rem; margin-bottom: 1rem; padding-left: 1rem; border-left: 4px solid #2563eb; color: #1e293b; }
        .article-content h3 { font-size: 1.25rem; font-weight: 500; margin-top: 1.5rem; margin-bottom: 0.75rem; color: #334155; }
        .article-content p { font-size: 1.05rem; line-height: 1.8; margin-bottom: 1.25rem; color: #334155; max-width: 720px; }
        .article-content ul, .article-content ol { font-size: 1.05rem; line-height: 1.8; margin-bottom: 1.25rem; padding-left: 1.5rem; color: #334155; max-width: 720px; }
        .article-content li { margin-bottom: 0.5rem; }
        .article-content a { color: #2563eb; text-decoration: underline; text-underline-offset: 2px; }
        .article-content a:hover { color: #1d4ed8; }
        .article-content img { border-radius: 0.75rem; margin: 1.5rem 0; max-width: 100%; height: auto; }
        .article-content blockquote { border-left: 4px solid #2563eb; padding-left: 1.25rem; margin: 1.5rem 0; color: #64748b; font-style: italic; }
        .article-content table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; overflow-x: auto; display: block; }
        .article-content table th { background: #eff6ff; font-weight: 600; padding: 0.75rem 1rem; border: 1px solid #e2e8f0; text-align: left; }
        .article-content table td { padding: 0.75rem 1rem; border: 1px solid #e2e8f0; }
        .article-content table tr:nth-child(even) { background: #f8fafc; }
        .article-content pre { background: #1e293b; color: #e2e8f0; padding: 1.25rem; border-radius: 0.75rem; overflow-x: auto; margin: 1.5rem 0; font-size: 0.9rem; }
        .article-content code { font-size: 0.875rem; background: #f1f5f9; padding: 0.2rem 0.4rem; border-radius: 0.25rem; }
        .article-content pre code { background: none; padding: 0; }
        .toc-link { transition: all 0.2s ease; border-left: 2px solid transparent; }
        .toc-link:hover { border-left-color: #2563eb; color: #2563eb; }
        .toc-link.active { border-left-color: #2563eb; color: #2563eb; font-weight: 500; }
        .faq-accordion-content { max-height: 0; overflow: hidden; transition: max-height 0.3s ease, opacity 0.25s ease; opacity: 0; }
        .faq-accordion-content.open { max-height: 300px; opacity: 1; }
        .faq-accordion-icon { transition: transform 0.3s ease; }
        .faq-accordion-icon.rotated { transform: rotate(45deg); }
        @keyframes gradientShift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        .hero-animate { background-size: 200% 200%; animation: gradientShift 8s ease infinite; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>

    @yield('schema')
    @stack('schema')
    @stack('styles')
</head>
<body class="app-shell min-h-screen flex flex-col text-slate-800 antialiased" style="font-family: 'Inter', 'Noto Sans Devanagari', sans-serif;">

    @if($announcement)
    <div id="announcement-bar" class="bg-[#083b7a] text-blue-50 py-2.5 px-4 relative text-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-center gap-3">
            <svg class="w-4 h-4 shrink-0 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            <span>{{ $announcement }}</span>
            <button onclick="document.getElementById('announcement-bar').remove()" class="hover:bg-white/10 rounded p-2 ml-2 text-blue-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
    @endif

    <div class="tricolor-top"></div>

    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200/60">
        <div class="hidden xl:flex items-center justify-end gap-4 px-6 py-1 text-xs text-slate-500 border-b border-slate-100 max-w-7xl mx-auto">
            <a href="{{ route('pages.about') }}" class="hover:text-blue-600 transition">About</a>
            <span class="text-slate-300">|</span>
            <a href="{{ route('pages.contact') }}" class="hover:text-blue-600 transition">Contact</a>
            <span class="text-slate-300">|</span>
            <a href="{{ route('pages.privacy') }}" class="hover:text-blue-600 transition">Privacy</a>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6"><!-- overflow handled on nav inner -->
            <div class="flex items-center justify-between h-16 md:h-20 gap-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="UmangIndia Logo" class="h-9 md:h-10 w-auto" width="120" height="40">
                    <div class="hidden sm:block">
                        <span class="text-lg font-extrabold text-blue-600 tracking-tight">UMANG</span><span class="text-lg font-extrabold text-amber-500 tracking-tight">India</span>
                        <p class="text-[10px] text-slate-400 -mt-0.5 tracking-wider uppercase font-medium">Independent Information Portal</p>
                    </div>
                </a>

                <div class="hidden md:flex items-center flex-1 min-w-0 relative self-stretch overflow-visible">
                    <nav class="flex items-center gap-1 flex-1 min-w-max py-1 overflow-visible">
                        <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium whitespace-nowrap rounded-lg transition-colors {{ $isActive('home') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">Home</a>

                        <div class="relative nav-group">
                            <button class="px-3 py-2 text-sm font-medium whitespace-nowrap rounded-lg transition-colors flex items-center gap-1 {{ $isActive(['schemes.*', 'categories.*', 'states.*']) ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                Yojana
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="nav-dropdown left-0 mt-1 w-52 bg-white rounded-xl shadow-lg border border-slate-200 py-2 z-[60]">
                                <a href="{{ route('schemes.index') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">All Yojana</a>
                                <a href="{{ route('schemes.latest') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">Latest Updates</a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <p class="px-4 py-1.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Categories</p>
                                @foreach(\App\Models\Category::orderBy('sort_order')->get() as $cat)
                                <a href="{{ route('categories.show', $cat) }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <span class="w-4 h-4 rounded bg-blue-50 flex items-center justify-center shrink-0">{!! \App\Helpers\IconHelper::categorySvg($cat->slug, 'w-2.5 h-2.5 text-blue-600') !!}</span>
                                    {{ $cat->name }}
                                </a>
                                @endforeach
                                <div class="border-t border-slate-100 my-1"></div>
                                <p class="px-4 py-1.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">States</p>
                                <div class="max-h-48 overflow-y-auto">
                                @foreach(\App\Models\State::orderBy('is_central', 'desc')->orderBy('name')->get() as $st)
                                <a href="{{ route('states.show', $st) }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">{{ $st->name }}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('articles.index') }}" class="px-3 py-2 text-sm font-medium whitespace-nowrap rounded-lg transition-colors {{ $isActive('articles.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">Articles</a>

                        <div class="relative nav-group">
                            <button class="px-3 py-2 text-sm font-medium whitespace-nowrap rounded-lg transition-colors flex items-center gap-1 {{ $isActive(['calendar.*', 'pdfs.*', 'eligibility.*']) ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                More
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="nav-dropdown right-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-slate-200 py-2 z-[60]">
                                <a href="{{ route('calendar.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Calendar
                                </a>
                                <a href="{{ route('pdfs.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Downloads
                                </a>
                                <a href="{{ route('eligibility.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    Eligibility
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="flex items-center gap-2">
                    <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden text-sm shrink-0">
                        <a href="{{ route('language.switch', 'en') }}" class="px-2.5 py-1.5 font-medium transition-colors {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600' }}" title="English">EN</a>
                        <a href="{{ route('language.switch', 'hi') }}" class="px-2.5 py-1.5 font-medium transition-colors {{ app()->getLocale() === 'hi' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600' }}" title="हिंदी">हिंदी</a>
                    </div>
                    <form action="{{ route('search') }}" method="GET" class="hidden sm:block">
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search schemes..." class="w-36 lg:w-48 pl-9 pr-3 py-2 text-sm border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 bg-slate-50 placeholder-slate-400 transition-all">
                            <svg class="absolute left-3 top-2.5 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </form>
                    <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-blue-50 transition-colors" aria-label="Toggle menu">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path class="hamburger-line hamburger-top" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16"/>
                            <path class="hamburger-line hamburger-middle" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16"/>
                            <path class="hamburger-line hamburger-bottom" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden border-t border-slate-200/60 bg-white/95 backdrop-blur-xl">
            <div class="px-4 py-4 space-y-1">
                <form action="{{ route('search') }}" method="GET" class="mb-4">
                    <div class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search schemes..." class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 placeholder-slate-400">
                        <svg class="absolute left-3 top-3 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
                <a href="{{ route('home') }}" class="block px-3 py-2.5 text-sm font-medium rounded-lg {{ $isActive('home') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }} transition-colors">Home</a>
                <a href="{{ route('schemes.index') }}" class="block px-3 py-2.5 text-sm font-medium rounded-lg {{ $isActive('schemes.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }} transition-colors">All Yojana</a>
                <a href="{{ route('schemes.latest') }}" class="block px-3 py-2.5 text-sm font-medium rounded-lg {{ $isActive('schemes.latest') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }} transition-colors">Latest Updates</a>
                <a href="{{ route('articles.index') }}" class="block px-3 py-2.5 text-sm font-medium rounded-lg {{ $isActive('articles.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }} transition-colors">Articles</a>
                <a href="{{ route('calendar.index') }}" class="block px-3 py-2.5 text-sm font-medium rounded-lg {{ $isActive('calendar.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }} transition-colors">Calendar</a>
                <a href="{{ route('pdfs.index') }}" class="block px-3 py-2.5 text-sm font-medium rounded-lg {{ $isActive('pdfs.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }} transition-colors">
                    <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Downloads
                </a>
                <a href="{{ route('eligibility.index') }}" class="block px-3 py-2.5 text-sm font-medium rounded-lg {{ $isActive('eligibility.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }} transition-colors">Check Eligibility</a>

                <div class="border-t border-slate-100 pt-3 mt-3">
                    <button onclick="toggleMobileCategories(this)" class="w-full flex items-center justify-between px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">
                        <span>Categories & States</span>
                        <svg class="w-4 h-4 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="mobile-categories" class="space-y-0.5">
                    @foreach(\App\Models\Category::orderBy('sort_order')->get() as $cat)
                    <a href="{{ route('categories.show', $cat) }}" class="flex items-center gap-2.5 px-3 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="w-5 h-5 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">{!! \App\Helpers\IconHelper::categorySvg($cat->slug, 'w-3 h-3 text-blue-600') !!}</span>
                        {{ $cat->name }}
                    </a>
                    @endforeach
                    </div>
                </div>
                <div class="border-t border-slate-100 pt-3 mt-1">
                    <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Links</p>
                    <a href="{{ route('pages.about') }}" class="block px-3 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">About</a>
                    <a href="{{ route('pages.contact') }}" class="block px-3 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Contact</a>
                    <a href="{{ route('pages.privacy') }}" class="block px-3 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Privacy</a>
                    <a href="{{ route('pages.disclaimer') }}" class="block px-3 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Disclaimer</a>
                    <a href="{{ route('pages.terms') }}" class="block px-3 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Terms</a>
                </div>
            </div>
        </div>
    </header>

    @if(\App\Models\Setting::get('adsense_enabled') && \App\Models\Setting::get('adsense_header_slot'))
    <div class="max-w-7xl mx-auto px-4 my-4 text-center">
        <ins class="adsbygoogle" style="display:block" data-ad-client="{{ \App\Models\Setting::get('adsense_publisher_id') }}" data-ad-slot="{{ \App\Models\Setting::get('adsense_header_slot') }}" data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>
    @endif

    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </div>
    </main>

    <!-- Newsletter CTA Section (only on non-article pages since articles have their own) -->
    @if(!$isActive('articles.show'))
    <section class="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3">Stay Updated with Government Schemes</h2>
            <p class="text-blue-200 mb-6 text-sm sm:text-base">Get weekly updates on new schemes, eligibility criteria, and application deadlines in your inbox.</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                @csrf
                <input type="email" name="email" required placeholder="Enter your email address" class="flex-1 px-4 py-3 rounded-xl text-sm border-0 focus:outline-none focus:ring-2 focus:ring-white/50 placeholder-slate-400">
                <button type="submit" class="px-6 py-3 bg-white text-blue-700 hover:bg-blue-50 font-semibold rounded-xl transition-colors text-sm whitespace-nowrap shadow-sm">Subscribe</button>
            </form>
            <p class="text-blue-300/60 text-xs mt-3">No spam. Unsubscribe anytime.</p>
        </div>
    </section>
    @endif

    <footer class="footer-gradient text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <img src="{{ asset('images/icon.png') }}" alt="UmangIndia" loading="lazy" class="h-10 w-10 rounded-xl">
                        <div>
                            <span class="text-white font-extrabold text-lg tracking-tight">UMANG</span><span class="text-amber-400 font-extrabold text-lg tracking-tight">India</span>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-400">Your trusted portal for complete information about Indian government schemes (Sarkari Yojana). Check eligibility, benefits and application process.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 text-xs uppercase tracking-widest">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('schemes.index') }}" class="hover:text-white transition-colors">All Schemes</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-white transition-colors">Articles</a></li>
                        <li><a href="{{ route('schemes.latest') }}" class="hover:text-white transition-colors">Latest Updates</a></li>
                        <li><a href="{{ route('pdfs.index') }}" class="hover:text-white transition-colors">Downloads</a></li>
                        <li><a href="{{ route('search') }}" class="hover:text-white transition-colors">Search</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 text-xs uppercase tracking-widest">Categories</h4>
                    <ul class="space-y-2.5 text-sm">
                        @foreach(\App\Models\Category::orderBy('sort_order')->take(6)->get() as $cat)
                        <li><a href="{{ route('categories.show', $cat) }}" class="hover:text-white transition-colors">{{ $cat->icon }} {{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 text-xs uppercase tracking-widest">Legal</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('pages.about') }}" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="{{ route('pages.contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                        <li><a href="{{ route('pages.privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ route('pages.disclaimer') }}" class="hover:text-white transition-colors">Disclaimer</a></li>
                        <li><a href="{{ route('pages.terms') }}" class="hover:text-white transition-colors">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>

            @if(\App\Models\Setting::get('adsense_enabled') && \App\Models\Setting::get('adsense_footer_slot'))
            <div class="my-6 text-center">
                <ins class="adsbygoogle" style="display:block" data-ad-client="{{ \App\Models\Setting::get('adsense_publisher_id') }}" data-ad-slot="{{ \App\Models\Setting::get('adsense_footer_slot') }}" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>
            @endif

            <div class="border-t border-gray-700/50 mt-8 pt-6 text-center text-sm">
                <p class="text-white/90">&copy; {{ date('Y') }} UmangIndia.com. All rights reserved.</p>
                <div class="mt-4 p-4 rounded-xl bg-white/5 border border-white/10 max-w-3xl mx-auto">
                    <p class="text-gray-300 text-xs leading-relaxed"><strong class="text-white">Disclaimer:</strong> UmangIndia is an independent, privately-run information portal. It is NOT affiliated with, endorsed by, or connected to the Government of India, UMANG (umang.gov.in), or any state government. For official information, please visit <a href="https://www.india.gov.in" class="text-amber-400 hover:underline" target="_blank" rel="noopener noreferrer">india.gov.in</a> or the respective government department.</p>
                </div>
                <div class="mt-4 h-1 rounded-full overflow-hidden max-w-xs mx-auto" style="background: linear-gradient(90deg, #0b4ea2 0%, #0b4ea2 50%, #f58220 50%, #f58220 100%);"></div>
            </div>
        </div>
    </footer>

    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 invisible z-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
    </button>

    @if($manifestExists)
        @vite('resources/js/app.js')
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('mobile-menu-btn');
        var menu = document.getElementById('mobile-menu');
        if (btn && menu) {
            btn.addEventListener('click', function() {
                menu.classList.toggle('open');
                btn.classList.toggle('active');
            });
        }
        window.addEventListener('scroll', function() {
            var t = document.getElementById('back-to-top');
            if (t) {
                if (window.scrollY > 500) { t.classList.remove('opacity-0','invisible'); t.classList.add('opacity-100','visible'); }
                else { t.classList.add('opacity-0','invisible'); t.classList.remove('opacity-100','visible'); }
            }
        });
    });
    function toggleMobileCategories(btn) {
        var el = document.getElementById('mobile-categories');
        var icon = btn.querySelector('svg');
        if (el) {
            el.classList.toggle('collapsed');
            if (icon) icon.style.transform = el.classList.contains('collapsed') ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    }
    </script>

    @stack('scripts')
</body>
</html>

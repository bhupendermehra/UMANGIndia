<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'hi' ? 'hi' : 'en' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UmangIndia - सरकारी योजनाएं | Government Schemes Portal')</title>
    <meta name="description" content="@yield('description', '259+ सरकारी योजनाओं की जानकारी। पात्रता, लाभ और आवेदन प्रक्रिया की जानकारी। PM किसान, आयुष्मान भारत, मगनेगा और अधिक।')">
    <meta name="keywords" content="@yield('keywords', 'सरकारी योजना, government schemes, pm kisan, ayushman bharat, mgnrega, sarkari yojana')">
    <link rel="canonical" href="https://umangindia.com{{ request()->is('language/*') ? '' : url()->current() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'UmangIndia - सरकारी योजनाएं | Government Schemes Portal')">
    <meta property="og:description" content="@yield('description', '259+ सरकारी योजनाओं की जानकारी। पात्रता, लाभ और आवेदन प्रक्रिया की जानकारी।')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'UmangIndia - सरकारी योजनाएं | Government Schemes Portal')">
    <meta name="twitter:description" content="@yield('description', '259+ सरकारी योजनाओं की जानकारी। PM किसान, आयुष्मान भारत, मगनेगा।')">
    <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">

    <!-- Hreflang Tags for Bilingual SEO -->
    @if(app()->getLocale() === 'hi')
    <link rel="alternate" hreflang="en" href="{{ url('/') }}">
    <link rel="alternate" hreflang="hi" href="{{ url()->current() }}">
    @else
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="hi" href="{{ url('/language/hi') }}">
    @endif
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

    @if($gsc = \App\Models\Setting::get('google_search_console'))
    <meta name="google-site-verification" content="{{ $gsc }}">
    @endif
    @if($ga4 = \App\Models\Setting::get('google_analytics_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga4 }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $ga4 }}');</script>
    @endif

    <!-- Organization Schema -->
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

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    @stack('meta')

    <!-- Google AdSense -->
    @if(\App\Models\Setting::get('adsense_enabled') && \App\Models\Setting::get('adsense_publisher_id'))
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ \App\Models\Setting::get('adsense_publisher_id') }}" crossorigin="anonymous"></script>
    @endif

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eef4fb',
                            100: '#d4e4f5',
                            200: '#a9c9eb',
                            300: '#7daede',
                            400: '#5293d1',
                            500: '#2D6CC4',
                            600: '#0B4EA2',
                            700: '#083B7A',
                            800: '#062A57',
                            900: '#041A35',
                        },
                        saffron: {
                            50: '#FFF8F0',
                            100: '#FFEDD5',
                            200: '#FFD9AA',
                            300: '#FFC47A',
                            400: '#FFA640',
                            500: '#F58220',
                            600: '#D96A0B',
                            700: '#B35509',
                            800: '#8C4207',
                            900: '#663005',
                        },
                        green: {
                            50: '#ECFDF0',
                            100: '#D1FAE5',
                            200: '#A7F3D0',
                            300: '#6EE7B7',
                            400: '#34D399',
                            500: '#33B249',
                            600: '#138A1A',
                            700: '#0F6D15',
                            800: '#0B5311',
                            900: '#083A0C',
                        },
                    }
                }
            }
        }
    </script>

    <style>
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 12px 24px -8px rgba(0,0,0,0.15); }
        .page-enter { animation: fadeInUp 0.3s ease-out; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .skeleton { background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; }
        @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }
        .tab-content { animation: fadeIn 0.2s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        #mobile-menu { transition: max-height 0.3s ease, opacity 0.2s ease; overflow: hidden; }
        .footer-gradient { background: linear-gradient(180deg, #0f172a 0%, #1e293b 50%, #0f172a 100%); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <!-- Schema.org -->
    @yield('schema')
    @stack('schema')

    @stack('styles')
</head>
<body class="app-shell text-slate-800 antialiased" style="font-family: 'Inter', 'Noto Sans Devanagari', sans-serif;">
    @php $announcement = \App\Models\Setting::get('announcement_text'); @endphp
    @if($announcement)
    <!-- Announcement Bar -->
    <div id="announcement-bar" class="bg-gradient-to-r from-amber-500 to-orange-500 text-white py-2.5 px-4 relative text-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-center gap-3">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            <span>{{ $announcement }}</span>
            <button onclick="document.getElementById('announcement-bar').remove()" class="hover:bg-white/20 rounded p-2 ml-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
    @endif

    <!-- Tricolor Top Bar -->
    <div class="tricolor-top"></div>

    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16 gap-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="UmangIndia Logo" class="h-10 w-auto" width="120" height="40">
                    <div class="hidden sm:block">
                <span class="text-lg font-bold text-blue-600">UMANG</span><span class="text-lg font-bold text-amber-500">India</span>
                    <p class="text-xs text-slate-500 -mt-1 tracking-wide">Independent Information Portal</p>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center space-x-1 overflow-x-auto flex-nowrap scrollbar-hide">
                    <a href="{{ route('home') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">Home</a>
                    <a href="{{ route('schemes.index') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">All Yojana</a>
                    <div class="relative group">
                        <button class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 flex items-center transition">
                            Categories
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="absolute left-0 mt-1 w-52 bg-white rounded-xl shadow-xl border py-2 hidden group-hover:block z-50">
                            @foreach(\App\Models\Category::orderBy('sort_order')->get() as $cat)
                            <a href="{{ route('categories.show', $cat) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-blue-50 hover:text-blue-600 transition">
                                <span class="w-5 h-5 rounded bg-blue-50 flex items-center justify-center">{!! \App\Helpers\IconHelper::categorySvg($cat->slug, 'w-3 h-3 text-blue-600') !!}</span>
                                {{ $cat->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="relative group">
                        <button class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 flex items-center transition">
                            States
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="absolute left-0 mt-1 w-56 bg-white rounded-xl shadow-xl border py-2 hidden group-hover:block z-50 max-h-72 overflow-y-auto">
                            @foreach(\App\Models\State::orderBy('is_central', 'desc')->orderBy('name')->get() as $st)
                            <a href="{{ route('states.show', $st) }}" class="block px-4 py-2.5 text-sm hover:bg-blue-50 hover:text-blue-600 transition">{{ $st->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('schemes.latest') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">Latest</a>
                    <a href="{{ route('calendar.index') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">Calendar</a>
                    <a href="{{ route('pdfs.index') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">
                        <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Downloads
                    </a>
                    <a href="{{ route('eligibility.index') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Check Eligibility
                    </a>
                    <!-- Trust Links for AdSense -->
                    <a href="{{ route('pages.about') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">About</a>
                    <a href="{{ route('pages.contact') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">Contact</a>
                    <a href="{{ route('pages.privacy') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">Privacy</a>
                </nav>

                <!-- Search + Language + Mobile Menu -->
                <div class="flex items-center space-x-2">
                    <!-- Language Switcher -->
                    <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden text-sm flex-shrink-0">
                        <a href="{{ route('language.switch', 'en') }}" class="px-3 py-2 font-medium transition {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-blue-50' }}" title="English">EN</a>
                        <a href="{{ route('language.switch', 'hi') }}" class="px-3 py-2 font-medium transition {{ app()->getLocale() === 'hi' ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-blue-50' }}" title="हिंदी">हिंदी</a>
                    </div>
                    <form action="{{ route('search') }}" method="GET" class="hidden sm:block flex-shrink-0">
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search schemes..." class="w-36 lg:w-48 pl-9 pr-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus-ring">
                            <svg class="absolute left-3 top-2.5 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </form>
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-blue-50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white">
            <div class="px-4 py-3">
                <form action="{{ route('search') }}" method="GET" class="mb-3">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search schemes..." class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 focus-ring">
                </form>
                <a href="{{ route('home') }}" class="block py-2.5 text-sm font-medium hover:text-blue-600">Home</a>
                <a href="{{ route('schemes.index') }}" class="block py-2.5 text-sm font-medium hover:text-blue-600">All Yojana</a>
                <a href="{{ route('schemes.latest') }}" class="block py-2.5 text-sm font-medium hover:text-blue-600">Latest</a>
                <a href="{{ route('calendar.index') }}" class="block py-2.5 text-sm font-medium hover:text-blue-600">Calendar</a>
                <a href="{{ route('pdfs.index') }}" class="block py-2.5 text-sm font-medium hover:text-blue-600">
                    <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Downloads
                </a>
                <a href="{{ route('eligibility.index') }}" class="block py-2.5 text-sm font-medium hover:text-blue-600">Check Eligibility</a>
                <!-- Trust Links for AdSense -->
                <a href="{{ route('pages.about') }}" class="block py-2.5 text-sm font-medium hover:text-blue-600">About</a>
                <a href="{{ route('pages.contact') }}" class="block py-2.5 text-sm font-medium hover:text-blue-600">Contact</a>
                <a href="{{ route('pages.privacy') }}" class="block py-2.5 text-sm font-medium hover:text-blue-600">Privacy</a>
                <div class="border-t border-slate-200 mt-2 pt-2">
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1 tracking-wider">Categories</p>
                    @foreach(\App\Models\Category::orderBy('sort_order')->get() as $cat)
                    <a href="{{ route('categories.show', $cat) }}" class="flex items-center gap-2 py-2.5 text-sm hover:text-blue-600">
                        <span class="w-5 h-5 rounded bg-blue-50 flex items-center justify-center">{!! \App\Helpers\IconHelper::categorySvg($cat->slug, 'w-3 h-3 text-blue-600') !!}</span>
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    <!-- AdSense Header Banner -->
    @if(\App\Models\Setting::get('adsense_enabled') && \App\Models\Setting::get('adsense_header_slot'))
    <div class="max-w-7xl mx-auto px-4 my-4 text-center">
        <ins class="adsbygoogle" style="display:block" data-ad-client="{{ \App\Models\Setting::get('adsense_publisher_id') }}" data-ad-slot="{{ \App\Models\Setting::get('adsense_header_slot') }}" data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-gradient text-gray-300 mt-12">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('images/icon.png') }}" alt="UmangIndia" loading="lazy" class="h-10 w-10 rounded-lg">
                        <div>
                            <span class="text-white font-bold text-lg">UMANG</span><span class="text-saffron-400 font-bold text-lg">India</span>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-400">Your trusted portal for complete information about Indian government schemes (Sarkari Yojana). Check eligibility, benefits and application process.</p>
                </div>
                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('schemes.index') }}" class="hover:text-white transition">All Schemes</a></li>
                        <li><a href="{{ route('schemes.latest') }}" class="hover:text-white transition">Latest Updates</a></li>
                        <li><a href="{{ route('pdfs.index') }}" class="hover:text-white transition">Downloads</a></li>
                        <li><a href="{{ route('search') }}" class="hover:text-white transition">Search</a></li>
                    </ul>
                </div>
                <!-- Categories -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Categories</h4>
                    <ul class="space-y-2.5 text-sm">
                        @foreach(\App\Models\Category::orderBy('sort_order')->take(6)->get() as $cat)
                        <li><a href="{{ route('categories.show', $cat) }}" class="hover:text-white transition">{{ $cat->icon }} {{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- Legal -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Legal</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('pages.about') }}" class="hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('pages.contact') }}" class="hover:text-white transition">Contact</a></li>
                        <li><a href="{{ route('pages.privacy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="{{ route('pages.disclaimer') }}" class="hover:text-white transition">Disclaimer</a></li>
                        <li><a href="{{ route('pages.terms') }}" class="hover:text-white transition">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>

            <!-- AdSense Footer -->
            @if(\App\Models\Setting::get('adsense_enabled') && \App\Models\Setting::get('adsense_footer_slot'))
            <div class="my-6 text-center">
                <ins class="adsbygoogle" style="display:block" data-ad-client="{{ \App\Models\Setting::get('adsense_publisher_id') }}" data-ad-slot="{{ \App\Models\Setting::get('adsense_footer_slot') }}" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>
            @endif

            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm">
                <p class="text-white">&copy; {{ date('Y') }} UmangIndia.com. All rights reserved.</p>
                <div class="mt-3 p-3 rounded-lg bg-white/5 border border-white/10 max-w-2xl mx-auto">
                    <p class="text-gray-300 text-xs leading-relaxed"><strong class="text-white">Disclaimer:</strong> UmangIndia is an independent, privately-run information portal. It is NOT affiliated with, endorsed by, or connected to the Government of India, UMANG (umang.gov.in), or any state government. For official information, please visit <a href="https://www.india.gov.in" class="text-saffron-400 hover:underline" target="_blank" rel="noopener noreferrer">india.gov.in</a> or the respective government department.</p>
                </div>
                <div class="mt-4 h-1 rounded-full overflow-hidden max-w-xs mx-auto" style="background: linear-gradient(90deg, #0b4ea2 0%, #0b4ea2 50%, #f58220 50%, #f58220 100%);"></div>
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) {
            btn.addEventListener('click', () => menu.classList.toggle('hidden'));
        }
    </script>

    <!-- Back to Top Button -->
    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 invisible z-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
    </button>
    <script>
    window.addEventListener('scroll', function() {
        var btn = document.getElementById('back-to-top');
        if (window.scrollY > 500) { btn.classList.remove('opacity-0','invisible'); btn.classList.add('opacity-100','visible'); }
        else { btn.classList.add('opacity-0','invisible'); btn.classList.remove('opacity-100','visible'); }
    });
    </script>
    @stack('scripts')
</body>
</html>

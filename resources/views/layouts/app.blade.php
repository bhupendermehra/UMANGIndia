<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UmangIndia - Government Schemes & Sarkari Yojana')</title>
    <meta name="description" content="@yield('description', 'Complete information about Indian government schemes, sarkari yojana, eligibility, benefits and application process.')">
    <meta name="keywords" content="@yield('keywords', 'sarkari yojana, government schemes, pm kisan, ayushman bharat, mgnrega')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'UmangIndia')">
    <meta property="og:description" content="@yield('description', 'Government Schemes & Sarkari Yojana Portal')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

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
    </style>

    <!-- Schema.org -->
    @yield('schema')

    @stack('styles')
</head>
<body class="app-shell text-slate-800 antialiased" style="font-family: 'Inter', 'Noto Sans Devanagari', sans-serif;">
    <!-- Announcement Bar -->
    <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-center gap-2 px-4 py-2">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            <span>New: Latest PM Kisan & Ayushman Bharat Updates Available</span>
            <a href="{{ route('schemes.latest') }}" class="underline font-medium hover:no-underline whitespace-nowrap">Check Now →</a>
        </div>
    </div>

    <!-- Tricolor Top Bar -->
    <div class="tricolor-top"></div>

    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16 gap-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="UmangIndia Logo" class="h-10 w-auto">
                    <div class="hidden sm:block">
                        <span class="text-lg font-bold" style="color: #2563eb;">UMANG</span><span class="text-lg font-bold" style="color: #F58220;">India</span>
                        <p class="text-[10px] text-[#64748b] -mt-1 tracking-wide">Government Schemes Portal</p>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-[#eef4fb] hover:text-[#2563eb] transition">Home</a>
                    <a href="{{ route('schemes.index') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-[#eef4fb] hover:text-[#2563eb] transition">All Yojana</a>
                    <div class="relative group">
                        <button class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-[#eef4fb] hover:text-[#2563eb] flex items-center transition">
                            Categories
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="absolute left-0 mt-1 w-52 bg-white rounded-xl shadow-xl border py-2 hidden group-hover:block z-50">
                            @foreach(\App\Models\Category::orderBy('sort_order')->get() as $cat)
                            <a href="{{ route('categories.show', $cat) }}" class="block px-4 py-2.5 text-sm hover:bg-[#eef4fb] hover:text-[#2563eb] transition">{{ $cat->icon }} {{ $cat->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="relative group">
                        <button class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-[#eef4fb] hover:text-[#2563eb] flex items-center transition">
                            States
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="absolute left-0 mt-1 w-56 bg-white rounded-xl shadow-xl border py-2 hidden group-hover:block z-50 max-h-72 overflow-y-auto">
                            @foreach(\App\Models\State::orderBy('is_central', 'desc')->orderBy('name')->get() as $st)
                            <a href="{{ route('states.show', $st) }}" class="block px-4 py-2.5 text-sm hover:bg-[#eef4fb] hover:text-[#2563eb] transition">{{ $st->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('schemes.latest') }}" class="text-sm font-medium px-3 py-2 rounded-lg hover:bg-[#eef4fb] hover:text-[#2563eb] transition">Latest</a>
                </nav>

                <!-- Search + Language + Mobile Menu -->
                <div class="flex items-center space-x-2">
                    <!-- Language Switcher -->
                    <div class="flex items-center border border-[#E5E7EB] rounded-lg overflow-hidden text-sm">
                        <a href="{{ route('language.switch', 'en') }}" class="px-2.5 py-1.5 font-medium transition {{ app()->getLocale() === 'en' ? 'bg-[#2563eb] text-white' : 'text-[#475569] hover:bg-[#eef4fb]' }}" title="English">EN</a>
                        <a href="{{ route('language.switch', 'hi') }}" class="px-2.5 py-1.5 font-medium transition {{ app()->getLocale() === 'hi' ? 'bg-[#2563eb] text-white' : 'text-[#475569] hover:bg-[#eef4fb]' }}" title="हिंदी">हि</a>
                    </div>
                    <form action="{{ route('search') }}" method="GET" class="hidden sm:block">
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search schemes..." class="w-48 lg:w-64 pl-9 pr-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb] bg-slate-50 focus-ring">
                            <svg class="absolute left-3 top-2.5 h-4 w-4 text-[#64748b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </form>
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-[#eef4fb]">
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
                <a href="{{ route('home') }}" class="block py-2.5 text-sm font-medium hover:text-[#2563eb]">Home</a>
                <a href="{{ route('schemes.index') }}" class="block py-2.5 text-sm font-medium hover:text-[#2563eb]">All Yojana</a>
                <a href="{{ route('schemes.latest') }}" class="block py-2.5 text-sm font-medium hover:text-[#2563eb]">Latest</a>
                <div class="border-t border-slate-200 mt-2 pt-2">
                    <p class="text-xs font-semibold text-[#64748b] uppercase mb-1 tracking-wider">Categories</p>
                    @foreach(\App\Models\Category::orderBy('sort_order')->get() as $cat)
                    <a href="{{ route('categories.show', $cat) }}" class="block py-1.5 text-sm hover:text-[#2563eb]">{{ $cat->icon }} {{ $cat->name }}</a>
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
                        <img src="{{ asset('images/icon.png') }}" alt="UmangIndia" class="h-10 w-10 rounded-lg">
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
                <p class="mt-2 text-gray-500">This is an informational portal. For official information, visit <a href="https://www.india.gov.in" class="text-saffron-400 hover:underline" target="_blank" rel="noopener">india.gov.in</a></p>
                <!-- Tricolor Bottom -->
                <div class="mt-4 h-1 rounded-full overflow-hidden max-w-xs mx-auto" style="background: linear-gradient(90deg, #FF9933 0%, #FF9933 33%, #FFFFFF 33%, #FFFFFF 66%, #138A1A 66%, #138A1A 100%);"></div>
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

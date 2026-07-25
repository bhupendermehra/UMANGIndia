<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - UmangIndia</title>
    <meta name="description" content="The page you are looking for does not exist.">
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eef4fb', 100: '#d4e4f5', 200: '#a9c9eb', 300: '#7daede',
                            400: '#5293d1', 500: '#2D6CC4', 600: '#0B4EA2', 700: '#083B7A',
                            800: '#062A57', 900: '#041A35',
                        },
                        saffron: {
                            50: '#FFF8F0', 100: '#FFEDD5', 200: '#FFD9AA', 300: '#FFC47A',
                            400: '#FFA640', 500: '#F58220', 600: '#D96A0B', 700: '#B35509',
                            800: '#8C4207', 900: '#663005',
                        },
                        green: {
                            50: '#ECFDF0', 100: '#D1FAE5', 200: '#A7F3D0', 300: '#6EE7B7',
                            400: '#34D399', 500: '#33B249', 600: '#138A1A', 700: '#0F6D15',
                            800: '#0B5311', 900: '#083A0C',
                        },
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', 'Noto Sans Devanagari', sans-serif; }
        .card-hover { transition: transform 160ms ease, box-shadow 160ms ease, border-color 160ms ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 16px 30px rgba(11, 78, 162, 0.12); }
        .focus-ring:focus-visible { outline: 3px solid rgba(11, 78, 162, 0.25); outline-offset: 2px; }
        .footer-gradient { background: linear-gradient(180deg, #083b7a 0%, #041a35 100%); }
        .tricolor-top { background: linear-gradient(90deg, #0b4ea2 0 50%, #f58220 50% 100%); height: 4px; }
        .app-shell {
            background:
                radial-gradient(circle at top left, rgba(11, 78, 162, 0.08), transparent 32%),
                radial-gradient(circle at top right, rgba(245, 130, 32, 0.08), transparent 28%),
                #f5f7fa;
        }
        #mobile-menu { transition: max-height 0.3s ease, opacity 0.2s ease; overflow: hidden; }
    </style>
</head>
<body class="app-shell text-slate-800 antialiased">

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
                <nav class="hidden md:flex items-center space-x-1">
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
                </nav>

                <!-- Search + Language + Mobile Menu -->
                <div class="flex items-center space-x-2">
                    <!-- Language Switcher -->
                    <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden text-sm">
                        <a href="{{ route('language.switch', 'en') }}" class="px-3 py-2 font-medium transition {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-blue-50' }}" title="English">EN</a>
                        <a href="{{ route('language.switch', 'hi') }}" class="px-3 py-2 font-medium transition {{ app()->getLocale() === 'hi' ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-blue-50' }}" title="हिंदी">हि</a>
                    </div>
                    <form action="{{ route('search') }}" method="GET" class="hidden sm:block">
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search schemes..." class="w-48 lg:w-64 pl-9 pr-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-slate-50 focus-ring">
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

    <!-- 404 Content -->
    <main class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center max-w-lg mx-auto">
            <div class="mb-6">
                <span class="text-8xl font-bold bg-gradient-to-r from-blue-600 to-saffron-500 bg-clip-text text-transparent">404</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-800 mb-3">Page Not Found</h1>
            <p class="text-slate-500 mb-8 leading-relaxed">
                The page you're looking for doesn't exist or has been moved.
                Please check the URL or use the links below.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('home') }}"
                   class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-md">
                    Go to Homepage
                </a>
                <a href="{{ route('schemes.index') }}"
                   class="px-6 py-3 bg-white border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition">
                    Browse Schemes
                </a>
            </div>
        </div>
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
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>

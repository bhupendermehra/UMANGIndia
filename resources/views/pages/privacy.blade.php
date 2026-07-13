@extends('layouts.app')

@section('title', 'Privacy Policy - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-slate-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
            <li>›</li>
            <li class="text-slate-900 font-medium">Privacy Policy</li>
        </ol>
    </nav>

    <div class="bg-white rounded-xl p-8 shadow-sm border border-slate-200">
        <h1 class="text-2xl font-bold text-blue-600 mb-6">Privacy Policy</h1>

        <div class="prose max-w-none text-slate-700 leading-relaxed space-y-4">
            <p>UmangIndia respects your privacy. This policy explains how we collect and use information.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Information We Collect</h2>
            <p>We may collect non-personal information like browser type, pages visited, and time spent for analytics purposes.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Cookies</h2>
            <p>We use cookies to improve user experience. Third-party services (like Google Analytics and AdSense) may also use cookies to serve personalized ads.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Third-Party Links</h2>
            <p>Our site contains links to government websites. We are not responsible for their privacy practices.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Data Security</h2>
            <p>We implement appropriate security measures to protect your information. However, no method of transmission over the internet is 100% secure.</p>

            <div class="mt-6 p-4 bg-amber-50 rounded-xl border border-amber-200">
                <p class="text-sm text-slate-600"><strong class="text-amber-600">Note:</strong> This privacy policy may be updated from time to time. Last updated: {{ date('F Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

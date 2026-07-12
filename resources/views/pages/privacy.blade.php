@extends('layouts.app')

@section('title', 'Privacy Policy - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-[#888888]">
            <li><a href="{{ route('home') }}" class="hover:text-[#0B4EA2] transition">Home</a></li>
            <li>›</li>
            <li class="text-[#333333] font-medium">Privacy Policy</li>
        </ol>
    </nav>

    <div class="bg-white rounded-xl p-8 shadow-sm border border-[#E5E7EB]">
        <h1 class="text-2xl font-bold text-[#0B4EA2] mb-6">Privacy Policy</h1>

        <div class="prose max-w-none text-[#333333] leading-relaxed space-y-4">
            <p>UmangIndia respects your privacy. This policy explains how we collect and use information.</p>

            <h2 class="text-[#0B4EA2] text-xl font-bold mt-6">Information We Collect</h2>
            <p>We may collect non-personal information like browser type, pages visited, and time spent for analytics purposes.</p>

            <h2 class="text-[#0B4EA2] text-xl font-bold mt-6">Cookies</h2>
            <p>We use cookies to improve user experience. Third-party services (like Google Analytics and AdSense) may also use cookies to serve personalized ads.</p>

            <h2 class="text-[#0B4EA2] text-xl font-bold mt-6">Third-Party Links</h2>
            <p>Our site contains links to government websites. We are not responsible for their privacy practices.</p>

            <h2 class="text-[#0B4EA2] text-xl font-bold mt-6">Data Security</h2>
            <p>We implement appropriate security measures to protect your information. However, no method of transmission over the internet is 100% secure.</p>

            <div class="mt-6 p-4 bg-[#FFF8F0] rounded-xl border border-[#FFD9AA]">
                <p class="text-sm text-[#666666]"><strong class="text-[#F58220]">Note:</strong> This privacy policy may be updated from time to time. Last updated: {{ date('F Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

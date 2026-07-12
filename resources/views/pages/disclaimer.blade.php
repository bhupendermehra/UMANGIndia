@extends('layouts.app')

@section('title', 'Disclaimer - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-[#888888]">
            <li><a href="{{ route('home') }}" class="hover:text-[#0B4EA2] transition">Home</a></li>
            <li>›</li>
            <li class="text-[#333333] font-medium">Disclaimer</li>
        </ol>
    </nav>

    <div class="bg-white rounded-xl p-8 shadow-sm border border-[#E5E7EB]">
        <h1 class="text-2xl font-bold text-[#0B4EA2] mb-6">Disclaimer</h1>

        <div class="prose max-w-none text-[#333333] leading-relaxed space-y-4">
            <p>UmangIndia is an informational website. The information provided is for general knowledge purposes only.</p>

            <h2 class="text-[#0B4EA2] text-xl font-bold mt-6">Not an Official Website</h2>
            <p>UmangIndia is not affiliated with any government body or department. We are an independent informational portal.</p>

            <h2 class="text-[#0B4EA2] text-xl font-bold mt-6">Accuracy</h2>
            <p>While we strive to provide accurate information, we recommend verifying details from official government sources before taking any action.</p>

            <h2 class="text-[#0B4EA2] text-xl font-bold mt-6">External Links</h2>
            <p>Links to external websites do not constitute endorsement. We are not responsible for the content of external sites.</p>

            <div class="mt-6 p-4 bg-[#eef4fb] rounded-xl border border-[#a9c9eb]">
                <p class="text-sm text-[#083B7A]"><strong>For Official Information:</strong> Always refer to <a href="https://www.india.gov.in" class="text-[#0B4EA2] hover:underline" target="_blank" rel="noopener">india.gov.in</a> or the respective government department for authoritative information.</p>
            </div>
        </div>
    </div>
</div>
@endsection

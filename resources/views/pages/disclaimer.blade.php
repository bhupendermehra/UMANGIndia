@extends('layouts.app')

@section('title', 'Disclaimer - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-slate-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
            <li>›</li>
            <li class="text-slate-900 font-medium">Disclaimer</li>
        </ol>
    </nav>

    <div class="bg-white rounded-xl p-8 shadow-sm border border-slate-200">
        <h1 class="text-2xl font-bold text-blue-600 mb-6">Disclaimer</h1>

        <div class="prose max-w-none text-slate-700 leading-relaxed space-y-4">
            <p>UmangIndia is an informational website. The information provided is for general knowledge purposes only.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Not an Official Website</h2>
            <p>UmangIndia is not affiliated with any government body or department. We are an independent informational portal.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Accuracy</h2>
            <p>While we strive to provide accurate information, we recommend verifying details from official government sources before taking any action.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">External Links</h2>
            <p>Links to external websites do not constitute endorsement. We are not responsible for the content of external sites.</p>

            <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                <p class="text-sm text-blue-800"><strong>For Official Information:</strong> Always refer to <a href="https://www.india.gov.in" class="text-blue-600 hover:underline" target="_blank" rel="noopener">india.gov.in</a> or the respective government department for authoritative information.</p>
            </div>
        </div>
    </div>
</div>
@endsection

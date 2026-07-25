@extends('layouts.app')

@section('title', 'About UmangIndia - Independent Government Schemes Information Portal')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="text-sm mb-6">
        <ol class="flex items-center gap-2 text-slate-500 flex-wrap">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
            <li>›</li>
            <li class="text-slate-800 font-medium">About Us</li>
        </ol>
    </nav>

    <section class="surface-card p-6 md:p-8">
        <h1 class="text-2xl md:text-3xl font-bold section-title mb-6">About UmangIndia</h1>

        <div class="content-prose prose max-w-none text-slate-700 space-y-4">
            <p>UmangIndia is an independent, privately-run informational portal providing comprehensive details about Indian government schemes (Sarkari Yojana). We are not affiliated with, endorsed by, or connected to the Government of India or any state government. Our goal is to help citizens find and understand welfare schemes they may be eligible for.</p>
            <p>We cover schemes across categories including Education, Health, Agriculture, Housing, Employment, Social Welfare, Financial Inclusion, and more. Our team works to keep the information up-to-date with the latest government announcements.</p>

            <h2>Our Mission</h2>
            <p>To bridge the information gap between government welfare schemes and Indian citizens. We believe every person deserves to know about the benefits available to them.</p>

            <h2>What We Offer</h2>
            <ul class="list-disc pl-5 space-y-2">
                <li>Detailed information about government schemes across India</li>
                <li>Eligibility criteria for each scheme</li>
                <li>Step-by-step application process</li>
                <li>Required documents checklist</li>
                <li>State-wise scheme listings</li>
                <li>Latest updates and deadlines</li>
            </ul>

            <div class="mt-6 p-4 rounded-2xl border border-amber-200 bg-amber-50">
                <p class="text-sm text-slate-600"><strong class="text-amber-500">Note:</strong> This is not an official government website. For official information, please visit <a href="https://www.india.gov.in" class="text-blue-600 hover:underline" target="_blank" rel="noopener">india.gov.in</a></p>
            </div>
        </div>
    </section>
</div>
@endsection

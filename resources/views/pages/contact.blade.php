@extends('layouts.app')

@section('title', 'Contact Us - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="text-sm mb-6">
        <ol class="flex items-center gap-2 text-slate-500 flex-wrap">
            <li><a href="{{ route('home') }}" class="hover:text-[#0B4EA2] transition">Home</a></li>
            <li>›</li>
            <li class="text-slate-800 font-medium">Contact Us</li>
        </ol>
    </nav>

    <section class="surface-card p-6 md:p-8">
        <h1 class="text-2xl md:text-3xl font-bold section-title mb-6">Contact Us</h1>

        <div class="content-prose prose max-w-none text-slate-700 space-y-4">
            <p>Have questions or suggestions? We'd love to hear from you!</p>

            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <h3 class="font-semibold text-[#0B4EA2] mb-2">Email</h3>
                    <p class="text-slate-800">contact@umangindia.com</p>
                    <p class="text-xs muted mt-1">We aim to respond within 48 hours</p>
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <h3 class="font-semibold text-[#0B4EA2] mb-2">Website</h3>
                    <p class="text-slate-800">www.umangindia.com</p>
                    <p class="text-xs muted mt-1">Available 24/7 online</p>
                </div>
            </div>

            <div class="mt-6 p-4 rounded-2xl border border-slate-200 bg-[#eef4fb]">
                <p class="text-sm text-[#083B7A]"><strong>For Official Government Information:</strong> Please visit <a href="https://www.india.gov.in" class="text-[#0B4EA2] hover:underline" target="_blank" rel="noopener">india.gov.in</a> or contact the respective government department directly.</p>
            </div>
        </div>
    </section>
</div>
@endsection

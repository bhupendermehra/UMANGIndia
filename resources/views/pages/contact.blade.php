@extends('layouts.app')

@section('title', 'Contact Us - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="text-sm mb-6">
        <ol class="flex items-center gap-2 text-slate-500 flex-wrap">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
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
                    <h2 class="font-semibold text-blue-600 mb-2">Email</h2>
                    <p class="text-slate-800">contact@umangindia.com</p>
                    <p class="text-xs muted mt-1">We aim to respond within 48 hours</p>
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <h2 class="font-semibold text-blue-600 mb-2">Website</h2>
                    <p class="text-slate-800">www.umangindia.com</p>
                    <p class="text-xs muted mt-1">Available 24/7 online</p>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="font-semibold text-slate-800 mb-4">Send us a message</h2>
                @if(session('contact_success'))
                <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm">{{ session('contact_success') }}</div>
                @endif
                <form action="{{ route('pages.contact.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Your Name</label>
                            <input type="text" name="name" required maxlength="100" value="{{ old('name') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500" placeholder="Full name">
                            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                            <input type="email" name="email" required maxlength="150" value="{{ old('email') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500" placeholder="you@example.com">
                            @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Message</label>
                        <textarea name="message" required maxlength="2000" rows="4" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500" placeholder="How can we help?">{{ old('message') }}</textarea>
                        @error('message') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition">Send Message</button>
                </form>
            </div>

            <div class="mt-6 p-4 rounded-2xl border border-slate-200 bg-blue-50">
                <p class="text-sm text-blue-800"><strong>For Official Government Information:</strong> Please visit <a href="https://www.india.gov.in" class="text-blue-600 hover:underline" target="_blank" rel="noopener">india.gov.in</a> or contact the respective government department directly.</p>
            </div>
        </div>
    </section>
</div>
@endsection

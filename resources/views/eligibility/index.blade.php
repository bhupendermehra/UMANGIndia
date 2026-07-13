@extends('layouts.app')

@section('title', 'Check Eligibility - UmangIndia | Government Scheme Eligibility Checker')
@section('description', 'Find out which Indian government schemes and sarkari yojana you are eligible for. Answer a few simple questions to get personalised scheme recommendations.')
@section('keywords', 'eligibility checker, government schemes eligibility, sarkari yojana eligibility, scheme finder, yojana checker')

@push('meta')
<meta name="robots" content="index, follow">
@endpush

@section('content')
<div class="page-enter">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-800 font-medium">Eligibility Checker</span>
    </nav>

    <div class="max-w-3xl mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
            <!-- Gradient Header -->
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 px-6 py-8 sm:px-8 sm:py-10 text-white text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold mb-3">Scheme Eligibility Checker</h1>
                <p class="text-blue-100 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
                    Not sure which government schemes you qualify for? Answer a few simple questions and we'll find the best schemes and yojana for you.
                </p>
            </div>

            <!-- Body -->
            <div class="px-6 py-6 sm:px-8 sm:py-8">
                <!-- How it works -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4">How it works</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-blue-50 border border-blue-100">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-bold shrink-0">1</span>
                            <div>
                                <p class="font-medium text-slate-800 text-sm">Select State</p>
                                <p class="text-xs text-slate-500 mt-0.5">Choose your state or central scheme</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-saffron-50 border border-saffron-100">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-saffron-500 text-white text-sm font-bold shrink-0">2</span>
                            <div>
                                <p class="font-medium text-slate-800 text-sm">Your Details</p>
                                <p class="text-xs text-slate-500 mt-0.5">Tell us about yourself</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-green-50 border border-green-100">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-green-500 text-white text-sm font-bold shrink-0">3</span>
                            <div>
                                <p class="font-medium text-slate-800 text-sm">Get Results</p>
                                <p class="text-xs text-slate-500 mt-0.5">View matching schemes instantly</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('eligibility.step2') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="state" class="block text-sm font-medium text-slate-700 mb-2">
                            Select your State <span class="text-red-500">*</span>
                        </label>
                        <select name="state" id="state" required
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-white @error('state') border-red-500 @enderror">
                            <option value="">— Choose a State / Union Territory —</option>
                            <option value="">All India (Central Schemes)</option>
                            @foreach($states as $st)
                                <option value="{{ $st->id }}" {{ old('state') == $st->id ? 'selected' : '' }}>
                                    {{ $st->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('state')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1.5 text-xs text-slate-400">Select "All India" for central government schemes, or choose a specific state for state-specific yojana.</p>
                    </div>

                    <button type="submit"
                            class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-sm inline-flex items-center justify-center gap-2">
                        <span>Start Eligibility Check</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-4 sm:p-5 flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-sm font-medium text-amber-800">Important Note</p>
                <p class="text-sm text-amber-700 mt-0.5">This tool provides recommendations based on the information you provide. Always verify eligibility criteria on the official scheme website before applying.</p>
            </div>
        </div>
    </div>
</div>
@endsection

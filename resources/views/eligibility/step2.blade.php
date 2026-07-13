@extends('layouts.app')

@section('title', 'Step 2: Your Details - Eligibility Checker | UmangIndia')
@section('description', 'Tell us about your category, age, income, occupation and other details to find matching government schemes and sarkari yojana.')

@push('meta')
<meta name="robots" content="noindex, follow">
@endpush

@section('content')
<div class="page-enter">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('eligibility.index') }}" class="hover:text-blue-600 transition">Eligibility Checker</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-800 font-medium">Your Details</span>
    </nav>

    <div class="max-w-3xl mx-auto">
        <!-- Progress Indicator -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-slate-700">Step 2 of 2</span>
                <span class="text-sm text-slate-500">Your Details</span>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 h-2 rounded-full transition-all duration-500" style="width: 100%"></div>
            </div>
            <div class="flex justify-between mt-2">
                <div class="flex items-center gap-1 text-xs text-green-600">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    State Selected
                </div>
                <div class="flex items-center gap-1 text-xs text-blue-600 font-medium">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    Your Details
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 px-6 py-6 sm:px-8 text-white">
                <h1 class="text-xl sm:text-2xl font-bold">Tell Us About Yourself</h1>
                <p class="text-blue-100 text-sm mt-1.5">Fill in your details below to find the best schemes for you.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('eligibility.result') }}" method="POST" class="px-6 py-6 sm:px-8 sm:py-8">
                @csrf

                <!-- Hidden state_id -->
                <input type="hidden" name="state" value="{{ $validated['state'] ?? '' }}">

                <!-- Category -->
                <div class="mb-6">
                    <label for="category" class="block text-sm font-medium text-slate-700 mb-2">Scheme Category</label>
                    <select name="category" id="category"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-white">
                        <option value="">— Any Category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ old('category') == $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-slate-400">Select a specific category or leave as "Any Category" to see all matching schemes.</p>
                </div>

                <!-- Age Group -->
                <div class="mb-6">
                    <span class="block text-sm font-medium text-slate-700 mb-3">Age Group</span>
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                        @foreach(['0-18' => '0-18', '18-25' => '18-25', '25-40' => '25-40', '40-60' => '40-60', '60+' => '60+'] as $val => $label)
                        <label class="relative flex items-center justify-center p-3 rounded-xl border-2 cursor-pointer transition-all duration-200
                            {{ old('age_group') === $val ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200 hover:border-blue-300 hover:bg-blue-50/50' }}">
                            <input type="radio" name="age_group" value="{{ $val }}" {{ old('age_group') === $val ? 'checked' : '' }}
                                   class="absolute opacity-0 w-0 h-0">
                            <span class="text-sm font-medium {{ old('age_group') === $val ? 'text-blue-700' : 'text-slate-600' }}">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Income Bracket -->
                <div class="mb-6">
                    <span class="block text-sm font-medium text-slate-700 mb-3">Annual Income Bracket</span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach([
                            '0-1lac' => 'Up to ₹1 Lakh',
                            '1-2.5lac' => '₹1 - ₹2.5 Lakh',
                            '2.5-5lac' => '₹2.5 - ₹5 Lakh',
                            '5-10lac' => '₹5 - ₹10 Lakh',
                            '10+lac' => 'Above ₹10 Lakh',
                        ] as $val => $label)
                        <label class="relative flex items-center justify-center p-3 rounded-xl border-2 cursor-pointer transition-all duration-200
                            {{ old('income') === $val ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200 hover:border-blue-300 hover:bg-blue-50/50' }}">
                            <input type="radio" name="income" value="{{ $val }}" {{ old('income') === $val ? 'checked' : '' }}
                                   class="absolute opacity-0 w-0 h-0">
                            <span class="text-sm font-medium {{ old('income') === $val ? 'text-blue-700' : 'text-slate-600' }}">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Occupation -->
                <div class="mb-6">
                    <span class="block text-sm font-medium text-slate-700 mb-3">Occupation</span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach([
                            'farming' => 'Farming / Agriculture',
                            'student' => 'Student',
                            'private_job' => 'Private Job',
                            'govt_job' => 'Government Job',
                            'business' => 'Business / Self-Employed',
                            'unemployed' => 'Unemployed',
                            'retired' => 'Retired',
                        ] as $val => $label)
                        <label class="relative flex items-center justify-center p-3 rounded-xl border-2 cursor-pointer transition-all duration-200
                            {{ old('occupation') === $val ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200 hover:border-blue-300 hover:bg-blue-50/50' }}">
                            <input type="radio" name="occupation" value="{{ $val }}" {{ old('occupation') === $val ? 'checked' : '' }}
                                   class="absolute opacity-0 w-0 h-0">
                            <span class="text-sm font-medium {{ old('occupation') === $val ? 'text-blue-700' : 'text-slate-600' }}">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Caste -->
                <div class="mb-6">
                    <label for="caste" class="block text-sm font-medium text-slate-700 mb-2">Caste Category</label>
                    <select name="caste" id="caste"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-white">
                        <option value="">— Select Caste Category —</option>
                        @foreach([
                            'general' => 'General / Unreserved',
                            'sc' => 'Scheduled Caste (SC)',
                            'st' => 'Scheduled Tribe (ST)',
                            'obc' => 'Other Backward Class (OBC)',
                            'ewb' => 'Economically Weaker Section (EWS)',
                        ] as $val => $label)
                            <option value="{{ $val }}" {{ old('caste') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Disability -->
                <div class="mb-8">
                    <span class="block text-sm font-medium text-slate-700 mb-3">Person with Disability?</span>
                    <div class="flex gap-4">
                        <label class="relative flex items-center justify-center px-6 py-3 rounded-xl border-2 cursor-pointer transition-all duration-200 min-w-[100px]
                            {{ old('disability') === 'no' ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200 hover:border-blue-300 hover:bg-blue-50/50' }}">
                            <input type="radio" name="disability" value="no" {{ old('disability') === 'no' ? 'checked' : '' }}
                                   class="absolute opacity-0 w-0 h-0">
                            <span class="text-sm font-medium {{ old('disability') === 'no' ? 'text-blue-700' : 'text-slate-600' }}">No</span>
                        </label>
                        <label class="relative flex items-center justify-center px-6 py-3 rounded-xl border-2 cursor-pointer transition-all duration-200 min-w-[100px]
                            {{ old('disability') === 'yes' ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200 hover:border-blue-300 hover:bg-blue-50/50' }}">
                            <input type="radio" name="disability" value="yes" {{ old('disability') === 'yes' ? 'checked' : '' }}
                                   class="absolute opacity-0 w-0 h-0">
                            <span class="text-sm font-medium {{ old('disability') === 'yes' ? 'text-blue-700' : 'text-slate-600' }}">Yes</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 sm:justify-between">
                    <a href="{{ route('eligibility.index') }}"
                       class="px-6 py-3 border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition text-sm inline-flex items-center justify-center gap-2 order-2 sm:order-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                        Back
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-sm inline-flex items-center justify-center gap-2 order-1 sm:order-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Check Eligibility</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Skip note -->
        <div class="mt-6 text-center">
            <p class="text-xs text-slate-400">All fields are optional. The more you fill, the more accurate your recommendations will be.</p>
        </div>
    </div>
</div>
@endsection

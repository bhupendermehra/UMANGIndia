@extends('layouts.app')

@section('title', 'Scheme Comparison Tool | UmangIndia')
@section('description', 'Compare Indian government schemes side-by-side. Select 2-3 schemes to compare eligibility, benefits, application process, and more.')
@section('keywords', 'compare schemes, yojana comparison, sarkari yojana compare, scheme comparison tool, government schemes comparison')

@push('meta')
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}">
@endpush

@section('content')
<div class="page-enter">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-800">Scheme Comparison Tool</h1>
                <p class="text-slate-500 mt-1">Select 2 or 3 schemes to compare them side-by-side</p>
            </div>
        </div>
    </div>

    <!-- Error Message -->
    @if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl flex items-start gap-3">
        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    <!-- Category Filter -->
    @if($categories->count() > 0)
    <div class="mb-6 flex flex-wrap gap-2">
        <button type="button" class="filter-btn active px-4 py-2 rounded-full text-sm font-medium bg-blue-600 text-white transition" data-category="all">All Categories</button>
        @foreach($categories as $category)
        <button type="button" class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-slate-100 text-slate-600 hover:bg-slate-200 transition" data-category="{{ $category->id }}">{{ $category->name }} ({{ $category->schemes_count }})</button>
        @endforeach
    </div>
    @endif

    <form id="compare-form" action="{{ route('compare.result') }}" method="POST">
        @csrf
        <input type="hidden" name="schemes[]" id="schemes-input" value="">

        <!-- Selection Counter -->
        <div id="selection-counter" class="mb-4 text-sm text-slate-500">
            <span id="selected-count">0</span> of 3 schemes selected
        </div>

        <!-- Scheme Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            @forelse($schemes as $scheme)
            <div class="scheme-card relative bg-white rounded-xl border border-slate-200 p-5 card-hover cursor-pointer transition-all duration-200 {{ $scheme->category ? 'cat-'.$scheme->category->id : '' }}" data-id="{{ $scheme->id }}" onclick="toggleScheme({{ $scheme->id }})">
                <!-- Checkbox -->
                <div class="absolute top-4 right-4">
                    <div class="scheme-checkbox w-5 h-5 rounded border-2 {{ $scheme->category ? 'border-blue-400' : 'border-blue-400' }} flex items-center justify-center transition-all duration-200">
                        <svg class="w-3 h-3 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                <!-- Category Badge -->
                @if($scheme->category)
                <span class="inline-block text-xs font-medium text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full mb-3">{{ $scheme->category->name }}</span>
                @endif

                <!-- Title -->
                <h3 class="text-base font-semibold text-slate-800 pr-8 mb-2 line-clamp-2">{{ $scheme->title }}</h3>

                <!-- Short Description -->
                <p class="text-sm text-slate-500 line-clamp-3">{{ Str::limit(strip_tags($scheme->short_description), 120) }}</p>

                <!-- Status Badge -->
                @if($scheme->status === 'active')
                <span class="inline-flex items-center gap-1 mt-3 text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Active
                </span>
                @endif
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <p class="text-slate-500">No schemes found.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mb-8">
            {{ $schemes->links() }}
        </div>

        <!-- Compare Button -->
        <div class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur border-t border-slate-200 p-4 z-40 shadow-[0_-4px_20px_rgba(0,0,0,0.08)]">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="text-sm text-slate-500">
                    <span id="selected-count-bottom">0</span> of 3 selected
                </div>
                <button type="submit" id="compare-btn" disabled
                    class="inline-flex items-center gap-2 px-8 py-3 bg-blue-600 text-white font-semibold rounded-xl transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-blue-700 active:scale-[0.98] shadow-lg shadow-blue-600/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Compare Selected
                </button>
            </div>
        </div>
    </form>

    <!-- Spacer for fixed bottom bar -->
    <div class="h-24"></div>
</div>
@endsection

@push('scripts')
<script>
let selectedSchemes = [];

function toggleScheme(id) {
    const idx = selectedSchemes.indexOf(id);
    const card = document.querySelector(`.scheme-card[data-id="${id}"]`);
    const checkbox = card?.querySelector('.scheme-checkbox');

    if (idx === -1) {
        // Add selection
        if (selectedSchemes.length >= 3) {
            showToast('You can select a maximum of 3 schemes only.');
            return;
        }
        selectedSchemes.push(id);
        if (card) {
            card.classList.add('ring-2', 'ring-blue-500', 'border-blue-500', 'bg-blue-50/50');
            card.classList.remove('border-slate-200');
        }
        if (checkbox) {
            checkbox.classList.add('bg-blue-600', 'border-blue-600');
            const svg = checkbox.querySelector('svg');
            if (svg) svg.classList.remove('hidden');
        }
    } else {
        // Remove selection
        selectedSchemes.splice(idx, 1);
        if (card) {
            card.classList.remove('ring-2', 'ring-blue-500', 'border-blue-500', 'bg-blue-50/50');
            card.classList.add('border-slate-200');
        }
        if (checkbox) {
            checkbox.classList.remove('bg-blue-600', 'border-blue-600');
            const svg = checkbox.querySelector('svg');
            if (svg) svg.classList.add('hidden');
        }
    }

    updateUI();
}

function updateUI() {
    const count = selectedSchemes.length;
    document.getElementById('selected-count').textContent = count;
    document.getElementById('selected-count-bottom').textContent = count;
    
    const btn = document.getElementById('compare-btn');
    btn.disabled = count < 2;
    btn.textContent = count < 2 ? 'Select at least 2 schemes' : 'Compare Selected';
}

function showToast(message) {
    const existing = document.querySelector('.toast-notification');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.className = 'toast-notification fixed top-4 right-4 z-50 bg-amber-50 border border-amber-200 text-amber-800 px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 animate-slide-in';
    toast.innerHTML = `
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.072 16.5c-.77.833.192 2.5 1.732 2.5z"/>
        </svg>
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" class="ml-2 hover:bg-amber-100 rounded p-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    `;
    document.body.appendChild(toast);

    setTimeout(() => {
        if (toast.parentElement) {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            toast.style.transition = 'all 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
}

// Handle form submission
document.getElementById('compare-form').addEventListener('submit', function(e) {
    if (selectedSchemes.length < 2) {
        e.preventDefault();
        showToast('Please select at least 2 schemes to compare.');
        return;
    }
    // Populate hidden input with selected IDs
    const input = document.getElementById('schemes-input');
    // Remove the hidden input and create proper array
    input.remove();
    selectedSchemes.forEach(id => {
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'schemes[]';
        hidden.value = id;
        this.appendChild(hidden);
    });
});

// Category Filter
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('bg-blue-600', 'text-white');
            b.classList.add('bg-slate-100', 'text-slate-600');
        });
        this.classList.remove('bg-slate-100', 'text-slate-600');
        this.classList.add('bg-blue-600', 'text-white');

        const category = this.dataset.category;
        document.querySelectorAll('.scheme-card').forEach(card => {
            if (category === 'all') {
                card.style.display = '';
            } else {
                const cardClasses = card.className;
                card.style.display = cardClasses.includes('cat-' + category) ? '' : 'none';
            }
        });
    });
});

// Add animation styles
const style = document.createElement('style');
style.textContent = `
    .animate-slide-in {
        animation: slideIn 0.3s ease-out;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(100px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
`;
document.head.appendChild(style);
</script>
@endpush

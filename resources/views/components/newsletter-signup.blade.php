<div class="bg-gradient-to-r from-primary-600 to-primary-500 rounded-lg p-6 text-white">
    <span class="font-bold text-lg mb-2">📬 Get Scheme Updates</span>
    <p class="text-sm text-white/80 mb-4">
        Subscribe to our weekly newsletter and never miss a new government scheme update!
    </p>

    @if (session('success'))
        <div class="bg-green-500/30 border border-green-300/50 text-white px-4 py-2 rounded mb-3 text-sm">{{ session('success') }}</div>
    @endif

    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
        @csrf
        <div>
            <input type="text" name="name" placeholder="Your Name (optional)"
                   class="w-full px-4 py-2.5 rounded-lg text-gray-900 text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white/50">
        </div>
        <div>
            <input type="email" name="email" placeholder="Enter your email"
                   required
                   class="w-full px-4 py-2.5 rounded-lg text-gray-900 text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white/50">
        </div>
        <button type="submit"
                class="w-full bg-white text-primary-600 font-semibold px-4 py-2.5 rounded-lg hover:bg-gray-100 transition text-sm">
            Subscribe Now
        </button>
    </form>
    <p class="text-xs text-white/60 mt-2">No spam. Unsubscribe anytime.</p>
</div>
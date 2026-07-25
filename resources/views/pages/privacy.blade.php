@extends('layouts.app')

@section('title', 'Privacy Policy - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-slate-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
            <li>›</li>
            <li class="text-slate-900 font-medium">Privacy Policy</li>
        </ol>
    </nav>

    <div class="bg-white rounded-xl p-8 shadow-sm border border-slate-200">
        <h1 class="text-2xl font-bold text-blue-600 mb-6">Privacy Policy</h1>

        <div class="prose max-w-none text-slate-700 leading-relaxed space-y-4">
            <p><strong>Last Updated:</strong> {{ date('F Y') }}</p>
            <p>UmangIndia ("we", "us", or "our") operates the umangindia.com website. This Privacy Policy explains how we collect, use, and protect information when you use our website.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Information We Collect</h2>
            <p>We collect the following types of information:</p>
            <ul class="list-disc pl-5 space-y-2">
                <li><strong>Automatically collected information:</strong> Browser type, operating system, pages visited, time spent on pages, referring URLs, and IP address (for analytics and security).</li>
                <li><strong>Form data:</strong> When you subscribe to our newsletter, we collect your email address and a unique unsubscribe token.</li>
                <li><strong>Usage data:</strong> Search queries, scheme interactions, and sharing activity on our site.</li>
            </ul>
            <p>We do <strong>not</strong> collect Aadhaar numbers, bank account details, or any government-issued identity numbers. We do <strong>not</strong> process financial transactions.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">How We Use Your Information</h2>
            <ul class="list-disc pl-5 space-y-2">
                <li>To operate and maintain the website</li>
                <li>To improve user experience through analytics</li>
                <li>To send newsletter updates (only if you subscribe)</li>
                <li>To detect and prevent security threats</li>
                <li>To comply with legal obligations</li>
            </ul>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Third-Party Services</h2>
            <p>We use the following third-party services that may collect information:</p>
            <ul class="list-disc pl-5 space-y-2">
                <li><strong>Google Analytics:</strong> Tracks website usage, page views, and user behavior. Google may collect data per their <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">Privacy Policy</a>.</li>
                <li><strong>Google AdSense:</strong> If enabled, serves personalized advertisements. Google uses cookies to serve ads based on your prior visits to our website or other websites. You can opt out via <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">Google Ad Settings</a>.</li>
            </ul>
            <p>These third-party services have their own privacy policies, and we encourage you to review them.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Cookies</h2>
            <p>We use cookies to:</p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Maintain your session and preferences (e.g., language selection)</li>
                <li>Analyze website traffic via Google Analytics</li>
                <li>Serve relevant advertisements via Google AdSense</li>
            </ul>
            <p>You can control cookies through your browser settings. Disabling cookies may affect site functionality.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Data Retention</h2>
            <p>We retain analytics data for up to 26 months. Newsletter subscription data is retained until you unsubscribe. Server logs are rotated periodically.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Your Rights (DPDP Act 2023)</h2>
            <p>Under India's Digital Personal Data Protection Act, 2023, you have the right to:</p>
            <ul class="list-disc pl-5 space-y-2">
                <li><strong>Access</strong> the personal data we hold about you</li>
                <li><strong>Correct</strong> any inaccurate personal data</li>
                <li><strong>Erasure</strong> of your personal data (subject to legal requirements)</li>
                <li><strong>Withdraw consent</strong> for data processing at any time</li>
                <li><strong>Grievance redressal</strong> for any concerns about data handling</li>
            </ul>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Children's Privacy</h2>
            <p>Our website is not directed to children under 18. We do not knowingly collect personal data from children.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">External Links</h2>
            <p>Our site contains links to government websites and third-party resources. We are not responsible for their privacy practices. We encourage users to review the privacy policies of any external site they visit.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Data Security</h2>
            <p>We implement appropriate security measures to protect your information. However, no method of transmission over the internet is 100% secure. We cannot guarantee absolute security.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Grievance Officer</h2>
            <p>If you have any questions, concerns, or requests regarding this Privacy Policy or your personal data, please contact our Grievance Officer:</p>
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 mt-3">
                <p><strong>Email:</strong> contact@umangindia.com</p>
                <p><strong>Website:</strong> <a href="{{ route('pages.contact') }}" class="text-blue-600 hover:underline">Contact Page</a></p>
                <p class="text-sm text-slate-500 mt-2">We aim to respond to all privacy-related inquiries within 30 days.</p>
            </div>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Changes to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. Changes will be posted on this page with an updated "Last Updated" date. Continued use of the website after changes constitutes acceptance of the updated policy.</p>

            <div class="mt-6 p-4 bg-amber-50 rounded-xl border border-amber-200">
                <p class="text-sm text-slate-600"><strong class="text-amber-600">Note:</strong> This is not an official government website. For official information, please visit <a href="https://www.india.gov.in" class="text-blue-600 hover:underline" target="_blank" rel="noopener noreferrer">india.gov.in</a>.</p>
            </div>
        </div>
    </div>
</div>
@endsection

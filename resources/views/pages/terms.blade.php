@extends('layouts.app')

@section('title', 'Terms & Conditions - UmangIndia')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-slate-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
            <li>›</li>
            <li class="text-slate-900 font-medium">Terms & Conditions</li>
        </ol>
    </nav>

    <div class="bg-white rounded-xl p-8 shadow-sm border border-slate-200">
        <h1 class="text-2xl font-bold text-blue-600 mb-6">Terms & Conditions</h1>

        <div class="prose max-w-none text-slate-700 leading-relaxed space-y-4">
            <p>Welcome to UmangIndia. By accessing or using this website, you agree to be bound by the following Terms & Conditions. Please read them carefully.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Acceptance of Terms</h2>
            <p>By accessing, browsing, or using this website, you acknowledge that you have read, understood, and agree to be bound by these Terms & Conditions and our Privacy Policy. If you do not agree with any part of these terms, please do not use this website.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Use of the Website</h2>
            <p>UmangIndia is an informational website that aggregates and presents details about government schemes and welfare initiatives. This website is provided for informational purposes only and is <strong>NOT an official government website</strong>. We are an independent, privately operated resource and are not affiliated with, endorsed by, or officially connected to any government body, agency, or department.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Accuracy of Information</h2>
            <p>While we strive to keep all information accurate and up to date, government schemes, eligibility criteria, benefits, and deadlines are subject to change at any time. The details presented on this website may not always reflect the latest official updates. Users are strongly advised to verify all information—especially eligibility, application procedures, and deadlines—directly on the <strong>official government sources and portals</strong> before making any decisions or applications.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Intellectual Property</h2>
            <p>All original content, including text, graphics, logos, and design on this website, is the intellectual property of UmangIndia unless otherwise stated. You may not reproduce, distribute, or republish any content without prior written permission. Government scheme names, logos, and official marks remain the property of their respective owners.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Limitation of Liability</h2>
            <p>UmangIndia and its operators shall not be held liable for any direct, indirect, incidental, or consequential loss or damage arising from the use of, or reliance on, the information provided on this website. We do not guarantee the completeness, accuracy, or timeliness of any content, and decisions made based on this website are solely the user's responsibility.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">External Links Disclaimer</h2>
            <p>This website may contain links to external websites, including official government portals and third-party resources. These links are provided for convenience only. We have no control over the content, policies, or practices of external sites and are not responsible for their accuracy, security, or privacy practices. Accessing external links is at your own risk.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Changes to Terms</h2>
            <p>We reserve the right to modify or update these Terms & Conditions at any time without prior notice. Any changes will be reflected on this page, and continued use of the website after such changes constitutes acceptance of the updated terms.</p>

            <h2 class="text-blue-600 text-xl font-bold mt-6">Contact Information</h2>
            <p>If you have any questions or concerns regarding these Terms & Conditions, please reach out to us through our <a href="{{ route('pages.contact') }}" class="text-blue-600 hover:underline">Contact</a> page.</p>

            <div class="mt-6 p-4 bg-amber-50 rounded-xl border border-amber-200">
                <p class="text-sm text-slate-600"><strong class="text-amber-600">Note:</strong> These terms may be updated from time to time. Last updated: {{ date('F Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

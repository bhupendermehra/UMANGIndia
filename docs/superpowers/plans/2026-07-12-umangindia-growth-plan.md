# UmangIndia Growth & Monetization Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Transform UmangIndia from a 22-scheme static portal into a 200+ scheme, bilingual (Hindi+English), AdSense-ready government schemes platform achieving 10,000-50,000 monthly pageviews and ₹5,000-25,000 monthly AdSense revenue within 6 months.

**Architecture:** Laravel 12 + SQLite backend, Tailwind CSS frontend, bilingual content (Hindi primary), SEO-optimized with Schema.org structured data, blog/article system for long-tail keywords, admin panel for content management, WhatsApp sharing for viral growth.

**Tech Stack:** Laravel 12, PHP 8.2, SQLite, Tailwind CSS v4, Vite 7, Blade templates, spatie/laravel-sitemap, artesaos/seotools

---

## Current State Analysis

| Metric | Current | Target (6 months) |
|--------|---------|-------------------|
| Schemes | 22 | 200+ |
| Languages | English only | Hindi + English |
| Blog articles | 0 | 50+ |
| Monthly pageviews | ~0 (localhost) | 10,000-50,000 |
| AdSense | Not configured | Approved + earning ₹5K-25K/mo |
| Admin panel | None | Full CRUD |
| Email subscribers | 0 | 1,000+ |
| WhatsApp shares | 0 | Viral distribution |

## Competitor Benchmarks

| Site | Monthly Visits | Key Strategy |
|------|---------------|--------------|
| govtschemes.in | 7.18M | Hindi content, massive scheme coverage, SEO |
| myscheme.gov.in | High (gov official) | Eligibility checker, official trust |
| sarkariyojana.com | Medium | Hindi blog + schemes |
| pmkisan.gov.in | 2.27M | Single scheme, high intent traffic |

**Key insight:** Hindi content + comprehensive scheme coverage + SEO = massive traffic in this niche.

---

## Phase 1: Foundation & AdSense Readiness (Weeks 1-2)

### Task 1: Create Admin Panel for Content Management

**Files:**
- Create: `app/Http/Controllers/Admin/DashboardController.php`
- Create: `app/Http/Controllers/Admin/SchemeController.php`
- Create: `app/Http/Controllers/Admin/CategoryController.php`
- Create: `app/Http/Controllers/Admin/SettingController.php`
- Create: `app/Http/Middleware/AdminMiddleware.php`
- Create: `resources/views/admin/layouts/app.blade.php`
- Create: `resources/views/admin/dashboard.blade.php`
- Create: `resources/views/admin/schemes/index.blade.php`
- Create: `resources/views/admin/schemes/create.blade.php`
- Create: `resources/views/admin/schemes/edit.blade.php`
- Create: `resources/views/admin/categories/index.blade.php`
- Create: `resources/views/admin/settings/index.blade.php`
- Modify: `routes/web.php` — add admin route group
- Create: `database/migrations/2026_07_12_000001_create_admins_table.php`

- [ ] **Step 1: Create Admin migration and model**

```php
// database/migrations/2026_07_12_000001_create_admins_table.php
Schema::create('admins', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
```

```php
// app/Models/Admin.php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
```

- [ ] **Step 2: Create AdminMiddleware**

```php
// app/Http/Middleware/AdminMiddleware.php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
```

- [ ] **Step 3: Create admin auth routes and controllers**

Add to `routes/web.php`:
```php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [Admin\AuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout')->middleware('admin.auth');
    
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('schemes', Admin\SchemeController::class);
        Route::resource('categories', Admin\CategoryController::class)->only(['index', 'edit', 'update']);
        Route::get('settings', [Admin\SettingController::class, 'index'])->name('settings');
        Route::post('settings', [Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
```

- [ ] **Step 4: Create admin dashboard view**

- [ ] **Step 5: Create scheme CRUD views (index, create, edit)**

- [ ] **Step 6: Create category and settings views**

- [ ] **Step 7: Seed admin user**

```php
// database/seeders/AdminSeeder.php
Admin::create([
    'name' => 'Admin',
    'email' => 'admin@umangindia.com',
    'password' => Hash::make('password'),
]);
```

- [ ] **Step 8: Test admin login and CRUD operations**

Run: `php artisan migrate && php artisan db:seed --class=AdminSeeder`
Expected: Admin can login at `/admin/login` and manage schemes

- [ ] **Step 9: Commit**

```bash
git add -A
git commit -m "feat: add admin panel for content management"
```

---

### Task 2: Add Hindi Language Support

**Files:**
- Create: `resources/lang/hi/messages.php`
- Create: `resources/lang/hi/navigation.php`
- Create: `resources/views/home.blade.php` (bilingual version)
- Modify: `resources/views/layouts/app.blade.php` — add language switcher
- Modify: `app/Http/Controllers/HomeController.php` — language-aware
- Create: `app/Http/Middleware/SetLocale.php`

- [ ] **Step 1: Create locale middleware**

```php
// app/Http/Middleware/SetLocale.php
namespace App\Http\Middleware;
use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
    $locale = session('locale', config('app.locale'));
    app()->setLocale($locale);
    return $next($request);
}
}
```

- [ ] **Step 2: Create Hindi translation files**

```php
// resources/lang/hi/messages.php
return [
    'hero_title' => 'सरकारी योजनाएं और सरकारी योजना',
    'hero_description' => 'भारत सरकार की सभी योजनाओं की पूरी जानकारी। पात्रता, लाभ और आवेदन प्रक्रिया जांचें।',
    'search_placeholder' => 'योजनाएं खोजें... (जैसे पीएम किसान, आयुष्मान भारत)',
    'featured_schemes' => 'प्रमुख योजनाएं',
    'latest_schemes' => 'नवीनतम योजनाएं',
    'browse_category' => 'श्रेणी के अनुसार ब्राउज़ करें',
    'view_all' => 'सभी देखें',
    'view_details' => 'विवरण देखें',
    'eligibility' => 'पात्रता',
    'benefits' => 'लाभ',
    'how_to_apply' => 'आवेदन कैसे करें',
    'required_documents' => 'आवश्यक दस्तावेज',
    'overview' => 'अवलोकन',
];
```

- [ ] **Step 3: Add language switcher to layout**

Add to header nav in `resources/views/layouts/app.blade.php`:
```php
<a href="{{ route('lang.switch', 'hi') }}" class="text-sm px-2 py-1 rounded {{ app()->getLocale() === 'hi' ? 'bg-primary-100 text-primary-700' : '' }}">हिंदी</a>
<a href="{{ route('lang.switch', 'en') }}" class="text-sm px-2 py-1 rounded {{ app()->getLocale() === 'en' ? 'bg-primary-100 text-primary-700' : '' }}">English</a>
```

- [ ] **Step 4: Add language switch route**

```php
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'hi'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');
```

- [ ] **Step 5: Create Hindi versions of key pages (home, scheme detail)**

- [ ] **Step 6: Add Hindi scheme content to database (title_hi, description_hi columns)**

```php
// Migration: add_hindi_columns_to_schemes_table
Schema::table('schemes', function (Blueprint $table) {
    $table->string('title_hi')->nullable()->after('title');
    $table->text('short_description_hi')->nullable()->after('short_description');
    $table->longText('content_hi')->nullable()->after('content');
});
```

- [ ] **Step 7: Test language switching works correctly**

- [ ] **Step 8: Commit**

```bash
git add -A
git commit -m "feat: add Hindi language support with language switcher"
```

---

### Task 3: AdSense Configuration & Trust Pages

**Files:**
- Modify: `resources/views/pages/about.blade.php` — real content
- Modify: `resources/views/pages/contact.blade.php` — working form
- Modify: `resources/views/pages/privacy.blade.php` — DPDP Act compliant
- Modify: `resources/views/pages/disclaimer.blade.php` — comprehensive
- Modify: `resources/views/layouts/app.blade.php` — AdSense code injection
- Modify: `app/Models/Setting.php` — enable ads

- [ ] **Step 1: Rewrite About page with real author info**

```blade
<!-- resources/views/pages/about.blade.php -->
@section('meta_title', 'About Us - UmangIndia')
@section('meta_description', 'Learn about UmangIndia, your trusted source for Indian government scheme information.')

<div class="max-w-4xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-primary-700 mb-6">About UmangIndia</h1>
    <div class="prose prose-lg">
        <p>UmangIndia is an independent informational portal dedicated to helping Indian citizens discover, understand, and access government welfare schemes (Sarkari Yojana).</p>
        <p>Our mission is to bridge the gap between government initiatives and the people they serve. We provide comprehensive, accurate, and up-to-date information about central and state government schemes covering education, health, agriculture, housing, employment, and more.</p>
        <h2>Our Vision</h2>
        <p>To become India's most trusted and comprehensive government schemes information platform, helping every citizen access the benefits they're entitled to.</p>
        <h2>What We Cover</h2>
        <ul>
            <li>200+ government schemes across 12 categories</li>
            <li>Schemes from all 37 states and union territories</li>
            <li>Detailed eligibility criteria and application processes</li>
            <li>Regular updates on new and existing schemes</li>
        </ul>
        <h2>Contact</h2>
        <p>For queries, suggestions, or corrections, email us at <a href="mailto:info@umangindia.com">info@umangindia.com</a></p>
    </div>
</div>
@endsection
```

- [ ] **Step 2: Update Privacy Policy (DPDP Act 2023 compliant)**

Add Grievance Officer section and data collection disclosure.

- [ ] **Step 3: Update Disclaimer page**

- [ ] **Step 4: Update Contact page with working form**

- [ ] **Step 5: Configure AdSense settings in database**

```php
// In SettingSeeder or via admin panel
Setting::set('adsense_enabled', '1');
Setting::set('adsense_header', 'YOUR_ADSENSE_CODE_HERE');
Setting::set('adsense_footer', 'YOUR_ADSENSE_CODE_HERE');
Setting::set('adsense_sidebar', 'YOUR_ADSENSE_CODE_HERE');
Setting::set('adsense_in_article', 'YOUR_ADSENSE_CODE_HERE');
```

- [ ] **Step 6: Add Google Search Console verification meta tag**

- [ ] **Step 7: Add Google Analytics tracking**

- [ ] **Step 8: Commit**

```bash
git add -A
git commit -m "feat: configure AdSense, update trust pages for approval"
```

---

## Phase 2: Content Expansion & SEO (Weeks 3-6)

### Task 4: Expand Scheme Database to 100+ Schemes

**Files:**
- Create: `database/seeders/ExpandedSchemeSeeder.php`
- Modify: `app/Models/Scheme.php` — add Hindi fields

- [ ] **Step 1: Research and catalog 80+ additional schemes**

Categories to expand:
- Agriculture: PM Kisan, PM Fasal Bima, KCC + 10 more (PM KUSUM expanded, PM Krishi Sinchai, etc.)
- Health: Ayushman Bharat + 10 more (PM Jan Aushadhi, Mission Indradhanush, etc.)
- Education: + 15 more (PM Scholarship, NSP, Mid Day Meal, Vidya Lakshmi, etc.)
- Employment: MGNREGA + 12 more (PM Rozgar, Startup India, Skill India, etc.)
- Housing: PM Awas + 8 more (Rajiv Awas, Pradhan Mantri Awas, etc.)
- Social Welfare: + 10 more (PM Ujjwala expanded, National Social Assistance, etc.)
- Women & Child: + 8 more (PM Matru Vandana expanded, Beti Bachao, etc.)
- Financial Inclusion: + 8 more (PM JDY expanded, Sukanya, NPS, Atal Pension, etc.)
- Digital India: + 5 more (BharatNet, PMWANI, etc.)
- Senior Citizen: + 5 more (PM Vay Vandana expanded, IGNOAP, etc.)
- State-specific schemes for major states (UP, Bihar, Maharashtra, etc.)

- [ ] **Step 2: Create expanded seeder with full content**

Each scheme must include:
- title, title_hi
- short_description, short_description_hi
- content (HTML, 500+ words), content_hi
- eligibility, benefits, application_process, required_documents
- official_website, application_deadline
- status (active/upcoming/closed)
- meta_title, meta_description, meta_keywords
- category_id, state_id

- [ ] **Step 3: Run seeder**

Run: `php artisan db:seed --class=ExpandedSchemeSeeder`
Expected: 100+ schemes in database

- [ ] **Step 4: Verify all schemes display correctly**

- [ ] **Step 5: Commit**

```bash
git add -A
git commit -m "feat: expand scheme database to 100+ schemes with Hindi content"
```

---

### Task 5: Create Blog/Article System for Long-Tail SEO

**Files:**
- Create: `database/migrations/2026_07_12_000002_create_articles_table.php`
- Create: `app/Models/Article.php`
- Create: `app/Http/Controllers/ArticleController.php`
- Create: `app/Http/Controllers/Admin/ArticleController.php`
- Create: `resources/views/articles/index.blade.php`
- Create: `resources/views/articles/show.blade.php`
- Create: `resources/views/admin/articles/` (CRUD views)
- Modify: `routes/web.php` — add article routes

- [ ] **Step 1: Create articles migration**

```php
Schema::create('articles', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('title_hi')->nullable();
    $table->string('slug')->unique();
    $table->text('excerpt');
    $table->text('excerpt_hi')->nullable();
    $table->longText('content');
    $table->longText('content_hi')->nullable();
    $table->string('featured_image')->nullable();
    $table->enum('status', ['draft', 'published'])->default('draft');
    $table->integer('views')->default(0);
    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();
    $table->string('meta_keywords')->nullable();
    $table->foreignId('category_id')->nullable()->constrained();
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
});
```

- [ ] **Step 2: Create Article model with scopes**

- [ ] **Step 3: Create article controllers and views**

- [ ] **Step 4: Create 20 seed articles targeting long-tail keywords**

Target keywords (Hindi + English):
1. "पीएम किसान योजना का पैसा कैसे चेक करें" (How to check PM Kisan money)
2. "आयुष्मान भारत कार्ड कैसे बनाएं" (How to make Ayushman Bharat card)
3. "पीएम आवास योजना में आवेदन कैसे करें" (How to apply for PM Awas)
4. "मनरेगा में कैसे रजिस्टर करें" (How to register for MGNREGA)
5. "स्टूडेंट लोन कैसे लें" (How to get student loan)
6. "प्रधानमंत्री उज्ज्वला योजना 2026" (PM Ujjwala Yojana 2026)
7. "बेटी बचाओ बेटी पढ़ाओ योजना क्या है" (What is Beti Bachao Beti Padhao)
8. "जन धन योजना में खाता कैसे खोलें" (How to open Jan Dhan account)
9. "सुकन्या समृद्धि योजना 2026" (Sukanya Samriddhi Yojana 2026)
10. "पीएम मुद्रा लोन कैसे मिलेगा" (How to get PM Mudra loan)
11. "राशन कार्ड ऑनलाइन आवेदन" (Ration card online application)
12. "वृद्धा पेंशन योजना 2026" (Old age pension scheme 2026)
13. "किसान क्रेडिट कार्ड कैसे बनाएं" (How to make Kisan Credit Card)
14. "पीएम फसल बीमा योजना में आवेदन" (Apply for PM Fasal Bima)
15. "स्वच्छ भारत मिशन 2026" (Swachh Bharat Mission 2026)
16. "डिजिटल इंडिया योजना क्या है" (What is Digital India scheme)
17. "नेशनल पेंशन स्कीम 2026" (National Pension Scheme 2026)
18. "पीएम गरीब कल्याण अन्न योजना" (PM Garib Kalyan Anna Yojana)
19. "पीएम वय वंदना योजना 2026" (PM Vay Vandana Yojana 2026)
20. "सरकारी योजनाओं की पूरी लिस्ट 2026" (Complete list of government schemes 2026)

Each article: 1,200-2,000 words, with headings, FAQs, internal links.

- [ ] **Step 5: Add article routes**

```php
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('articles.show');
```

- [ ] **Step 6: Add articles to sitemap**

- [ ] **Step 7: Test articles display and SEO meta**

- [ ] **Step 8: Commit**

```bash
git add -A
git commit -m "feat: add blog/article system with 20 SEO-optimized articles"
```

---

### Task 6: Advanced SEO Implementation

**Files:**
- Modify: `app/Http/Controllers/SchemeController.php` — add schema markup
- Modify: `resources/views/schemes/show.blade.php` — add FAQ schema
- Modify: `app/Http/Controllers/SitemapController.php` — include articles
- Create: `app/Services/SeoService.php` — centralized SEO management
- Modify: `resources/views/layouts/app.blade.php` — canonical, OG tags

- [ ] **Step 1: Create SeoService for centralized meta management**

```php
// app/Services/SeoService.php
namespace App\Services;

class SeoService
{
    public static function meta($title, $description, $keywords = null, $url = null)
    {
        return [
            'title' => $title ?: config('app.name'),
            'description' => $description ?: config('app.description'),
            'keywords' => $keywords,
            'url' => $url ?: url()->current(),
            'og_title' => $title,
            'og_description' => $description,
            'og_url' => $url ?: url()->current(),
        ];
    }
    
    public static function schema($type, $data)
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => $type,
            ...$data
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
```

- [ ] **Step 2: Add FAQ schema to scheme detail pages**

```blade
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "GovernmentService",
    "name": "{{ $scheme->title }}",
    "description": "{{ $scheme->short_description }}",
    "provider": {
        "@type": "GovernmentOrganization",
        "name": "Government of India"
    },
    "areaServed": "{{ $scheme->state?->name ?: 'India' }}",
    "serviceType": "{{ $scheme->category->name }}"
}
</script>
```

- [ ] **Step 3: Add FAQ section to scheme pages**

Create expandable FAQ sections on each scheme page targeting common questions.

- [ ] **Step 4: Update sitemap to include articles and FAQ pages**

- [ ] **Step 5: Add canonical URLs to all pages**

- [ ] **Step 6: Optimize meta titles and descriptions**

Formula: `{Scheme Name} - पात्रता, लाभ और आवेदन प्रक्रिया | UmangIndia`

- [ ] **Step 7: Add breadcrumbs with structured data**

- [ ] **Step 8: Test with Google Rich Results Test**

- [ ] **Step 9: Commit**

```bash
git add -A
git commit -m "feat: advanced SEO with Schema.org, FAQ, canonical URLs, breadcrumbs"
```

---

## Phase 3: Traffic Growth & User Engagement (Weeks 7-12)

### Task 7: WhatsApp Share & Social Features

**Files:**
- Modify: `resources/views/schemes/show.blade.php` — add share buttons
- Modify: `resources/views/layouts/app.blade.php` — floating share button
- Create: `app/Http/Controllers/ShareController.php`

- [ ] **Step 1: Add WhatsApp share button to scheme pages**

```blade
<a href="https://api.whatsapp.com/send?text={{ urlencode($scheme->title . ' - ' . url('/yojana/' . $scheme->slug)) }}" 
   target="_blank" 
   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
    WhatsApp पर शेयर करें
</a>
```

- [ ] **Step 2: Add Twitter, Facebook share buttons**

- [ ] **Step 3: Add "Copy Link" button**

- [ ] **Step 4: Add floating share sidebar on mobile**

- [ ] **Step 5: Add share counter to track viral content**

- [ ] **Step 6: Add "Share via WhatsApp" CTA at bottom of every scheme**

- [ ] **Step 7: Test all share buttons work correctly**

- [ ] **Step 8: Commit**

```bash
git add -A
git commit -m "feat: add WhatsApp and social sharing for viral growth"
```

---

### Task 8: Email Newsletter System

**Files:**
- Create: `database/migrations/2026_07_12_000003_create_subscribers_table.php`
- Create: `app/Models/Subscriber.php`
- Create: `app/Http/Controllers/SubscriberController.php`
- Create: `resources/views/components/newsletter-signup.blade.php`
- Modify: `resources/views/layouts/app.blade.php` — add signup form

- [ ] **Step 1: Create subscribers table**

```php
Schema::create('subscribers', function (Blueprint $table) {
    $table->id();
    $table->string('email')->unique();
    $table->string('name')->nullable();
    $table->boolean('is_active')->default(true);
    $table->string('token')->unique();
    $table->timestamps();
});
```

- [ ] **Step 2: Create subscriber controller for signup/confirm/unsubscribe**

- [ ] **Step 3: Create newsletter signup component**

Place in footer and after scheme content:
```blade
<div class="bg-primary-50 rounded-xl p-6 text-center">
    <h3 class="text-lg font-bold text-primary-700 mb-2">नवीनतम योजनाओं की जानकारी पाएं</h3>
    <p class="text-sm text-gray-600 mb-4">हमारे न्यूज़लेटर से जुड़ें और सभी सरकारी योजनाओं की जानकारी सबसे पहले पाएं</p>
    <form action="{{ route('subscribe') }}" method="POST" class="flex gap-2 max-w-md mx-auto">
        @csrf
        <input type="email" name="email" placeholder="अपना ईमेल दर्ज करें" required class="flex-1 px-4 py-2 rounded-lg border">
        <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded-lg">सब्सक्राइब</button>
    </form>
</div>
```

- [ ] **Step 4: Create weekly digest email template**

- [ ] **Step 5: Set up Laravel scheduler for weekly emails**

- [ ] **Step 6: Test subscription flow**

- [ ] **Step 7: Commit**

```bash
git add -A
git commit -m "feat: add email newsletter system for return traffic"
```

---

### Task 9: Performance Optimization

**Files:**
- Modify: `config/app.php` — production settings
- Modify: `resources/views/layouts/app.blade.php` — optimize assets
- Create: `app/Http/Middleware/PerformanceMiddleware.php`

- [ ] **Step 1: Enable route caching**

Run: `php artisan route:cache`
Run: `php artisan config:cache`
Run: `php artisan view:cache`

- [ ] **Step 2: Add lazy loading to images**

```blade
<img loading="lazy" src="..." alt="..." width="..." height="...">
```

- [ ] **Step 3: Optimize database queries with eager loading**

```php
// In SchemeController
$schemes = Scheme::with(['category', 'state'])
    ->active()
    ->latestPublished()
    ->paginate(20);
```

- [ ] **Step 4: Add GZIP compression middleware**

- [ ] **Step 5: Optimize CSS delivery (critical CSS inline)**

- [ ] **Step 6: Add CDN for static assets**

- [ ] **Step 7: Test PageSpeed score**

Target: 80+ on mobile, 90+ on desktop

- [ ] **Step 8: Commit**

```bash
git add -A
git commit -m "perf: optimize performance for Core Web Vitals"
```

---

## Phase 4: Launch & Growth (Weeks 13-26)

### Task 10: Google Search Console & Analytics Setup

- [ ] **Step 1: Verify site in Google Search Console**

- [ ] **Step 2: Submit XML sitemap**

- [ ] **Step 3: Set up Google Analytics 4**

- [ ] **Step 4: Create Google Business Profile**

- [ ] **Step 5: Set up Bing Webmaster Tools**

- [ ] **Step 6: Monitor indexing status daily for first week**

- [ ] **Step 7: Commit**

```bash
git add -A
git commit -m "feat: add Search Console and Analytics tracking"
```

---

### Task 11: Content Marketing & Link Building

- [ ] **Step 1: Create Quora account and answer 50 scheme-related questions**

Target questions:
- "PM Kisan का पैसा कैसे चेक करें?"
- "Ayushman Bharat card कैसे बनाएं?"
- "Government schemes for farmers 2026"
- Link back to relevant UmangIndia pages

- [ ] **Step 2: Join 20+ WhatsApp groups related to government schemes**

Share valuable content (not spam) - 1-2 articles per week per group

- [ ] **Step 3: Guest post on 5 Indian Hindi blogs**

Topics: "Top 10 Government Schemes for Farmers", "Complete Guide to PM Awas Yojana"

- [ ] **Step 4: Create shareable infographics**

Use Canva to create:
- "सरकारी योजनाओं की पूरी लिस्ट 2026"
- "पीएम किसान योजना - स्टेप बाय स्टेप गाइड"
- "आयुष्मान भारत - पात्रता और लाभ"

- [ ] **Step 5: Submit to Indian business directories**

- [ ] **Step 6: Create YouTube channel (optional, high effort)**

Short videos explaining schemes in Hindi

- [ ] **Step 7: Commit progress**

```bash
git add -A
git commit -m "docs: content marketing and link building progress"
```

---

### Task 12: AdSense Application & Optimization

- [ ] **Step 1: Verify AdSense eligibility checklist**

- [x] 20+ quality articles (1,200+ words each) ✓
- [x] Trust pages (About, Contact, Privacy, Disclaimer) ✓
- [x] HTTPS enabled ✓
- [x] Mobile responsive ✓
- [x] Original content ✓
- [ ] Real author byline
- [ ] 2-3 months of active publishing

- [ ] **Step 2: Apply for Google AdSense**

- [ ] **Step 3: Place ad codes after approval**

Ad placements for maximum revenue:
- Header banner (728x90 or responsive)
- In-article ads (between scheme content)
- Sidebar ads (300x250)
- Footer banner
- Mobile anchor ads

- [ ] **Step 4: Optimize ad placements for RPM**

Test different positions:
- Above the fold vs below
- In-content vs sidebar
- Anchor ads on mobile

- [ ] **Step 5: Monitor and adjust**

Track: CTR, CPC, RPM, pageviews
Target RPM: ₹150-300 for Indian traffic

- [ ] **Step 6: Commit**

```bash
git add -A
git commit -m "feat: AdSense integration and optimization"
```

---

## Revenue Projections

| Month | Pageviews | RPM (₹) | Monthly Revenue (₹) |
|-------|-----------|---------|---------------------|
| 1 | 500 | 0 | 0 (pre-approval) |
| 2 | 2,000 | 0 | 0 (pre-approval) |
| 3 | 5,000 | 150 | 750 |
| 4 | 15,000 | 200 | 3,000 |
| 5 | 30,000 | 250 | 7,500 |
| 6 | 50,000 | 300 | 15,000 |

**Conservative estimate:** ₹5,000-15,000/month by month 6
**Optimistic estimate:** ₹15,000-25,000/month by month 6

## Key Success Factors

1. **Hindi content** — 90% of target audience searches in Hindi
2. **Scheme coverage** — 200+ schemes beats most competitors
3. **SEO optimization** — Schema.org, FAQs, internal linking
4. **WhatsApp virality** — Indian users share scheme info in family groups
5. **Fresh content** — Weekly updates on new schemes and deadline reminders
6. **Mobile-first** — 80%+ traffic will be mobile
7. **Trust signals** — Real author, contact info, privacy policy

## Risk Mitigation

| Risk | Mitigation |
|------|------------|
| AdSense rejection | Apply after 3 months, 30+ articles, real traffic |
| Low RPM | Target high-CPC niches (finance, insurance schemes) |
| Competition | Focus on Hindi content + comprehensive coverage |
| Content freshness | Weekly admin updates on scheme changes |
| Technical issues | Performance optimization, caching, CDN |

---

**Plan complete and saved to `docs/superpowers/plans/2026-07-12-umangindia-growth-plan.md`.**

Two execution options:

**1. Subagent-Driven (recommended)** — I dispatch a fresh subagent per task, review between tasks, fast iteration

**2. Inline Execution** — Execute tasks in this session using executing-plans, batch execution with checkpoints

Which approach?

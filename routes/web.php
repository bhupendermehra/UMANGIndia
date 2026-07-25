<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\EligibilityController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SchemeController as AdminSchemeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\StateController as AdminStateController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SeoDraftController;
use App\Http\Controllers\Admin\SeoMonitorController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Api\SeoDraftImportController;
use Illuminate\Support\Facades\Route;

// Language switcher
Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'hi'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/yojana', [SchemeController::class, 'index'])->name('schemes.index');
Route::get('/yojana/{scheme}', [SchemeController::class, 'show'])->name('schemes.show');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/state/{state}', [StateController::class, 'show'])->name('states.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/latest', [SchemeController::class, 'latest'])->name('schemes.latest');

// Static pages
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('pages.privacy');
Route::get('/disclaimer', [PageController::class, 'disclaimer'])->name('pages.disclaimer');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('pages.terms');

// SEO routes
Route::get('/sitemap.xml', [SitemapController::class, 'xml'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Article routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Share tracking
Route::post('/share/track', [ShareController::class, 'track'])->name('share.track');

// Comparison Tool
Route::get('/compare', [CompareController::class, 'index'])->name('compare.index');
Route::post('/compare', [CompareController::class, 'compare'])->name('compare.result');

// Eligibility Checker
Route::get('/check-eligibility', [EligibilityController::class, 'index'])->name('eligibility.index');
Route::post('/check-eligibility/step2', [EligibilityController::class, 'step2'])->name('eligibility.step2');
Route::post('/check-eligibility/result', [EligibilityController::class, 'result'])->name('eligibility.result');

// Deadline Calendar
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

// PDF Downloads
Route::get('/downloads', [PdfController::class, 'index'])->name('pdfs.index');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Notification acknowledgment
Route::post('/notification/acknowledge/{notification}', function (\App\Models\Notification $notification) {
    session(['notification_acknowledged_' . $notification->id => true]);
    return response()->json(['success' => true]);
})->name('notification.acknowledge');

// Login redirect (for auth middleware compatibility)
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Routes (protected)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Schemes CRUD
    Route::resource('schemes', AdminSchemeController::class)->except(['show']);

    // Categories CRUD
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    // States CRUD
    Route::resource('states', AdminStateController::class)->except(['show']);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Articles CRUD (enhanced)
    Route::resource('articles', AdminArticleController::class)->except(['show']);
    Route::post('articles/{article}/restore', [AdminArticleController::class, 'restore'])->name('articles.restore');
    Route::post('articles/bulk-action', [AdminArticleController::class, 'bulkAction'])->name('articles.bulk-action');

    // Notifications CRUD
    Route::resource('notifications', NotificationController::class)->except(['show']);

    // SEO Drafts (from SEO Agent)
    Route::resource('seo-drafts', SeoDraftController::class)->only(['index', 'show']);
    Route::post('seo-drafts/{draft}/approve', [SeoDraftController::class, 'approve'])->name('seo-drafts.approve');
    Route::post('seo-drafts/{draft}/reject', [SeoDraftController::class, 'reject'])->name('seo-drafts.reject');
    Route::post('seo-drafts/{draft}/publish', [SeoDraftController::class, 'publishAsArticle'])->name('seo-drafts.publish');

    // SEO Monitor
    Route::get('seo-monitor', [SeoMonitorController::class, 'index'])->name('seo-monitor.index');
    Route::post('seo-monitor/run-check', [SeoMonitorController::class, 'runCheck'])->name('seo-monitor.run-check');

    // Activity Logs
    Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::post('activity-logs/clear', [ActivityLogController::class, 'clear'])->name('activity-logs.clear');
});

// API Routes (no CSRF for SEO agent)
Route::prefix('api')->group(function () {
    Route::post('seo-agent/import-draft', [SeoDraftImportController::class, 'import']);
    Route::get('seo-agent/health', [SeoDraftImportController::class, 'health']);
});
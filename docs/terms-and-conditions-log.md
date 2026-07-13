# Terms & Conditions Page — Build Log

## Files Created / Changed

### Created
- `resources/views/pages/terms.blade.php` — New Terms & Conditions page view (mirrors `privacy.blade.php` structure with required sections).
- `docs/terms-and-conditions-log.md` — This log file.

### Changed
- `app/Http/Controllers/PageController.php` — Added `terms()` method returning `view('pages.terms')`.
- `routes/web.php` — Added route `Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('pages.terms');` after the disclaimer route (line 48).
- `resources/views/layouts/app.blade.php` — Added Terms & Conditions link inside the Legal `<ul>` (after Disclaimer link, line 296).

## Route / URL of New Page
- URL: `/terms-and-conditions`
- Named route: `pages.terms`

## Footer Link
- Confirmed: Terms & Conditions link added to the footer Legal section using `{{ route('pages.terms') }}`.

## Issues / Blockers
None

# Sitemap Fix Log

## Date: July 13, 2026

---

## Fix 1: `View [sitemap.xml] not found`

### What Was Found (Broken Code)

**File:** `app/Http/Controllers/SitemapController.php`, line 20

```php
// BEFORE (broken)
return response()
    ->view('sitemap.xml', compact('schemes', 'categories', 'states', 'articles'))
    ->header('Content-Type', 'application/xml');
```

**Problem:** In Laravel, dots in view names are treated as directory separators. `view('sitemap.xml')` tells Laravel to look for `resources/views/sitemap/xml.blade.php` instead of the actual file `resources/views/sitemap.blade.php`. The file doesn't exist at that path, so Laravel throws: `View [sitemap.xml] not found`.

### What Was Changed

**File:** `app/Http/Controllers/SitemapController.php`, line 19-21

```php
// AFTER (fixed)
return response()
    ->view('sitemap', compact('schemes', 'categories', 'states', 'articles'))
    ->header('Content-Type', 'text/xml');
```

**Changes:**
1. `view('sitemap.xml')` → `view('sitemap')` — removed `.xml` so Laravel finds the correct view file
2. `Content-Type` changed from `application/xml` → `text/xml` — proper MIME type for sitemaps per sitemaps.org specification

### Confirmation — Sitemap Renders Correctly

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Homepage -->
    <url>
        <loc>http://localhost:8000</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <!-- Schemes Index -->
    <url>
        <loc>http://localhost:8000/yojana</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <!-- ... more URLs ... -->
</urlset>
```

Valid XML output confirmed. All scheme, category, state, article, and static page URLs present.

---

## Fix 2: `Call to undefined function Illuminate\Filesystem\exec()`

### What Was Found

**Source:** `vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php`, lines 358 and 364

```php
// Laravel's Filesystem::link() method
return exec('ln -s '.escapeshellarg($target).' '.escapeshellarg($link)) !== false;
// and on Windows:
exec("mklink /{$mode} ".escapeshellarg($link).' '.escapeshellarg($target));
```

**Cause:** This error comes from Laravel's internal `Filesystem::link()` method, which is called when:
- Running `php artisan storage:link`
- Any code using `Storage::link()` or `File::link()`
- Some package operations that create symlinks

**This is NOT your application code.** It's Laravel's core filesystem utility trying to create symlinks (typically `public/storage → storage/app/public`). Hostinger shared hosting disables `exec()` for security, so any symlink operation fails.

### Does It Need Fixing?

**No — it's safe to ignore** unless you specifically need `storage:link`. Here's why:

- If you're not using file uploads publicly (or files are served differently), you don't need the symlink
- The error only appears if someone triggered `storage:link` or a symlink operation
- Your app works fine without it if you're not serving files from `storage/app/public`

**If you DO need public file storage**, alternatives on shared hosting:
1. Manually create a symlink via Hostinger File Manager (if supported)
2. Copy files to `public/` directly instead of symlinking
3. Use a cloud storage driver (S3, Cloudflare R2) — avoids `exec()` entirely

### Recommendation

**Can wait.** This is a hosting environment limitation, not a code bug. Only fix if file uploads/public storage stops working.

---

## Files Modified

| File | Change |
|------|--------|
| `app/Http/Controllers/SitemapController.php` | `view('sitemap.xml')` → `view('sitemap')`, content-type fixed |

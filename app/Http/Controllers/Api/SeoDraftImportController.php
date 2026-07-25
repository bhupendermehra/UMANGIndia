<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SeoDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;

class SeoDraftImportController extends Controller
{
    public function import(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:100',
            'excerpt' => 'nullable|string|max:500',
            'target_keyword' => 'nullable|string|max:100',
            'source_url' => 'nullable|url',
            'seo_agent_run_id' => 'nullable|string|max:50',
            'api_token' => 'required|string',
        ]);

        // Simple API auth
        $token = config('app.seo_agent_token', env('SEO_AGENT_TOKEN', ''));
        if (empty($token)) {
            return response()->json(['error' => 'SEO Agent token not configured'], 500);
        }

        if (!hash_equals($token, $validated['api_token'])) {
            return response()->json(['error' => 'Invalid API token'], 401);
        }

        // Check for duplicate
        $existing = SeoDraft::where('title', $validated['title'])
            ->where('status', '!=', 'rejected')
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Draft already exists',
                'draft_id' => $existing->id,
                'status' => $existing->status,
            ], 200);
        }

        $draft = SeoDraft::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'target_keyword' => $validated['target_keyword'] ?? null,
            'source_url' => $validated['source_url'] ?? null,
            'seo_agent_run_id' => $validated['seo_agent_run_id'] ?? null,
            'status' => 'pending_review',
        ]);

        return response()->json([
            'message' => 'Draft imported successfully',
            'draft_id' => $draft->id,
            'status' => 'pending_review',
        ], 201);
    }

    public function health(Request $request)
    {
        return response()->json([
            'status' => 'ok',
            'timestamp' => now()->toIso8601String(),
            'php_version' => PHP_VERSION,
        ]);
    }
}

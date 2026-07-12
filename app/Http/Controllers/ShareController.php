<?php

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function track(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'id' => 'required|integer',
            'platform' => 'required|in:whatsapp,twitter,facebook',
        ]);

        $modelClass = match ($validated['type']) {
            'scheme' => \App\Models\Scheme::class,
            'article' => \App\Models\Article::class,
            default => null,
        };

        if (!$modelClass) {
            return response()->json(['error' => 'Invalid type'], 422);
        }

        Share::create([
            'shareable_type' => $modelClass,
            'shareable_id' => $validated['id'],
            'platform' => $validated['platform'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true]);
    }
}
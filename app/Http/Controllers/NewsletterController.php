<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:100',
        ]);

        $existing = Subscriber::where('email', $validated['email'])->first();
        if ($existing) {
            if (!$existing->is_active) {
                $existing->update(['is_active' => true, 'subscribed_at' => now()]);
            }
            return back()->with('success', 'You are already subscribed!');
        }

        Subscriber::create([
            'email' => $validated['email'],
            'name' => $validated['name'] ?? null,
        ]);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }

    public function unsubscribe(Request $request, string $token)
    {
        $subscriber = Subscriber::where('token', $token)->firstOrFail();
        $subscriber->update([
            'is_active' => false,
            'unsubscribed_at' => now(),
        ]);

        return redirect('/')->with('success', 'You have been unsubscribed successfully.');
    }
}
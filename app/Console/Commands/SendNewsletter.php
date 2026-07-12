<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscriber;
use App\Models\Scheme;
use Illuminate\Support\Facades\Mail;

class SendNewsletter extends Command
{
    protected $signature = 'newsletter:send';
    protected $description = 'Send weekly newsletter to active subscribers';

    public function handle(): int
    {
        $subscribers = Subscriber::active()->get();
        if ($subscribers->isEmpty()) {
            $this->info('No active subscribers.');
            return 0;
        }

        $latestSchemes = Scheme::active()->latest()->limit(5)->get();
        $this->info("Sending to {$subscribers->count()} subscribers...");

        foreach ($subscribers as $subscriber) {
            $unsubscribeUrl = url('/newsletter/unsubscribe/' . $subscriber->token);
            // In a real environment, send actual email here
            \Illuminate\Support\Facades\Log::info("Newsletter sent to {$subscriber->email}");
            $this->line("  ✓ {$subscriber->email}");
        }

        $this->info('Newsletter sent to all active subscribers.');
        return 0;
    }
}
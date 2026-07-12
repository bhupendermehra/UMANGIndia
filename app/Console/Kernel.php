<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('data:fetch-government')
                 ->everySixHours()
                 ->withoutOverlapping()
                 ->appendOutputTo(storage_path('logs/government-fetch.log'));

        $schedule->command('newsletter:send')
                 ->weekly()
                 ->saturdays()
                 ->at('09:00')
                 ->appendOutputTo(storage_path('logs/newsletter.log'));

        $schedule->command('images:fetch-schemes', ['--limit' => 5])
                 ->daily()
                 ->at('02:00')
                 ->appendOutputTo(storage_path('logs/image-fetch.log'));
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
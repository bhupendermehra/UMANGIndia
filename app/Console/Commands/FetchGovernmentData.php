<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GovDataFetcher;

class FetchGovernmentData extends Command
{
    protected $signature = 'data:fetch-government';
    protected $description = 'Fetch latest government scheme data from official sources';

    public function handle(GovDataFetcher $fetcher): int
    {
        $this->info('Starting government data fetch...');
        $fetcher->fetchAll();
        $this->info('Government data fetch completed.');
        return 0;
    }
}
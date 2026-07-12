<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\SchemeUpdate;
use App\Services\BlogGenerator;
use Illuminate\Support\Facades\Log;

class GenerateArticleFromUpdate implements ShouldQueue
{
    use Queueable;

    protected int $updateId;

    public function __construct(int $updateId)
    {
        $this->updateId = $updateId;
    }

    public function handle(BlogGenerator $generator): void
    {
        $update = SchemeUpdate::find($this->updateId);
        if (!$update) return;

        $article = $generator->generateFromUpdate($update);
        if ($article) {
            Log::info("Auto-generated article for update {$this->updateId}: {$article->title}");
        }
    }
}
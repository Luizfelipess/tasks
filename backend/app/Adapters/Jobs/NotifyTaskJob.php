<?php

namespace App\Adapters\Jobs;

use App\Application\UseCases\NotifySingleTaskUseCase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $taskId
    ) {}

    public function handle(NotifySingleTaskUseCase $useCase): void
    {
        $useCase->execute($this->taskId);
    }
}

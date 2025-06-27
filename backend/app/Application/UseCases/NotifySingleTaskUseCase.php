<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\TaskRepositoryInterface;
use Illuminate\Support\Facades\Log;

class NotifySingleTaskUseCase
{
    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute(int $taskId): void
    {
        $task = $this->repository->findById($taskId);

        if (!$task || $task->is_notified) {
            Log::info("Náo tem tarefas para serem notificadas...");
        }

        Log::info("Notificando tarefa: {$task->title}");

        $task->is_notified = true;
        $this->repository->save($task);

        Log::info("Tarefa [{$task->id}] notificada com sucesso.");
    }
}

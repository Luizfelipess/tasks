<?php

namespace App\Application\UseCases;

use App\Domain\Services\TaskNotifierInterface;
use App\Infra\Repositories\EloquentTaskRepository;

class NotifyPendingTasksUseCase
{
    public function __construct(private TaskNotifierInterface $notifier)
    {
    }

    public function execute(): void
    {
        $repository = new EloquentTaskRepository();
        $tasks = $repository->getPendingTasks();

        foreach ($tasks as $task) {
            $this->notifier->notify($task);
        }
    }
}

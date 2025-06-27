<?php

namespace App\Domain\Services;

use App\Infra\Models\Task;

interface TaskNotifierInterface
{
    public function notify(Task $task): void;
}

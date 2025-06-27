<?php

namespace App\Infra\Repositories;

use App\Domain\Repositories\TaskRepositoryInterface;
use App\Infra\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function list(int $perPage = 20): LengthAwarePaginator
    {
        return Task::paginate($perPage);
    }

    public function getPendingTasks(): Collection
    {
        return Task::where('scheduled_to', '<=', now())
            ->where('is_notified', false)
            ->get();
    }

    public function findById(int $id): ?Task
    {
        return Task::find($id);
    }

    public function save(Task $task): void
    {
        $task->save();
    }
}

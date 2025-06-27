<?php

namespace App\Domain\Repositories;

use App\Infra\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function list(int $perPage = 20): LengthAwarePaginator;

    public function getPendingTasks(): Collection;

    public function findById(int $id): ?Task;

    public function save(Task $task): void;
}

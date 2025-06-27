<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\TaskRepositoryInterface;

class GetAllTasksUseCase
{
    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function handle(int $perPage = 20)
    {
        return $this->repository->list($perPage);
    }
}

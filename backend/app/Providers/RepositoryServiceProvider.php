<?php


namespace App\Providers;

use App\Domain\Repositories\TaskRepositoryInterface;
use App\Infra\Repositories\EloquentTaskRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            TaskRepositoryInterface::class,
            EloquentTaskRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}

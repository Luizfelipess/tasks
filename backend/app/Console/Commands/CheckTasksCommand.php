<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Infra\Repositories\EloquentTaskRepository;
use App\Adapters\Jobs\NotifyTaskJob;

class CheckTasksCommand extends Command
{
    protected $signature = 'check:tasks';
    protected $description = 'Verifica tarefas agendadas e despacha jobs de notificação';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Buscando tarefas pendentes para notificação...');

        $repository = new EloquentTaskRepository();
        $tasks = $repository->getPendingTasks();

        if ($tasks->isEmpty()) {
            $this->warn('Nenhuma tarefa pendente encontrada.');
            return 0;
        }

        foreach ($tasks as $task) {
            NotifyTaskJob::dispatch($task->id);
            $this->info("Job para tarefa [ID: {$task->id}] despachado.");
        }

        $this->info("Total: {$tasks->count()} tarefa(s) despachada(s).");
        return 0;
    }
}

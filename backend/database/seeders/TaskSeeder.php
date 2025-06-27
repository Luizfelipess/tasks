<?php

namespace Database\Seeders;

use App\Infra\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::factory(10)->create();
    }
}

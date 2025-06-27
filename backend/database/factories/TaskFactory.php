<?php

namespace Database\Factories;

use App\Infra\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Infra\Models\Task> */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title'        => $this->faker->word(),
            'description'  => $this->faker->text(),
            'scheduled_to' => Carbon::now(),
            'is_notified'  => $this->faker->boolean(),
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ];
    }
}

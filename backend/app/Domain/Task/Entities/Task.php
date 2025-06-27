<?php

namespace App\Domain\Task\Entities;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public \DateTimeInterface $scheduledTo,
        public bool $isNotified,
    ) {}
}

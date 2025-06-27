<?php

namespace App\Infra\Models;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected static string $factory = TaskFactory::class;

    protected $casts = [
        'is_notified'  => 'boolean',
        'scheduled_to' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    protected $guarded = ['id'];

}

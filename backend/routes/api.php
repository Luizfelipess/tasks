<?php

use App\Adapters\Controllers\TaskListController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('tasks', TaskListController::class);
});

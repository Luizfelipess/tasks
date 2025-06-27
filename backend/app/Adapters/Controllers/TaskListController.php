<?php

namespace App\Adapters\Controllers;

use App\Application\UseCases\GetAllTasksUseCase;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function __invoke(Request $request, GetAllTasksUseCase $useCase)
    {
        $perPage = (int) $request->query('per_page', 20);
        $paginator = $useCase->handle($perPage);
        return $this->successResponse($paginator);
    }
}

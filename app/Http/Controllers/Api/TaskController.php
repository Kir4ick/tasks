<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Task\ListRequest;
use App\Services\Contracts\ITaskService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskCollectionResource;
use App\Http\Resources\TaskResource;

/**
 * Resource контроллер для задач
 * Здесь методы CRUD для таблицы tasks модели Task
 */
class TaskController extends Controller
{

    public function index(ListRequest $request)
    {
        return TaskCollectionResource::collection($this->taskService->list($request->validationData()));
    }

    public function store(CreateRequest $request)
    {
        return new TaskResource($this->taskService->create($request->validationData()));
    }

    public function show(string $uuid)
    {
        return new TaskResource($this->taskService->one($uuid));
    }

    public function update(UpdateRequest $request, string $uuid)
    {
        return new TaskResource($this->taskService->update($uuid, $request->validationData()));
    }

    public function destroy(string $uuid)
    {
        return new TaskResource($this->taskService->delete($uuid));
    }

    public function __construct(
        private readonly ITaskService $taskService
    ){}
}

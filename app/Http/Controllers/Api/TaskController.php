<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Task\ListRequest;
use App\Services\Contracts\ITaskService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskCollectionResource;
use App\Http\Resources\TaskResource;
use App\Swagger\Models\Tasks\Requests\CreateTaskRequest;
use App\Swagger\Models\Tasks\Requests\GetListTaskRequest;
use App\Swagger\Models\Tasks\Requests\UpdateTaskRequest;
use App\Swagger\Models\Tasks\Responses\ListTask;
use App\Swagger\Models\Tasks\Responses\Task;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Put;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;

class TaskController extends Controller
{

    #[Get(
        path: '/api/tasks',
        operationId: 'last-task',
        security: [['bearerAuth' => []]],
        requestBody: new RequestBody(
            description: 'Тело запроса фильтров',
            required: false,
            content: new JsonContent(
                ref: '#/components/schemas/GetListTaskRequest'
            ),
        ),
        tags: ['tasks'],
        responses: [
            new Response(
                response: 200,
                description: 'Пример успешного ответа',
                content: new JsonContent(
                    ref: '#/components/schemas/ListTask'
                ),
            ),
            new Response(
                response: '401',
                description: 'Не авторизован',
            ),
        ]
    )]
    public function index(ListRequest $request)
    {
        return TaskCollectionResource::collection($this->taskService->list($request->validationData()));
    }

    #[Post(
        path: '/api/tasks',
        operationId: 'create-task',
        security: [['bearerAuth' => []]],
        requestBody: new RequestBody(
            description: 'Тело запроса для создания задачи',
            required: true,
            content: new JsonContent(
                ref: '#/components/schemas/CreateTaskRequest'
            ),
        ),
        tags: ['tasks'],
        responses: [
            new Response(
                response: 200,
                description: 'Пример успешного ответа',
                content: new JsonContent(
                    ref: '#/components/schemas/Task'
                ),
            ),
            new Response(
                response: '401',
                description: 'Не авторизован',
            ),
            new Response(
                response: '422',
                description: 'Ошибка валидации',
            ),
        ]
    )]
    public function store(CreateRequest $request)
    {
        return new TaskResource($this->taskService->create($request->validationData()));
    }

    #[Get(
        path: '/api/tasks/{uuid}',
        operationId: 'one-task',
        security: [['bearerAuth' => []]],
        tags: ['tasks'],
        parameters: [
            new Parameter(
                name: 'uuid',
                description: 'uuid задачи',
                in: 'path',
                required: true
            )
        ],
        responses: [
            new Response(
                response: 200,
                description: 'Пример успешного ответа',
                content: new JsonContent(
                    ref: '#/components/schemas/Task'
                ),
            ),
            new Response(
                response: 401,
                description: 'Не авторизован',
            ),
            new Response(
                response: 404,
                description: 'Не найдено',
            ),
        ]
    )]
    public function show(string $uuid)
    {
        return new TaskResource($this->taskService->one($uuid));
    }

    #[Put(
        path: '/api/tasks/{uuid}',
        operationId: 'update-task',
        security: [['bearerAuth' => []]],
        requestBody: new RequestBody(
            description: 'Тело запроса для обновления задачи',
            required: true,
            content: new JsonContent(
                ref: '#/components/schemas/UpdateTaskRequest'
            ),
        ),
        tags: ['tasks'],
        parameters: [
            new Parameter(
                name: 'uuid',
                description: 'uuid задачи',
                in: 'path',
                required: true
            )
        ],
        responses: [
            new Response(
                response: 200,
                description: 'Пример успешного ответа',
                content: new JsonContent(
                    ref: '#/components/schemas/Task'
                ),
            ),
            new Response(
                response: '401',
                description: 'Не авторизован',
            ),
            new Response(
                response: '404',
                description: 'Не найдено',
            ),
            new Response(
                response: '403',
                description: 'Нет доступа',
            ),
            new Response(
                response: '422',
                description: 'Ошибки валидации',
            ),
        ]
    )]
    public function update(UpdateRequest $request, string $uuid)
    {
        return new TaskResource($this->taskService->update($uuid, $request->validationData()));
    }

    #[Delete(
        path: '/api/tasks/{uuid}',
        operationId: 'delete-task',
        security: [['bearerAuth' => []]],
        tags: ['tasks'],
        parameters: [
            new Parameter(
                name: 'uuid',
                description: 'uuid задачи',
                in: 'path',
                required: true
            )
        ],
        responses: [
            new Response(
                response: 200,
                description: 'Пример успешного ответа',
                content: new JsonContent(
                    ref: '#/components/schemas/Task'
                ),
            ),
            new Response(
                response: '401',
                description: 'Не авторизован',
            ),
            new Response(
                response: '404',
                description: 'Не найдено',
            ),
            new Response(
                response: '403',
                description: 'Нет доступа',
            ),
        ]
    )]
    public function destroy(string $uuid)
    {
        return new TaskResource($this->taskService->delete($uuid));
    }

    public function __construct(
        private readonly ITaskService $taskService
    ){}
}

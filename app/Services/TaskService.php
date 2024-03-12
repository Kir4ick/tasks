<?php

namespace App\Services;

use App\Filters\TaskFilter;
use App\Models\Task;
use App\Services\Contracts\ITaskService;
use App\Exceptions\Api\AccessDeniedException;
use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\InternalException;
use App\Exceptions\Api\NotFoundException;
use App\Repositories\Contracts\ITaskRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Ramsey\Uuid\Uuid;

/**
 * CRUD операции для задач
 */
class TaskService implements ITaskService
{

    /**
     * @inheritDoc
     */
    public function create(array $createData): Task
    {
        return $this->taskRepository->create($createData);
    }

    /**
     * @inheritDoc
     */
    public function update(string $uuid, array $updateData): Task
    {
        # Т к нет проверки валидации на то, что хоть одно поле заполнено из нескольких
        # То проверяем здесь на пустоту
        if (empty($updateData)) {
            throw new BadRequestException('Не было передано данных для обновления');
        }

        if (!Uuid::isValid($uuid)) {
            throw new BadRequestException('UUID неправильного формата');
        }

        $updated_task = $this->taskRepository->one($uuid);
        if ($updated_task == null) {
            throw new NotFoundException(
                sprintf('Задача с uuid %s не найдена', $uuid)
            );
        }

        if (!Gate::inspect('update', $updated_task)->allowed()) {
            throw new AccessDeniedException();
        }

        $result = $this->taskRepository->update($updated_task, $updateData);
        if ($result == null) {
            throw new InternalException('Не удалось обновить запись');
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $uuid): Task
    {
        if (!Uuid::isValid($uuid)) {
            throw new BadRequestException('UUID неправильного формата');
        }

        $deleted_task = $this->taskRepository->one($uuid);
        if ($deleted_task == null) {
            throw new NotFoundException(
                sprintf('Задача с uuid %s не найдена', $uuid)
            );
        }

        if (!Gate::inspect('delete', $deleted_task)->allowed()) {
            throw new AccessDeniedException();
        }

        if (!$this->taskRepository->delete($deleted_task)) {
            throw new InternalException('Не удалось удалить запись');
        }

        return $deleted_task;
    }

    /**
     * @inheritDoc
     */
    public function list(array $filterList): LengthAwarePaginator
    {
        if (isset($filterList[TaskFilter::MY_RECORDS]) && $filterList[TaskFilter::MY_RECORDS]) {
            $filterList[TaskFilter::CREATED_BY] = Auth::user()->getAuthIdentifier();
        }

        return $this->taskRepository->list($filterList);
    }

    /**
     * @inheritDoc
     */
    public function one(string $uuid): Task
    {
        if (!Uuid::isValid($uuid)) {
            throw new BadRequestException('UUID неправильного формата');
        }

        $task = $this->taskRepository->one($uuid);
        if (!$task) {
            throw new NotFoundException(
                sprintf('Задача с uuid %s не найдена', $uuid)
            );
        }

        return $task;
    }

    public function __construct(
        private readonly ITaskRepository $taskRepository
    ){}
}

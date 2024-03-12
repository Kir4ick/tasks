<?php

namespace App\Services;

use App\Filters\TaskFilter;
use App\Services\Contracts\ITaskService;
use App\Exceptions\Api\AccessDeniedException;
use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\InternalException;
use App\Exceptions\Api\NotFoundException;
use App\Repositories\Contracts\ITaskRepository;
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
    public function create(array $created_data)
    {
        $created_data['created_by'] = Auth::user()->getAuthIdentifier();

        return $this->taskRepository->create($created_data);
    }

    /**
     * @inheritDoc
     */
    public function update(string $uuid, array $updated_data)
    {
        # Т к нет проверки валидации на то, что хоть одно поле заполнено из нескольких
        # То проверяем здесь на пустоту
        if (empty($updated_data)) {
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

        return $this->taskRepository->update($updated_task, $updated_data);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $uuid)
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
    public function list(array $filterList)
    {
        if (isset($filterList[TaskFilter::MY_RECORDS]) && $filterList[TaskFilter::MY_RECORDS]) {
            $filterList[TaskFilter::CREATED_BY] = Auth::user()->getAuthIdentifier();
        }

        return $this->taskRepository->list($filterList);
    }

    /**
     * @inheritDoc
     */
    public function one(string $uuid)
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

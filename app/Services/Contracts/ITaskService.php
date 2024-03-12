<?php

namespace App\Services\Contracts;

use App\Exceptions\Api\NotFoundException;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ITaskService
{

    /**
     * Создание задачи
     *
     * @param array{title: string} $createData
     * @return Task
     */
    public function create(array $createData): Task;

    /**
     * Обновление задачи
     *
     * @param string $uuid
     * @param array{status: string, title: string} $updateData
     *
     * @return Task
     *@throws NotFoundException
     */
    public function update(string $uuid, array $updateData): Task;

    /**
     * Удаление задачи
     *
     * @param string $uuid
     * @return Task
     */
    public function delete(string $uuid): Task;

    /**
     * Вывод списка задач
     *
     * @param array $filterList
     *
     * @return Collection<Task>
     */
    public function list(array $filterList): LengthAwarePaginator;

    /**
     * Получение одной задачи
     *
     * @param string $uuid
     * @return Task
     */
    public function one(string $uuid): Task;
}

<?php

namespace App\Repositories\Contracts;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ITaskRepository
{

    /**
     * Вывод одной задачи
     *
     * @param string $uuid
     * @return null|Task
     */
    public function one(string $uuid): ?Task;

    /**
     * Вывод списка задач по фильтрам
     *
     * @param array $filterList
     * @return LengthAwarePaginator<Task>
     */
    public function list(array $filterList): LengthAwarePaginator;

    /**
     * Создание задачи
     *
     * @param array{
     *     title: string,
     *     createdBy: string
     * } $createdFields
     * @return null|Task
     */
    public function create(array $createdFields): ?Task;

    /**
     * Обновление задачи
     *
     * @param Task $task
     * @param array $updatedFields
     * @return Task
     */
    public function update(Task $task, array $updatedFields): ?Task;

    /**
     * Удаление задачи
     *
     * @param string $uuid
     * @return bool
     */
    public function delete(Task $task): bool;
}

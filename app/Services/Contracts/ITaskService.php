<?php

namespace App\Services\Contracts;

use App\Exceptions\Api\NotFoundException;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface ITaskService
{

    /**
     * Создание задачи
     *
     * @param array{title: string} $created_data
     * @return Task
     */
    public function create(array $created_data);

    /**
     * Обновление задачи
     *
     * @param string $uuid
     * @param array{status: string, title: string} $updated_data
     *
     * @throws NotFoundException
     * @return Task
     */
    public function update(string $uuid, array $updated_data);

    /**
     * Удаление задачи
     *
     * @param string $uuid
     * @return Task
     */
    public function delete(string $uuid);

    /**
     * Вывод списка задач
     *
     * @param array $filterList
     *
     * @return Collection<Task>
     */
    public function list(array $filterList);

    /**
     * Получение одной задачи
     *
     * @param string $uuid
     * @return Task
     */
    public function one(string $uuid);
}

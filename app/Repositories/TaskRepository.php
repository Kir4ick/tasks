<?php

namespace App\Repositories;

use App\Filters\TaskFilter;
use App\Models\Task;
use App\Repositories\Contracts\ITaskRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository implements ITaskRepository
{

    public function one(string $uuid): ?Task
    {
        return Task::query()->find($uuid);
    }

    public function list(array $filterList): LengthAwarePaginator
    {
        return Task::filter(new TaskFilter(), $filterList)->paginate(
            $filterList[TaskFilter::LIMIT] ?? null,
            $filterList['columns'] ?? ['*'],
            TaskFilter::PAGE,
            $filterList[TaskFilter::PAGE] ?? null
        );
    }

    public function create(array $createdFields): ?Task
    {
        return Task::query()->create($createdFields);
    }

    public function update(Task $task, array $updatedFields): ?Task
    {
        $task->update($updatedFields);

        return $task;
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}

<?php

namespace App\Http\Policies;

use App\Models\Task;
use App\Models\User;

/**
 * Класс для проверки возможности действия с определенными сущностями
 */
class TaskPolicy
{
    public function update(User $user, Task $task): bool
    {
        return $this->checkUUIDs($user, $task);
    }

    public function delete(User $user, Task $task): bool
    {
        return $this->checkUUIDs($user, $task);
    }

    private function checkUUIDs(User $user, Task $task): bool
    {
        return $task->created_by === $user->getAuthIdentifier();
    }
}

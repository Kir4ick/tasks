<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskObserver
{
    /**
     * Обработчик перед созданием новой записи задачи
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function creating(Task $task)
    {
        $task->created_by = Auth::user()->getAuthIdentifier();
    }
}

<?php

namespace App\Providers;

use App\Services\Contracts\ITaskService;
use App\Repositories\Contracts\ITaskRepository;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        # Сервисы
        $this->app->bind(ITaskService::class, TaskService::class);

        # Репозитории
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}

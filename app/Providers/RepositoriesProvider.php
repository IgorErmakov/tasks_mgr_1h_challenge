<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ProjectsRepository;
use App\Repositories\Contracts\ProjectsRepositoryInterface;
use App\Repositories\TasksRepository;
use App\Repositories\Contracts\TasksRepositoryInterface;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectsRepositoryInterface::class, ProjectsRepository::class);
        $this->app->bind(TasksRepositoryInterface::class, TasksRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

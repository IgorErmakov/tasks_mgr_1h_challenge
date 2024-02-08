<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Contracts\TasksRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TasksRepository implements TasksRepositoryInterface
{
    public function getTasks(int $projectId): Collection
    {
        return Task::query()
            ->where('project_id', $projectId)
            ->take(10)
            ->orderBy('priority')
            ->get();
    }

    public function create(int $projectId, string $name, int $priority): int
    {
        $task = new Task;
        $task->project_id = $projectId;
        $task->name = $name;
        $task->priority = $priority;
        $task->save();

        return $task->id;
    }

    public function find(int $taskId): Task
    {
        return Task::findOrFail($taskId);
    }

    public function findByIds(array $ids): Collection
    {
        return Task::whereIn('id', $ids)
            ->get();
    }

    public function updatePriority(int $taskId, int $priority): void
    {
        Task::where('id', $taskId)->update(['priority' => $priority]);
    }
}

<?php
declare(strict_types=1);
namespace App\Repositories\Contracts;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TasksRepositoryInterface
{
    public function getTasks(int $projectId): Collection;
    public function create(int $projectId, string $name, int $priority): int;
    public function find(int $taskId): Task;
    public function findByIds(array $ids): Collection;
}

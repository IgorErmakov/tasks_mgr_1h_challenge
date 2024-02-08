<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Contracts\ProjectsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class ProjectsRepository implements ProjectsRepositoryInterface
{
    public function getLast(): Collection
    {
        return Project::query()
            ->take(10)
            ->get();
    }
}

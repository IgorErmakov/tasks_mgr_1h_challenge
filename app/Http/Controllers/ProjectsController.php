<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Repositories\Contracts\ProjectsRepositoryInterface;

class ProjectsController extends Controller
{
    public function __construct(
        protected ProjectsRepositoryInterface $projectsRepository
    ) {}

    function index()
    {
        $projects = $this->projectsRepository->getLast();

        return view('projects.index', ['projects' => $projects]);
    }
}

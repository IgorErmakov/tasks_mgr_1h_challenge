<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Repositories\Contracts\TasksRepositoryInterface;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function __construct(
        protected TasksRepositoryInterface $tasksRepository
    ) {}

    function index(int $projectId)
    {
        $tasks = $this->tasksRepository->getTasks($projectId);

        return view('tasks.index', ['tasks' => $tasks, 'projectId' => $projectId]);
    }

    function form(int $projectId)
    {
        return view('tasks.form', ['projectId' => $projectId]);
    }

    function updateForm(int $taskId)
    {
        $task = $this->tasksRepository->find($taskId);
        return view('tasks.update-form', ['projectId' => $task->project_id, 'task' => $task]);
    }

    function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $taskId = $this->tasksRepository->create(
            (int) $validated['project_id'],
            $validated['name'],
            (int) $validated['priority']
        );

        return redirect()
            ->route('project.tasks', $request->project_id)
            ->with('success', "Task created with id: {$taskId}");
    }

    function update(TaskUpdateRequest $request)
    {
        $validated = $request->validated();
        $task = $this->tasksRepository->find((int) $validated['id']);
        $task->fill($validated);
        $task->save();

        return redirect()
            ->route('project.tasks', $task->project_id)
            ->with('success', 'Task updated');
    }

    function destroy(int $taskId)
    {
        $task = $this->tasksRepository->find($taskId);
        $projectId = $task->project_id;
        $task->delete();

        return redirect()
            ->route('project.tasks', $projectId)
            ->with('success', 'Task deleted');
    }

    function sort(Request $request)
    {
        collect($request->get('ids'))->each(function (int $id, int $key) {
            $this->tasksRepository->updatePriority($id, $key);
        });

        return ['result' => true];
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResourceCollection;
use Illuminate\Http\Request;
use App\Service\TaskService;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function postTask(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'title' => ['required', 'string'],
            'project_id' => ['required', 'integer'],
            'description' => ['nullable','string'],
            'status'      => ['required','in:pending,in_progress,completed'],
            'deadline'    => ['nullable','date']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $task = $this->taskService->postTask($params);
        return new TaskResource($task);
    }

    public function showTask(int $id)
    {
        $task = $this->taskService->showTask($id);
        return new TaskResource($task);
    }

    public function allProjectTasks(int $projectId)
    {
        $tasks = $this->taskService->allProjectTasks($projectId);
        return new TaskResourceCollection($tasks);
    }

    // Update the task
    public function update(Request $request, int $id)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,in_progress,completed',
            'priority'    => 'integer|min:0|max:2',
            'deadline'    => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $task = $this->taskService->updateTask($id, $params);
        return new TaskResource($task);
    }

    public function deleteTask(Request $request, int $id)
    {
        $this->taskService->deleteTask($id);
        return response()->json([
            'message' => 'Task deleted successfully!'
        ], 200);
    }

    public function updateOrder(Request $request)
    {
        $this->taskService->updateOrder($request->tasks);
        return response()->json(['message' => 'Task priority updated successfully']);
    }
}

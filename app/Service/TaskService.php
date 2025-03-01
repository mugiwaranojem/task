<?php

namespace App\Service;

use App\Models\Task;

class TaskService
{
    public function postTask(array $params): Task
    {
        $projectId = $params['project_id'] ?? null;
        $latestPriority = Task::where('project_id', $projectId)->max('priority');
        $priority = ($latestPriority !== null) ? $latestPriority + 1 : 0;
        $params['priority'] = $priority;
        $task = Task::create($params);
        return $task;
    }

    public function allProjectTasks(int $project_id)
    {
        $tasks = Task::where('project_id', $project_id)->orderBy('title', 'asc')->paginate(10);
        return $tasks;
    }

    public function showTask(int $id): Task
    {
        return Task::find($id);
    }

    public function updateTask(int $id, array $params): Task
    {
        $task = Task::find($id);
        $task->update($params);
        return $task;
    }

    public function deleteTask(int $id): void
    {
        $task = Task::find($id);
        $task->delete();
    }
}
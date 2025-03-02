<?php

namespace App\Service;

use App\Models\Project;

class ProjectService
{
    public function postProject(array $params): Project
    {
        $project = Project::create($params);
        return $project;
    }

    public function showProject(int $id): Project
    {
        return Project::find($id);
    }

    public function allProjects()
    {
        $projects = Project::orderBy('title', 'asc')->paginate(10);
        return $projects;
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollectionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Service\ProjectService;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{

    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function postProject(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $project = $this->projectService->postProject($params);
        return new ProjectResource($project);
    }

    public function allProjects(Request $request)
    {
        $projects = $this->projectService->allProjects();
        return new ProjectCollectionResource($projects);
    }
}

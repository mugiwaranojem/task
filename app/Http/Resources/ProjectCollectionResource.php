<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'description' => $project->description,
                ];
            }),
            'count' => $this->collection->count()
        ];
    }
}

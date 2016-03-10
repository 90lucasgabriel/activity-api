<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract{
/*	protected $defaultIncludes = [
		'project'
	];
*/
	public function transform(ProjectTask $projectTask){
		return [
			'id'         => $projectTask->id,
			'project_id' => $projectTask->project_id,
			'name'       => $projectTask->name,
			'start_date' => $projectTask->start_date,
			'due_date'   => $projectTask->due_date,
			'status'     => $projectTask->status,
			'created_at' => $projectTask->created_at,
			'updated_at' => $projectTask->updated_at
		];
	}

/*
	public function includeProject(ProjectTask $projectTask){
		return $this->collection($projectTask->project, new ProjectTransformer());
	}
*/
}

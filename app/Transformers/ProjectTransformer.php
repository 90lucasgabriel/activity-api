<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use CodeProject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract{
	protected $defaultIncludes = [
	'members', 'client'
	];

	public function transform(Project $project){
		return [
		'project_id'  => $project->id,
		'owner'       => $project->owner,
		'name'        => $project->name,
		'description' => $project->description,
		'progress'    => (int)$project->progress,
		'status'      => $project->status,
		'due_date'    => $project->due_date,
		'is_member'   => $project->owner_id != \Authorizer::getResourceOwnerId(),
		];
	}

	public function includeMembers(Project $project){
		return $this->collection($project->members, new MemberTransformer());
	}

	public function includeClient(Project $project){
		return $this->item($project->client, new ClientTransformer());
	}
}

<?php

namespace CodeProject\Transformers;
use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformAbstract{
	public function transform(ProjectFile $project){
		return [
		'id' => $project->id,
		'name' => $project->name,
		'extension' => $project->extension,
		'description' => $project->description,
		];
	}
}
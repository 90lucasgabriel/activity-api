<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract{
	public function transform(ProjectFile $projectFile){
		return [
		'id' => $projectFile->id,
		'name' => $projectFile->name,
		'extension' => $projectFile->extension,
		'description' => $projectFile->description,
		'project_id' =>$projectFile->project_id
		];
	}
}
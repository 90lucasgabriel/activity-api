<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use CodeProject\Entities\Project;


class ProjectFile extends Model implements Transformable
{
	use TransformableTrait;

	protected $fillable = [
	'project_id',
	'name',
	'description',
	'extension',
	];

	public function project(){
		return $this->belongsTo(Project::class);
	}

	public function getFileName(){
		return $this->id . '.' . $this->extension;
	}
}
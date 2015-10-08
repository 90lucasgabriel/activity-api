<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use CodeProject\Entities\Project;

class ProjectTask extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'project_id',
    	'name',
    	'start_date',
    	'due_date',
    	'status'
    ];

    public function project(){
    	return $this->belongsTo(Project::class);
    }

}

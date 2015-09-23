<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use CodeProject\Entities\ProjectNote;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'owner_id',
    	'client_id',
    	'name',
    	'description',
    	'progess',
    	'status',
    	'due_date'
    ];

    public function notes(){
    	return $this->hasMany(ProjectNote::class);
    }

}

<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository{
	public function model(){
		return Project::class;
	}

	public function isOwner($projectId, $userId){
		if(count($this->findWhere(['id'=>$projectId, 'owner_id'=>$userId]))){
			return true;
		}
		return false;
	}
}
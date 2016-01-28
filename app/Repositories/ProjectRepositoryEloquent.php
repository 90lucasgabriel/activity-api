<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectPresenter;
use Illuminate\Database\Eloquent\Builder;


class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository{
	
	public function model(){
		return Project::class;
	}

	public function isOwner($projectId, $userId){
		if(count($this->skipPresenter()->findWhere(['id'=>$projectId, 'owner_id'=>$userId]))){
			return true;
		}
		return false;
	}

	public function hasMember($projectId, $memberId){
		$project = $this->skipPresenter()->find($projectId);

		foreach ($project->members as $member) {
			if($member->id == $memberId){
				return true;
			}
		}
		
		return false;
	}

	public function findWithOwnerAndMember($userId){
		$model = new $this->model();
		return $this->scopeQuery(function($query) use($userId){

			return $query
				->select('projects.*')
				->leftJoin('project_members', 'project_members.project_id', '=', 'projects.id')
				->where('project_members.member_id', '=', $userId)
				->union($model->query()->getQuery()->where('owner_id', '=', $userId));
		})->all();
	}


	public function presenter(){
		return ProjectPresenter::class;
	}
}
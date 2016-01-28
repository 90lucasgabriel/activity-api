<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectTask;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectTaskPresenter;

class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository{
    public function model(){
        return ProjectTask::class;
    }

    public function presenter(){
		return ProjectTaskPresenter::class;
	}

	public function boot(){
		$this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
	}
}
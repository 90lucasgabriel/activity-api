<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectMember;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectMemberPresenter;

class ProjectMemberRepositoryEloquent extends BaseRepository implements ProjectMemberRepository{
    public function model(){
        return ProjectMember::class;
    }

    public function presenter(){
    	return ProjectMemberPresenter::class;
    }

    public function boot(){
    	$this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }
}
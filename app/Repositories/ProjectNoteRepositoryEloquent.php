<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\Project;
use CodeProject\Entities\ProjectNote;
use CodeProject\Presenters\ProjectNotePresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository{
    public function model(){
        return ProjectNote::class;
    }

    public function isOwner($projectId, $userId){
    	$projectNote = $this->findWhere(['project_id'=>$projectId]);
    	if($projectNote[0]->project->owner_id == $userId){
			return true;
		}
		return false;
	}

    public function presenter(){
        return ProjectNotePresenter::class;
    }
}
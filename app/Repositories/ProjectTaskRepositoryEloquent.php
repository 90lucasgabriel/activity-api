<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectTask;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository{
    public function model(){
        return ProjectTask::class;
    }
}
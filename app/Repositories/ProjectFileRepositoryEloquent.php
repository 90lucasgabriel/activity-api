<?php

namespace CodeProject\Repositories;

user CodeProject\Presenters\ProjectFilePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Entities\ProjectFile;

class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository{

    public function model(){
        return ProjectFile::class;
    }

    public function presenter(){
        return ProjectFilePresenter::class;
    }
}
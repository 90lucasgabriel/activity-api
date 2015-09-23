<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectNote;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository{
    public function model(){
        return ProjectNote::class;
    }
}
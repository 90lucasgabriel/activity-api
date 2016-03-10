<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use CodeProject\Entities\ProjectNote;

class ProjectNoteController extends Controller
{

    /**
    * @var ProjectNoteRepository
    */
    private $repository;

    /**
    * @var ProjectNoteService
    */
    private $service;

    /**
    * @param ProjectNoteRepository $repository
    * @param ProjectNoteService $service
    */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service){
        $this->repository   = $repository;
        $this->service      = $service;
    }

    public function index($id){
        $projectNotes =  $this->repository->findWhere(['project_id'=>$id]);
        return $projectNotes;
    }

    public function store(Request $request){
        return $this->service->create($request->all());
    }

    public function show($id, $noteId)    {
        if($this->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        $projectNote = $this->repository->skipPresenter()->findWhere(['project_id'=>$id, 'id'=>$noteId]);
        return $projectNote->first();
    }

    public function update(Request $request, $noteId){
        return $this->service->update($request->all(), $noteId);
    }

    public function destroy($id, $noteId){
        return $this->service->destroy($noteId);
    }


    //Checks --------------------------------------------------------------------
    private function checkProjectOwner($projectId){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->skipPresenter()->isOwner($projectId, $userId);
    }

    /*
    private function checkProjectMember($projectId){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }

    private function checkProjectPermissions($projectId){
        $this->repository->skipPresenter(true);
        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            $this->repository->skipPresenter(false);
            return true;
        }

        return false;
    }
    */
}
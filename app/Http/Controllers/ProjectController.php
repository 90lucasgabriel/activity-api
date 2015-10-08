<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;

class ProjectController extends Controller
{

    /**
    * @var ProjectRepository
    */
    private $repository;

    /**
    * @var ProjectService
    */
    private $service;

    /**
    * @param ProjectRepository $repository
    * @param ProjectService $service
    */
    public function __construct(ProjectRepository $repository, ProjectService $service){
        $this->repository   = $repository;
        $this->service      = $service;
    }

    public function index(){
        return $this->repository->skipPresenter()->with(['members', 'client', 'owner'])->findWhere(['owner_id'=>\Authorizer::getResourceOwnerId()]);
    }

    public function store(Request $request){
        return $this->service->create($request->all());
    }

    public function show($id){
        
        if($this->checkProjectPermissions($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        return $this->repository->skipPresenter()->with(['members', 'client', 'owner'])->find($id);
    }

    public function update(Request $request, $id){
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id){
        return $this->repository->delete($id);
    }



    //Checks --------------------------------------------------------------------
    private function checkProjectOwner($projectId){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

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
}
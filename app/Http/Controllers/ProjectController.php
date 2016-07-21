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
        $this->middleware('check.project.owner', ['except' => ['store', 'show', 'index', 'queryIsMember']]);
        $this->middleware('check.project.permission', ['except' => ['index', 'store', 'update', 'destroy', 'queryIsMember']]);
    }

    public function index(Request $request){
       //return $this->repository->with(['members', 'client', 'owner'])->findWithOwnerAndMember(\Authorizer::getResourceOwnerId());
       return $this->repository->with(['members', 'client', 'owner'])->findOwner(\Authorizer::getResourceOwnerId());
    }

    public function queryIsMember(Request $request){
       return $this->repository->with(['members', 'client', 'owner'])->findMember(\Authorizer::getResourceOwnerId());
    }

    public function store(Request $request){
        return $this->service->create($request->all());
    }

    public function show($id){
        
        if($this->service->checkProjectPermissions($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        return $this->repository->with(['members', 'client', 'owner'])->find($id);
    }

    public function update(Request $request, $id){
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id){
        return $this->service->destroy($id);
    }    
}
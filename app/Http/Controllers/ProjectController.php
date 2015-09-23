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
        
        return $this->repository->all();
    }

    public function store(Request $request){
        return $this->service->create($request->all());
    }

    public function show($id)    {
        return $this->repository->find($id);
    }

    public function update(Request $request, $id){
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id){
        return $this->repository->delete($id);
    }
}
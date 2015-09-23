<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;

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
        return $this->repository->findWhere(['project_id'=>$id]);
    }

    public function store(Request $request){
        return $this->service->create($request->all());
    }

    public function show($id, $noteId)    {
        return $this->repository->findWhere(['project_id'=>$id, 'id'=>$noteId]);
    }

    public function update(Request $request, $id, $noteId){
        return $this->service->update($request->all(), $noteId);
    }

    public function destroy($id, $noteId){
        return $this->repository->delete($noteId);
    }
}
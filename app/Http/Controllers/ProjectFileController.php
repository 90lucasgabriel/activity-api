<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;


class ProjectFileController extends Controller
{
    public function __construct(ProjectRepository $repository, ProjectService $service){
        $this->repository   = $repository;
        $this->service      = $service;
    }

    public function index($id){
        return $this->repository->skipPresenter()->find($id)->files;
    }

    public function show($projectId, $fileId){
        $data['project_id'] = $projectId;
        $data['file_id'] = $fileId;
        return $this->repository->skipPresenter()->find($projectId)->files()->find($fileId);

    }

    public function store(Request $request){
        $file = $request->file('file');
        
        $data['file'] = $file;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        if($this->service->checkFile($data)){
            $extension = $file->getClientOriginalExtension();
            $data['extension'] = $extension;

            $this->service->createFile($data);

            return [
                    'error'     => false,
                    'message'   => 'File created'
                ];
        }
        return [
                    'error'     => true,
                    'message'   => 'Create  File error'
                ];
    }

    public function destroy($projectId, $fileId){
        $data['project_id'] = $projectId;
        $data['file_id'] = $fileId;

        $this->service->deleteFile($data);
    }
}
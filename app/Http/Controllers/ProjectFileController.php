<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;
use Illuminate\Http\Request;

class ProjectFileController extends Controller{

    private $repository;
    private $service;

    public function __construct(ProjectFileRepository $repository, ProjectFileService $service){
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id){
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store(Request $request){
        $file = $request->file('file');
        $extension = $file->getClientoriginalExtension;

        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        return $this->service->create($data);
    }

    public function showFile($id){
        if($this->service->checkProjectPermissions($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        return response()->download($this->service->getFilePatch($id));
    }

    public function show($id){
        if($this->service->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        return $this->repository->find($id);
    }

    public function update(Request $request, $id){
        if($this->service->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id){
        if($this->service->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        return $this->repository->delete($id);
    }
}


/*
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

        return $this->service->createFile($data);
    }

    public function destroy($projectId, $fileId){
        $data['project_id'] = $projectId;
        $data['file_id'] = $fileId;

        $this->service->deleteFile($data);
    }
}*/
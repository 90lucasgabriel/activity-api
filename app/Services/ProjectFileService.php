<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectFileValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectFileService{

	private $repository;
	private $projectRepository;
	private $validator;
	private $filesystem;
	private $storage;

	public function __construct(ProjectFileRepository $repository, ProjectRepository $projectRepository, ProjectFileValidator $validator, FileSystem $filesystem, Storage $storage){
		$this->repository        = $repository;
		$this->projectRepository = $projectRepository;
		$this->validator         = $validator;
		$this->filesystem        = $filesystem;
		$this->storage           = $storage;
	}

	PUBLIC FUNCTION CREATE (ARRAY $DATA){

	}

	PUBLIC FUNCTION UPDATE(ARRAY $DATA, $ID){

	}

	public function getFilePath($id){
		$projectFile = $this->repository->skipPresenter()->find($id);
		return $this->getBaseURL($projectFile);
	}

	PUBLIC FUNCTION getBaseURL($projectFile){
		switch($this->storage->getDefaultDriver()){
			case 'local':
				return $this->storage->getDriver()->getAdapter()->getPathPrefix()
				.'/'. $projectFile->id . '.' . $projectFile->extension;
		}
	}

	PUBLIC FUNCTION CHECKPROJECTOWNER($projectFileId){

	}

	PUBLIC FUNCTION CHECKPROJECTMEMBER($projectFileId){
		
	}

	PUBLIC FUNCTION CHECKPROJECTPERMISSIONS($projectFileId){
		
	}

	public function delete($id){
		$projectFile = $this->repository->skipPresenter()->find($id);
		if($this->storage->exists($projectFile->id . '.' . $projectFile->extension)){
			$this->storage->delete($projectFile->id . '.' . $projectFile->extension);
			$projectFile->delete();
		}
	}
}
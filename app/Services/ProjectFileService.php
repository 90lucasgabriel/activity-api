<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectFileValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Prettus\Validator\Contracts\ValidatorInterface;

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


	//PROJECT FILE ----------------------------------------------------------------------------------------
	public function create(array $data){
		//name, description, extension, file.
		try{
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			//$extension = $data['file']->getClientOriginalExtension();
            //$data['extension'] = $extension;

			$project = $this->projectRepository->skipPresenter()->find($data['project_id']);
			$projectFile = $project->files()->create($data);
			$this->storage->put($projectFile->getFileName(), $this->filesystem->get($data['file']));
			return [
				'error' 	=> false,
				'message'	=> "File created"
			];
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}
	}

	public function update(array $data, $fileId){
		try{
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			return $this->repository->update($data, $fileId);
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}
	}


	public function show(array $data){
		//name, description, extension, file.
		$project = $this->repository->skipPresenter()->find($data['project_id']);
		$projectFile = $project->files()->create($data);
		$this->storage->put($projectFile->getFileName(), $this->filesystem->get($data['file']));
		
	}

/*
	public function delete(array $data){
		try{
			$project = $this->repository->skipPresenter()->find($data['project_id']);
			if($project->files()->delete($data['file_id'])){
				return [
					'error'		=> false,
					'message'	=> 'File removed'
				];
			}
			else{
				return [
					'error'		=> true,
					'message'	=> 'Remove File error'
				];
			}
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}
	}
*/
	public function delete($fileId){
		$projectFile = $this->repository->skipPresenter()->find($fileId);
		
		try{
			if($this->storage->exists($projectFile->getFileName())){
				$this->storage->delete($projectFile->getFileName());
				if($projectFile->delete())
				{
					$projectFile->delete();
					return [
						'error'		=> false,
						'message'	=> 'File removed'
					];
				}
				else{
					return [
						'error'		=> true,
						'message'	=> 'Remove File error'
					];
				}
			}
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}

	}

	
	public function getFilePath($fileId){
		$projectFile = $this->repository->skipPresenter()->find($fileId);
		return $this->getBaseURL($projectFile);
	}

	public function getFileName($fileId){
		$projectFile = $this->repository->skipPresenter()->find($fileId);
		return $projectFile->getFileName();	
	}

	public function getBaseURL($projectFile){
		switch($this->storage->getDefaultDriver()){
			case 'local':
				return $this->storage->getDriver()->getAdapter()->getPathPrefix()
				.'/'. $projectFile->getFileName();
		}
	}



	
}
<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectService{
	/**
	* @var ProjectRespository
	*/
	protected $repository;

	/**
	* @var ProjectValidator
	*/
	protected $validator;

	/**
	* @var Filesystem
	*/
	protected $filesystem;

	/**
	* @var Storage
	*/
	protected $storage;

	public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage){
		$this->repository 	= $repository;
		$this->validator 	= $validator;
		$this->filesystem 	= $filesystem;
		$this->storage 		= $storage;
	}

	//Ao passar os dados do Projecte, criá-lo.
	public function create(array $data){
		try{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->create($data);
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}		
	}

	public function update(array $data, $id){
		try{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->update($data, $id);
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}
	}

	public function createFile(array $data){
		//name, description, extension, file.
		$project = $this->repository->skipPresenter()->find($data['project_id']);
		$projectFile = $project->files()->create($data);
		$this->storage->put($projectFile->id . "." . $data['extension'], $this->filesystem->get($data['file']));
	}
}
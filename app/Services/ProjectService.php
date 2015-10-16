<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use CodeProject\Validators\ProjectFileValidator;
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

	/**
	* @var ProjectFileValidator
	*/
	protected $validatorFile;

	public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage, ProjectFileValidator $validatorFile){
		$this->repository 		= $repository;
		$this->validator 		= $validator;
		$this->filesystem 		= $filesystem;
		$this->storage 			= $storage;
		$this->validatorFile	= $validatorFile;
	}

	//PROJECT ---------------------------------------------------------------------------------------------
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



	//PROJECT MEMBER --------------------------------------------------------------------------------------
	public function addMember(array $data){
		try{
			$project = $this->repository->skipPresenter()->find($data['project_id']);
			if($project->members()->create($data)){
				return [
					'error'		=> false,
					'message'	=> 'Member added to Project'
				];
			}
			else{
				return [
					'error'		=> true,
					'message'	=> 'Add member error'
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

	public function removeMember(array $data){
		try{
			$project = $this->repository->skipPresenter()->find($data['project_id']);
			if($project->members()->detach($data['member_id'])){
				return [
					'error'		=> false,
					'message'	=> 'Member removed'
				];
			}
			else{
				return [
					'error'		=> true,
					'message'	=> 'Remove member error'
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

	public function isMember(array $data){
		try{
			$project = $this->repository->skipPresenter()->find($data['project_id']);
			if($project->members->find($data['member_id'])){
				return [
					'error'		=> false,
					'message'	=> 'Is member'
				];
			}
			else{
				return [
					'error'		=> true,
					'message'	=> 'Is not a member'
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

	
	

	//PROJECT FILE ----------------------------------------------------------------------------------------
	public function createFile(array $data){
		//name, description, extension, file.
		try{
			$this->validatorFile->with($data)->passesOrFail();

			$extension = $data['file']->getClientOriginalExtension();
            $data['extension'] = $extension;

			$project = $this->repository->skipPresenter()->find($data['project_id']);
			$projectFile = $project->files()->create($data);
			$this->storage->put($projectFile->id . "." . $data['extension'], $this->filesystem->get($data['file']));
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

	public function showFile(array $data){
		//name, description, extension, file.
		$project = $this->repository->skipPresenter()->find($data['project_id']);
		$projectFile = $project->files()->create($data);
		$this->storage->put($projectFile->id . "." . $data['extension'], $this->filesystem->get($data['file']));
		
	}

	public function deleteFile(array $data){
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

}
<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService{
	/**
	* @var ProjectNoteRespository
	*/
	protected $repository;

	/**
	* @var ProjectRespository
	*/
	protected $repositoryProject;

	/**
	* @var ProjectNoteValidator
	*/
	protected $validator;

	public function __construct(ProjectNoteRepository $repository, ProjectRepository $repositoryProject, ProjectNoteValidator $validator){
		$this->repository 			= $repository;
		$this->repositoryProject 	= $repositoryProject;
		$this->validator 			= $validator;
	}

	//Ao passar os dados do ProjectNotee, criá-lo.
	public function create(array $data, $projectId){
		try{
			$this->validator->with($data)->passesOrFail();

			$data['project_id'] = $projectId;
			return $this->repository->create($data);
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}		
	}

	public function update(array $data, $noteId){
		try{
			$this->validator->with($data)->passesOrFail();

			return $this->repository->update($data, $noteId);
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}
	}

	public function destroy($noteId){
		if($this->repository->delete($noteId)){
			return ['success'=>true];
		}
		else{
			return ['success'=>false];
		}
	}
}
<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService{
	/**
	* @var ProjectMemberRespository
	*/
	protected $repository;

	/**
	* @var ProjectMemberValidator
	*/
	protected $validator;

	public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator){
		$this->repository 			= $repository;
		$this->validator 			= $validator;
	}

	//Ao passar os dados do ProjectMembere, criá-lo.
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

	public function destroy($id){
		//$projectMember = $this->repository->skipPresenter()->find($id);
		//return $projectMember->delete();
		if($this->repository->delete($id)){
			return ['success'=>true];
		}
		else{
			return ['success'=>false];
		}
	}
}
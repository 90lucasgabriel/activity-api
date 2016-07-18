<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService{
	protected $repository;
	protected $projectRepository;
	protected $validator;

	public function __construct(ProjectMemberRepository $repository, ProjectRepository $projectRepository, ProjectMemberValidator $validator){
		$this->repository        = $repository;
		$this->projectRepository = $projectRepository;
		$this->validator         = $validator;
	}

	//Ao passar os dados do ProjectMembere, criá-lo.
	public function create(array $data){
		
		try{
			$this->validator->with($data)->passesOrFail();
			//$project = $this->projectRepository->skipPresenter()->find($data['project_id']);
			//$projectMember = $project->members()->create($data);
			//return $projectMember;
			return $this->repository->create($data);
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}		
	}

	public function show(array $data){
		
		try{
			$this->validator->with($data)->passesOrFail();
			//$project = $this->projectRepository->skipPresenter()->find($data['project_id']);
			//$projectMember = $project->members()->create($data);
			//return $projectMember;
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

	public function delete($projectId, $memberId){
		$projectMember = $this->repository->findWhere(["project_id"=>$projectId, "member_id"=>$memberId]);
		$projectMember = $projectMember['data'];
		$projectMember = $projectMember[0];
		try{
			if($this->repository->delete($projectMember['id'])){
				return [
					'error' => false,
					'message' => 'Member removed'
				];
			}
			else{
				return [
					'error' => true,
					'message' => 'Member remove error'
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
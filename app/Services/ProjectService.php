<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService{
	/**
	* @var ProjectRespository
	*/
	protected $repository;

	/**
	* @var ProjectValidator
	*/
	protected $validator;


	public function __construct(ProjectRepository $repository, ProjectValidator $validator){
		$this->repository 		= $repository;
		$this->validator 		= $validator;
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

	public function destroy($id){
		if($this->repository->delete($id)){
			return ['success'=>true];
		}
		else{
			return ['success'=>false];
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

	
	

	



	//Checks --------------------------------------------------------------------
    public function checkProjectOwner($projectId){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    public function checkProjectMember($projectId){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }

    public function checkProjectPermissions($projectId){
        $this->repository->skipPresenter(true);
        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            $this->repository->skipPresenter(false);
            return true;
        }

        return false;
    }

    /*
	public function checkProjectOwner($projectFileId){
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

        return $this->projectRepository->isOwner($projectId, $userId);
    }

	public function checkProjectMember($projectFileId){
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;
        return $this->projectRepository->hasMember($projectId, $userId);
    }

	public function checkProjectPermissions($projectFileId){
        if($this->checkProjectOwner($projectFileId) or $this->checkProjectMember($projectFileId)){
            return true;
        }

        return false;
    }
    */

}
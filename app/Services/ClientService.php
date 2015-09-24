<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService{
	/**
	* @var ClientRespository
	*/
	protected $repository;

	/**
	* @var ClientValidator
	*/
	protected $validator;

	public function __construct(ClientRepository $repository, ClientValidator $validator){
		$this->repository 	= $repository;
		$this->validator 	= $validator;
	}

	//Ao passar os dados do cliente, criá-lo.
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
	

}
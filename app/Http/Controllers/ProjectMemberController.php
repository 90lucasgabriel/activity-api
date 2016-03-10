<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;

class ProjectMemberController extends Controller
{

    /**
    * @var ProjectMemberRepository
    */
    private $repository;

    /**
    * @var ProjectMemberService
    */
    private $service;

    /**
    * @param ProjectMemberRepository $repository
    * @param ProjectMemberService $service
    */
    public function __construct(ProjectRepository $repository, ProjectService $service){
        $this->repository   = $repository;
        $this->service      = $service;
        $this->middleware('check.project.owner', ['except' => ['show', 'index']]);
        $this->middleware('check.project.permission', ['except' => ['store', 'destroy']]);
    }

    public function index($id){
        return $this->repository->findWhere(['project_id'=>$id]);
        //return $this->repository->skipPresenter()->find($id)->members;
    }

    public function store(Request $request){
    	$data['name'] 		= $request->name;
        $data['email'] 		= $request->email;
        $data['password'] 	= $request->password;
        $data['project_id'] = $request->id;

        return $this->service->addMember($data);
    }

    public function show(/*Request $request*/$idProjectMember)    {
    	//$data['project_id'] = $request->id;
    	//$data['member_id'] = $request->memberId;

        //return $this->service->isMember($data);
        return $this->service->find($idProjectMember);
    }


    public function destroy(Request $request){
    	$data['project_id'] = $request->id;
    	$data['member_id'] = $request->memberId;

        return $this->service->removeMember($data);
    }
}
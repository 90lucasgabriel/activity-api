<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Services\ProjectMemberService;

class ProjectMemberController extends Controller
{

    private $repository;
    private $service;
    public function __construct(ProjectMemberRepository $repository, ProjectMemberService $service){
        $this->repository   = $repository;
        $this->service      = $service;        
    }

    public function index($id){
        return $this->repository->findWhere(['project_id'=>$id]);
    }

    public function store(Request $request){
        
        return $this->service->create($request->all());
    }

    public function destroy($id, $memberId){
        return $this->service->delete($id,$memberId);
    }
}
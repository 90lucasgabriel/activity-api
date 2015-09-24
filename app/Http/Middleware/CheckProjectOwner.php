<?php

namespace CodeProject\Http\Middleware;

use Closure;

class CheckProjectOwner
{
    private $repository;
    public function __construct(ProjectRepository $repository){
        $this->repository = $repository;
    }

    public function handle($request, Closure $next){
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $request->project;
        if($this->repository->isOwner($id, $userId) == false){
            return ['error' => 'Access forbidden'];
        }
    }

}

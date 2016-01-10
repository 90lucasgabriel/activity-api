<?php
namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Services\ProjectService;

class CheckProjectOwner
{
    private $service;
    public function __construct(ProjectService $service){
        $this->service = $service;
    }

    public function handle($request, Closure $next){
        $projectId = $request->route('id')?$request->route('id'):$request->route('project');

        if($this->service->CheckProjectOwner($projectId) == false){
            return ['error' => 'Access forbidden'];
        }

        return $next($request);
    }

}

/**
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
*/
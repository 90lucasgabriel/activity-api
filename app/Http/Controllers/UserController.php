<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Http\Controllers\Controller;
use CodeProject\Repositories\UserRepository;
use LucasDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->all();
    }

    public function authenticated(){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->find($userId);
    }
}

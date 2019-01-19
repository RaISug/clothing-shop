<?php

namespace controller;

use entity\User;
use factory\UserFactory;
use repository\UserRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class CreateUserController extends Controller {

    private $path;
    private $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && 
                        ($request->getPath() == "/administration/users/api/v1"
                            || $request->getPath() == "/users/api/v1");
    }

    public function handle(Request $request) {
        $this->path = $request->getPath();

        $factory = new UserFactory();

        $user = $factory->createUserFromRequest($request);
        if ($this->userExists($user)) {
            return (new ResponseBuilder())->withStatusCode(409)->build();
        }

        if ($this->isAdministratorRequest()) {
            $this->repository->persistAsAdministrator($user);
        } else {
            $this->repository->persist($user);
        }

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    private function userExists(User $user) {
        $dbResponse = $this->repository->byUsername($user->username());

        return $dbResponse->num_rows != 0;
    }

    private function isAdministratorRequest() {
        return $this->path === "/administration/users/api/v1";
    }

    public function display(Response $response) {
        if ($response->statusCode() == 409) {
            $response->redirectTo("/registration?registration-failed=username-is-taken");
        } else if ($this->isAdministratorRequest()) {
            $response->redirectTo("/administration/users/create?operation-create=succeed");
        } else {
            $response->redirectTo("/");
        }
    }

}
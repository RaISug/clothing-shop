<?php

namespace controller;

use request\Request;
use response\Response;
use factory\UserFactory;
use repository\UserRepository;
use response\ResponseBuilder;

class CreateUserController extends Controller {

    private $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && $request->getPath() == "/administration/users/api/v1";
    }

    public function handle(Request $request) {
        $factory = new UserFactory();

        $this->repository->persist($factory->createUserFromRequest($request));

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $response->redirectTo("/administration/users/create");
    }

}
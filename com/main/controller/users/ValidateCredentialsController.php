<?php

namespace controller;

use entity\User;
use exception\UnauthorizedException;
use repository\UserRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use session\SessionService;

class ValidateCredentialsController extends Controller {

    private $repository;
    private $sessionService;
    
    public function __construct() {
        $this->repository = new UserRepository();
        $this->sessionService = new SessionService();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && $request->getPath() === "/login";
    }

    public function handle(Request $request) {
        $username = $request->getParameter("username");
        $password = $request->getParameter("password");

        $dbResponse = $this->repository->byUsernameAndPassword($username, $password);

        if ($dbResponse->num_rows == 0) {
            throw new UnauthorizedException("Incorrect username or password.");
        }

        $this->addUserIntoSession(new User($dbResponse->fetch_assoc()));

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    private function addUserIntoSession($user) {
        $this->sessionService->start();
        $this->sessionService->setAuthenticatedUser($user);
    }

    public function display(Response $response) {
        $response->redirectTo("/");
    }

}
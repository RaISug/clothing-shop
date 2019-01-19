<?php

namespace controller;

use request\Request;
use response\Response;
use response\ResponseBuilder;
use session\SessionService;

class LogoutController extends Controller {

    private $sessionService;

    public function __construct() {
        $this->sessionService = new SessionService();
    }
    
    public function canHandle(Request $request) {
        return $request->isGETRequest() && $request->getPath() == "/logout";
    }
    
    public function handle(Request $request) {
        $this->sessionService->stop();

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    public function display(Response $response) {
        $response->redirectTo("/");
    }
    
}
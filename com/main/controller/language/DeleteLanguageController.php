<?php

namespace controller;

use repository\LanguageRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class DeleteLanguageController extends Controller {
    
    private $repository;
    
    function __construct() {
        $this->repository = new LanguageRepository();
    }
    
    public function canHandle(Request $request) {
        return $request->isDELETERequest() && preg_match("/^\/administration\/languages\/api\/v1\/language\/(\d)+$/", $request->getPath()) == 1;
    }
    
    public function handle(Request $request) {
        $this->repository->deleteById($request->getPathParameter("language"));
        
        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    public function display(Response $response) {
        $response->redirectTo("/administration/languages/api/v1?operation-delete=succeed");
    }
    
}
<?php

namespace controller;

use repository\CollectionRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class DeleteCollectionController extends Controller {

    private $repository;
    
    function __construct() {
        $this->repository = new CollectionRepository();
    }

    public function canHandle(Request $request) {
        return $request->isDELETERequest() && preg_match("/^\/administration\/collections\/api\/v1\/collection\/(\d)+$/", $request->getPath()) == 1;
    }
    
    public function handle(Request $request) {
        $this->repository->deleteById($request->getPathParameter("collection"));

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $response->redirectTo("/administration/collections/api/v1");
    }
    
}
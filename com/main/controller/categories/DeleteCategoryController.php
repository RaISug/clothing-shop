<?php

namespace controller;

use request\Request;
use response\Response;
use repository\CategoryRepository;
use response\ResponseBuilder;

class DeleteCategoryController extends Controller {

    private $repository;
    
    function __construct() {
        $this->repository = new CategoryRepository();
    }

    public function canHandle(Request $request) {
        return $request->isDELETERequest() && preg_match("/^\/administration\/categories\/api\/v1\/category\/(\d)+$/", $request->getPath()) == 1;
    }
    
    public function handle(Request $request) {
        $this->repository->deleteById($request->getPathParameter("category"));

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $response->redirectTo("/administration/categories/api/v1");
    }
    
}
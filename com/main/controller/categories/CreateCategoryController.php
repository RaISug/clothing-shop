<?php

namespace controller;

use request\Request;
use response\Response;
use repository\CategoryRepository;
use response\ResponseBuilder;
use factory\CategoryFactory;

class CreateCategoryController extends Controller {
    
    private $repository;
    private $factory;
    
    function __construct() {
        $this->repository = new CategoryRepository();
        $this->factory = new CategoryFactory();
    }
    
    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && preg_match("/^\/administration\/categories\/api\/v1$/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $category = $this->factory->createCategoryFromRequest($request);

        $this->repository->persist($category);
        
        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    public function display(Response $response) {
        $response->redirectTo("/administration/categories/create");
    }
    
}
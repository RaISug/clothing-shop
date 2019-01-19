<?php

namespace controller;

use request\Request;
use response\Response;
use repository\CategoryRepository;
use response\ResponseBuilder;
use dto\Pagination;
use entity\Category;

class ListCategoriesController extends Controller {
    
    private $repository;
    
    function __construct() {
        $this->repository = new CategoryRepository();
    }
    
    public function canHandle(Request $request) {
        return $request->isGETRequest() && $request->getPath() === "/administration/categories/api/v1";
    }

    public function handle(Request $request) {
        $dbResponse = $this->repository->all();

        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withStatusCodeOK()->withRequest($request)->withEntity(new Pagination(array(), 0, 0, 50))->build();
        }
        
        $entities = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Category($row);
        }
        
        return (new ResponseBuilder())
                        ->withStatusCodeOK()
                        ->withRequest($request)
                        ->withEntity(new Pagination($entities, 0, 0, 50))
                        ->build();
    }
    
    public function display(Response $response) {
        include "com/view/administration/category/all-categories.php";
    }

}
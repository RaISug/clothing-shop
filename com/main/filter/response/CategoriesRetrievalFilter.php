<?php

namespace filter;

use request\Request;
use response\Response;
use response\ResponseBuilder;
use repository\CategoryRepository;
use entity\Category;

class CategoriesRetrievalFilter implements ResponseFilter {
    
    private $repository;
    
    public function __construct() {
        $this->repository = new CategoryRepository();
    }

    public function canHandle(Request $request, Response $response) {
        return $this->isProductUpdatePageRequest($request) || $this->isProductCreatePageRequest($request);
    }

    private function isProductUpdatePageRequest(Request $request) {
        return $request->isGETRequest() && preg_match("/^\/administration\/products\/api\/v1\/product\/[0-9]+$/", $request->getPath()) == 1;
    }

    private function isProductCreatePageRequest(Request $request) {
        return $request->isGETRequest() && $request->getPath() === "/administration/products/create";
    }

    public function filter(Response &$response) {
        $dbResponse = $this->repository->all();
        
        if ($dbResponse->num_rows == 0) {
            return;
        }
        
        $entities = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Category($row);
        }
        
        $response = (new ResponseBuilder())
                        ->withEntity($response->entity())
                        ->withStatusCode($response->statusCode())
                        ->withSupportingEntity("categories", $entities)
                        ->build();
    }
    
}
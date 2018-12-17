<?php

namespace filter;

use request\Request;
use response\Response;
use response\ResponseBuilder;
use entity\Category;
use repository\CategoryRepository;

class DropdownsRetrievalFilter implements ResponseFilter {

    private $repository;
    
    public function __construct() {
        $this->repository = new CategoryRepository();
    }

    public function canHandle(Request $request, Response $response) {
        return $request->isGETRequest() && strpos($request->getPath(), "/administration/") == false;
    }

    public function filter(Response &$response) {
        $menCategories = $this->retrieveMenCategories();
        $womenCategories = $this->retrieveWomenCategories();

        $response = (new ResponseBuilder())
                            ->withEntity($response->entity())
                            ->withStatusCode($response->statusCode())
                            ->withSupportingEntities($response->supportingEntities())
                            ->withSupportingEntity("menCategories", $menCategories)
                            ->withSupportingEntity("womenCategories", $womenCategories)
                            ->build();
    }

    private function retrieveMenCategories() {
        $dbResponse = $this->repository->menCategories();
        
        if ($dbResponse->num_rows == 0) {
            return;
        }
        
        $mensCategories = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $mensCategories[] = new Category($row);
        }
        
        return $mensCategories;
    }
    
    private function retrieveWomenCategories() {
        $dbResponse = $this->repository->womenCategories();
        
        if ($dbResponse->num_rows == 0) {
            return;
        }
        
        $mensCategories = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $mensCategories[] = new Category($row);
        }
        
        return $mensCategories;
    }

}
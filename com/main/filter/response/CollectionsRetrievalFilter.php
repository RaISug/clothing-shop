<?php

namespace filter;

use entity\Collection;
use repository\CollectionRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class CollectionsRetrievalFilter implements ResponseFilter {
    
    private $repository;
    
    public function __construct() {
        $this->repository = new CollectionRepository();
    }
    
    public function canHandle(Request $request, Response $response) {
        return $request->isGETRequest() && 
                    ($request->getPath() === "/administration/collections/add/products"
                        || strpos($request->getPath(), "/administration/") == false);
    }
    
    public function filter(Response &$response) {
        $dbResponse = $this->repository->all();
        
        if ($dbResponse->num_rows == 0) {
            return;
        }
        
        $entities = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Collection($row);
        }

        $response = (new ResponseBuilder())
                            ->withRequest($response->request())
                            ->withEntity($response->entity())
                            ->withRequest($response->request())
                            ->withStatusCode($response->statusCode())
                            ->withSupportingEntities($response->supportingEntities())
                            ->withSupportingEntity("collections", $entities)
                            ->build();
    }
    
}
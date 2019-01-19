<?php

namespace filter;

use entity\Carousel;
use repository\CarouselRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class CarouselsRetrievalFilter implements ResponseFilter {
    
    private $repository;
    
    public function __construct() {
        $this->repository = new CarouselRepository();
    }
    
    public function canHandle(Request $request, Response $response) {
        return $request->isGETRequest() && 
                                ($request->getPath() == "" 
                                    || $request->getPath() === "/"
                                        || $request->getPath() === "/newdesign");
    }
    
    public function filter(Response &$response) {
        $dbResponse = $this->repository->all();
        
        if ($dbResponse->num_rows == 0) {
            return;
        }
        
        $entities = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Carousel($row);
        }

        $response = (new ResponseBuilder())
                            ->withLanguage($response->language())
                            ->withRequest($response->request())
                            ->withEntity($response->entity())
                            ->withStatusCode($response->statusCode())
                            ->withSupportingEntities($response->supportingEntities())
                            ->withSupportingEntity("carousels", $entities)
                            ->build();
    }
    
}
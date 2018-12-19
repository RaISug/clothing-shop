<?php

namespace filter;

use request\Request;
use response\Response;
use repository\LanguageRepository;
use entity\Language;
use response\ResponseBuilder;

class LanguageRetrievalFilter implements ResponseFilter {

    private $repository;
    
    public function __construct() {
        $this->repository = new LanguageRepository();
    }

    public function canHandle(Request $request, Response $response) {
        return $request->isGETRequest();
    }

    public function filter(Response &$response) {
        $dbResponse = $this->repository->all();
        
        $languages = array();

        if ($dbResponse->num_rows != 0) {
            while ($row = $dbResponse->fetch_assoc()) {
                $languages[] = new Language($row);
            }
        }
        
        $response = (new ResponseBuilder())
                            ->withLanguage($response->language())
                            ->withRequest($response->request())
                            ->withEntity($response->entity())
                            ->withStatusCode($response->statusCode())
                            ->withSupportingEntities($response->supportingEntities())
                            ->withSupportingEntity("languages", $languages)
                            ->build();
    }
    
}
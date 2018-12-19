<?php

namespace filter;

use request\Request;
use response\Response;
use response\ResponseBuilder;
use session\SessionService;

class InternationalizationFilter implements ResponseFilter {

    private $sessionService;

    public function __construct() {
        $this->sessionService = new SessionService();
    }

    public function canHandle(Request $request, Response $response) {
        return $request->isGETRequest();
    }

    public function filter(Response &$response) {
        $language = $this->sessionService->getAttribute("language");

        $response = (new ResponseBuilder())
                                ->withLanguage($language == null ? "BG" : $language->name())
                                ->withRequest($response->request())
                                ->withEntity($response->entity())
                                ->withRequest($response->request())
                                ->withStatusCode($response->statusCode())
                                ->withSupportingEntities($response->supportingEntities())
                                ->build();
    }
    
}
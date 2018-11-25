<?php

namespace filter;

use request\Request;
use response\Response;
use response\ResponseBuilder;

class JsonConverterFilter implements ResponseFilter {

    public function canHandle(Request $request, Response $response) {
        return $response->contentType() === "application/json";
    }

    public function filter(Response &$response) {
        $response = (new ResponseBuilder())
                        ->withEntity(json_encode($response->entity()))
                        ->withContentTypeApplicationJson()
                        ->withStatusCodeOK()
                        ->build();
    }

}
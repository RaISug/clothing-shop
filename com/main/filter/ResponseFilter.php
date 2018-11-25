<?php

namespace filter;

use response\Response;
use request\Request;

interface ResponseFilter {

    public function canHandle(Request $request, Response $response);

    public function filter(Response &$response);

}
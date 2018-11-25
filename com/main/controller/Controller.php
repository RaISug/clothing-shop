<?php

namespace controller;

use request\Request as Request;
use response\Response as Response;

abstract class Controller {

    public abstract function canHandle(Request $request);

    public abstract function handle(Request $request);

    public abstract function display(Response $response);

}
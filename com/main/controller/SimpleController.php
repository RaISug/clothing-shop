<?php

namespace controller;

use request\Request;
use response\Response;
use response\ResponseBuilder;

class SimpleController extends Controller {
    
    private $requestPath;

    public function canHandle(Request $request) {
        return $request->isGETRequest();
    }

    public function handle(Request $request) {
        $this->requestPath = $request->getPath();

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $pathToViewMappings = array(
            "" => "com/view/index.php",
            "/" => "com/view/index.php",
            "/login" => "com/view/login.php",
            "/administration/users/create" => "com/view/users/create-user.php",
            "/administration/categories/create" => "com/view/administration/category/create-category.php",
            "/administration/products/create" => "com/view/administration/products/create-product.php"
        );

        $viewPath = $pathToViewMappings[$this->requestPath];
        if ($viewPath == null) {
            http_response_code(404);

            include "com/view/not-found.php";
        } else {
            include $viewPath;
        }
    }

}
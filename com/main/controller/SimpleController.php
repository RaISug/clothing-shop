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

        return (new ResponseBuilder())->withRequest($request)->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $pathToViewMappings = array(
            "" => "com/view/home.php",
            "/" => "com/view/home.php",
            "/newdesign" => "newdesign/home.php",
            "/login" => "com/view/login.php",
            "/registration" => "com/view/registration.php",
            "/orders/api/v1" => "com/view/orders.php",
            "/orders/api/v1/order/submitted" => "com/view/order-submitted.php",
            "/users/api/v1/profile" => "com/view/user-profile.php",
            "/administration" => "com/view/administration/home.php",
            "/administration/" => "com/view/administration/home.php",
            "/administration/collections/create" => "com/view/administration/collections/create-collection.php",
            "/administration/orders/by/date" => "com/view/administration/orders/find-orders-by-date.php",
            "/administration/orders/between/datetimes" => "com/view/administration/orders/find-orders-between-datetime.php",
            "/administration/users/create" => "com/view/administration/users/create-user.php",
            "/administration/categories/create" => "com/view/administration/category/create-category.php",
            "/administration/products/create" => "com/view/administration/products/create-product.php",
            "/administration/carousels/create" => "com/view/administration/carousel/create-carousel.php",
            "/administration/languages/create" => "com/view/administration/language/create-language.php"
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
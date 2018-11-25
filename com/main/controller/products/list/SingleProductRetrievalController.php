<?php

namespace controller;

use request\Request;
use response\Response;
use entity\Product as Product;
use response\ResponseBuilder as ResponseBuilder;
use repository\ProductRepository as ProductRepository;

class SingleProductRetrievalController extends Controller {

    private $product;
    private $repository;

    private $requestPath;

    public function __construct() {
        $this->repository = new ProductRepository();
    }

    public function canHandle(Request $request) {
        return $request->isGETRequest() && preg_match("/(^\/administration\/products\/api\/v1\/product\/[0-9]+$)|(^\/products\/api\/v1\/product\/[0-9]+$)/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $this->requestPath = $request->getPath();

        $id = $request->getPathParameter("product");

        $dbResponse = $this->repository->byId($id);

        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withStatusCodeOK()->build();
        }

        return (new ResponseBuilder())->withStatusCodeOK()->withEntity(new Product($dbResponse->fetch_assoc()))->build();
    }

    public function display(Response $response) {
        if ($this->isAdministrationPath()) {
            include "com/view/administration/products/update-product.php";
        } else {
            include "com/view/products/single-product.php";
        }
    }

    private function isAdministrationPath() {
        return strpos($this->requestPath, "/administration") === 0;
    }

}
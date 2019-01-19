<?php

namespace controller;

use request\Request;
use response\Response;
use repository\OrderRepository;
use response\ResponseBuilder;
use entity\Order;

class SingleOrderRetrievalController extends Controller {
    
    private $repository;
    private $isUpdateRequest;
    
    public function __construct() {
        $this->repository = new OrderRepository();
    }

    public function canHandle(Request $request) {
        return $request->isGETRequest() && preg_match("/\/administration\/orders\/api\/v1\/order\/[0-9]+$/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $this->isUpdateRequest = $request->getQueryParameter("update");

        $id = $request->getPathParameter("order");

        $dbResponse = $this->repository->byId($id);
        
        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withStatusCodeOK()->build();
        }
        
        return (new ResponseBuilder())->withStatusCodeOK()->withEntity(new Order($dbResponse->fetch_assoc()))->build();
    }

    public function display(Response $response) {
        if ($this->isUpdateRequest === "true") {
            include 'com/view/administration/orders/update-order.php';
        } else {
            include 'com/view/administration/orders/single-order.php';
        }
    }
    
}
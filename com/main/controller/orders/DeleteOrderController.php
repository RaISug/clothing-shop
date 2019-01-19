<?php

namespace controller;

use request\Request;
use response\Response;
use repository\OrderRepository;
use response\ResponseBuilder;

class DeleteOrderController extends Controller {

    private $repository;
    
    public function __construct() {
        $this->repository = new OrderRepository();
    }

    public function canHandle(Request $request) {
        return $request->isDELETERequest() && preg_match("/\/administration\/orders\/api\/v1\/order\/[0-9]+$/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $id = $request->getPathParameter("order");

        $this->repository->deleteById($id);

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $response->redirectTo("/administration/orders/search");
    }
    
}
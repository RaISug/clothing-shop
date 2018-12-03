<?php

namespace controller;

use request\Request;
use response\Response;
use repository\OrderRepository;
use response\ResponseBuilder;

class UpdateOrderStatusController extends Controller {
    
    private $repository;
    
    public function __construct() {
        $this->repository = new OrderRepository();
    }
    
    public function canHandle(Request $request) {
        return $request->isPUTRequest() && preg_match("/\/administration\/orders\/api\/v1\/order\/[0-9]+$/", $request->getPath()) == 1;
    }
    
    public function handle(Request $request) {
        $id = $request->getPathParameter("order");
        $markAsProcessed = $request->getParameter("mark_as_processed");
        
        if ($markAsProcessed === "true") {
            $this->repository->markAsProcessed($id);
        } else {
            $this->repository->markAsNotProcessed($id);
        }
        
        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    public function display(Response $response) {
        $response->redirectTo("/administration/orders/search");
    }
    
}
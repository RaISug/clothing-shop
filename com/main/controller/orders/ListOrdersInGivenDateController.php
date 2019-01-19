<?php

namespace controller;

use request\Request;
use response\Response;
use repository\OrderRepository;
use dto\Pagination;
use response\ResponseBuilder;
use entity\Order;
use service\PaginationService;
use service\OrderingService;

class ListOrdersInGivenDateController extends Controller {
    
    private $repository;
    private $paginationService;
    private $orderingService;
    
    public function __construct() {
        $this->repository = new OrderRepository();
        $this->paginationService = new PaginationService();
        $this->orderingService = new OrderingService();
    }
    
    public function canHandle(Request $request) {
        return $request->isGETRequest() && $request->getPath() === "/administration/orders/api/v1" && $request->getParameter("date") != null;
    }
    
    public function handle(Request $request) {
        $date = $request->getParameter("date");
        $showProcessed = $request->getParameter("show_processed");
        
        $page = $this->paginationService->getPage($request);
        $offset = $this->paginationService->getOffset($request);
        $orderBy = $this->orderingService->getOrderedBy($request);
        $orderingType = $this->orderingService->getOrderingType($request);
        
        if ($showProcessed === "true") {
            $dbResponse = $this->repository->onlyProcessedInDate($date, $page, $offset, $orderBy, $orderingType);
        } else {
            $dbResponse = $this->repository->onlyNotProcessedInDate($date, $page, $offset, $orderBy, $orderingType);
        }
        
        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withStatusCodeOK()->withEntity(new Pagination(array(), 0, 0, 50))->build();
        }
        
        $entities = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Order($row);
        }
        
        if ($showProcessed === "true") {
            $total = $this->repository->countOfProcessed();
        } else {
            $total = $this->repository->countOfNotProcessed();
        }
        
        return (new ResponseBuilder())
                    ->withStatusCodeOK()
                    ->withEntity(new Pagination($entities, $total, $page + 1, $offset, $orderBy, $orderingType))
                    ->build();
    }
    
    public function display(Response $response) {
        include 'com/view/administration/orders/all-orders.php';
    }
    
}
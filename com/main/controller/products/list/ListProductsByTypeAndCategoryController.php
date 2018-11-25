<?php

namespace controller;

use entity\Product;
use repository\ProductRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use service\PaginationService;
use service\OrderingService;

class ListProductsByTypeAndCategoryController extends Controller {

    private $repository;
    private $paginationService;
    private $orderingService;

    public function __construct() {
        $this->repository = new ProductRepository();
        $this->paginationService = new PaginationService();
        $this->orderingService = new OrderingService();
    }

    public function canHandle(Request $request) {
        return $request->isGETRequest() && preg_match("/\/products\/api\/v1\/type\/\w+?\/category\/[a-zA-Z ]+$/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $type = $request->getPathParameter("type");
        $category = $request->getPathParameter("category");

        $page = $this->paginationService->getPage($request);
        $offset = $this->paginationService->getOffset($request);
        $orderBy = $this->orderingService->getOrderedBy($request);
        $orderingType = $this->orderingService->getOrderingType($request);

        $dbResponse = $this->repository->byTypeAndCategory($type, $category, $page, $offset, $orderBy, $orderingType);

        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withStatusCodeOK()->withEntity(array())->build();
        }

        $entities = array();

        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Product($row);
        }

        return (new ResponseBuilder())->withStatusCodeOK()->withEntity($entities)->build();
    }

    public function display(Response $response) {
        include "com/view/products/all-products.php";
    }
    
}
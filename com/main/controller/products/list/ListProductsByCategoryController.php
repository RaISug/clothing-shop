<?php

namespace controller;

use entity\Product;
use repository\ProductRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use service\PaginationService;
use service\OrderingService;
use dto\Pagination;

class ListProductsByCategoryController extends Controller {

    private $repository;
    private $paginationService;
    private $orderingService;

    public function __construct() {
        $this->repository = new ProductRepository();
        $this->paginationService = new PaginationService();
        $this->orderingService = new OrderingService();
    }

    public function canHandle(Request $request) {
        return $request->isGETRequest() && preg_match("/\/products\/api\/v1\/category\/[\w\p{Cyrillic}\-]+$/", $request->getPath()) === 1;
    }

    public function handle(Request $request) {
        $category = $request->getPathParameter("category");

        $page = $this->paginationService->getPage($request);
        $offset = $this->paginationService->getOffset($request);
        $orderBy = $this->orderingService->getOrderedBy($request);
        $orderingType = $this->orderingService->getOrderingType($request);

        $dbResponse = $this->repository->byCategory($category, $page, $offset, $orderBy, $orderingType);

        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withRequest($request)->withStatusCodeOK()->withEntity(new Pagination(array(), 0, 0, 50, $orderBy, $orderingType))->build();
        }

        $entities = array();

        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Product($row);
        }

        $total = $this->repository->countOfItemsInCategory($category);

        return (new ResponseBuilder())
                    ->withRequest($request)
                    ->withStatusCodeOK()
                    ->withEntity(new Pagination($entities, $total, $page + 1, $offset, $orderBy, $orderingType))
                    ->build();
    }
    
    public function display(Response $response) {
        include "com/view/products.php";
    }
    
}
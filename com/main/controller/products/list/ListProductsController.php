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

class ListProductsController extends Controller {

    private $repository;
    private $paginationService;
    private $orderingService;

    private $requestPath;

    public function __construct() {
        $this->repository = new ProductRepository();
        $this->paginationService = new PaginationService();
        $this->orderingService = new OrderingService();
    }

    public function canHandle(Request $request) {
        return $request->isGETRequest() && ($request->getPath() === "/products/api/v1" || $request->getPath() === "/administration/products/api/v1");
    }

    public function handle(Request $request) {
        $this->requestPath = $request->getPath();

        $page = $this->paginationService->getPage($request);
        $offset = $this->paginationService->getOffset($request);
        $orderBy = $this->orderingService->getOrderedBy($request);
        $orderingType = $this->orderingService->getOrderingType($request);

        $dbResponse = $this->repository->all($page, $offset, $orderBy, $orderingType);

        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withStatusCodeOK()->withEntity(new Pagination(array(), 0, 0, 50))->build();
        }

        $entities = array();

        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Product($row);
        }

        $total = $this->repository->count();

        return (new ResponseBuilder())
                    ->withStatusCodeOK()
                    ->withEntity(new Pagination($entities, $total, $page + 1, $offset, $orderBy, $orderingType))
                    ->build();
    }

    public function display(Response $response) {
        if ($this->isAdministrationPath()) {
            include "com/view/administration/products/manage-products.php";
        } else {
            include "com/view/products/all-products.php";
        }
    }

    private function isAdministrationPath() {
        return strpos($this->requestPath, "/administration") === 0;
    }

}
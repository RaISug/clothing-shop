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

class ListProductsInCollectionController extends Controller {
    
    private $repository;
    private $paginationService;
    private $orderingService;
    
    public function __construct() {
        $this->repository = new ProductRepository();
        $this->paginationService = new PaginationService();
        $this->orderingService = new OrderingService();
    }
    
    public function canHandle(Request $request) {
        return $request->isGETRequest() && preg_match("/\/products\/api\/v1\/collection\/[0-9a-zA-Z -]+$/", $request->getPath()) === 1;
    }
    
    public function handle(Request $request) {
        $collection = $request->getPathParameter("collection");
        
        $page = $this->paginationService->getPage($request);
        $offset = $this->paginationService->getOffset($request);
        $orderBy = $this->orderingService->getOrderedBy($request);
        $orderingType = $this->orderingService->getOrderingType($request);
        
        $dbResponse = $this->repository->byCollection($collection, $page, $offset, $orderBy, $orderingType);
        
        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withStatusCodeOK()->withEntity(new Pagination(array(), 0, 0, 50, $orderBy, $orderingType))->build();
        }
        
        $entities = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Product($row);
        }
        
        $total = $this->repository->countOfItemsInCollection($collection);
        
        return (new ResponseBuilder())
                        ->withStatusCodeOK()
                        ->withEntity(new Pagination($entities, $total, $page + 1, $offset, $orderBy, $orderingType))
                        ->build();
    }
    
    public function display(Response $response) {
        include "com/view/products.php";
    }
    
}
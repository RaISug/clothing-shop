<?php

namespace controller;

use repository\CollectionRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class AddProductsToCollectionController extends Controller {
    
    private $repository;
    
    function __construct() {
        $this->repository = new CollectionRepository();
    }
    
    public function canHandle(Request $request) {
        return $request->isPUTRequest() && $request->getPath() === "/administration/collections/api/v1";
    }

    public function handle(Request $request) {
        $productId = $request->getParameter("product_id");
        $collectionId = $request->getParameter("collection_id");

        $this->repository->addProductToCollection($productId, $collectionId);

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    public function display(Response $response) {
        $response->redirectTo("/administration/collections/add/products?operation-add=succeed");
    }

}
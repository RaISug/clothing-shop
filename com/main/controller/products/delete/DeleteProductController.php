<?php

namespace controller;

use entity\Product;
use repository\ProductRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use service\FileService;
use exception\NotFoundException;
use constants\Constants;

class DeleteProductController extends Controller {

    private $repository;
    private $fileService;
    
    public function __construct() {
        $this->repository = new ProductRepository();
        $this->fileService = new FileService();
    }

    public function canHandle(Request $request) {
        return $request->isDELETERequest() && preg_match("/\/administration\/products\/api\/v1\/product\/[0-9]+$/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $id = $request->getPathParameter("product");
        $product = $this->retrieveProductById($id);

        $this->fileService->deleteFilesFrom($product->imageNamesAsArray(), Constants::$PRODUCTS_UPLOAD_DIRECTORY);

        $this->repository->deleteById($id);

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    private function retrieveProductById($id) {
        $dbResponse = $this->repository->byId($id);

        if ($dbResponse->num_rows == 0) {
            throw new NotFoundException("Product with the specified id does not exists");
        }

        return new Product($dbResponse->fetch_assoc());
    }

    public function display(Response $response) {
        $response->redirectTo("/administration/products/api/v1");
    }

}
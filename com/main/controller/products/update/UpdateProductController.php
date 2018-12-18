<?php

namespace controller;

use entity\Product;
use factory\ProductFactory;
use repository\ProductRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use service\FileService;
use constants\Constants;

class UpdateProductController extends Controller {

    private $repository;
    private $fileService;
    private $factory;
    
    public function __construct() {
        $this->repository = new ProductRepository();
        $this->fileService = new FileService();
        $this->factory = new ProductFactory();
    }

    public function canHandle(Request $request) {
        return $request->isPUTRequest() && preg_match("/\/administration\/products\/api\/v1\/product\/[0-9]+$/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $id = $request->getPathParameter("product");

        $product = $this->retrieveProductById($id);

        $files = $request->getFiles("productimage");
        if ($files->areUploaded()) {
            $this->fileService->deleteFilesFrom($product->imageNamesAsArray(), Constants::$PRODUCTS_UPLOAD_DIRECTORY);
            $this->fileService->uploadFilesInto($files, Constants::$PRODUCTS_UPLOAD_DIRECTORY);
        }

        $imageNames = '';
        if ($files->areUploaded()) {
            $imageNames = $files->getUniqueNames();
        } else {
            $imageNames = $product->imageName();
        }

        $product = $this->factory->createProductFromRequest($request);
        $product->setImageName($imageNames);

        $this->repository->update($product);

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    private function retrieveProductById($id) {
        $dbResponse = $this->repository->byId($id);

        if ($dbResponse->num_rows == 0) {
            return null;
        }

        return new Product($dbResponse->fetch_assoc());
    }

    public function display(Response $response) {
        $response->redirectTo("/administration/products/api/v1");
    }

}
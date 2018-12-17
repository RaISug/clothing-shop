<?php

namespace controller;

use request\Request;
use response\Response;
use repository\ProductRepository;
use factory\ProductFactory;
use response\ResponseBuilder;
use service\FileService;
use constants\Constants;

class CreateProductController extends Controller {

    private $repository;
    private $fileService;
    
    public function __construct() {
        $this->repository = new ProductRepository();
        $this->fileService = new FileService();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && $request->getPath() === "/administration/products/api/v1";
    }

    public function handle(Request $request) {
        $factory = new ProductFactory();

        $files = $request->getFiles("productimage");

        $this->fileService->uploadFilesInto($files, Constants::$PRODUCTS_UPLOAD_DIRECTORY);

        $product = $factory->createProductFromRequest($request);
        $product->setImageName($files->getUniqueNames());

        $this->repository->persist($product);

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $response->redirectTo("/administration/products/create");
    }

}
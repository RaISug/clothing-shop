<?php

namespace controller;

use request\Request;
use response\Response;
use repository\ProductRepository;
use factory\ProductFactory;
use response\ResponseBuilder;
use service\FileService;

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

        $this->fileService->uploadFiles($request->getFiles("productimage"));
        $this->repository->persist($factory->createProductFromRequest($request));

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        include "com/view/administration/products/create-product.php";
    }

}
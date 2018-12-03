<?php

namespace controller;

use factory\CarouselFactory;
use repository\CarouselRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use service\FileService;
use constants\Constants;

class CreateCarouselController extends Controller {

    private $repository;
    private $factory;
    private $fileService;

    function __construct() {
        $this->repository = new CarouselRepository();
        $this->factory = new CarouselFactory();
        $this->fileService = new FileService();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && preg_match("/^\/administration\/carousels\/api\/v1$/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $this->fileService->uploadFileInto($request->getFile("carouselimage"), Constants::$CAROUSEL_UPLOAD_DIRECTORY);

        $this->repository->persist($this->factory->createCarouselFromRequest($request));

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    public function display(Response $response) {
        $response->redirectTo("/administration/carousels/create");
    }
    
}
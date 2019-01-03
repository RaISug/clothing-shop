<?php

namespace controller;

use repository\CarouselRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use exception\NotFoundException;
use entity\Carousel;
use constants\Constants;
use service\FileService;

class DeleteCarouselController extends Controller {

    private $repository;
    private $fileService;
    
    function __construct() {
        $this->repository = new CarouselRepository();
        $this->fileService = new FileService();
    }

    public function canHandle(Request $request) {
        return $request->isDELETERequest() && preg_match("/^\/administration\/carousels\/api\/v1\/carousel\/(\d)+$/", $request->getPath()) == 1;
    }
    
    public function handle(Request $request) {
        $id = $request->getPathParameter("carousel");
        $carousel = $this->retrieveCarouselById($id);

        $this->fileService->deleteFilesFrom($carousel->imageName(), Constants::$CAROUSEL_UPLOAD_DIRECTORY);

        $this->repository->deleteById($id);

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    private function retrieveCarouselById($id) {
        $dbResponse = $this->repository->byId($id);
        
        if ($dbResponse->num_rows == 0) {
            throw new NotFoundException("Carousel with the specified id does not exists");
        }
        
        return new Carousel($dbResponse->fetch_assoc());
    }

    public function display(Response $response) {
        $response->redirectTo("/administration/carousels/api/v1?operation-delete=succeed");
    }
    
}
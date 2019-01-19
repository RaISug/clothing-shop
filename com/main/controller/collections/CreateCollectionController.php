<?php

namespace controller;

use factory\CollectionFactory;
use repository\CollectionRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use service\FileService;
use constants\Constants;

class CreateCollectionController extends Controller {
    
    private $repository;
    private $factory;
    private $fileService;
    
    function __construct() {
        $this->repository = new CollectionRepository();
        $this->factory = new CollectionFactory();
        $this->fileService = new FileService();
    }
    
    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && preg_match("/^\/administration\/collections\/api\/v1$/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $file = $request->getFile("collectionimage");

        $this->fileService->uploadFileInto($file, Constants::$COLLECTIONS_UPLOAD_DIRECTORY);

        $collection = $this->factory->createCollectionFromRequest($request);
        $collection->setImageName($file->getUniqueName());
        
        $this->repository->persist($collection);
        
        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    public function display(Response $response) {
        $response->redirectTo("/administration/collections/add/products?operation-create=succeed");
    }
    
}
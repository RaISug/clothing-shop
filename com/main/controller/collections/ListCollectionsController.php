<?php

namespace controller;

use dto\Pagination;
use entity\Collection;
use repository\CollectionRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class ListCollectionsController extends Controller {
    
    private $repository;
    
    function __construct() {
        $this->repository = new CollectionRepository();
    }
    
    public function canHandle(Request $request) {
        return $request->isGETRequest() && $request->getPath() === "/administration/collections/api/v1";
    }

    public function handle(Request $request) {
        $dbResponse = $this->repository->all();

        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withStatusCodeOK()->withEntity(new Pagination(array(), 0, 0, 50))->build();
        }
        
        $entities = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Collection($row);
        }
        
        return (new ResponseBuilder())
                        ->withStatusCodeOK()
                        ->withEntity(new Pagination($entities, 0, 0, 50))
                        ->build();
    }
    
    public function display(Response $response) {
        include "com/view/administration/collections/all-collections.php";
    }

}
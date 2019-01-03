<?php

namespace controller;

use entity\Language;
use repository\LanguageRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class ListLanguagesController extends Controller {
    
    private $repository;
    
    function __construct() {
        $this->repository = new LanguageRepository();
    }
    
    public function canHandle(Request $request) {
        return $request->isGETRequest() && $request->getPath() === "/administration/languages/api/v1";
    }
    
    public function handle(Request $request) {
        $dbResponse = $this->repository->all();
        
        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withStatusCodeOK()->withRequest($request)->withEntity(array())->build();
        }
        
        $entities = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $entities[] = new Language($row);
        }
        
        return (new ResponseBuilder())
                        ->withStatusCodeOK()
                        ->withRequest($request)
                        ->withEntity($entities)
                        ->build();
    }
    
    public function display(Response $response) {
        include "com/view/administration/language/all-languages.php";
    }
    
}
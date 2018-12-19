<?php

namespace controller;

use entity\Language;
use exception\NotFoundException;
use repository\LanguageRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class ListSingleLanguageController extends Controller {
    
    private $repository;
    
    function __construct() {
        $this->repository = new LanguageRepository();
    }
    
    public function canHandle(Request $request) {
        return $request->isGETRequest() && preg_match("/^\/administration\/languages\/api\/v1\/language\/(\d)+$/", $request->getPath()) == 1;
    }
    
    public function handle(Request $request) {
        $dbResponse = $this->repository->byId($request->getPathParameter("language"));
        if ($dbResponse->num_rows === 0) {
            throw new NotFoundException("Element does not exists.");
        }

        return (new ResponseBuilder())->withEntity(new Language($dbResponse->fetch_assoc()))->withStatusCodeOK()->build();
    }
    
    public function display(Response $response) {
        include "com/view/administration/language/update-language.php";
    }
    
}
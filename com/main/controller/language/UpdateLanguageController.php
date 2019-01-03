<?php

namespace controller;

use repository\LanguageRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use factory\LanguageFactory;
use service\InternationalizationService;

class UpdateLanguageController extends Controller {
    
    private $factory;
    private $repository;
    
    function __construct() {
        $this->factory = new LanguageFactory();
        $this->repository = new LanguageRepository();
    }
    
    public function canHandle(Request $request) {
        return $request->isPUTRequest() && preg_match("/^\/administration\/languages\/api\/v1\/language\/(\d)+$/", $request->getPath()) == 1;
    }
    
    public function handle(Request $request) {
        $language = $this->factory->createLanguageFromRequest($request);

        $this->repository->update($language);

        $bundle = $request->getParameter("bundle");
        $this->createBundleFor($bundle, $language->name());

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }
    
    private function createBundleFor($bundle, $language) {
        $internationalizationService = new InternationalizationService($language);
        
        $internationalizationService->store($bundle);
    }
    
    public function display(Response $response) {
        $response->redirectTo("/administration/languages/api/v1?operation-update=succeed");
    }
    
}
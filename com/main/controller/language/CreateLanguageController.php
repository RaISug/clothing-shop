<?php

namespace controller;

use request\Request;
use response\Response;
use factory\LanguageFactory;
use repository\LanguageRepository;
use response\ResponseBuilder;
use service\InternationalizationService;

class CreateLanguageController extends Controller {

    private $repository;
    private $factory;
    
    function __construct() {
        $this->repository = new LanguageRepository();
        $this->factory = new LanguageFactory();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && $request->getPath() === "/administration/languages/api/v1";
    }

    public function handle(Request $request) {
        $language = $this->factory->createLanguageFromRequest($request);
        
        $this->repository->persist($language);

        $bundle = $request->getParameter("bundle");
        $this->createBundleFor($bundle, $language->name());

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    private function createBundleFor($bundle, $language) {
        $internationalizationService = new InternationalizationService($language);

        $internationalizationService->store($bundle);
    }

    public function display(Response $response) {
        $response->redirectTo("/administration/languages/create?operation-create=succeed");
    }
    
}
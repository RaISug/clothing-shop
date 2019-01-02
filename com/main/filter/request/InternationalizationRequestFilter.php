<?php

namespace filter;

use request\Request;
use session\SessionService;
use repository\LanguageRepository;
use exception\InternalServerErrorException;
use entity\Language;

class InternationalizationRequestFilter implements RequestFilter {

    private $repository;
    private $sessionService;
    
    public function __construct() {
        $this->repository = new LanguageRepository();
        $this->sessionService = new SessionService();
        
        $this->sessionService->start();
    }

    public function canHandle(Request $request) {
        return $request->isGETRequest();
    }

    public function filter(Request $request) {
        if ($this->isAdministrationRequest($request)) {
            $this->removeChoosenLanguage();
        } else {
            $this->addDefaultLanguageIfNone();
        }
    }
    
    private function isAdministrationRequest(Request $request) {
        return strpos($request->getPath(), "/administration/") === 0;
    }

    private function removeChoosenLanguage() {
        $this->sessionService->removeAttribute("language");
    }

    private function addDefaultLanguageIfNone() {
        $language = $this->sessionService->getAttribute("language");
        if ($language == null) {
            $language = $this->retrieveDefaultLanguage();
            
            $this->sessionService->setAttribute("language", $language);
        }
    }

    private function retrieveDefaultLanguage() {
        $dbResponse = $this->repository->defaultLanguages();
        if ($dbResponse->num_rows === 0) {
            throw new InternalServerErrorException("There is no default language.");
        }
        
        return new Language($dbResponse->fetch_assoc());
    }

}
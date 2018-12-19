<?php

namespace controller;

use request\Request;
use response\Response;
use session\SessionService;
use response\ResponseBuilder;
use repository\LanguageRepository;
use exception\BadRequestException;
use entity\Language;

class ChangeActiveLanguageController extends Controller {
 
    private $repository;
    private $sessionService;

    public function __construct() {
        $this->repository = new LanguageRepository();
        $this->sessionService = new SessionService();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && $request->getPath() === "/languages/api/v1";
    }
    
    public function handle(Request $request) {
        $languageName = $request->getParameter("language_name");
        
        $dbResponse = $this->repository->byName($languageName);
        if ($dbResponse->num_rows == 0) {
            throw new BadRequestException("Language with the given name does not exists.");
        }

        $this->sessionService->setAttribute("language", new Language($dbResponse->fetch_assoc()));

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $response->redirectTo("/");
    }
    
}
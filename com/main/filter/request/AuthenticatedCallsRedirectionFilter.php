<?php

namespace filter;

use request\Request;
use session\SessionService;

class AuthenticatedCallsRedirectionFilter implements RequestFilter {

    private $sessionService;

    public function __construct() {
        $this->sessionService = new SessionService();
    }

    public function canHandle(Request $request) {
        return $this->sessionService->isUnauthenticatedRequest() === false;
    }

    public function filter(Request $request) {
        $pathsToRedirect = array(
            "/login",
            "/registration"
        );
        
        foreach ($pathsToRedirect as $path) {
            if ($path === $request->getPath()) {
                header("Location:http://localhost/com.radoslav.web.shop/t.php/");

                exit;
            }
        }
    }

}
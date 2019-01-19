<?php

namespace filter;

use request\Request;
use session\SessionService;

class UnauthenticatedCallsRedirectionFilter implements RequestFilter {

    private $sessionService;

    public function __construct() {
        $this->sessionService = new SessionService();
    }

    public function canHandle(Request $request) {
        return $this->sessionService->isUnauthenticatedRequest();
    }

    public function filter(Request $request) {
        $pathsToRedirect = array(
            "/orders/api/v1",
        );
        
        foreach ($pathsToRedirect as $path) {
            if ($path === $request->getPath()) {
                header("Location:http://localhost/com.radoslav.web.shop/t.php/login?login=required");

                exit;
            }
        }
    }

}
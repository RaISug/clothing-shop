<?php

namespace filter;

use request\Request;
use exception\UnauthorizedException;
use session\SessionService;

class AuthenticationFilter implements RequestFilter {

    private $sessionService;

    public function __construct() {
        $this->sessionService = new SessionService();
    }

    public function canHandle(Request $request) {
        return strpos($request->getPath(), "/administration") === 0;
    }

    public function filter(Request $request) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            throw new UnauthorizedException("There is no active session.");
        }

        if ($this->sessionService->isRequestMadeByUserWithoutPrivileges()) {
            throw new UnauthorizedException("There is no active session.");
        }
    }

}
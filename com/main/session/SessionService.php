<?php

namespace session;

use \RuntimeException;
use entity\User;

class SessionService {

    public function start() {
        $isSessionStarted = session_start();
        if ($isSessionStarted === FALSE) {
            throw new RuntimeException("Failed to start session.");
        }
    }

    public function getAuthenticatedUser() {
        return $_SESSION['user'];
    }

    public function setAuthenticatedUser(User $user) {
        $_SESSION['user'] = $user;
    }

    public function isUnauthenticatedRequest() {
        return $_SESSION['user'] == null;
    }

    public function getAttribute($name) {
        return $_SESSION[$name];
    }

    public function setAttribute($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function removeAttribute($name) {
        unset($_SESSION[$name]);
    }

    public function stop() {
        $isSessionDestroyed = session_destroy();
        if ($isSessionDestroyed === FALSE) {
            throw new RuntimeException("Failed to destroy session.");
        }
    }

}
<?php

namespace exception;

class UnauthorizedException extends ResponseException {
    
    private $errorMessage;
    private $statusCode;
    
    public function __construct($errorMessage) {
        $this->errorMessage = $errorMessage;
        $this->statusCode = "401";
    }
    
    public function errorMessage() {
        return $this->errorMessage;
    }
    
    public function statusCode() {
        return $this->statusCode;
    }
    
}
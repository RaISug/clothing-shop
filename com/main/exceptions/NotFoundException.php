<?php

namespace exception;

class NotFoundException extends ResponseException {
    
    private $errorMessage;
    private $statusCode;
    
    public function __construct($errorMessage) {
        $this->errorMessage = $errorMessage;
        $this->statusCode = "404";
    }
    
    public function errorMessage() {
        return $this->errorMessage;
    }
    
    public function statusCode() {
        return $this->statusCode;
    }
    
}
<?php
namespace exception;

class InternalServerErrorException extends ResponseException {
    
    private $errorMessage;

    public function __construct($errorMessage) {
        $this->errorMessage = $errorMessage;
    }

    public function errorMessage() {
        return $this->errorMessage;
    }

    public function statusCode() {
        return "500";
    }
    
}
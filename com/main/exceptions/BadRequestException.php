<?php

namespace exception;

class BadRequestException extends ResponseException {

    private $errorMessage;
    private $statusCode;

    public function __construct($errorMessage) {
        $this->errorMessage = $errorMessage;
        $this->statusCode = "400";
    }

    public function errorMessage() {
        return $this->errorMessage;
    }

    public function statusCode() {
        return $this->statusCode;
    }

}
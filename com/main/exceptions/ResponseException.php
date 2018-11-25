<?php

namespace exception;

use Exception;

abstract class ResponseException extends Exception {

    public abstract function errorMessage();

    public abstract function statusCode();

}
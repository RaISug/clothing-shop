<?php

namespace request;

use file\Files;

class Request {

    public function getPath() {
        return $this->getPathInfo();
    }

    public function getPathParameter(string $paramName) {
        $requestURI = $this->getPathInfo();

        $pathParams = explode("/", $requestURI);
        for ($i = 0 ; $i < count($pathParams) ; $i++) {
            if ($pathParams[$i] === $paramName && ($i + 1) < count($pathParams)) {
                return $pathParams[$i + 1];
            }
        }
        
        return null;
    }

    private function getPathInfo() {
        return $_SERVER['PATH_INFO'];
    }

    public function getQueryParameter(string $name) {
        return $_GET[$name];
    }

    private function getQueryParams() {
        return $_SERVER['QUERY_STRING'];
    }

    public function getRawBody() {
        return file_get_contents("php://input");
    }

    public function getFiles(string $name) {
        return new Files($this->getFilesAsArray($name));
    }

    private function getFilesAsArray(string $name) {
        $keys = array_keys($_FILES[$name]);

        $files = array();
        for ($i = 0 ; $i < count($_FILES[$name]['name']) ; $i++) {
            foreach ($keys as $key) {
                $files[$i][$key] = $_FILES[$name][$key][$i];
            }
        }

        return $files;
    }

    public function getParameter(string $name) {
        if ($this->isPOSTRequest()) {
            return $_POST[$name];
        }

        return $_GET[$name];
    }

    public function isGETRequest() {
        return $_SERVER['REQUEST_METHOD'] === "GET";
    }
    
    public function isPOSTRequest() {
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }
    
    public function isPUTRequest() {
        return $_SERVER['REQUEST_METHOD'] === "POST" && $this->getParameter("_method") === "PUT";
    }
    
    public function isDELETERequest() {
        return $_SERVER['REQUEST_METHOD'] === "POST" && $this->getParameter("_method") === "DELETE";
    }

}
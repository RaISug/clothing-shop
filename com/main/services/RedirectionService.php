<?php

namespace service;

class RedirectionService {

    private $whitelistedPaths;

    public function __construct() {
        $this->whitelistedPaths = array();
        
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/type\/\w+?\/category\/[\w\p{Cyrillic}\-\s]+$/u";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/category\/[\w\p{Cyrillic}\-\s]+$/u";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/type\/\w+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/collection\/[\w\p{Cyrillic}\-\s]+$/u";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/product\/[0-9]+$/";
        $this->whitelistedPaths[] = "/\/carts\/api\/v1$/";
    }

    public function constructRedirectionPath() {    
        $matches = array();

        $requestPath = urldecode($this->extractRequestPath());
        foreach ($this->whitelistedPaths as $whitelistedPath) {
            if (preg_match($whitelistedPath, $requestPath, $matches) == 1) {
            	$queryPath = $this->extractQueryPath();
            	if ($queryPath == "") {
            		return $matches[0] . "?insert=succeed";
            	}

            	if (strpos($queryPath, "insert=succeed") === FALSE) {
	                return $matches[0] . "?insert=succeed&" . $queryPath;
            	}

            	return $matches[0] . "?" . $queryPath;
            }
        }

        return "/products/api/v1?insert=succeed";
    }

    private function extractRequestPath() {
    	$referrer = $_SERVER['HTTP_REFERER'];
    
    	$requestLine = explode("?", $referrer);

    	return $requestLine[0];
    }

    private function extractQueryPath() {
    	$referrer = $_SERVER['HTTP_REFERER'];

    	$requestLine = explode("?", $referrer);
    	if (count($requestLine) == 1) {
    		return "";
    	}

    	return $requestLine[1];
    }

}
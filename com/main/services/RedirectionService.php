<?php

namespace service;

class RedirectionService {

    private $whitelistedPaths;

    public function __construct() {
        $this->whitelistedPaths = array();
        
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/type\/\w+?\/category\/[a-zA-Z ]+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/category\/[a-zA-Z ]+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/type\/\w+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/collection\/[0-9a-zA-Z -]+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/product\/[0-9]+$/";
        $this->whitelistedPaths[] = "/\/carts\/api\/v1$/";
    }

    public function constructRedirectionPath() {    
        $matches = array();

        $referrer = $_SERVER['HTTP_REFERER'];

        foreach ($this->whitelistedPaths as $whitelistedPath) {
            if (preg_match($whitelistedPath, $referrer, $matches) === 1) {
                return $matches[0] . "?insert=succeed";
            }
        }
        
        return "/products/api/v1?insert=succeed";
    }

}
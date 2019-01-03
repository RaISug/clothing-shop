<?php

namespace service;

class RedirectionService {

    private $whitelistedPaths;

    public function __construct() {
        $this->whitelistedPaths = array();
        
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/type\/\w+?\/category\/[a-zA-Z ]+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/type\/\w+?\/category\/[a-zA-Z ]+\?insert=succeed$/";
        
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/category\/[a-zA-Z ]+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/category\/[a-zA-Z ]+\?insert=succeed$/";
        
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/type\/\w+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/type\/\w+\?insert=succeed$/";
        
        $this->whitelistedPaths[] = "/\/products\/api\/v1$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\?insert=succeed$/";
        
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/collection\/[0-9a-zA-Z -]+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/collection\/[0-9a-zA-Z -]+\?insert=succeed$/";
        
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/product\/[0-9]+$/";
        $this->whitelistedPaths[] = "/\/products\/api\/v1\/product\/[0-9]+\?insert=succeed$/";
        
        $this->whitelistedPaths[] = "/\/carts\/api\/v1$/";
        $this->whitelistedPaths[] = "/\/carts\/api\/v1\?insert=succeed$/";
    }

    public function constructRedirectionPath() {    
        $matches = array();

        $referrer = $_SERVER['HTTP_REFERER'];

        foreach ($this->whitelistedPaths as $whitelistedPath) {
            if (preg_match($whitelistedPath, $referrer, $matches) === 1) {
                if ($this->endsWith($matches[0], "?insert=succeed")) {
                    return $matches[0];
                }

                return $matches[0] . "?insert=succeed";
            }
        }
        
        return "/products/api/v1?insert=succeed";
    }

    function endsWith($haystack, $needlee) {
        return (substr($haystack, -strlen($needlee)) === $needlee);
    }

}
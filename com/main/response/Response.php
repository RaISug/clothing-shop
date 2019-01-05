<?php

namespace response;


class Response {

    private $statusCode;
    private $entity;
    private $supportingEntities;
    private $headers;
    private $contentType;
    private $request;
    private $language;

    public function __construct($statusCode, $entity, $supportingEntities, $headers, $contentType, $request, $language) {
        $this->statusCode = $statusCode;
        $this->entity = $entity;
        $this->supportingEntities = $supportingEntities;
        $this->headers = $headers;
        $this->contentType = $contentType;
        $this->request = $request;
        $this->language = $language;
    }

    public function entity() {
        return $this->entity;
    }

    public function supportingEntities() {
        return $this->supportingEntities;
    }

    public function supportingEntity($key) {
        return $this->supportingEntities[$key];
    }

    public function contentType() {
        return $this->contentType;
    }

    public function statusCode() {
        return $this->statusCode;
    }

    public function header($name) {
        return $this->headers[$name];
    }

    public function redirectTo($location) {
        header("Location:http://localhost" . $this->serverContext() . $location);
    }

    public function resourceContext() {
    	return "/clothing-shop";
    }

    public function serverContext() {
        return "/clothing-shop/t.php";
    }
    
    public function imagesContext() {
        return "/clothing-shop/images";
    }

    public function request() {
        return $this->request;
    }

    public function language() {
        return $this->language;
    }

}
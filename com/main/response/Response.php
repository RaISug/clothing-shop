<?php

namespace response;

class Response {

    private $statusCode;
    private $entity;
    private $supportingEntities;
    private $headers;
    private $contentType;

    public function __construct($statusCode, $entity, $supportingEntities, $headers, $contentType) {
        $this->statusCode = $statusCode;
        $this->entity = $entity;
        $this->supportingEntities = $supportingEntities;
        $this->headers = $headers;
        $this->contentType = $contentType;
    }

    public function entity() {
        return $this->entity;
    }

    public function supportingEntities() {
        return $this->supportingEntities;
    }

    public function supportingEntity(string $key) {
        return $this->supportingEntities[$key];
    }

    public function contentType() {
        return $this->contentType;
    }

    public function statusCode() {
        return $this->statusCode;
    }

    public function getHeader($name) {
        return $this->headers[$name];
    }

    public function redirectTo(string $location) {
        header("Location:http://localhost/com.radoslav.web.shop/t.php" . $location);
    }

    public function serverContext() {
        return "/com.radoslav.web.shop/t.php";
    }

}
<?php

namespace response;


class ResponseBuilder {

    private $headers;
    private $statusCode;
    private $entity;
    private $supportingEntities;
    private $contentType;
    private $request;
    private $language;

    public function __construct() {
        $this->headers = array();
        $this->supportingEntities = array();
    }

    public function withEntity($entity) {
        $this->entity = $entity;

        return $this;
    }

    public function withSupportingEntities($supportingEntities) {
        $this->supportingEntities = $supportingEntities;

        return $this;
    }

    public function withSupportingEntity(string $key, $entity) {
        $this->supportingEntities[$key] = $entity;

        return $this;
    }

    public function putHeader($name, $value) {
        $this->headers[$name] = $value;

        return $this;
    }

    public function withStatusCodeUnauthorized() {
        $this->statusCode = 401;

        return $this;
    }

    public function withStatusCode($statusCode) {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function withStatusCodeOK() {
        $this->statusCode = 200;

        return $this;
    }

    public function withContentTypeApplicationJson() {
        $this->contentType = "application/json";

        return $this;
    }

    public function withRequest($request) {
        $this->request = $request;

        return $this;
    }

    public function withLanguage($language) {
        $this->language = $language;

        return $this;
    }

    public function build() {
        return new Response($this->statusCode, $this->entity, $this->supportingEntities, $this->headers, $this->contentType, $this->request, $this->language);
    }

}
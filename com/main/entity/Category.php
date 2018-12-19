<?php

namespace entity;

class Category {

    private $id;
    private $name;
    private $displayName;
    private $languageId;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->displayName = $data['display_name'];
        $this->languageId = $data['language_id'];
    }

    public function id() {
        return $this->id;
    }

    public function name() {
        return $this->name;
    }

    public function displayName() {
        return $this->displayName;
    }

    public function languageId() {
        return $this->languageId;
    }
   
}
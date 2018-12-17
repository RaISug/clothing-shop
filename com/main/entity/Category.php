<?php

namespace entity;

class Category {

    private $id;
    private $name;
    private $displayName;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->displayName = $data['display_name'];
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

}
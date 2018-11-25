<?php

namespace entity;

class Category {

    private $id;
    private $name;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public function id() {
        return $this->id;
    }

    public function name() {
        return $this->name;
    }

}
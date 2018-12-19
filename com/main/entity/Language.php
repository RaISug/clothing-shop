<?php

namespace entity;

class Language {
    
    private $id;
    private $name;
    private $isDefault;
    
    public function __construct($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->isDefault = $data['is_default'];
    }
    
    public function id() {
        return $this->id;
    }
    
    public function name() {
        return $this->name;
    }

    public function isDefault() {
        return $this->isDefault;
    }

}
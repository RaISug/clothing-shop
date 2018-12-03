<?php

namespace entity;

class Carousel {

    private $id;
    private $imageName;
    private $description;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->imageName = $data['image_name'];
        $this->description = $data['description'];
    }

    public function id() {
        return $this->id;
    }

    public function imageName() {
        return $this->imageName;
    }

    public function description() {
        return $this->description;
    }

}
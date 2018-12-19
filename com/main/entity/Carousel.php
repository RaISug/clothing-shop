<?php

namespace entity;

class Carousel {

    private $id;
    private $imageName;
    private $description;
    private $languageId;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->imageName = $data['image_name'];
        $this->description = $data['description'];
        $this->languageId = $data['language_id'];
    }

    public function id() {
        return $this->id;
    }

    public function imageName() {
        return $this->imageName;
    }

    public function setImageName($imageName) {
        $this->imageName = $imageName;
    }

    public function description() {
        return $this->description;
    }

    public function languageId() {
        return $this->languageId;
    }

}
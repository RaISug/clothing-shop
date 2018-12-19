<?php

namespace entity;

class Collection {
    
    private $id;
    private $imageName;
    private $titleName;
    private $description;
    private $technicalName;
    private $languageId;
    
    public function __construct($data) {
        $this->id = $data['id'];
        $this->imageName = $data['image_name'];
        $this->titleName = $data['title_name'];
        $this->description = $data['description'];
        $this->technicalName = $data['technical_name'];
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

    public function titleName() {
        return $this->titleName;
    }

    public function description() {
        return $this->description;
    }

    public function technicalName() {
        return $this->technicalName;
    }
    
    public function languageId() {
        return $this->languageId;
    }

}
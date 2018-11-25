<?php

namespace entity;

class Product {

    private $id;
    private $name;
    private $type;
    private $price;
    private $imageName;
    private $category;
    private $categoryId;

    public function __construct($data) {
        $this->id = $data['ID'];
        $this->name = $data['NAME'];
        $this->type = $data['type'];
        $this->price = $data['price'];
        $this->imageName = $data['image_name'];
        $this->category = $data['category'];
        $this->categoryId = $data['category_id'];
    }

    public function id() {
        return $this->id;
    }
    
    public function name() {
        return $this->name;
    }

    public function type() {
        return $this->type;
    }

    public function price() {
        return $this->price;
    }

    public function imageName() {
        return $this->imageName;
    }

    public function category() {
        return $this->category;
    }
    
    public function categoryId() {
        return $this->categoryId;
    }

    public function getFirstImageName() {
        return $this->imageNames()[0];
    }

    public function imageNames() {
        return explode(";", $this->imageName);
    }
}
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
    private $description;
    private $promotionalPrice;
    private $availableSizes;

    public function __construct($data) {
        $this->id = $data['ID'];
        $this->name = $data['NAME'];
        $this->type = $data['type'];
        $this->price = $data['price'];
        $this->imageName = $data['image_name'];
        $this->category = $data['category'];
        $this->categoryId = $data['category_id'];
        $this->description = $data['description'];
        $this->promotionalPrice = $data['promotional_price'];
        $this->availableSizes = $data['available_sizes'];
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
        return $this->imageNamesAsArray()[0];
    }

    public function imageNamesAsArray() {
        return explode(";", $this->imageName());
    }

    public function description() {
        return $this->description;
    }
    
    public function promotionalPrice() {
        return $this->promotionalPrice;
    }

    public function availableSizes() {
        return $this->availableSizes;
    }
    
    public function availableSizesAsArray() {
        return explode(";", $this->availableSizes);
    }

    public function hasSize(string $size) {
        if ($this->availableSizes === "") {
            return false;
        }

        $position = strpos($this->availableSizes, $size);

        return $position || $position === 0;
    }

}
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
    private $languageId;

    public function __construct($data) {
        $this->id = $data['ID'];
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->price = $data['price'];
        $this->imageName = $data['image_name'];
        $this->category = $data['category'];
        $this->categoryId = $data['category_id'];
        $this->description = $data['description'];
        $this->promotionalPrice = $data['promotional_price'];
        $this->availableSizes = $data['available_sizes'];
        $this->languageId = $data['language_id'];
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

    public function setImageName($imageName) {
        $this->imageName = $imageName;
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

    public function languageId() {
        return $this->languageId;
    }

    public function availableSizes() {
        return $this->availableSizes;
    }
    
    public function availableSizesAsArray() {
        return explode(";", $this->availableSizes);
    }

    public function hasSize($size) {
        if ($this->availableSizes === "") {
            return false;
        }

        $position = strpos($this->availableSizes, $size);

        return $position || $position === 0;
    }

    public function asArray() {
        return array(
            "ID" => $this->id,
            "name" => $this->name,
            "type" => $this->type,
            "price" => $this->price,
            "promotional_price" => $this->promotionalPrice,
            "image_name" => $this->imageName,
            "category" => $this->category,
            "category_id" => $this->categoryId,
            "description" => $this->description,
            "available_sizes" => $this->availableSizes,
            "language_id" => $this->languageId
        );
    }

}
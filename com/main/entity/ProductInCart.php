<?php

namespace entity;

use cart\CartItem;

class ProductInCart {

    private $product;
    private $cartItem;

    public function __construct(Product $product, CartItem $cartItem) {
        $this->product = $product;
        $this->cartItem = $cartItem;
    }

    public function id() {
        return $this->product->id();
    }
    
    public function name() {
        return $this->product->name();
    }
    
    public function type() {
        return $this->product->type();
    }
    
    public function price() {
        return $this->product->price();
    }
    
    public function setImageName($imageName) {
        $this->product->setImageName($imageName);
    }
    
    public function imageName() {
        return $this->product->imageName();
    }
    
    public function category() {
        return $this->product->category();
    }
    
    public function categoryId() {
        return $this->product->categoryId();
    }
    
    public function getFirstImageName() {
        return $this->product->getFirstImageName();
    }
    
    public function imageNamesAsArray() {
        return $this->product->imageNamesAsArray();
    }
    
    public function description() {
        return $this->product->description();
    }
    
    public function promotionalPrice() {
        return $this->product->promotionalPrice();
    }
    
    public function availableSizes() {
        return $this->product->availableSizes();
    }
    
    public function availableSizesAsArray() {
        return $this->product->availableSizesAsArray();
    }
    
    public function hasSize(string $size) {
        return $this->product->hasSize($size);
    }
    
    public function productId() {
        return $this->cartItem->productId();
    }
    
    public function size() {
        return $this->cartItem->size();
    }
    
    public function quantity() {
        return $this->cartItem->quantity();
    }

    public function asArray() {
        $product = $this->product->asArray();
        $cartItem = $this->cartItem->asArray();

        return array_merge($product, $cartItem);
    }

}
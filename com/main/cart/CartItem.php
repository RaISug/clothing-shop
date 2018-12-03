<?php

namespace cart;

class CartItem {

    private $productId;
    private $size;
    private $quantity;

    public function __construct($productId, $size) {
        $this->productId = $productId;
        $this->size = $size;
        $this->quantity = 1;
    }

    public function productId() {
        return $this->productId;
    }

    public function size() {
        return $this->size;
    }

    public function quantity() {
        return $this->quantity;
    }

    public function increaseQuantity() {
        $this->quantity++;
    }

    public function decreaseQuantity() {
        $this->quantity--;
    }

}
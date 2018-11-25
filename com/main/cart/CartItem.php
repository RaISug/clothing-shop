<?php

namespace cart;

class CartItem {

    private $productId;
    private $quantity;

    public function __construct($productId) {
        $this->productId = $productId;
        $this->quantity = 1;
    }

    public function productId() {
        return $this->productId;
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
<?php

namespace cart;

class CartItem {

    private $productId;
    private $size;
    private $quantity;

    public function __construct($productId, $size, $quantity = 1) {
        $this->productId = $productId;
        $this->size = $size;
        $this->quantity = $quantity;
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

    public function asArray() {
        return array(
            "productId" => $this->productId,
            "size" => $this->size,
            "quantity" => $this->quantity
        );
    }

}
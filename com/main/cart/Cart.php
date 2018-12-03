<?php

namespace cart;

use cart\CartItem as CartItem;
use session\SessionService as SessionService;

class Cart {

    private $sessionService;

    public function __construct() {
        $this->sessionService = new SessionService();

        $this->sessionService->start();
    }

    public function add($productId, $size) {
        if ($this->isProductAddedIntoCart($productId, $size)) {
            $this->incrementProductQuantity($productId, $size);
        } else {
            $this->addProductIntoCart($productId, $size);
        }
    }

    private function incrementProductQuantity($productId, $size) {
        $cartItems = $this->getCartItems();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->productId() === $productId && $cartItem->size() === $size) {
                $cartItem->increaseQuantity();
            }
        }
    }

    private function isProductAddedIntoCart($productId, $size) {
        $cartItems = $this->getCartItems();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->productId() === $productId && $cartItem->size() === $size) {
                return true;
            }
        }

        return false;
    }

    private function getCartItems() {
        $cartItems = $this->sessionService->getAttribute("cartItems");
        if ($cartItems == null) {
            return array();
        }

        return $cartItems;
    }

    private function addProductIntoCart($productId, $size) {
        $cartItems = $this->getCartItems();
        $cartItems[] = new CartItem($productId, $size);

        $this->sessionService->setAttribute("cartItems", $cartItems);
    }

    public function remove($productId, $size) {
        $cartItems = $this->getCartItems();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->productId() === $productId && $cartItem->size() === $size) {
                $cartItem->decreaseQuantity();
            }
        }
    }

    public function getAllProducts() {
        return $this->getCartItems();
    }

    public function clear() {
        $this->sessionService->removeAttribute("cartItems");
    }

}
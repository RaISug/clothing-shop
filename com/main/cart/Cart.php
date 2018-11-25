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

    public function add($productId) {
        if ($this->isProductAddedIntoCart($productId)) {
            $this->incrementProductQuantity($productId);
        } else {
            $this->addProductIntoCart($productId);
        }
    }

    private function incrementProductQuantity($productId) {
        $cartItems = $this->getCartItems();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->productId() === $productId) {
                $cartItem->increaseQuantity();
            }
        }
    }

    private function isProductAddedIntoCart($productId) {
        $cartItems = $this->getCartItems();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->productId() === $productId) {
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

    private function addProductIntoCart($productId) {
        $cartItems = $this->getCartItems();
        $cartItems[] = new CartItem($productId);

        $this->sessionService->setAttribute("cartItems", $cartItems);
    }

    public function remove($productId) {
        $cartItems = $this->getCartItems();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->productId() === $productId) {
                $cartItem->decreaseQuantity();
            }
        }
    }

    public function getAllProducts() {
        return $this->getCartItems();
    }

}
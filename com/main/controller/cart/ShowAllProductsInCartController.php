<?php

namespace controller;

use request\Request;
use response\Response;
use cart\Cart;
use response\ResponseBuilder;

class ShowAllProductsInCartController extends Controller {

    private $cart;

    public function __construct() {
        $this->cart = new Cart();
    }

    public function canHandle(Request $request) {
        return $request->isGETRequest() && $request->getPath() === "/cart/api/v1";
    }

    public function handle(Request $request) {
        return (new ResponseBuilder())->withStatusCodeOK()->withEntity($this->cart->getAllProducts())->build();
    }

    public function display(Response $response) {
        include "com/view/cart/cart.php";
    }

}
<?php

namespace controller;

use cart\Cart;
use request\Request;
use response\ResponseBuilder;
use response\Response;

class RemovingProductFromCartController extends Controller {

    private $cart;

    public function __construct() {
        $this->cart = new Cart();
    }

    public function canHandle(Request $request) {
        return $request->isDELETERequest() && preg_match("/\/cart\/api\/v1\/cart\/[0-9]+\/size\/(\w)+$/", $request->getPath()) == 1;
    }

    public function handle(Request $request) {
        $productId = $request->getPathParameter('cart');
        $size = $request->getPathParameter('size');

        $this->cart->remove($productId, $size);

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $response->redirectTo("/cart/api/v1");
    }

}
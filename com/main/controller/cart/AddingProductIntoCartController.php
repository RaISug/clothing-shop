<?php

namespace controller;

use request\Request;
use response\Response;
use cart\Cart as Cart;
use response\ResponseBuilder as ResponseBuilder;
use exception\BadRequestException as BadRequestException;

class AddingProductIntoCartController extends Controller {

    private $cart;

    public function __construct() {
        $this->cart = new Cart();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && $request->getPath() === "/carts/api/v1";
    }

    public function handle(Request $request) {
        $productId = $request->getParameter('id');
        if ($productId == null) {
            throw new BadRequestException("Id parameter is missing.");
        }

        $size = $request->getParameter("size");
        if ($size == null) {
            throw new BadRequestException("Size parameter is missing.");
        }

        $this->cart->add($productId, $size);
        
        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $response->redirectTo("/carts/api/v1");
    }

}
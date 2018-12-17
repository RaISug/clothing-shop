<?php

namespace controller;

use cart\Cart;
use entity\Product;
use entity\ProductInCart;
use repository\ProductRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class ShowAllProductsInCartController extends Controller {

    private $cart;
    private $repository;

    public function __construct() {
        $this->cart = new Cart();
        $this->repository = new ProductRepository();
    }

    public function canHandle(Request $request) {
        return $request->isGETRequest() && $request->getPath() === "/carts/api/v1";
    }

    public function handle(Request $request) {
        $productIds = array();
        
        $cartItems = $this->cart->getCartItems();
        foreach ($cartItems as $cartItem) {
            $productIds[] = $cartItem->productId();
        }

        if (count($productIds) == 0) {
            return (new ResponseBuilder())->withRequest($request)->withStatusCodeOK()->withEntity(array())->build();
        }

        $dbResponse = $this->repository->byIds($productIds);
        
        if ($dbResponse->num_rows == 0) {
            return (new ResponseBuilder())->withRequest($request)->withStatusCodeOK()->withEntity(array())->build();
        }

        $entities = array();
        
        while ($row = $dbResponse->fetch_assoc()) {
            $product = new Product($row);
            foreach ($cartItems as $cartItem) {
                if ($cartItem->productId() == $product->id()) {
                    $entities[] = new ProductInCart($product, $cartItem);
                }
            }
        }

        return (new ResponseBuilder())
                        ->withRequest($request)
                        ->withStatusCodeOK()
                        ->withEntity($entities)
                        ->build();
    }

    public function display(Response $response) {
        include "com/view/cart.php";
    }

}
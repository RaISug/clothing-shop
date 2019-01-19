<?php

namespace filter;

use cart\Cart;
use entity\Product;
use entity\ProductInCart;
use repository\ProductRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class CartProductsRetrievalFilter implements ResponseFilter {
    
    private $cart;
    private $repository;
    
    public function __construct() {
        $this->cart = new Cart();
        $this->repository = new ProductRepository();
    }
    
    public function canHandle(Request $request, Response $response) {
        return $request->isGETRequest() && strpos($request->getPath(), "/administration/") === false;
    }
    
    public function filter(Response &$response) {
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

        $response = (new ResponseBuilder())
                            ->withLanguage($response->language())
                            ->withRequest($response->request())
                            ->withEntity($response->entity())
                            ->withRequest($response->request())
                            ->withStatusCode($response->statusCode())
                            ->withSupportingEntities($response->supportingEntities())
                            ->withSupportingEntity("cartProducts", $entities)
                            ->build();
    }
    
}
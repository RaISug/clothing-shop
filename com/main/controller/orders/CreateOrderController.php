<?php

namespace controller;

use cart\Cart;
use factory\OrderFactory;
use repository\OrderRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;

class CreateOrderController extends Controller {

    private $cart;
    private $factory;
    private $repository;
    
    public function __construct() {
        $this->cart = new Cart();
        $this->factory = new OrderFactory();
        $this->repository = new OrderRepository();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && $request->getPath() === "/orders/api/v1";
    }

    public function handle(Request $request) {
        $elements = $this->cart->getAllProducts();

        $order = $this->factory->createOrderFromRequest($request);

        $order->setIsProcessed(0);
        $order->setElements($elements);

        $this->repository->persist($order);

        $this->cart->clear();

        return (new ResponseBuilder())->withStatusCodeOK()->build();
    }

    public function display(Response $response) {
        $response->redirectTo("/order/submitted");
    }

}
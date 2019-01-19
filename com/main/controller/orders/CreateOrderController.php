<?php

namespace controller;

use cart\Cart;
use factory\OrderFactory;
use repository\OrderRepository;
use request\Request;
use response\Response;
use response\ResponseBuilder;
use service\EmailService;
use entity\Product;
use entity\ProductInCart;
use exception\BadRequestException;
use repository\ProductRepository;
use session\SessionService;

class CreateOrderController extends Controller {

    private $cart;
    private $factory;
    private $repository;
    private $productRepository;
    private $emailService;
    private $sessionService;

    public function __construct() {
        $this->cart = new Cart();
        $this->factory = new OrderFactory();
        $this->repository = new OrderRepository();
        $this->productRepository = new ProductRepository();
        $this->emailService = new EmailService();
        $this->sessionService = new SessionService();
    }

    public function canHandle(Request $request) {
        return $request->isPOSTRequest() && $request->getPath() === "/orders/api/v1";
    }

    public function handle(Request $request) {
        $elements = $this->getOrderedProducts();
        if (count($elements) == 0) {
            throw new BadRequestException("There are no products in the cart.");
        }

        $elements = $this->convertEveryElementToArray($elements);

        $order = $this->factory->createOrderFromRequest($request);

        $order->setIsProcessed(0);
        $order->setElements($elements);
        $order->setUserId($this->sessionService->getAuthenticatedUser()->id());

        $this->repository->persist($order);

        $this->cart->clear();

        $this->emailService->sendEmail($order);

        return (new ResponseBuilder())->withRequest($request)->withStatusCodeOK()->build();
    }

    private function getOrderedProducts() {
        $productIds = array();
        
        $cartItems = $this->cart->getCartItems();
        foreach ($cartItems as $cartItem) {
            $productIds[] = $cartItem->productId();
        }

        if (count($productIds) == 0) {
            return array();
        }

        $dbResponse = $this->productRepository->byIds($productIds);
        
        if ($dbResponse->num_rows == 0) {
            return array();
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

        return $entities;
    }

    private function convertEveryElementToArray($elements) {
        $convertedElements = array();

        foreach ($elements as $element) {
            $convertedElements[] = $element->asArray();
        }

        return $convertedElements;
    }

    public function display(Response $response) {
        $response->redirectTo("/orders/api/v1?order=succeed");
    }

}
<?php

namespace entity;

class Order {

    private $id;
    private $userFirstName;
    private $userLastName;
    private $email;
    private $phone;
    private $address;
    private $comment;
    private $elements;
    private $isProcessed;
    private $orderDate;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->userFirstName = $data['user_first_name'];
        $this->userLastName = $data['user_last_name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->address = $data['address'];
        $this->comment = $data['comment'];
        $this->elements = $data['elements'];
        $this->isProcessed = $data['is_processed'];
        $this->orderDate = $data['order_date'];
    }

    public function id() {
        return $this->id;
    }
    
    public function userFirstName() {
        return $this->userFirstName;
    }
    
    public function userLastName() {
        return $this->userLastName;
    }
    
    public function email() {
        return $this->email;
    }
    
    public function phone() {
        return $this->phone;
    }
    
    public function address() {
        return $this->address;
    }
    
    public function comment() {
        return $this->comment;
    }
    
    public function elements() {
        return $this->elements;
    }

    public function setElements($elements) {
        $this->elements = $elements;
    }

    public function isProcessed() {
        return $this->isProcessed;
    }

    public function setIsProcessed($isProcessed) {
        $this->isProcessed = $isProcessed;
    }

    public function orderDate() {
        return $this->orderDate;
    }

}
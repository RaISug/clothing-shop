<?php

namespace entity;

class User {

    private $id;
    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $email;
    private $phone;
    private $roleId;

    public function __construct($data) {
        $this->id = $data['ID'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->firstname = $data['first_name'];
        $this->lastname = $data['last_name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->roleId = $data['role_id'];
    }

    public function id() {
        return $this->id;
    }

    public function username() {
        return $this->username;
    }

    public function password() {
        return $this->password;
    }

    public function firstname() {
        return $this->firstname;
    }

    public function lastname() {
        return $this->lastname;
    }

    public function email() {
        return $this->email;
    }
    
    public function phone() {
        return $this->phone;
    }

    public function roleId() {
        return $this->roleId;
    }
}
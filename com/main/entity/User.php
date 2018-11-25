<?php

namespace entity;

class User {

    private $id;
    private $username;
    private $password;
    private $firstname;
    private $lastname;

    public function __construct($data) {
        $this->id = $data['ID'];
        $this->username = $data['USERNAME'];
        $this->password = $data['PASSWORD'];
        $this->firstname = $data['FIRST_NAME'];
        $this->lastname = $data['LAST_NAME'];
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

}
<?php

namespace repository;

use entity\User;
use exception\InternalServerErrorException;

class UserRepository {

    private $connectionFactory;
    
    public function __construct() {
        $this->connectionFactory = new \ConnectionFactory();
    }

    public function persist(User $user) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("INSERT INTO users (username, password, first_name, last_name, email, phone, role_id) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $roleId = 0;

        $statement->bind_param("ssssssi", $user->username(), md5($user->password()), $user->firstname(), $user->lastname(), $user->email(), $user->phone(), $roleId);

        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create user");
        }
    }

    public function persistAsAdministrator(User $user) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("INSERT INTO users (username, password, first_name, last_name, email, phone, role_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $roleId = 1;

        $statement->bind_param("ssssssi", $user->username(), md5($user->password()), $user->firstname(), $user->lastname(), $user->email(), $user->phone(), $roleId);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create user");
        }
    }

    public function byUsernameAndPassword($username, $password) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("SELECT * FROM users WHERE USERNAME = ? AND PASSWORD = ?");

        $statement->bind_param("ss", $username, md5($password));

        $statement->execute();

        return $statement->get_result();
    }

    public function byUsername($username) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("SELECT * FROM users WHERE USERNAME = ?");
        
        $statement->bind_param("s", $username);
        
        $statement->execute();
        
        return $statement->get_result();
    }

}
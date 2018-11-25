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

        $statement = $connection->prepare("INSERT INTO users (USERNAME, PASSWORD, FIRST_NAME, LAST_NAME) VALUES (?, ?, ?, ?)");

        $statement->bind_param("ssss", $user->username(), md5($user->password()), $user->firstname(), $user->lastname());

        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create product");
        }
    }

    public function byUsernameAndPassword(string $username, string $password) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("SELECT * FROM users WHERE USERNAME = ? AND PASSWORD = ?");

        $statement->bind_param("ss", $username, md5($password));

        $statement->execute();

        return $statement->get_result();
    }

}
<?php

namespace repository;

use entity\Language;
use exception\InternalServerErrorException;

class LanguageRepository {
    
    private $connectionFactory;
    
    public function __construct() {
        $this->connectionFactory = new \ConnectionFactory();
    }

    public function all() {
        $connection = $this->connectionFactory->create();
        
        return $connection->query("SELECT * FROM languages");
    }
    
    public function persist(Language $language) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("INSERT INTO languages (name, is_default) VALUES (?, ?)");
        
        $statement->bind_param("si", $language->name(), $language->isDefault());
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create language");
        }
    }

    public function defaultLanguages() {
        $connection = $this->connectionFactory->create();
        
        return $connection->query("SELECT * FROM languages WHERE is_default = 1");
    }

    public function byName($name) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("SELECT * FROM languages WHERE name = ?");
        
        $statement->bind_param("s", $name);
        
        $statement->execute();

        return $statement->get_result();
    }

    public function byId($id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("SELECT * FROM languages WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        $statement->execute();
        
        return $statement->get_result();
    }

    public function deleteById($id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("DELETE FROM languages WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to delete language");
        }
    }

    public function update(Language $language) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("UPDATE languages SET name = ?, is_default = ? WHERE ID = ?");
        
        $statement->bind_param("sii", $language->name(), $language->isDefault(), $language->id());
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to update language");
        }
    }

}
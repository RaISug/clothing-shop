<?php

namespace repository;

use entity\Category;
use exception\InternalServerErrorException;
use session\SessionService;

class CategoryRepository {

    private $connectionFactory;
    private $sessionService;
    
    public function __construct() {
        $this->connectionFactory = new \ConnectionFactory();
        $this->sessionService = new SessionService();
    }

    public function all() {
        $connection = $this->connectionFactory->create();

        $language = $this->getLanguage();
        if ($language == null) {
            return $connection->query("SELECT * FROM categories");
        }

        return $connection->query("SELECT * FROM categories WHERE language_id = " . $language->id());
    }

    private function getLanguage() {
        return $this->sessionService->getAttribute("language");
    }

    public function menCategories() {
        $connection = $this->connectionFactory->create();
        
        $language = $this->getLanguage();
        if ($language == null) {
            return $connection->query("SELECT DISTINCT c.* FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = 'male'");
        }
        
        return $connection->query("SELECT DISTINCT c.* FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = 'male' AND p.language_id = " . $language->id());
    }

    public function womenCategories() {
        $connection = $this->connectionFactory->create();
        
        $language = $this->getLanguage();
        if ($language == null) {
            return $connection->query("SELECT DISTINCT c.* FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = 'female'");
        }
        
        return $connection->query("SELECT DISTINCT c.* FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = 'female' AND p.language_id = " . $language->id());
    }

    public function persist(Category $category) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("INSERT INTO categories (name, display_name, language_id) VALUES (?, ?, ?)");

        $statement->bind_param("ssi", $category->name(), $category->displayName(), $category->languageId());

        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create category");
        }
    }

    public function deleteById($id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("DELETE FROM categories WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to delete category");
        }
    }

}
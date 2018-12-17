<?php

namespace repository;

use entity\Category;
use exception\InternalServerErrorException;

class CategoryRepository {

    private $connectionFactory;
    
    public function __construct() {
        $this->connectionFactory = new \ConnectionFactory();
    }

    public function all() {
        $connection = $this->connectionFactory->create();

        return $connection->query("SELECT * FROM categories");
    }

    public function menCategories() {
        $connection = $this->connectionFactory->create();
        
        return $connection->query("SELECT DISTINCT c.* FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = 'male'");
    }

    public function womenCategories() {
        $connection = $this->connectionFactory->create();
        
        return $connection->query("SELECT DISTINCT c.* FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = 'female'");
    }

    public function persist(Category $category) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("INSERT INTO categories (name, display_name) VALUES (?, ?)");

        $statement->bind_param("ss", $category->name(), $category->displayName());

        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create category");
        }
    }

    public function deleteById(int $id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("DELETE FROM categories WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to delete category");
        }
    }

}
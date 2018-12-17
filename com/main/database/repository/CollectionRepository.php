<?php

namespace repository;

use entity\Collection;
use exception\InternalServerErrorException;

class CollectionRepository {
    
    private $connectionFactory;
    
    public function __construct() {
        $this->connectionFactory = new \ConnectionFactory();
    }
    
    public function all() {
        $connection = $this->connectionFactory->create();
        
        return $connection->query("SELECT * FROM collections");
    }
    
    public function persist(Collection $collection) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("INSERT INTO collections (image_name, title_name, description, technical_name) VALUES (?, ?, ?, ?)");
        
        $statement->bind_param("ssss", $collection->imageName(), $collection->titleName(), $collection->description(), $collection->technicalName());
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create collection");
        }
    }
    
    public function deleteById(int $id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("DELETE FROM collections WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to delete collections");
        }
    }

    public function addProductToCollection(int $productId, int $collectionId) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("INSERT INTO products_to_collections_mapping (product_id, collection_id) VALUES (?, ?)");
        
        $statement->bind_param("ii", $productId, $collectionId);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to add product into collection");
        }
    }

}
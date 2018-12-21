<?php

namespace repository;

use entity\Collection;
use exception\InternalServerErrorException;
use session\SessionService;

class CollectionRepository {
    
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
            return $connection->query("SELECT * FROM collections");
        }
        
        return $connection->query("SELECT * FROM collections WHERE language_id = " . $language->id());
    }
    
    private function getLanguage() {
        return $this->sessionService->getAttribute("language");
    }
    
    public function persist(Collection $collection) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("INSERT INTO collections (image_name, title_name, description, technical_name, language_id) VALUES (?, ?, ?, ?, ?)");
        
        $statement->bind_param("ssss", $collection->imageName(), $collection->titleName(), $collection->description(), $collection->technicalName(), $collection->languageId());
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create collection");
        }
    }
    
    public function deleteById($id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("DELETE FROM collections WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to delete collections");
        }
    }

    public function addProductToCollection($productId, $collectionId) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("INSERT INTO products_to_collections_mapping (product_id, collection_id) VALUES (?, ?)");
        
        $statement->bind_param("ii", $productId, $collectionId);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to add product into collection");
        }
    }

}
<?php

namespace repository;

use entity\Carousel;
use exception\InternalServerErrorException;

class CarouselRepository {

    private $connectionFactory;
    
    public function __construct() {
        $this->connectionFactory = new \ConnectionFactory();
    }

    public function all() {
        $connection = $this->connectionFactory->create();

        return $connection->query("SELECT * FROM carousel");
    }

    public function persist(Carousel $carousel) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("INSERT INTO carousel (image_name, description) VALUES (?, ?)");
        
        $statement->bind_param("ss", $carousel->imageName(), $carousel->description());
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create carousel");
        }
    }

    public function deleteById(int $id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("DELETE FROM carousel WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to delete carousel");
        }
    }
    
    public function byId(int $id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("SELECT * FROM carousel WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        $statement->execute();
        
        return $statement->get_result();
    }

}
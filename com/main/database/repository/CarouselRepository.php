<?php

namespace repository;

use entity\Carousel;
use exception\InternalServerErrorException;
use session\SessionService;

class CarouselRepository {

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
            return $connection->query("SELECT * FROM carousel");
        }

        return $connection->query("SELECT * FROM carousel WHERE language_id = " . $language->id());
    }

    private function getLanguage() {
        return $this->sessionService->getAttribute("language");
    }

    public function persist(Carousel $carousel) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("INSERT INTO carousel (image_name, description, language_id) VALUES (?, ?, ?)");
        
        $statement->bind_param("ssi", $carousel->imageName(), $carousel->description(), $carousel->languageId());
        
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
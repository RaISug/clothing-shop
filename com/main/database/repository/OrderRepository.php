<?php

namespace repository;

use entity\Order;
use exception\InternalServerErrorException;

class OrderRepository {

    private $connectionFactory;
    
    public function __construct() {
        $this->connectionFactory = new \ConnectionFactory();
    }

    public function persist(Order $order) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("INSERT INTO orders (user_first_name, user_last_name, email, phone, address, comment, elements, is_processed) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $statement->bind_param("sssssssi", $order->userFirstName(), $order->userLastName(), $order->email(), $order->phone(), $order->address(), $order->comment(), json_encode($order->elements()), $order->isProcessed());

        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create order");
        }
    }
    
    public function all(int &$page, int &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();
        
        if ($orderBy === null) {
            $statement = $connection->prepare("SELECT * FROM orders LIMIT ?,?");
        } else {
            $statement = $connection->prepare("SELECT * FROM orders ORDER BY " . $orderBy . " " . $orderingType . " LIMIT ?,?");
        }

        $startIndex = $page * $offset;

        $statement->bind_param("ii", $startIndex, $offset);

        $statement->execute();

        return $statement->get_result();
    }
    
    public function onlyNotProcessed(int &$page, int &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();
        
        if ($orderBy === null) {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 0 LIMIT ?,?");
        } else {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 0 ORDER BY " . $orderBy . " " . $orderingType . " LIMIT ?,?");
        }
        
        $startIndex = $page * $offset;
        
        $statement->bind_param("ii", $startIndex, $offset);
        
        $statement->execute();
        
        return $statement->get_result();
    }
    
    public function onlyNotProcessedBetweenDatetimes($from, $to, int &$page, int &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();
        
        if ($orderBy === null) {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 0 AND order_date between ? and ? LIMIT ?,?");
        } else {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 0 AND order_date between ? and ? ORDER BY " . $orderBy . " " . $orderingType . " LIMIT ?,?");
        }
        
        $startIndex = $page * $offset;
        
        $statement->bind_param("ssii", $from, $to, $startIndex, $offset);
        
        $statement->execute();
        
        return $statement->get_result();
    }
    
    public function onlyNotProcessedInDate($date, int &$page, int &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();
        
        if ($orderBy === null) {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 0 AND DATE(order_date) = ? LIMIT ?,?");
        } else {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 0 AND DATE(order_date) = ? ORDER BY " . $orderBy . " " . $orderingType . " LIMIT ?,?");
        }
        
        $startIndex = $page * $offset;
        
        $statement->bind_param("sii", $date, $startIndex, $offset);
        
        $statement->execute();
        
        return $statement->get_result();
    }
    
    public function countOfNotProcessed() {
        $connection = $this->connectionFactory->create();
        
        $query = $connection->query("SELECT COUNT(*) as orders_count FROM orders WHERE is_processed = 0");
        
        return $query->fetch_assoc()['orders_count'];
    }
    
    public function markAsNotProcessed(int $id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("UPDATE orders SET is_processed = 0 WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to update order");
        }
    }
    
    public function countOfProcessed() {
        $connection = $this->connectionFactory->create();
        
        $query = $connection->query("SELECT COUNT(*) as orders_count FROM orders WHERE is_processed = 1");
        
        return $query->fetch_assoc()['orders_count'];
    }
    
    public function onlyProcessedBetweenDatetimes($from, $to, int &$page, int &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();
        
        if ($orderBy === null) {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 1 AND order_date between ? and ? LIMIT ?,?");
        } else {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 1 AND order_date between ? and ? ORDER BY " . $orderBy . " " . $orderingType . " LIMIT ?,?");
        }
        
        $startIndex = $page * $offset;
        
        $statement->bind_param("ssii", $from, $to, $startIndex, $offset);
        
        $statement->execute();
        
        return $statement->get_result();
    }
    
    public function onlyProcessedInDate($date, int &$page, int &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();
        
        if ($orderBy === null) {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 1 AND DATE(order_date) = '?' LIMIT ?,?");
        } else {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 1 AND DATE(order_date) = '?' ORDER BY " . $orderBy . " " . $orderingType . " LIMIT ?,?");
        }
        
        $startIndex = $page * $offset;
        
        $statement->bind_param("sii", $date, $startIndex, $offset);
        
        $statement->execute();
        
        return $statement->get_result();
    }

    public function onlyProcessed(int &$page, int &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();
        
        if ($orderBy === null) {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 1 LIMIT ?,?");
        } else {
            $statement = $connection->prepare("SELECT * FROM orders WHERE is_processed = 1 ORDER BY " . $orderBy . " " . $orderingType . " LIMIT ?,?");
        }
        
        $startIndex = $page * $offset;
        
        $statement->bind_param("ii", $startIndex, $offset);
        
        $statement->execute();
        
        return $statement->get_result();
    }

    public function markAsProcessed(int $id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("UPDATE orders SET is_processed = 1 WHERE id = ?");
        
        $statement->bind_param("i", $id);
        
        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to update order");
        }
    }

    public function deleteById(int $id) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("DELETE FROM orders WHERE id = ?");

        $statement->bind_param("i", $id);

        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to delete order");
        }
    }

}
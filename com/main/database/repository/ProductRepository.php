<?php

namespace repository;

use entity\Product;
use exception\InternalServerErrorException;
use session\SessionService;

class ProductRepository {

    private $connectionFactory;
    private $sessionService;
    
    public function __construct() {
        $this->connectionFactory = new \ConnectionFactory();
        $this->sessionService = new SessionService();
    }

    public function all(&$page, &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();

        $language = $this->getLanguage();
        if ($language === null) {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        } else {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id AND p.language_id = " . $language->id() . " LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id AND p.language_id = " . $language->id() . " ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        }

        $startIndex = $page * $offset;

        $statement->bind_param("ii", $startIndex, $offset);

        $statement->execute();

        return $statement->get_result();
    }
    
    private function getLanguage() {
        return $this->sessionService->getAttribute("language");
    }

    public function count() {
        $connection = $this->connectionFactory->create();

        $language = $this->getLanguage();
        if ($language === null) {
            $query = $connection->query("SELECT COUNT(*) as products_count FROM products");
        } else {
            $query = $connection->query("SELECT COUNT(*) as products_count FROM products WHERE language_id = " . $language->id());
        }

        return $query->fetch_assoc()['products_count'];
    }

    public function countOfItemsInCategory($category) {
        $connection = $this->connectionFactory->create();

        $language = $this->getLanguage();
        if ($language === null) {
            $statement = $connection->prepare("SELECT COUNT(*) as products_count FROM products p JOIN categories c ON p.category_id = c.id WHERE c.name = ?");
        } else {
            $statement = $connection->prepare("SELECT COUNT(*) as products_count FROM products p JOIN categories c ON p.category_id = c.id WHERE c.name = ? AND p.language_id = " . $language->id());
        }

        $statement->bind_param("s", $category);

        $statement->execute();

        return $statement->get_result()->fetch_assoc()['products_count'];
    }
    
    public function countOfItemsInType($type) {
        $connection = $this->connectionFactory->create();
        
        $language = $this->getLanguage();
        if ($language === null) {
            $statement = $connection->prepare("SELECT COUNT(*) as products_count FROM products WHERE type = ?");
        } else {
            $statement = $connection->prepare("SELECT COUNT(*) as products_count FROM products WHERE type = ? AND language_id = " . $language->id());
        }
        
        $statement->bind_param("s", $type);
        
        $statement->execute();
        
        return $statement->get_result()->fetch_assoc()['products_count'];
    }

    public function countOfItemsInCollection($collection) {
        $connection = $this->connectionFactory->create();
        
        $language = $this->getLanguage();
        if ($language === null) {
            $statement = $connection->prepare("SELECT COUNT(*) as products_count FROM products p JOIN products_to_collections_mapping pcm ON pcm.product_id = p.id JOIN collections c ON c.id = pcm.collection_id WHERE c.technical_name = ?");
        } else {
            $statement = $connection->prepare("SELECT COUNT(*) as products_count FROM products p JOIN products_to_collections_mapping pcm ON pcm.product_id = p.id JOIN collections c ON c.id = pcm.collection_id WHERE c.technical_name = ? AND p.language_id = " . $language->id());
        }
        
        $statement->bind_param("s", $collection);
        
        $statement->execute();
        
        return $statement->get_result()->fetch_assoc()['products_count'];
    }

    public function countOfItemsForTypeInCategory($type, $category) {
        $connection = $this->connectionFactory->create();
        
        $language = $this->getLanguage();
        if ($language === null) {
            $statement = $connection->prepare("SELECT COUNT(*) as products_count FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? AND c.name = ?");
        } else {
            $statement = $connection->prepare("SELECT COUNT(*) as products_count FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? AND c.name = ? AND p.language_id = " . $language->id());
        }
        
        $statement->bind_param("ss", $type, $category);
        
        $statement->execute();
        
        return $statement->get_result()->fetch_assoc()['products_count'];
    }

    public function byId($id) {
        $connection = $this->connectionFactory->create();
        
        $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.ID = ?");

        $statement->bind_param("i", $id);

        $statement->execute();

        return $statement->get_result();
    }

    public function byIds($ids) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.ID IN (" . $this->constructInClause($ids) . ")");

        $this->bindIdsToStatement($ids, $statement);

        $statement->execute();
        
        return $statement->get_result();
    }

    private function constructInClause($ids) {
        return implode(',', array_fill(0, count($ids), '?'));
    }

    private function bindIdsToStatement($ids, $statement) {
        $parameterTypes = '';
        $parameters = array();
        
        for ($i = 0 ; $i < count($ids) ; $i++) {
            $parameterTypes .= 'i';
            $parameters[$i] = &$ids[$i];
        }

        array_unshift($parameters, $parameterTypes);

        call_user_func_array([$statement, 'bind_param'], $parameters);
    }

    public function byType($type, &$page, &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();

        $language = $this->getLanguage();
        if ($language === null) {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        } else {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? AND p.language_id = " . $language->id() . " LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? AND p.language_id = " . $language->id() . " ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        }

        $startIndex = $page * $offset;

        $statement->bind_param("sii", $type, $startIndex, $offset);

        $statement->execute();

        return $statement->get_result();
    }

    public function byCategory($category, &$page, &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();

        $language = $this->getLanguage();
        if ($language === null) {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE c.name = ? LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE c.name = ? ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        } else {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE c.name = ? AND p.language_id = " . $language->id() . " LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE c.name = ? AND p.language_id = " . $language->id() . " ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        }

        $startIndex = $page * $offset;

        $statement->bind_param("sii", $category, $startIndex, $offset);

        $statement->execute();

        return $statement->get_result();
    }

    public function byCollection($collection, &$page, &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();
        
        $language = $this->getLanguage();
        if ($language === null) {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.* FROM products p JOIN products_to_collections_mapping pcm ON pcm.product_id = p.id JOIN collections c ON c.id = pcm.collection_id WHERE c.technical_name = ? LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.* FROM products p JOIN products_to_collections_mapping pcm ON pcm.product_id = p.id JOIN collections c ON c.id = pcm.collection_id WHERE c.technical_name = ? ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        } else {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.* FROM products p JOIN products_to_collections_mapping pcm ON pcm.product_id = p.id JOIN collections c ON c.id = pcm.collection_id WHERE c.technical_name = ? AND p.language_id = " . $language->id() . " LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.* FROM products p JOIN products_to_collections_mapping pcm ON pcm.product_id = p.id JOIN collections c ON c.id = pcm.collection_id WHERE c.technical_name = ? AND p.language_id = " . $language->id() . " ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        }
        
        $startIndex = $page * $offset;
        
        $statement->bind_param("sii", $collection, $startIndex, $offset);
        
        $statement->execute();
        
        return $statement->get_result();
    }

    public function byTypeAndCategory($type, $category, &$page, &$offset, $orderBy, $orderingType) {
        $connection = $this->connectionFactory->create();

        $language = $this->getLanguage();
        if ($language === null) {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? AND c.name = ? LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? AND c.name = ? ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        } else {
            if ($orderBy === null) {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? AND c.name = ? AND p.language_id = " . $language->id() . " LIMIT ?,?");
            } else {
                $statement = $connection->prepare("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id = c.id WHERE p.type = ? AND c.name = ? AND p.language_id = " . $language->id() . " ORDER BY p." . $orderBy . " " . $orderingType . " LIMIT ?,?");
            }
        }

        $startIndex = $page * $offset;

        $statement->bind_param("ssii", $type, $category, $startIndex, $offset);

        $statement->execute();

        return $statement->get_result();
    }

    public function persist(Product $product) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("INSERT INTO products (name, type, price, image_name, category_id, description, promotional_price, available_sizes, language_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $statement->bind_param("ssdsisdsi", $product->name(), $product->type(), $product->price(), $product->imageName(), $product->categoryId(), $product->description(), $product->promotionalPrice(), $product->availableSizes(), $product->languageId());

        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to create product");
        }
    }

    public function update(Product $product) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("UPDATE products SET name = ?, type = ?, category_id = ?, price = ?, image_name = ?, description = ?, promotional_price = ?, available_sizes = ?, language_id = ? WHERE ID = ?");

        $statement->bind_param("ssidssdsii", $product->name(), $product->type(), $product->categoryId(), $product->price(), $product->imageName(), $product->description(), $product->promotionalPrice(), $product->availableSizes(), $product->languageId(), $product->id());

        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to update product");
        }
    }

    public function deleteById($id) {
        $connection = $this->connectionFactory->create();

        $statement = $connection->prepare("DELETE FROM products WHERE ID = ?");

        $statement->bind_param("i", $id);

        if ($statement->execute() === FALSE) {
            throw new InternalServerErrorException("Failed to delete product");
        }
    }

}
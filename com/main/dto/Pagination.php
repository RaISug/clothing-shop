<?php

namespace dto;

class Pagination {

    private $entities;
    private $total;
    private $nextPage;
    private $pageSize;
    private $orderBy;
    private $orderingType;

    public function __construct($entities, $total, $nextPage, $pageSize, $orderBy, $orderingType) {
        $this->entities = $entities;
        $this->total = $total;
        $this->nextPage = $nextPage;
        $this->pageSize = $pageSize;
        $this->orderBy = $orderBy;
        $this->orderingType = $orderingType;
    }

    public function entities() {
        return $this->entities;
    }

    public function total() {
        return $this->total;
    }

    public function pageSize() {
        return $this->pageSize;
    }

    public function nextPage() {
        return $this->nextPage;
    }

    public function orderBy() {
        return $this->orderBy;
    }

    public function orderingType() {
        return $this->orderingType;
    }

    public function currentPage() {
        return $this->nextPage - 1;
    }

    public function hasPreviousPage() {
        return $this->currentPage() > 0;
    }

    public function calculatePagesCount() {
        return ceil($this->total / $this->pageSize);
    }

    public function hasMorePages() {
        return $this->total > $this->nextPage * $this->pageSize;
    }
    
    public function construcPaginationQueryPathForPage($page) {
        $path = "page=" . $page . "&offset=" . $this->pageSize;

        if ($this->orderBy !== null) {
            $path .= "&orderBy=" . $this->orderBy . "&orderingType=" . $this->orderingType;
        }

        return $path;
    }

    public function constructPreviousPagePaginationQueryPath() {
        $path = "page=" . ($this->nextPage - 2) . "&offset=" . $this->pageSize;
        
        if ($this->orderBy !== null) {
            $path .= "&orderBy=" . $this->orderBy . "&orderingType=" . $this->orderingType;
        }
        
        return $path;
    }

    public function constructNextPagePaginationQueryPath() {
        $path = "page=" . $this->nextPage . "&offset=" . $this->pageSize;

        if ($this->orderBy !== null) {
            $path .= "&orderBy=" . $this->orderBy . "&orderingType=" . $this->orderingType;
        }

        return $path; 
    }

}
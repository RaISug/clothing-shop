<?php

namespace service;

use request\Request;

class OrderingService {

    public function getOrderedBy(Request $request) {
        $orderBy = $request->getQueryParameter("orderBy");
        if ($orderBy === "price") {
            return "price";
        }

        return null;
    }

    public function getOrderingType(Request $request) {
        $orderingType = $request->getQueryParameter("orderingType");
        if ($orderingType === "DESC") {
            return "DESC";
        }

        return "ASC";
    }
}
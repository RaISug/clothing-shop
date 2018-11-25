<?php

namespace factory;

use request\Request;
use entity\Product;

class ProductFactory {

    public function createProductFromRequest(Request $request) {
        $data = array(
            'ID' => $request->getParameter("id"),
            'NAME' => $request->getParameter("name"),
            'type' => $request->getParameter("type"),
            'category_id' => $request->getParameter("category_id"),
            'price' => $request->getParameter("price"),
            'image_name' => $request->getFiles("productimage")->getUniqueNames()
        );

        return new Product($data);
    }

}
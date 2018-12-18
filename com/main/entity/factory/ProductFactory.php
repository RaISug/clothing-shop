<?php

namespace factory;

use request\Request;
use entity\Product;

class ProductFactory {

    public function createProductFromRequest(Request $request) {
        $data = array(
            'ID' => $request->getParameter("id"),
            'name' => $request->getParameter("name"),
            'type' => $request->getParameter("type"),
            'category_id' => $request->getParameter("category_id"),
            'price' => $request->getParameter("price"),
//             'image_name' => $request->getFiles("productimage")->getUniqueNames(),
            'description' => $request->getParameter("description"),
            'promotional_price' => $request->getParameter("promotional_price"),
            'available_sizes' => $request->getMultiValueParameterAsStringDelimitedWithSemicolon("available_sizes")
        );

        return new Product($data);
    }

}
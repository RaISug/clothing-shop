<?php

namespace factory;

use request\Request;
use entity\Category;

class CategoryFactory {
    
    public function createCategoryFromRequest(Request $request) {
        $data = array(
            'name' => $request->getParameter("name"),
            'display_name' => $request->getParameter("display_name"),
            'language_id' => $request->getParameter("language_id")
        );
        
        return new Category($data);
    }
    
}
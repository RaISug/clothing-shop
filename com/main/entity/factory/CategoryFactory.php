<?php

namespace factory;

use request\Request;
use entity\Category;

class CategoryFactory {
    
    public function createCategoryFromRequest(Request $request) {
        $data = array(
            'name' => $request->getParameter("name")
        );
        
        return new Category($data);
    }
    
}
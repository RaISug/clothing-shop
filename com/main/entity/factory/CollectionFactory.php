<?php

namespace factory;

use entity\Collection;
use request\Request;

class CollectionFactory {
    
    public function createCollectionFromRequest(Request $request) {
        $data = array(
            'image_name' => $request->getFile("collectionimage")->getUniqueName(),
            'title_name' => $request->getParameter("title_name"),
            'description' => $request->getParameter("description"),
            'technical_name' => $request->getParameter("technical_name"),
            'language_id' => $request->getParameter("language_id")
        );
        
        return new Collection($data);
    }
    
}
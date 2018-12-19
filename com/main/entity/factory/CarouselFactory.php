<?php

namespace factory;

use entity\Carousel;
use request\Request;

class CarouselFactory {
    
    public function createCarouselFromRequest(Request $request) {
        $data = array(
            'image_name' => $request->getFile("carouselimage")->getUniqueName(),
            'description' => $request->getParameter("description"),
            'language_id' => $request->getParameter("language_id")
        );
        
        return new Carousel($data);
    }
    
}
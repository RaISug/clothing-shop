<?php

namespace factory;

use entity\Carousel;
use request\Request;

class CarouselFactory {
    
    public function createCarouselFromRequest(Request $request) {
        $data = array(
            'image_name' => $request->getFile("carouselimage")->getUniqueName(),
            'description' => $request->getParameter("description")
        );
        
        return new Carousel($data);
    }
    
}
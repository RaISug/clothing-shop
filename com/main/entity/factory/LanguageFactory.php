<?php

namespace factory;

use request\Request;
use entity\Language;

class LanguageFactory {
    
    public function createLanguageFromRequest(Request $request) {
        $data = array(
            'name' => $request->getParameter("name"),
            'is_default' => $request->getParameter("is_default") === "on" ? 1 : 0
        );

        return new Language($data);
    }
}
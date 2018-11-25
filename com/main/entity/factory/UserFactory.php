<?php

namespace factory;

use request\Request;
use entity\User;

class UserFactory {

    public function createUserFromRequest(Request $request) {
        $data = array(
            'USERNAME' => $request->getParameter("username"),
            'PASSWORD' => $request->getParameter("password"),
            'FIRST_NAME' => $request->getParameter("firstname"),
            'LAST_NAME' => $request->getParameter("lastname")
        );

        return new User($data);
    }

}
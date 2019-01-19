<?php

namespace factory;

use request\Request;
use entity\User;

class UserFactory {

    public function createUserFromRequest(Request $request) {
        $data = array(
            'username' => $request->getParameter("username"),
            'password' => $request->getParameter("password"),
            'first_name' => $request->getParameter("firstname"),
            'last_name' => $request->getParameter("lastname"),
            'email' => $request->getParameter("email"),
            'phone' => $request->getParameter("phone")
        );

        return new User($data);
    }

}
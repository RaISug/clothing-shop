<?php

namespace factory;

use request\Request;
use entity\Order;

class OrderFactory {

    public function createOrderFromRequest(Request $request) {
        $data = array(
            'user_first_name' => $request->getParameter('user_first_name'),
            'user_last_name' => $request->getParameter('user_last_name'),
            'email' => $request->getParameter('email'),
            'phone' => $request->getParameter('phone'),
            'address' => $request->getParameter('address'),
            'comment' => $request->getParameter('comment'),
            'is_processed' => $request->getParameter('is_processed')
        );

        return new Order($data);
    }

}
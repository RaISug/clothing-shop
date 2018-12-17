<?php

namespace service;

use entity\Order;

class EmailService {

    private $smtpinfo;

    public function __construct() {
        $this->smtpinfo = array();

        $this->smtpinfo["host"] = "smtp.server.com";
        $this->smtpinfo["port"] = "25";
        $this->smtpinfo["auth"] = true;
        $this->smtpinfo["username"] = "smtp_user";
        $this->smtpinfo["password"] = "smtp_password";
    }

    public function sendEmail() {
        $recipients = 'julieta.gosheva@gmail.com';
        
//         $headers = array();
        
//         $headers['From']    = 'radoslav.i.sugarev@gmail.com';
//         $headers['To']      = 'julieta.gosheva@gmail.com';
//         $headers['Subject'] = 'Order confirmation';
        
        $headers = 'From: radoslav.i.sugarev@gmail.com' . "\r\n";
        
        $body = 'Your order was received';
        
        mail("julieta.gosheva@gmail.com", "Order confirmation", $body, $headers);
    }

    
}
<?php

namespace service;

use entity\Order;
use PHPMailer\PHPMailer\PHPMailer;

class EmailService {

    private $smtpinfo;

    public function __construct() {
        $this->smtpinfo = array();

        $this->smtpinfo["host"] = "smtp.gmail.com";
        $this->smtpinfo["port"] = "587";
        $this->smtpinfo["auth"] = true;
        $this->smtpinfo["username"] = "";
        $this->smtpinfo["password"] = "";
        $this->smtpinfo["protocol"] = "tls";
    }

    public function sendEmail(Order $order) {
        $mailer = new PHPMailer();

        $mailer->IsSMTP();

        $mailer->SMTPDebug = 0;
        $mailer->Host = $this->smtpinfo["host"];
        $mailer->Port = $this->smtpinfo["port"];
        $mailer->SMTPAuth = $this->smtpinfo["auth"];
        $mailer->Username = $this->smtpinfo["username"];
        $mailer->Password = $this->smtpinfo["password"];
        $mailer->SMTPSecure = $this->smtpinfo["protocol"];
        $mailer->CharSet = "UTF-8";
        
        $mailer->setFrom('', 'Web Shop Administrator');
        $mailer->addAddress($order->email());
        
        $mailer->isHTML(true);
        $mailer->Subject = 'Потвърдена поръчка';
        $mailer->Body    = $this->constructBody($order);
        $mailer->AltBody = 'Поръчката ви беше успешно потвърдена';
        
        $mailer->send();
    }

    private function constructBody(Order $order) {
        $builder = new TableBuilder();

        $builder->withHeader("Име на продукта");
        $builder->withHeader("Размер");
        $builder->withHeader("Количество");
        $builder->withHeader("Цена");

        $finalPrice = 0;

        $products = $order->elements();
        foreach ($products as $product) {
            $builder->withRowValue($product["name"]);
            $builder->withRowValue($product["size"]);
            $builder->withRowValue($product["quantity"]);

            $price = $product["promotional_price"] == 0 ? $product["price"] : $product["promotional_price"];

            $builder->withRowValue($price);

            $finalPrice += $price * $product['quantity'];

            $builder->newRow();
        }

        $builder->withRowValue("");
        $builder->withRowValue("");
        $builder->withRowValue("");
        $builder->withRowValue($finalPrice);

        return $builder->build();
    }

}
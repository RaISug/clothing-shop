<?php

class ConnectionFactory {
    
    public function create() {
        return new mysqli("localhost", "root", "", "CLOTHING_SHOP");
    }

}
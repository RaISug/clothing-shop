<?php

class ConnectionFactory {
    
    public function create() {
        return new mysqli("localhost", "radoslav", "", "CLOTHING_SHOP");
    }

}
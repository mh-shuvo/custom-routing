<?php

namespace RouterApplication\Controller;

class PriceController{
    private static $instance;

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function showPrice(){
        echo "<br/>Price is 10 TK</br>";
    }

    public function getPrice($price){
        echo "<br/>Price is {$price} TK</br>";
    }
}

?>
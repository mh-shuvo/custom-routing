<?php
require "Router.php";

use RouterApplication\Controller\PriceController;
use RouterApplication\Router;

Router::get('/',function(){
    echo "Welcome to home page";
});

Router::get('/user/(\w+)',function($name){
    echo "current user: {$name}";
});

Router::get('/number/(\w+)',function($number){
    echo $number*5;
});

Router::get('/class',function(){
    echo "You are a class of Engineering";
});

Router::post('/class',function(){
    echo "Class Successfully Added";
});

Router::delete('/class',function(){
    echo "Class Successfully Deletd";
});

Router::get('/price',[PriceController::class,'showPrice']);
Router::get('/price/(\w+)',"PriceController@getPrice");




Router::notfound();


?>
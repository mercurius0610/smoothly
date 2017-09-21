<?php
namespace App;

use Controllers;

class Request {

    private static $controller;
    
    public static function set($class, $interceptor) {

        self::$controller = $class;
        if(class_exists("Controllers\\" . $class)) {
            $class = "Controllers\\" . $class;
        }else {
            $class = "Controllers\\404";
        }
        self::$controller = new $class();

    }

    public static function get_controller() {
        return self::$controller;
    }

    private static $parameters;
    
    public static function get_parameters() {
    }

    public static function set_parameters() {
    }

}

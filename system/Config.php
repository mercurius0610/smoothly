<?php
namespace App;

class Config {
    static private $configures = [];

    public static function get($name, $type = "common") {

        if(isset(self::$configures[$type])) {
            $config = self::$configures[$type];
        }else {
            $config = self::load($type);
            self::$configures[$type] = $config;
        }

        return $config[$name];

    }

    public static function list($type) {

        if(isset(self::$configures[$type])) {
            $config = self::$configures[$type];
        }else {
            $config = self::load($type);
            self::$configures[$type] = $config;
        }
        return $config;
    }

    public static function load($type) {

        $config = [];
        if (file_exists( ROOT_PATH . "config/$type.php" )) {
            include( ROOT_PATH . "config/$type.php" );
        }
        return $config;
    }
}

<?php
namespace App;

class Route {

    const CONFIG_ROUTE = 'route';

    const REGEX_FUNCTION = 'preg_match';

    private static $mappings;

    public static function get($path = ''){
        if($path && self::$mappings[$path]) {
            return self::$mappings[$path];
        }else {
            return self::mapping();
        }
    }

    public static function set($path, $class, $method = null, $interceptor = null){
        $mappings = self::$mappings;
        $mappings[$path] = [
            'class' => $class,
            'method' => $method,
            'interceptor' => $interceptor,
        ];
        self::$mappings = $mappings;
    }

    public static function mapping() {

        Config::list(self::CONFIG_ROUTE);
        $uri = $_SERVER['REQUEST_URI'];
        $reguest_method = $_SERVER['REQUEST_METHOD'];
        $regex_function = self::REGEX_FUNCTION;
        foreach(self::$mappings as $path => $config) {

            $pattern = preg_replace('/\{\w+?\}/', '(\w+)', $path);
            if(preg_match("@^" . $pattern . "$@", $uri, $uri_mathes) ) {

                if($config['method'] && $config['method'] != $reguest_method) {
                    Request::set(405);
                    break;
                }
                Request::set($config['class'], $config['interceptor']);
                if($pattern != $path) {
                    preg_match_all('/\{(.*?)\}/', $path, $route_mathes);
                    foreach($route_mathes[1] as $k=>$key) {
                        $k++;
                        if($uri_mathes[$k]) {
#                            print_r(array($key, $uri_mathes[$k]));
                            Request::set_parameters($key, $uri_mathes[$k]);
                        }
                    }
                }
                break;
            }
#            print_r($params);
#            print "\n";
#            print_r($mathes);
#            print "\n";
        }

        return Request::get_controller();
#        print_r(self::$mappings);
#        print_r($_SERVER);
    }

    public static function bind_parameters($d) {

    }

}

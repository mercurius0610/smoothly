<?php
namespace App;

class App {

    public function __construct() {
    }



    public function execute() {

        $this->prepare();
        $this->run();

    }

    private function prepare() {

        Route::mapping();

    }

    private function run() {

        // debug
        // performance
        // db factory
        // interceptor
        Request::get_controller()->handle();
        // views

    }


}

return new App;

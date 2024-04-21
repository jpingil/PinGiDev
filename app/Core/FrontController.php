<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            Route::add('/AboutMe',
                    function () {
                        echo "Hola";
                    }
                    , 'get');
//
//        Route::pathNotFound(
//            function () {
//                header('location: /AboutMe');
//            }
//        );    
        }

        Route::pathNotFound(
                function () {
                    $controller = new \Com\Daw2\Controllers\ErroresController();
                    $controller->error404();
                }
        );

        Route::methodNotAllowed(
                function () {
                    $controller = new \Com\Daw2\Controllers\ErroresController();
                    $controller->error405();
                }
        );

        Route::run();
    }
}

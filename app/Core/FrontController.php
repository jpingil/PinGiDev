<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            Route::add('/AboutMe',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AboutMeController();
                        $controlador->seeAbouMe();
                    }
                    , 'get');

            Route::add('/Products',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\ProductController();
                        $controlador->seeProducts();
                    }
                    , 'get');

            Route::add('/LoginRegister',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\LoginRegisterController();
                        $controlador->seeLoginRegister();
                    }
                    , 'get');

            Route::add('/CustomProduct',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\LoginRegisterController();
                        $controlador->seeLoginRegister();
                    }
                    , 'get');

            Route::add('/Favorites',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\LoginRegisterController();
                        $controlador->seeLoginRegister();
                    }
                    , 'get');

            Route::pathNotFound(
                    function () {
                        header("Location: /AboutMe");   
                    }
            );
        } else {
            Route::add('/CustomProduct',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\CustomProductController();
                        $controlador->seeCustomProduct();
                    }
                    , 'get');
        }

        Route::run();
    }
}

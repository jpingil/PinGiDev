<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
        session_start();

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

        if (!isset($_SESSION['user'])) {
            Route::add('/LoginRegister',
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
            Route::add('/CustomProduct',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\LoginRegisterController();
                        $controlador->seeLoginRegister();
                    }
                    , 'get');

            Route::add('/Register',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\LoginRegisterController();
                        $controlador->processRegister();
                    }
                    , 'post');

            Route::add('/Login',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\LoginRegisterController();
                        $controlador->processLogin();
                    }
                    , 'post');
        } else {
            Route::add('/CustomProduct',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\CustomProductController();
                        $controlador->seeCustomProduct();
                    }
                    , 'get');

            Route::add('/Logout',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\LoginRegisterController();
                        $controlador->logout();
                    }
                    , 'get');
        }

        Route::pathNotFound(
                function () {
                    header("Location: /AboutMe");
                }
        );

        Route::run();
    }
}

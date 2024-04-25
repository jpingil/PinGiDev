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

        if (isset($_SESSION['user'])) {
            Route::add('/CustomProduct',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\CustomProductController();
                        $controlador->seeCustomProduct();
                    }
                    , 'get');

            Route::add('/Logout',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->logout();
                    }
                    , 'get');

            if ($_SESSION['user']['rol_name'] == 'admin') {
                Route::add('/Management',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->seeUsers();
                        }
                        , 'get');

                Route::add('/AdminUsers',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->seeUsers();
                        }
                        , 'get');

                Route::add('/AdminUsers/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->seeAdd();
                        }
                        , 'get');

                Route::add('/AdminProducts',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->seeAdminProducts();
                        }
                        , 'get');

                Route::add('/AdminProducts/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->seeAdd();
                        }
                        , 'get');

                Route::add('/AdminProducts/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->processAdd();
                        }
                        , 'post');
            }
        } else {
            Route::add('/LoginRegister',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->seeLoginRegister();
                    }
                    , 'get');

            Route::add('/Favorites',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->seeLoginRegister();
                    }
                    , 'get');
            Route::add('/CustomProduct',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->seeLoginRegister();
                    }
                    , 'get');

            Route::add('/Register',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->processRegister();
                    }
                    , 'post');

            Route::add('/Login',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->processLogin();
                    }
                    , 'post');
        }


        Route::pathNotFound(
                function () {
                    header("Location: /AboutMe");
                }
        );

        Route::run();
    }
}
